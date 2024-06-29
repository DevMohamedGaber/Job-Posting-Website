<?php
// start session
session_start();

// check if user not logged in, otherwise return to home page
if(isset($_SESSION['user'])) {
    header('Location: /index.php');
    exit();
}
// check if it's a post request
if($_SERVER["REQUEST_METHOD"] != 'POST') {
    echo "Wrong request method";
    die();
}
// check if user sent valid email
if(!isset($_REQUEST['email']) || filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL) == false) {
    echo "please send a valid email";
    die();
}
// check if user sent valid email
if(!isset($_REQUEST['password'])) {
    echo "invalid  password";
    die();
}

// require database class
require_once('../core/Database.php');
// start new instance
$db = new Database();
// get user from database if possible
$user = $db->Query("SELECT * FROM users WHERE email=? AND password=?", [$_REQUEST['email'], $_REQUEST['password']])->fetch(PDO::FETCH_ASSOC);
// close database connection
$db->CloseConnection();

//check if user found, if not, send error
if(!$user) {
    echo "user not found";
    die();
}

// save user into session
$_SESSION['user'] = $user;

// return done message
echo "Done";