<?php
include 'includes/connect.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $db->prepare("DELETE FROM emergency_type WHERE id = :post_id");
    $result->bindParam(':post_id', $id);
    
    if($result->execute()) {
        header("location:emergency_type.php?success=Emergency type deleted successfully");
    } else {
        header("location:emergency_type.php?error=Failed to delete emergency type");
    }
} else {
    header("location:emergency_type.php?error=No ID specified");
}