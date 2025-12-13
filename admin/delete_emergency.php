<?php
session_start();
include('includes/connect.php');

// Check if ID is provided
if(!isset($_GET['id']) || empty($_GET['id'])) {
    header("location: view_emergency.php?failed=true");
    exit;
}

$id = intval($_GET['id']);

try {
    // Get emergency details for photo cleanup
    $select_sql = "SELECT emergency_id, photo FROM emergency WHERE id = :id";
    $select_stmt = $db->prepare($select_sql);
    $select_stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $select_stmt->execute();
    
    if($select_stmt->rowCount() == 0) {
        header("location: view_emergency.php?failed=true&error=not_found");
        exit;
    }
    
    $emergency = $select_stmt->fetch(PDO::FETCH_ASSOC);
    $emergency_id = $emergency['emergency_id'];
    
    // Delete the emergency
    $delete_sql = "DELETE FROM emergency WHERE id = :id";
    $delete_stmt = $db->prepare($delete_sql);
    $delete_stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if($delete_stmt->execute()) {
        // Delete photo file if exists
        if(!empty($emergency['photo'])) {
            $photo_path = "../uploads/" . $emergency['photo'];
            if(file_exists($photo_path)) {
                unlink($photo_path);
            }
        }
        
        header("location: view_emergency.php?success=true&message=Emergency+" . urlencode($emergency_id) . "+deleted");
        exit;
    } else {
        header("location: view_emergency.php?failed=true");
        exit;
    }
    
} catch (PDOException $e) {
    error_log("Delete Error: " . $e->getMessage());
    header("location: view_emergency.php?failed=true&error=database");
    exit;
}
?>