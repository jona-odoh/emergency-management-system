<?php

session_start();
include('includes/connect.php');

$a = $_POST['name'];
$b = $_POST['email'];
$c = $_POST['state'];
$d = $_POST['username'];
$e = $_POST['password'];
$f = $_POST['phone'];
$g = $_POST['user_id'];

// Check if username, email, or phone already exist
$query = "SELECT * FROM users WHERE username = :username OR email = :email OR phone = :phone";
$stmt = $db->prepare($query);
$stmt->execute(array(':username' => $d, ':email' => $b, ':phone' => $f));

if ($stmt->rowCount() > 0) {
    echo "<script>alert('Username, email, or phone already exists. Please choose a different one.');</script>";
    echo "<script>window.location.href ='register.php'</script>";
} else {
    // check if a file was uploaded
    if(isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $file_name  = strtolower($_FILES['photo']['name']);
        $file_ext = substr($file_name, strrpos($file_name, '.'));
        $prefix = 'user'.md5(time()*rand(1, 9999));
        $file_name_new = $prefix.$file_ext;
        $path = '../../uploads/'.$file_name_new;

        // move uploaded file to destination
        if(move_uploaded_file($_FILES['photo']['tmp_name'], $path)) {
            // insert record into database with filename
            $sql = "INSERT INTO users (name,email,state,username,password,phone,user_id,photo) VALUES (:a,:b,:c,:d,:e,:f,:g,:h)";
            $q = $db->prepare($sql);
            $q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':g'=>$g,':h'=>$file_name_new));
            if($q){
                echo "<script>alert('Your account is created successfully! Login');</script>";
                echo "<script>window.location.href ='sign-in.php'</script>";
            } else {
                echo "<script>alert('Something went wrong please try again');</script>";
                echo "<script>window.location.href ='register.php'</script>";
            } 
        }
    } else {
        // insert record into database without filename
        $sql = "INSERT INTO users (name,email,state,username,password,phone,user_id) VALUES (:a,:b,:c,:d,:e,:f,:g)";
        $q = $db->prepare($sql);
        $q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':g'=>$g));
        if($q){
            echo "<script>alert('Your account is created successfully! Login');</script>";
            echo "<script>window.location.href ='sign-in.php'</script>";
        } else {
            echo "<script>alert('Something went wrong please try again');</script>";
            echo "<script>window.location.href ='register.php'</script>";
        } 
    }
}

?>
