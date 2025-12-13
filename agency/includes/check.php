<?php
  $sql1 ="SELECT count(id) As total FROM users";
      $result1=mysqli_query($mysqli,$sql1);
      $values=mysqli_fetch_assoc($result1);
      $users=$values['total'];
  // $sql2 ="SELECT count(id) As total2 FROM cases ";
  //     $result2=mysqli_query($mysqli,$sql2);
  //     $values=mysqli_fetch_assoc($result2);
  //     $cases=$values['total2'];
  // $sql3 ="SELECT count(id) As total3 FROM agency ";
  //     $result3=mysqli_query($mysqli,$sql3);
  //     $values=mysqli_fetch_assoc($result3);
  //     $agency=$values['total3'];

?>

