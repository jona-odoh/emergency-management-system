<?php

	include'includes/connect.php';
	$id=$_GET['id'];
	$result = $db->prepare("DELETE FROM emergency_type WHERE id= :post_id");
	$result->bindParam(':post_id', $id);
       if($result->execute()){
      header("location:emergency_type.php?success=true");
        }else{
            header("location:emergency_type.php?failed=true");
        } 
		
?>