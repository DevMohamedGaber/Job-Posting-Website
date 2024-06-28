<?php
// start session
session_start();

// check if user logged in, otherwise return to login
if(!isset($_SESSION['user']) || $_SESSION['user'] == null) {
    header('Location: /login.php');
    exit();
}

$user = $_SESSION['user'];

// require database class
require_once('./core/Database.php');
// start new instance
$db = new Database();

// get user experiences from database
$exps = $db->Query("SELECT * FROM experiences WHERE author_id=?", [$user['id']])->fetchAll();

// get user skills from database
$skills = $db->Query("SELECT * FROM skills WHERE user_id=?", [$user['id']])->fetchAll();