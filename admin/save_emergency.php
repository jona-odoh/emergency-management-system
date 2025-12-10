<?php
// session_start();
include('includes/connect.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("location: report-emergency.php?error=invalid_request");
    exit;
}

// Validate required fields
$required_fields = ['emergency_id', 'agency_id', 'case_severity', 'emergency_category', 'phone_number', 'address', 'name', 'state', 'description'];
foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        header("location: report-emergency.php?error=missing_fields");
        exit;
    }
}

// Sanitize inputs
$a = trim($_POST['emergency_id']);
$b = intval($_POST['agency_id']);
$c = htmlspecialchars(trim($_POST['case_severity']));
$d = htmlspecialchars(trim($_POST['emergency_category']));
$e = htmlspecialchars(trim($_POST['phone_number']));
$f = htmlspecialchars(trim($_POST['address']));
$g = htmlspecialchars(trim($_POST['name']));
$h = htmlspecialchars(trim($_POST['state']));
$i = 'Pending'; // Default status
$j = isset($_POST['victim_id']) ? intval($_POST['victim_id']) : 0;
$k = date('Y-m-d');
$l = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$m = htmlspecialchars(trim($_POST['description']));
$n = ''; // Initialize photo variable

// File upload handling
if (!empty($_FILES['photo']['name'])) {
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
    // $max_size = 2 * 1024 * 1024; // 2MB
    
    $file_type = $_FILES['photo']['type'];
    $file_size = $_FILES['photo']['size'];
    $file_name = $_FILES['photo']['name'];
    $file_tmp = $_FILES['photo']['tmp_name'];
    
    // Validate file type
    if (!in_array($file_type, $allowed_types)) {
        header("location: report-emergency.php?error=invalid_file_type");
        exit;
    }
    
    // Validate file size
    // if ($file_size > $max_size) {
    //     header("location: report-emergency.php?error=file_too_large");
    //     exit;
    // }
    
    // Generate unique filename
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_name_new = 'emergency_' . uniqid() . '_' . time() . '.' . $file_ext;
    $upload_dir = '../uploads/';
    $path = $upload_dir . $file_name_new;
    
    // Create uploads directory if it doesn't exist
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    
    // Move uploaded file
    if (move_uploaded_file($file_tmp, $path)) {
        $n = $file_name_new;
    } else {
        header("location: report-emergency.php?error=file_upload_failed");
        exit;
    }
}

// Prepare and execute SQL statement
try {
    // Check if emergency ID already exists (for uniqueness)
    $check_sql = "SELECT COUNT(*) FROM emergency WHERE emergency_id = :emergency_id";
    $check_q = $db->prepare($check_sql);
    $check_q->bindParam(':emergency_id', $a);
    $check_q->execute();
    
    if ($check_q->fetchColumn() > 0) {
        // Generate new emergency ID if duplicate
        $a = 'EMG-' . rand(1000, 9999) . '-' . date('YmdHis');
    }
    
    // Insert emergency record
    $sql = "INSERT INTO emergency (emergency_id, agency_id, case_severity, emergency_category, phone_number, 
            address, name, state, status, victim_id, dates, email, description, photo, created_at) 
            VALUES (:emergency_id, :agency_id, :case_severity, :emergency_category, :phone_number, 
            :address, :name, :state, :status, :victim_id, :dates, :email, :description, :photo, NOW())";
    
    $q = $db->prepare($sql);
    $q->execute([
        ':emergency_id' => $a,
        ':agency_id' => $b,
        ':case_severity' => $c,
        ':emergency_category' => $d,
        ':phone_number' => $e,
        ':address' => $f,
        ':name' => $g,
        ':state' => $h,
        ':status' => $i,
        ':victim_id' => $j,
        ':dates' => $k,
        ':email' => $l,
        ':description' => $m,
        ':photo' => $n
    ]);
    
    // Get the last inserted ID
    $emergency_id = $db->lastInsertId();
    
    // Log the emergency report (optional)
    // $log_sql = "INSERT INTO emergency_logs (emergency_id, action, user_id, created_at) 
    //             VALUES (:emergency_id, 'Emergency Reported', :user_id, NOW())";
    // $log_q = $db->prepare($log_sql);
    // $log_q->execute([
    //     ':emergency_id' => $emergency_id,
    //     ':user_id' => $j
    // ]);
    
    header("location: report-emergency.php?success=true");
    exit;
    
} catch (PDOException $e) {
    // Log error for debugging
    error_log("Emergency report error: " . $e->getMessage());
    
    // Redirect with error
    header("location: report-emergency.php?failed=true&error=" . urlencode($e->getMessage()));
    exit;
}
?>