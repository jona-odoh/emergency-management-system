<?php
session_start();
include('includes/connect.php');

$latitude = $_GET['latitude'];
$longitude = $_GET['longitude'];

// query


  //do your write to the database filename and other details   
        $sql = "INSERT INTO emergency (latitude,log) VALUES (:latitude,:longitude)";
$q = $db->prepare($sql);
$q->execute(array(':latitude'=>$latitude,':longitude'=>$longitude,));
if($q){
      header("location:report-emergency.php?success=true");
        }else{
            header("location:report-emergency.php?failed=true");
        } 
		
		?>