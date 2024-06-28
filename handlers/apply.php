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

// require database class
require_once('../core/Database.php');
// start new instance
$db = new Database();

// check if user already applied before
$checkApplied = $db->Query("SELECT * FROM applicants WHERE job_post_id=? AND job_seeker_id=?", [$_POST['id'], $_SESSION['user']['id']])->fetch();
if($checkApplied != false) {
    echo "Already Applied";
    die();
}

// insert into database
$db->Query("INSERT INTO applicants(job_post_id, job_seeker_id, cover_letter) VALUES(?,?,?)", [$_POST['id'], $_SESSION['user']['id'], $_POST['content']]);

// return success
echo "Done";