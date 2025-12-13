<?php
session_start();
include 'includes/connect.php';

// Check if ID is provided
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        // First, check if agency exists
        $check_stmt = $db->prepare("SELECT * FROM agency WHERE id = :post_id");
        $check_stmt->bindParam(':post_id', $id, PDO::PARAM_INT);
        $check_stmt->execute();
        
        if($check_stmt->rowCount() > 0) {
            // Get agency info for logging (optional)
            $agency_info = $check_stmt->fetch(PDO::FETCH_ASSOC);
            
            // Delete the agency
            $result = $db->prepare("DELETE FROM agency WHERE id = :post_id");
            $result->bindParam(':post_id', $id, PDO::PARAM_INT);
            
            if($result->execute()) {
                // Optionally delete associated photo file
                if(!empty($agency_info['photo'])) {
                    $photo_path = "../uploads/" . $agency_info['photo'];
                    if(file_exists($photo_path)) {
                        unlink($photo_path);
                    }
                }
                
                // Redirect with success message
                header("location:agency.php?success=true");
                exit();
            } else {
                header("location:agency.php?failed=true&error=delete_failed");
                exit();
            }
        } else {
            header("location:agency.php?failed=true&error=agency_not_found");
            exit();
        }
        
    } catch(PDOException $e) {
        // Log error (you can add logging here)
        error_log("Delete Agency Error: " . $e->getMessage());
        
        // Redirect with error
        header("location:agency.php?failed=true&error=database_error");
        exit();
    }
} else {
    // No ID provided
    header("location:agency.php?failed=true&error=no_id");
    exit();
}
?>