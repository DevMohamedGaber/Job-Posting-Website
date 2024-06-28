<?php
// start session
session_start();

// check if user logged in, otherwise return to login
if(!isset($_SESSION['user']) || $_SESSION['user'] == null) {
    header('Location: /login.php');
    exit();
}

// check if it's a post request
if($_SERVER["REQUEST_METHOD"] != 'GET') {
    echo "Wrong request method";
    die();
}

if(!isset($_GET['id'])) {
    echo "select post to show comments";
    die();
}

// require database class
require_once('../core/Database.php');
// start new instance
$db = new Database();
// fetch comments
$comments = $db->Query("SELECT * FROM comments WHERE post_id=?", [$_GET['id']])->fetchAll();

if(count($comments) > 0) {
    for ($i=0; $i < count($comments); $i++) { 
        $user = $db->Query("SELECT first_name, last_name, title FROM users WHERE id=?", [$comments[$i]['author_id']])->fetch();
        $comments[$i]['user_name'] = $user['first_name'] ." ". $user['last_name'];
        $comments[$i]['user_title'] = $user['title'];
    }
}
// return results
echo json_encode($comments);