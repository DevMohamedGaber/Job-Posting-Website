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
if(!isset($_POST['id']) || $_POST['id'] == null) {
    echo "please choose a post to like";
    die();
}

// check content 
if(!isset($_POST['content']) || $_POST['content'] == null || $_POST['content'] == '') {
    echo "please provide comment content";
    die();
}

// require database class
require_once('../core/Database.php');
// start new instance
$db = new Database();

// add comment to database
$db->Query("INSERT INTO comments(content, post_id, author_id) VALUES(?,?,?)", [$_POST['content'], $_POST['id'], $_SESSION['user']['id']]);

echo "Done";