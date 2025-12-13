<?php
session_start();
include('includes/connect.php');

// Get form data
$a = $_POST['agency_name'];
$b = $_POST['phone_number'];
$c = $_POST['email'];
$d = $_POST['personincharge'];
$e = $_POST['username'];
$f = $_POST['password'];
$g = $_POST['state'];
$h = $_POST['address'];
$i = $_POST['agency_id'];

// File upload
$file_name_new = '';
if (!empty($_FILES['photo']['name'])) {
    $file_name = strtolower($_FILES['photo']['name']);
    $file_ext = substr($file_name, strrpos($file_name, '.'));
    $prefix = 'agency' . md5(time() * rand(1, 9999));
    $file_name_new = $prefix . $file_ext;
    $path = '../uploads/' . $file_name_new;
    
    // Move uploaded file
    move_uploaded_file($_FILES['photo']['tmp_name'], $path);
}

// Insert into database
$sql = "INSERT INTO agency (agency_name, phone_number, email, personincharge, username, password, state, address, agency_id, photo) 
        VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j)";

$q = $db->prepare($sql);
$q->execute([
    ':a' => $a,
    ':b' => $b,
    ':c' => $c,
    ':d' => $d,
    ':e' => $e,
    ':f' => $f,
    ':g' => $g,
    ':h' => $h,
    ':i' => $i,
    ':j' => $file_name_new
]);

if ($q) {
    header("location: add-agency.php?success=true");
} else {
    header("location: add-agency.php?failed=true");
}
?>