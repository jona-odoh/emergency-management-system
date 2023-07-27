<?php
session_start();
include('includes/connect.php');
$id = $_GET['id'];
$a = $_POST['status'];

// query
$sql = "UPDATE emergency SET 
        `status` = :status WHERE id = :id";

$q = $db->prepare($sql);
$q->bindParam(':status', $a);
$q->bindParam(':id', $id);
$result = $q->execute();

if ($result) {
    header("Location: view-emergency.php?success=true");
    exit;
} else {
    $error = $q->errorInfo();
    $errorMessage = isset($error[2]) ? $error[2] : "Unknown error";
    header("Location: view-emergency.php?failed=true&message=" . urlencode($errorMessage));
    exit;
}
?>
