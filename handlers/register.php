<?php
// start session
session_start();

// check if it's a post request
if($_SERVER["REQUEST_METHOD"] != 'POST') {
    echo "Wrong request method";
    die();
}

// check if user already logged in
if(isset($_SESSION['user'])) {
    echo "loggedIn";
    die();
}

// check if user sent valid first name and between 3 and 16
if(!isset($_POST['first_name'])) {
    echo "please enter a valid first";
    die();
}
// check if user sent valid last name and between 3 and 16
if(!isset($_POST['last_name'])) {
    echo "please enter a valid last";
    die();
}

// check if user sent valid address
if(!isset($_POST['address'])) {
    echo "please enter a address";
    die();
}
// check if user sent valid address
if(!isset($_POST['address'])) {
    echo "please enter a address";
    die();
}
// check if user sent valid industry and min 2 characters
if(!isset($_POST['industry']) || strlen($_POST['industry']) < 2) {
    echo "please send a valid email";
    die();
}
// check if user sent password and between 8 and 20 characters length
if(!isset($_POST['password']) || strlen($_POST['password']) < 8 || strlen($_POST['password']) > 20) {
    echo "invalid  password";
    die();
}
// check if user sent valid address
if(!isset($_POST['is_recruiter'])) {
    echo "please enter a if you're a recruiter";
    die();
}

// require database class
require_once('../core/Database.php');
// start new instance
$db = new Database();

// check if there is already user registered with this email
$checkExists = $db->Query("SELECT * FROM users WHERE email=?", [$_POST['email']])->fetch();
if($checkExists) {
    echo "email already registered";
    die();
}

// otherwise insert into database
$query = "INSERT INTO users(first_name, last_name, email, address, password, industry, is_recruiter) VALUES(?,?,?,?,?,?,?)";
$db->Query($query,  [
    $_POST['first_name'],
    $_POST['last_name'],
    $_POST['email'],
    $_POST['address'],
    $_POST['password'],
    $_POST['industry'],
    $_POST['is_recruiter']
])->fetch();

// close database connection
$db->CloseConnection();

// return done message
echo "Done";