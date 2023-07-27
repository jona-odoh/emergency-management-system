<?php

	include'includes/connect.php';
	$id=$_GET['id'];
	$result = $db->prepare("DELETE FROM agency WHERE id= :post_id");
	$result->bindParam(':post_id', $id);
       if($result->execute()){
      header("location:agency.php?success=true");
        }else{
            header("location:agency.php?failed=true");
        } 
		
?>