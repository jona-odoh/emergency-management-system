<?php

session_start();
include('includes/connect.php');

$a = $_POST['name'];
$b = $_POST['description'];

// query



  //do your write to the database filename and other details   
        $sql = "INSERT INTO emergency_type (name,description) VALUES (:a,:b)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b));
if($q){
      header("location:emergency_type.php?success=true");
        }else{
            header("location:emergency_type.php?failed=true");
        } 
		
		?>