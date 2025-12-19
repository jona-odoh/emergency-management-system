 <?php
               
session_start();
include('includes/connect.php');
$a = $_POST['name'];
$b = $_POST['email'];
$c = $_POST['state'];
$d = $_POST['phone'];

// query
$sql = "UPDATE users SET 
        `name`=?,`email`=?,`state`=?,`phone`=? WHERE id= $id ";

$q = $db->prepare($sql);
$q->execute(array($a,$b,$c,$d));
//$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d, ':e'=>$e,':f'=>$f,':g'=>$g,':h'=>$h,':i'=>$i, ':j'=>$j, ':k'=>$k, ':l'=>$l));
 if($q){
      header("location:profile.php?success=true");
        }else{
            header("location:profile.php?failed=true");
        }

?>