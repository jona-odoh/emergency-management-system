<?php
session_start();
include('includes/connect.php');
$id = $_GET['id']; // The ID of the record to update
$a = $_POST['name'];
$b = $_POST['email'];
$c = $_POST['state'];
$d = $_POST['phone'];
$e = $_POST['address'];

// Check if username, email, or phone already exist excluding the current ID
$query = "SELECT * FROM admin WHERE (email = :email OR phone = :phone) AND id != :id";
$stmt = $db->prepare($query);
$stmt->execute(array(':email' => $b, ':phone' => $d, ':id' => $id));

if ($stmt->rowCount() > 0) {
    echo "<script>alert('Username, email, or phone number already exists. Please choose a different one.');</script>";
    echo "<script>window.location.href ='users.php'</script>";
} else {
    // check if a file was uploaded
    if(isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $file_name  = strtolower($_FILES['photo']['name']);
        $file_ext = substr($file_name, strrpos($file_name, '.'));
        $prefix = 'admin'.md5(time()*rand(1, 9999));
        $file_name_new = $prefix.$file_ext;
        $path = '../../uploads/'.$file_name_new;

        // move uploaded file to destination
        if(move_uploaded_file($_FILES['photo']['tmp_name'], $path)) {
            // update record in the database with the new values and filename
            $sql = "UPDATE admin SET name = :a, email = :b, state = :c,  phone = :d, address = :e, photo = :f WHERE id = :id";
            $q = $db->prepare($sql);
            $q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' => $e, ':f' => $file_name_new, ':id' => $id));
            if($q){
                echo "<script>alert('Your account is updated successfully!');</script>";
                echo "<script>window.location.href ='users.php'</script>";
            } else {
                echo "<script>alert('Something went wrong, please try again');</script>";
                echo "<script>window.location.href ='users.php'</script>";
            }
        }
    } else {
        // update record in the database with the new values without changing the filename
        $sql = "UPDATE admin SET name = :a, email = :b, state = :c, phone = :d, address = :e WHERE id = :id";
        $q = $db->prepare($sql);
        $q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' => $e, ':id' => $id));
        if($q){
            echo "<script>alert('Your account is updated successfully!');</script>";
            echo "<script>window.location.href ='users.php'</script>";
        } else {
            echo "<script>alert('Something went wrong, please try again');</script>";
            echo "<script>window.location.href ='users.php'</script>";
        }
    }
}
?>
