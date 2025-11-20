<?php
// Database connection
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "hostel";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

$conn->set_charset("utf8mb4");

// Get action from request
$action = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : '');

header('Content-Type: application/json');

switch ($action) {
    case 'getStatistics':
        getStatistics();
        break;
    case 'getApprovedLeaves':
        getApprovedLeaves();
        break;
    case 'getOutStudents':
        getOutStudents();
        break;
    case 'getHistory':
        getHistory();
        break;
    case 'getLateEntries':
        getLateEntries();
        break;
    case 'markOut':
        markOut();
        break;
    case 'markIn':
        markIn();
        break;
    case 'testConnection':
        testConnection();
        break;
    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        break;
}

function testConnection() {
    global $conn;
    
    // Test database connection and verify columns
    $describeResult = $conn->query("DESCRIBE fingerprint_logs");
    $columns = [];
    while ($row = $describeResult->fetch_assoc()) {
        $columns[] = $row['Field'];
    }
    
    echo json_encode([
        'success' => true,
        'message' => 'Database connected successfully',
        'database' => 'hostel',
        'fingerprint_logs_columns' => $columns,
        'has_is_late_entry' => in_array('is_late_entry', $columns) ? 'YES' : 'NO',
        'has_leave_id' => in_array('leave_id', $columns) ? 'YES' : 'NO'
    ]);
}

