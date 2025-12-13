<?php
include 'connect.php';
session_start();

function clean($str) {
    global $conn;
    $str = @trim($str);
    return mysqli_real_escape_string($conn, $str);
}

// Sanitize the POST values
$login = clean($_POST['username']);
$password = clean($_POST['password']);

// Input Validations
$errmsg_arr = [];
$errflag = false;

if($login == '') {
    $errmsg_arr[] = 'Username missing';
    $errflag = true;
}
if($password == '') {
    $errmsg_arr[] = 'Password missing';
    $errflag = true; 
}

if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    echo '<script>alert("Please fill all fields"); window.location.href="sign-in.php";</script>';
    exit();
}

// Try to find user in each table with priority: admin > agency > users
$tables = [
    'admin' => [
        'table' => 'admin',
        'fields' => [
            'id', 'agency_id', 'name', 'email', 'phone', 'state', 
            'address', 'access_level', 'photo', 'username'
        ],
        'session_prefix' => 'SESS_'
    ],
    'agency' => [
        'table' => 'agency',
        'fields' => [
            'id', 'agency_id', 'agency_name', 'email', 'phone_number', 'state', 
            'address', 'personincharge', 'photo', 'username'
        ],
        'session_prefix' => 'SESS_'
    ],
    'users' => [
        'table' => 'users',
        'fields' => [
            'id', 'user_id', 'name', 'email', 'phone', 'state', 
            'address', 'photo', 'username'
        ],
        'session_prefix' => 'SESS_'
    ]
];

$user_found = false;
$user_type = '';
$user_data = null;

foreach($tables as $type => $config) {
    $table = $config['table'];
    $qry = "SELECT * FROM $table WHERE username='$login' AND password='$password'";
    $result = mysqli_query($conn, $qry);
    
    if($result && mysqli_num_rows($result) > 0) {
        $user_found = true;
        $user_type = $type;
        $user_data = mysqli_fetch_assoc($result);
        break;
    }
}

if($user_found) {
    // Login Successful
    session_regenerate_id();
    
    // Clear any existing session
    session_unset();
    
    // Store user type
    $_SESSION['SESS_USER_TYPE'] = $user_type;
    
    // Store common session variables
    $_SESSION['SESS_LOGGED_IN'] = true;
    $_SESSION['SESS_USERNAME'] = $user_data['username'];
    
    // Store user-specific data based on type
    switch($user_type) {
        case 'admin':
            $_SESSION['SESS_MEMBER_ID'] = $user_data['id'];
            $_SESSION['SESS_AGENCY_ID'] = $user_data['agency_id'];
            $_SESSION['SESS_FIRST_NAME'] = $user_data['name'];
            $_SESSION['SESS_EMAIL'] = $user_data['email'];
            $_SESSION['SESS_PHONE_NUMBER'] = $user_data['phone'];
            $_SESSION['SESS_STATE'] = $user_data['state'];
            $_SESSION['SESS_ADDRESS'] = $user_data['address'];            
            $_SESSION['SESS_ACCESS_LEVEL'] = $user_data['access_level'];
            $_SESSION['SESS_PRO_PIC'] = $user_data['photo'];
            break;
            
        case 'agency':
            $_SESSION['SESS_MEMBER_ID'] = $user_data['id'];
            $_SESSION['SESS_FIRST_NAME'] = $user_data['agency_name'];
            $_SESSION['SESS_EMAIL'] = $user_data['email'];
            $_SESSION['SESS_PHONE_NUMBER'] = $user_data['phone_number'];
            $_SESSION['SESS_STATE'] = $user_data['state'];
            $_SESSION['SESS_ADDRESS'] = $user_data['address'];            
            $_SESSION['SESS_PERSONINCHARGE'] = $user_data['personincharge'];
            $_SESSION['SESS_PRO_PIC'] = $user_data['photo'];
            $_SESSION['SESS_AGENCY_ID'] = $user_data['agency_id'];
            break;
            
        case 'users':
            $_SESSION['SESS_MEMBER_ID'] = $user_data['id'];
            $_SESSION['SESS_FIRST_NAME'] = $user_data['name'];
            $_SESSION['SESS_EMAIL'] = $user_data['email'];
            $_SESSION['SESS_PHONE_NUMBER'] = $user_data['phone'];
            $_SESSION['SESS_STATE'] = $user_data['state'];
            $_SESSION['SESS_ADDRESS'] = $user_data['address'];            
            $_SESSION['SESS_PRO_PIC'] = $user_data['photo'];
            $_SESSION['SESS_USERS_ID'] = $user_data['user_id'];
            break;
    }
    
    session_write_close();
    
    // Redirect based on user type
    if($user_type == 'admin') {
        header("location: admin/");
    } elseif($user_type == 'agency') {
        header("location: agency/");
    } else {
		header("location: users/");
	}
    exit();
} else {
    // Login failed
    echo '<script>
        alert("Invalid username or password");
        window.location.href="sign-in.php";
    </script>';
    exit();
}
?>