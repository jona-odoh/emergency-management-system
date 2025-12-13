<?php
session_start();
include('includes/connect.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("location: view_emergency.php?failed=true");
    exit;
}

// Get form data with validation
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$status = isset($_POST['status']) ? trim($_POST['status']) : '';

// Validate input
if($id == 0 || empty($status)) {
    header("location: view_emergency.php?failed=true");
    exit;
}

// Update query
try {
    $sql = "UPDATE emergency SET status = :status WHERE id = :id";
    $q = $db->prepare($sql);
    $q->bindParam(':status', $status);
    $q->bindParam(':id', $id);
    
    if($q->execute()) {
        header("Location: view_emergency.php?success=true");
        exit;
    } else {
        header("Location: view_emergency.php?failed=true");
        exit;
    }
} catch (Exception $e) {
    // Log error
    error_log("Update Error: " . $e->getMessage());
    header("Location: view_emergency.php?failed=true");
    exit;
}
?>