function getStatistics() {
    global $conn;
    
    try {
        // Count approved leaves
        $approvedSql = "SELECT COUNT(*) as count FROM leave_applications 
                        WHERE Status = 'Approved'";
        $result = $conn->query($approvedSql);
        $approved = $result->fetch_assoc()['count'] ?? 0;
        
        // Count out students
        $outSql = "SELECT COUNT(*) as count FROM leave_applications WHERE Status = 'Out'";
        $result = $conn->query($outSql);
        $out = $result->fetch_assoc()['count'] ?? 0;
        
        // Count late entries from fingerprint_logs
        $lateSql = "SELECT COUNT(*) as count FROM fingerprint_logs WHERE is_late_entry = 1";
        $result = $conn->query($lateSql);
        $late = $result->fetch_assoc()['count'] ?? 0;
        
        // Count closed leaves
        $closedSql = "SELECT COUNT(*) as count FROM leave_applications WHERE Status = 'Closed'";
        $result = $conn->query($closedSql);
        $closed = $result->fetch_assoc()['count'] ?? 0;
        
        echo json_encode([
            'success' => true,
            'approved' => intval($approved),
            'out' => intval($out),
            'late' => intval($late),
            'closed' => intval($closed)
        ]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function getApprovedLeaves() {
    global $conn;
    
    $sql = "SELECT 
                la.Leave_ID,
                la.Reg_No,
                la.From_Date,
                la.To_Date,
                la.Reason,
                la.Status,
                lt.Leave_Type_Name,
                s.name as student_name,
                s.student_id
            FROM leave_applications la
            LEFT JOIN leave_types lt ON la.LeaveType_ID = lt.LeaveType_ID
            LEFT JOIN students s ON la.Reg_No = s.roll_number
            WHERE la.Status = 'Approved'
            ORDER BY la.Leave_ID DESC
            LIMIT 100";
    
    $result = $conn->query($sql);
    
    if ($result) {
        $leaves = [];
        while ($row = $result->fetch_assoc()) {
            $leaves[] = $row;
        }
        echo json_encode(['success' => true, 'leaves' => $leaves, 'count' => count($leaves)]);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Query error: ' . $conn->error]);
    }
}

function getOutStudents() {
    global $conn;
    
    $sql = "SELECT 
                la.Leave_ID,
                la.Reg_No,
                la.From_Date,
                la.To_Date,
                la.Status,
                s.name as student_name,
                s.student_id,
                fl.scan_time,
                fl.log_id,
                fl.leave_id
            FROM leave_applications la
            INNER JOIN students s ON la.Reg_No = s.roll_number
            INNER JOIN fingerprint_logs fl ON s.student_id = fl.student_id 
                AND fl.scan_type = 'Out'
                AND fl.leave_id = la.Leave_ID
            WHERE la.Status = 'Out'
            ORDER BY la.Leave_ID DESC, fl.scan_time DESC";
    
    $result = $conn->query($sql);
    
    if ($result) {
        $students = [];
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
        echo json_encode(['success' => true, 'students' => $students]);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Query error: ' . $conn->error]);
    }
}

function getHistory() {
    global $conn;
    
    $sql = "SELECT 
                fl.log_id,
                fl.student_id,
                fl.scan_type,
                fl.scan_time,
                COALESCE(fl.is_late_entry, 0) as is_late_entry,
                fl.leave_id,
                s.roll_number,
                s.name as student_name,
                la.Leave_ID,
                la.Status as leave_status
            FROM fingerprint_logs fl
            LEFT JOIN students s ON fl.student_id = s.student_id
            LEFT JOIN leave_applications la ON fl.leave_id = la.Leave_ID
            ORDER BY fl.log_id DESC
            LIMIT 500";
    
    $result = $conn->query($sql);
    
    if ($result) {
        $history = [];
        while ($row = $result->fetch_assoc()) {
            $history[] = $row;
        }
        echo json_encode(['success' => true, 'history' => $history, 'count' => count($history)]);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Query error: ' . $conn->error]);
    }
}

function getLateEntries() {
    global $conn;
    
    $sql = "SELECT 
                la.Leave_ID,
                la.Reg_No,
                s.name as student_name,
                la.To_Date,
                fl.scan_time,
                HOUR(TIMEDIFF(fl.scan_time, la.To_Date)) as late_hours,
                MINUTE(TIMEDIFF(fl.scan_time, la.To_Date)) as late_minutes,
                COALESCE(fl.is_late_entry, 0) as is_late_entry
            FROM fingerprint_logs fl
            INNER JOIN leave_applications la ON fl.leave_id = la.Leave_ID
            INNER JOIN students s ON fl.student_id = s.student_id
            WHERE fl.is_late_entry = 1
            ORDER BY fl.log_id DESC
            LIMIT 100";
    
    $result = $conn->query($sql);
    
    if ($result) {
        $late_entries = [];
        while ($row = $result->fetch_assoc()) {
            $late_entries[] = $row;
        }
        echo json_encode(['success' => true, 'late_entries' => $late_entries]);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Query error: ' . $conn->error]);
    }
}

function markOut() {
    global $conn;
    
    // Validate input - MUST have Leave_ID
    if (!isset($_POST['Leave_ID']) || !isset($_POST['Reg_No'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Missing required parameters: Leave_ID or Reg_No']);
        return;
    }
    
    $leaveId = intval($_POST['Leave_ID']);
    $regNo = $conn->real_escape_string($_POST['Reg_No']);
    
    $conn->begin_transaction();
    
    try {
        // Verify this Leave_ID exists and belongs to the student
        $verifySql = "SELECT la.Leave_ID, s.student_id FROM leave_applications la
                     INNER JOIN students s ON la.Reg_No = s.roll_number
                     WHERE la.Leave_ID = ? AND la.Reg_No = ? AND la.Status = 'Approved'";
        $stmt = $conn->prepare($verifySql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("is", $leaveId, $regNo);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            throw new Exception("Invalid Leave ID or Leave not approved for this student");
        }
        
        $verifyData = $result->fetch_assoc();
        $studentId = $verifyData['student_id'];
        $stmt->close();
        
        // Insert fingerprint log with BOTH is_late_entry AND leave_id
        // IMPORTANT: Using 's' for fingerprint_id (string), NOT 'i'
        $insertLogSql = "INSERT INTO fingerprint_logs (student_id, fingerprint_id, scan_type, scan_time, is_late_entry, leave_id) 
                        VALUES (?, ?, 'Out', NOW(), 0, ?)";
        $stmt = $conn->prepare($insertLogSql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("isi", $studentId, $regNo, $leaveId);
        if (!$stmt->execute()) {
            throw new Exception("Failed to insert log: " . $stmt->error);
        }
        $stmt->close();
        
        // Verify insertion
        $verifyInsertSql = "SELECT leave_id, is_late_entry FROM fingerprint_logs ORDER BY log_id DESC LIMIT 1";
        $verifyInsert = $conn->query($verifyInsertSql);
        $insertedData = $verifyInsert->fetch_assoc();
        
        // Update leave status to 'Out'
        $updateLeaveSql = "UPDATE leave_applications SET Status = 'Out' WHERE Leave_ID = ? AND Reg_No = ?";
        $stmt = $conn->prepare($updateLeaveSql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("is", $leaveId, $regNo);
        if (!$stmt->execute()) {
            throw new Exception("Failed to update leave: " . $stmt->error);
        }
        $stmt->close();
        
        $conn->commit();
        
        echo json_encode([
            'success' => true, 
            'message' => 'Student marked OUT successfully for Leave ID: ' . $leaveId,
            'inserted_leave_id' => $insertedData['leave_id'],
            'inserted_is_late_entry' => $insertedData['is_late_entry']
        ]);
    } catch (Exception $e) {
        $conn->rollback();
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

function markIn() {
    global $conn;
    
    // Validate input - MUST have Leave_ID
    if (!isset($_POST['Leave_ID']) || !isset($_POST['Reg_No'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Missing required parameters']);
        return;
    }
    
    $leaveId = intval($_POST['Leave_ID']);
    $regNo = $conn->real_escape_string($_POST['Reg_No']);
    
    $conn->begin_transaction();
    
    try {
        // Get SPECIFIC leave application details by Leave_ID
        $leaveSql = "SELECT la.Leave_ID, la.To_Date, s.student_id FROM leave_applications la
                    INNER JOIN students s ON la.Reg_No = s.roll_number
                    WHERE la.Leave_ID = ? AND la.Reg_No = ? AND la.Status = 'Out'";
        $stmt = $conn->prepare($leaveSql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("is", $leaveId, $regNo);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            throw new Exception("Leave application not found or not marked OUT for this ID");
        }
        
        $leaveData = $result->fetch_assoc();
        $studentId = $leaveData['student_id'];
        $toDate = $leaveData['To_Date'];
        $stmt->close();
        
        // Get current time in UTC and check if late for THIS specific leave
        $currentTime = new DateTime('now', new DateTimeZone('UTC'));
        $toDateTime = new DateTime($toDate, new DateTimeZone('UTC'));
        $isActuallyLate = $currentTime > $toDateTime ? 1 : 0;
        
        // Insert fingerprint log with BOTH is_late_entry AND leave_id
        // IMPORTANT: Make sure leave_id is stored properly
        $insertLogSql = "INSERT INTO fingerprint_logs (student_id, fingerprint_id, scan_type, scan_time, is_late_entry, leave_id) 
                        VALUES (?, ?, 'In', NOW(), ?, ?)";
        $stmt = $conn->prepare($insertLogSql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        // Correct bind_param order: i (student_id), s (fingerprint_id), i (is_late_entry), i (leave_id)
        $stmt->bind_param("isii", $studentId, $regNo, $isActuallyLate, $leaveId);
        if (!$stmt->execute()) {
            throw new Exception("Failed to insert log: " . $stmt->error);
        }
        $stmt->close();
        
        // Verify insertion
        $verifyInsertSql = "SELECT leave_id, is_late_entry FROM fingerprint_logs ORDER BY log_id DESC LIMIT 1";
        $verifyInsert = $conn->query($verifyInsertSql);
        $insertedData = $verifyInsert->fetch_assoc();
        
        // Update leave status to 'Closed'
        $updateLeaveSql = "UPDATE leave_applications SET Status = 'Closed' WHERE Leave_ID = ? AND Reg_No = ?";
        $stmt = $conn->prepare($updateLeaveSql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("is", $leaveId, $regNo);
        if (!$stmt->execute()) {
            throw new Exception("Failed to update leave: " . $stmt->error);
        }
        $stmt->close();
        
        // If late entry for THIS specific leave, add to blocked_students
        if ($isActuallyLate) {
            $blockReason = "Late entry from approved leave (Leave ID: " . $leaveId . ")";
            $blockSql = "INSERT INTO blocked_students (student_id, reason, restriction_type) 
                        VALUES (?, ?, 'Outing')
                        ON DUPLICATE KEY UPDATE reason = VALUES(reason)";
            $stmt = $conn->prepare($blockSql);
            if ($stmt) {
                $stmt->bind_param("is", $studentId, $blockReason);
                $stmt->execute();
                $stmt->close();
            }
        }
        
        $conn->commit();
        
        $message = 'Student marked IN successfully for Leave ID: ' . $leaveId;
        if ($isActuallyLate) {
            $message .= ' - LATE ENTRY RECORDED';
        }
        
        echo json_encode([
            'success' => true, 
            'message' => $message, 
            'is_late' => $isActuallyLate,
            'inserted_leave_id' => $insertedData['leave_id'],
            'inserted_is_late_entry' => $insertedData['is_late_entry']
        ]);
    } catch (Exception $e) {
        $conn->rollback();
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

$conn->close();
?>