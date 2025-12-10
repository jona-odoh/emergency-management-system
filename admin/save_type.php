<?php

session_start();
include('includes/connect.php');

$a = $_POST['name'];
$b = $_POST['description'];
   
        $sql = "INSERT INTO emergency_type (name,description) VALUES (:a,:b)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b));
if($q){
      header("location:emergency_type.php?success=Emergency type added successfully");
        }else{
            header("location:emergency_type.php?error=Failed to add emergency type");
        } 
		
		?>