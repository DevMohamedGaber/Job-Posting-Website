<?php
// start session
session_start();

// check if user logged in, otherwise return to login
if(!isset($_SESSION['user']) || $_SESSION['user'] == null) {
    header('Location: /login.php');
    exit();
}

$user = null;
// check if we didn't specify id, then cache current user data from session
if(!isset($_GET['id'])) {
    $user = $_SESSION['user'];
}

// require database class
require_once('./core/Database.php');
// start new instance
$db = new Database();

// if we specify user id, fetch that user from database
if($user == null) {
    $user = $db->Query("SELECT * FROM users WHERE id=?", [$_GET['id']])->fetch();
}

// if no user found, redirect to home page
if(!$user) {
    header('Location: /index.php');
    exit();
}
// get user experiences from database
$exps = $db->Query("SELECT * FROM experiences WHERE author_id=?", [$user['id']])->fetchAll();

// get user skills from database
$skills = $db->Query("SELECT * FROM skills WHERE user_id=?", [$user['id']])->fetchAll();