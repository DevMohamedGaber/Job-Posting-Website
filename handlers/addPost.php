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

// check if post position is provided
if(!isset($_POST['position']) || $_POST['position'] == null) {
    echo "position not found";
    die();
}
// check if post company is provided
if(!isset($_POST['company']) || $_POST['company'] == null) {
    echo "company not found";
    die();
}
// check if post location is provided
if(!isset($_POST['location']) || $_POST['location'] == null) {
    echo "location not found";
    die();
}
// check if post salary is provided
if(!isset($_POST['salary']) || $_POST['salary'] == null) {
    echo "salary not found";
    die();
}
// check if post industry is provided
if(!isset($_POST['industry']) || $_POST['industry'] == null) {
    echo "industry not found";
    die();
}
// check if post description is provided
if(!isset($_POST['description']) || $_POST['description'] == null) {
    echo "description not found";
    die();
}

// require database class
require_once('../core/Database.php');
// start new instance
$db = new Database();

// add to database
$db->Query("INSERT INTO job_posts(position, industry, location, author_id, salary, description) VALUES(?,?,?,?,?,?)", [
    $_POST['position'],
    $_POST['industry'],
    $_POST['location'],
    $_SESSION['user']['id'],
    $_POST['salary'],
    $_POST['description']
]);
// get back recored
$post = $db->Query("SELECT * FROM job_posts WHERE id=?", [$db->GetLastId()])->fetch(PDO::FETCH_ASSOC);
// return success
echo json_encode($post);