<?php
// start session
session_start();

// check if it's a post request
if($_SERVER["REQUEST_METHOD"] != 'POST') {
    echo "Wrong request method";
    die();
}

// check if no user logged in 
if(!isset($_SESSION['user']) || $_SESSION['user'] == null) {
    echo "no user logged in found";
    die();
}

// destroy session and delete user data
$_SESSION = [];
session_unset();
session_destroy();

echo "Done";