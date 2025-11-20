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
    echo json_encode(['success' => false, 'message' => 'DB Connection Error: ' . $conn->connect_error]);
    exit();
}

$conn->set_charset("utf8mb4");
$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {
    case 'get_dashboard_stats':
        getDashboardStats($conn);
        break;
    case 'get_mess_menu':
        getMessMenu($conn);
        break;
    case 'get_special_tokens':
        getSpecialTokens($conn);
        break;
    case 'get_token_requests':
        getTokenRequests($conn);
        break;
    case 'get_monthly_revenue':
        getMonthlyRevenue($conn);
        break;
    case 'get_student_consumption':
        getStudentConsumption($conn);
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        break;
}

function getDashboardStats($conn)
{
    $stats = [];

    $today = date('Y-m-d');
    $sql = "SELECT COUNT(*) as cnt FROM mess_menu WHERE date = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $today);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stats['todays_menu_items'] = (int)$row['cnt'];
    $stmt->close();

    $sql = "SELECT COUNT(*) as cnt FROM specialtokenenable WHERE status = 'active'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $stats['active_special_tokens'] = (int)$row['cnt'];

    $sql = "SELECT COALESCE(SUM(mt.special_fee), 0) as revenue FROM mess_tokens mt WHERE DATE(mt.token_date) = ? AND mt.token_type = 'Special'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $today);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stats['todays_revenue'] = (float)$row['revenue'];
    $stmt->close();

    $currentMonth = date('Y-m');
    $sql = "SELECT COUNT(*) as cnt FROM mess_tokens WHERE DATE_FORMAT(token_date, '%Y-%m') = ? AND token_type = 'Special'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $currentMonth);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stats['month_special_tokens'] = (int)$row['cnt'];
    $stmt->close();

    echo json_encode(['success' => true, 'data' => $stats]);
}

function getMessMenu($conn)
{
    $date = $_POST['date'] ?? date('Y-m-d');

    $sql = "SELECT menu_id, date, meal_type, items, IFNULL(fee, 0) as fee FROM mess_menu WHERE date = ? ORDER BY FIELD(meal_type, 'Breakfast', 'Lunch', 'Snacks', 'Dinner')";

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
}

function getSpecialTokens($conn)
{
    $sql = "SELECT st.menu_id, IFNULL(st.from_date, '') as from_date, IFNULL(st.from_time, '') as from_time, IFNULL(st.to_date, '') as to_date, IFNULL(st.to_time, '') as to_time, st.token_date, st.meal_type, st.menu_items, IFNULL(st.fee, 0) as fee, IFNULL(st.status, 'active') as status FROM specialtokenenable st ORDER BY st.token_date DESC, st.from_time ASC";

    $result = $conn->query($sql);
    $data = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = [
                'menu_id' => (int)$row['menu_id'],
                'from_date' => $row['from_date'],
                'from_time' => $row['from_time'],
                'to_date' => $row['to_date'],
                'to_time' => $row['to_time'],
                'token_date' => $row['token_date'],
                'meal_type' => $row['meal_type'],
                'menu_items' => $row['menu_items'],
                'fee' => number_format((float)$row['fee'], 2, '.', ''),
                'status' => $row['status']
            ];
        }
    }

    echo json_encode(['success' => true, 'data' => $data, 'total_items' => count($data)]);
}

