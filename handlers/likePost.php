<?php
// start session
session_start();

// check if user logged in, otherwise return to login
if(!isset($_SESSION['user']) || $_SESSION['user'] == null) {
    header('Location: /login.php');
    exit();
}

// check if it's a post request
if($_SERVER["REQUEST_METHOD"] != 'POST') {
    echo "Wrong request method";
    die();
}

// check if post id is provided
if(!isset($_POST['post_id']) || $_POST['post_id'] == null) {
    echo "please choose a post to like";
    die();
}
$id = $_POST['post_id'];
$userId = $_SESSION['user']['id'];
// require database class
require_once('../core/Database.php');
// start new instance
$db = new Database();
// check if already reacted 
$checkExists = $db->Query("SELECT * FROM reactions WHERE post_id=? AND author_id=?", [$id, $userId])->fetch();
// if exists, remove it
if($checkExists) {
    $db->Query("DELETE FROM reactions WHERE post_id=? AND author_id=?", [$id, $userId]);
    echo "Deleted";
    die();
}
// add like to post
$user = $db->Query("INSERT INTO reactions(post_id, author_id) VALUES(?,?)", [$id, $userId]);
// close database connection
$db->CloseConnection();

// return success
echo "Added";