<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

$host = "localhost";
$dbname = "hostel";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit();
}

$conn->set_charset("utf8mb4");

$DEFAULT_ROLL_NUMBER = '927623bit203';
$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {
    case 'get_student_dashboard':
        getStudentDashboard($conn);
        break;
    case 'get_daily_menu':
        getDailyMenu($conn);
        break;
    case 'get_available_special_tokens':
        getAvailableSpecialTokens($conn);
        break;
    case 'get_my_tokens':
        getMyTokens($conn);
        break;
    case 'get_monthly_bill':
        getMonthlyBill($conn);
        break;
    case 'request_special_token':
        requestSpecialToken($conn);
        break;
    case 'get_token_historys':
        getTokenHistorys($conn);
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        break;
}

function getStudentDashboard($conn)
{
    global $DEFAULT_ROLL_NUMBER;
    $rollnumber = $_POST['roll_number'] ?? $DEFAULT_ROLL_NUMBER;

    try {
        $stats = [];

        $sql = "SELECT name FROM students WHERE roll_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $rollnumber);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stats['student_name'] = $row ? $row['name'] : 'Unknown';
        $stmt->close();

        $sql = "SELECT COUNT(*) as count FROM mess_tokens WHERE roll_number = ? AND token_type = 'Special'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $rollnumber);
        $stmt->execute();
        $result = $stmt->get_result();
        $stats['total_special_tokens'] = $result->fetch_assoc()['count'];
        $stmt->close();

        $currentMonth = date('Y-m');
        $sql = "SELECT COALESCE(SUM(special_fee), 0) as total FROM mess_tokens WHERE roll_number = ? AND token_type = 'Special' AND DATE_FORMAT(token_date, '%Y-%m') = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $rollnumber, $currentMonth);
        $stmt->execute();
        $result = $stmt->get_result();
        $stats['monthly_bill'] = $result->fetch_assoc()['total'];
        $stmt->close();

        $sql = "SELECT COUNT(*) as count FROM specialtokenenable WHERE status = 'active' AND token_date >= CURDATE()";
        $result = $conn->query($sql);
        $stats['available_tokens'] = $result->fetch_assoc()['count'];

        echo json_encode(['success' => true, 'data' => $stats]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function getDailyMenu($conn)
{
    $date = $_POST['date'] ?? date('Y-m-d');

    try {
        $sql = "SELECT 
                    menu_id,
                    date,
                    meal_type,
                    items,
                    fee
                FROM mess_menu 
                WHERE date = ? 
                ORDER BY FIELD(meal_type, 'Breakfast', 'Lunch', 'Snacks', 'Dinner')";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $date);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[] = [
                'menu_id' => (int)$row['menu_id'],
                'date' => $row['date'],
                'meal_type' => $row['meal_type'],
                'items' => $row['items'],
                'fee' => number_format((float)$row['fee'], 2, '.', '')
            ];
        }

        $stmt->close();
        echo json_encode(['success' => true, 'data' => $data, 'total_items' => count($data)]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function getAvailableSpecialTokens($conn)
{
    try {
        $today = date('Y-m-d');
        $sql = "SELECT 
                    st.menu_id,
                    st.from_date,
                    st.from_time,
                    st.to_date,
                    st.to_time,
                    st.token_date,
                    st.meal_type,
                    st.menu_items,
                    st.fee,
                    st.status,
                    CASE 
                        WHEN st.to_date < ? THEN 'expired'
                        WHEN st.from_date <= ? AND st.to_date >= ? THEN 'open'
                        ELSE 'coming_soon'
                    END as request_status,
                    COUNT(mt.token_id) as requests_made
                FROM specialtokenenable st
                LEFT JOIN mess_tokens mt ON st.menu_id = mt.menu_id
                WHERE st.status = 'active'
                AND st.token_date >= ?
                GROUP BY st.menu_id
                ORDER BY st.token_date ASC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $today, $today, $today, $today);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[] = [
                'menu_id' => (int)$row['menu_id'],
                'from_date' => $row['from_date'],
                'from_time' => substr($row['from_time'], 0, 5),
                'to_date' => $row['to_date'],
                'to_time' => substr($row['to_time'], 0, 5),
                'token_date' => $row['token_date'],
                'meal_type' => $row['meal_type'],
                'menu_items' => $row['menu_items'],
                'fee' => number_format((float)$row['fee'], 2, '.', ''),
                'status' => $row['status'],
                'request_status' => $row['request_status'],
                'requests_made' => (int)$row['requests_made']
            ];
        }

        $stmt->close();
        echo json_encode(['success' => true, 'data' => $data, 'total_items' => count($data)]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function getMyTokens($conn)
{
    global $DEFAULT_ROLL_NUMBER;
    $rollnumber = $_POST['roll_number'] ?? $DEFAULT_ROLL_NUMBER;
    $month = $_POST['month'] ?? date('Y-m');

    try {
        if (empty($rollnumber)) {
            echo json_encode(['success' => false, 'message' => 'Roll number required']);
            return;
        }

        $sql = "SELECT 
                    mt.token_id,
                    mt.meal_type,
                    COALESCE(mt.menu, 'N/A') as menu_items,
                    mt.special_fee as fee,
                    mt.token_date,
                    DATE_FORMAT(mt.created_at, '%Y-%m-%d %H:%i:%s') as requested_at,
                    CASE 
                        WHEN mt.token_date < CURDATE() THEN 'consumed'
                        WHEN mt.token_date = CURDATE() THEN 'today'
                        ELSE 'upcoming'
                    END as token_status
                FROM mess_tokens mt
                LEFT JOIN specialtokenenable st ON mt.menu_id = st.menu_id
                WHERE mt.roll_number = ? 
                  AND mt.token_type = 'Special'
                  AND DATE_FORMAT(mt.token_date, '%Y-%m') = ?
                ORDER BY mt.token_date DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $rollnumber, $month);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[] = [
                'token_id' => (int)$row['token_id'],
                'meal_type' => $row['meal_type'],
                'menu_items' => $row['menu_items'],
                'fee' => number_format((float)$row['fee'], 2, '.', ''),
                'token_date' => $row['token_date'],
                'requested_at' => $row['requested_at'],
                'token_status' => $row['token_status']
            ];
        }

        $stmt->close();
        echo json_encode(['success' => true, 'data' => $data, 'total_items' => count($data)]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function getMonthlyBill($conn)
{
    global $DEFAULT_ROLL_NUMBER;
    $rollnumber = $_POST['roll_number'] ?? $DEFAULT_ROLL_NUMBER;
    $month = $_POST['month'] ?? date('Y-m');

    try {
        if (empty($rollnumber)) {
            echo json_encode(['success' => false, 'message' => 'Roll number required']);
            return;
        }

        $sql = "SELECT 
                    s.name,
                    s.roll_number,
                    DATE_FORMAT(mt.token_date, '%Y-%m') as month,
                    COUNT(mt.token_id) as total_tokens,
                    COALESCE(SUM(mt.special_fee), 0) as total_bill
                FROM mess_tokens mt
                LEFT JOIN students s ON mt.roll_number = s.roll_number
                WHERE mt.roll_number = ? 
                  AND mt.token_type = 'Special'
                  AND DATE_FORMAT(mt.token_date, '%Y-%m') = ?
                GROUP BY mt.roll_number";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $rollnumber, $month);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        $data = [];
        if ($row) {
            $data = [
                'name' => $row['name'],
                'roll_number' => $row['roll_number'],
                'month' => $row['month'],
                'total_tokens' => (int)$row['total_tokens'],
                'total_bill' => number_format((float)$row['total_bill'], 2, '.', '')
            ];
        } else {
            $data = [
                'name' => '',
                'roll_number' => $rollnumber,
                'month' => $month,
                'total_tokens' => 0,
                'total_bill' => '0.00'
            ];
        }

        echo json_encode(['success' => true, 'data' => $data]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function requestSpecialToken($conn)
{
    global $DEFAULT_ROLL_NUMBER;
    $rollnumber = $_POST['roll_number'] ?? $DEFAULT_ROLL_NUMBER;
    $menuid = intval($_POST['menu_id'] ?? 0);

    try {
        if (empty($rollnumber) || $menuid === 0) {
            echo json_encode(['success' => false, 'message' => 'Roll number and menu ID required']);
            return;
        }

        // Get token details from specialtokenenable
        $sql = "SELECT menu_id, meal_type, menu_items, fee, token_date FROM specialtokenenable WHERE menu_id = ? AND status = 'active'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $menuid);
        $stmt->execute();
        $result = $stmt->get_result();
        $tokenData = $result->fetch_assoc();
        $stmt->close();

        if (!$tokenData) {
            echo json_encode(['success' => false, 'message' => 'Special token not found or inactive']);
            return;
        }

        // Check for duplicate
        $sql = "SELECT token_id FROM mess_tokens WHERE roll_number = ? AND menu_id = ? AND token_type = 'Special'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $rollnumber, $menuid);
        $stmt->execute();
        $duplicate = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($duplicate) {
            echo json_encode(['success' => false, 'message' => 'You have already requested this token']);
            return;
        }

        $mealType = $tokenData['meal_type'];
        $menu = $tokenData['menu_items'];
        $specialFee = (float)$tokenData['fee'];
        $tokenDate = $tokenData['token_date'];

        // INSERT to mess_tokens
        $sql = "INSERT INTO mess_tokens (roll_number, menu_id, meal_type, menu, token_type, token_date, special_fee, status, created_at) 
                VALUES (?, ?, ?, ?, 'Special', ?, ?, 'pending', NOW())";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisssd", $rollnumber, $menuid, $mealType, $menu, $tokenDate, $specialFee);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Token requested successfully!', 'token_id' => $conn->insert_id]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save token']);
        }

        $stmt->close();
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}

function getTokenHistorys($conn)
{
    global $DEFAULT_ROLL_NUMBER;
    $rollnumber = $_POST['roll_number'] ?? $DEFAULT_ROLL_NUMBER;

    try {
        if (empty($rollnumber)) {
            echo json_encode(['success' => false, 'message' => 'Roll number required']);
            return;
        }

        $sql = "SELECT 
                    mt.token_id,
                    mt.meal_type,
                    COALESCE(mt.menu, 'N/A') as menu_items,
                    mt.special_fee as fee,
                    mt.token_date,
                    DATE_FORMAT(mt.created_at, '%Y-%m-%d %H:%i:%s') as requested_at,
                    'history' as section
                FROM mess_tokens mt
                LEFT JOIN specialtokenenable st ON mt.menu_id = st.menu_id
                WHERE mt.roll_number = ? 
                  AND mt.token_type = 'Special'
                  AND mt.token_date < CURDATE()
                ORDER BY mt.token_date DESC
                LIMIT 50";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $rollnumber);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[] = [
                'token_id' => (int)$row['token_id'],
                'meal_type' => $row['meal_type'],
                'menu_items' => $row['menu_items'],
                'fee' => number_format((float)$row['fee'], 2, '.', ''),
                'token_date' => $row['token_date'],
                'requested_at' => $row['requested_at']
            ];
        }

        $stmt->close();
        echo json_encode(['success' => true, 'data' => $data, 'total_items' => count($data)]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

$conn->close();
