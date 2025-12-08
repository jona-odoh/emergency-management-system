<?php

    include'includes/connect.php';
    $id=$_GET['id'];
    $result = $db->prepare("DELETE FROM admin WHERE id= :post_id");
    $result->bindParam(':post_id', $id);
       if($result->execute()){
      header("location:users.php?success=true");
        }else{
            header("location:users.php?failed=true");
        } 
        
?>