function getTokenRequests($conn)
{
    // Get filter parameters
    $filterMonth = $_POST['filter_month'] ?? '';
    $filterDate = $_POST['filter_date'] ?? '';
    $filterMealType = $_POST['filter_meal_type'] ?? '';
    $filterItem = $_POST['filter_item'] ?? '';
    
    // Build base query
    $sql = "SELECT 
                mt.token_id, 
                mt.roll_number, 
                COALESCE(s.name, 'Unknown') as student_name, 
                mt.meal_type, 
                COALESCE(st.menu_items, mt.menu) as menu_items, 
                COALESCE(mt.special_fee, 0) as fee, 
                mt.token_date, 
                DATE_FORMAT(mt.created_at, '%Y-%m-%d %H:%i:%s') as requested_at 
            FROM mess_tokens mt 
            LEFT JOIN students s ON mt.roll_number = s.roll_number 
            LEFT JOIN specialtokenenable st ON mt.menu_id = st.menu_id 
            WHERE mt.token_type = 'Special'";
    
    // Add filters
    $params = [];
    $types = '';
    
    if (!empty($filterDate)) {
        $sql .= " AND mt.token_date = ?";
        $params[] = $filterDate;
        $types .= 's';
    } elseif (!empty($filterMonth)) {
        $sql .= " AND DATE_FORMAT(mt.token_date, '%Y-%m') = ?";
        $params[] = $filterMonth;
        $types .= 's';
    }
    
    if (!empty($filterMealType)) {
        $sql .= " AND mt.meal_type = ?";
        $params[] = $filterMealType;
        $types .= 's';
    }
    
    if (!empty($filterItem)) {
        $sql .= " AND (st.menu_items LIKE ? OR mt.menu LIKE ?)";
        $searchTerm = '%' . $filterItem . '%';
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $types .= 'ss';
    }
    
    $sql .= " ORDER BY mt.token_date DESC, mt.created_at DESC LIMIT 1000";
    
    // Prepare and execute
    if (!empty($params)) {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $result = $conn->query($sql);
    }
    
    $data = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Example fallback for 'undefined' or null student names
            $studentName = trim($row['student_name']);
            if ($studentName === '' || $studentName === 'Unknown' || is_null($studentName)) {
                $studentName = 'Unknown';
            }

            // For menu_items, prefer specialtokenenable, fallback to mess_tokens.menu
            $menuItems = $row['menu_items'];
            if (trim($menuItems) === '' || strtolower($menuItems) === 'n/a' || is_null($menuItems)) {
                $menuItems = $row['menu'];
            }

            $data[] = [
                'token_id'      => (int)$row['token_id'],
                'roll_number'   => $row['roll_number'],
                'student_name'  => $studentName,
                'meal_type'     => $row['meal_type'],
                'menu_items'    => $menuItems,
                'fee'           => number_format((float)$row['fee'], 2, '.', ''),
                'token_date'    => $row['token_date'],
                'requested_at'  => $row['requested_at']
            ];
        }
    }
    
    if (!empty($params)) {
        $stmt->close();
    }

    echo json_encode(['success' => true, 'data' => $data, 'total_items' => count($data)]);
}


function getMonthlyRevenue($conn)
{
    $month = $_POST['month'] ?? date('Y-m');

    $sql = "SELECT mt.token_date as date, COUNT(mt.token_id) as tokens_count, COALESCE(SUM(mt.special_fee), 0) as revenue FROM mess_tokens mt WHERE mt.token_type = 'Special' AND DATE_FORMAT(mt.token_date, '%Y-%m') = ? GROUP BY mt.token_date ORDER BY mt.token_date DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $month);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];
    $total = 0;

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $revenue = (float)$row['revenue'];
            $data[] = [
                'date' => $row['date'],
                'tokens_count' => (int)$row['tokens_count'],
                'revenue' => number_format($revenue, 2, '.', '')
            ];
            $total += $revenue;
        }
    }

    $stmt->close();

    echo json_encode(['success' => true, 'data' => $data, 'total' => number_format($total, 2, '.', ''), 'month' => $month, 'total_items' => count($data)]);
}

function getStudentConsumption($conn)
{
    $month = $_POST['month'] ?? date('Y-m');

    $sql = "SELECT mt.roll_number, COALESCE(s.name, 'N/A') as student_name, COUNT(mt.token_id) as tokens_count, COALESCE(SUM(mt.special_fee), 0) as total_spent FROM mess_tokens mt LEFT JOIN students s ON mt.roll_number = s.roll_number WHERE mt.token_type = 'Special' AND DATE_FORMAT(mt.token_date, '%Y-%m') = ? GROUP BY mt.roll_number, s.name ORDER BY total_spent DESC LIMIT 1000";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $month);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = [
                'roll_number' => $row['roll_number'],
                'student_name' => $row['student_name'] != 'N/A' ? $row['student_name'] : 'Unknown',
                'tokens_count' => (int)$row['tokens_count'],
                'total_spent' => number_format((float)$row['total_spent'], 2, '.', '')
            ];
        }
    }

    $stmt->close();

    echo json_encode(['success' => true, 'data' => $data, 'total_items' => count($data)]);
}

$conn->close();
