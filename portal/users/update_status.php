 <?php                
session_start();
include('includes/connect.php');
$a = $_POST['status'];

// query
$sql = "UPDATE emergency SET 
        `status`=? WHERE '$id' = id";

$q = $db->prepare($sql);
$q->execute(array($a));

 if($q){
      header("location:view-emergency.php?success=true");
        }else{
            header("location:view-emergency.php?failed=true");
        }

?>