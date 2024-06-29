<?php
session_start();

// check if user logged in, otherwise return to login
if(!isset($_SESSION['user'])) {
    header('Location: /login.php');
    exit();
}

require_once('./core/Database.php');

$db = new Database();
$posts = $db->Query("SELECT * FROM job_posts WHERE industry=?", [$_SESSION['user']['industry']])->fetchAll();
for ($i=0; $i < count($posts); $i++) { 
    $post = $posts[$i];
    // comment count
    $countComments = $db->Query("SELECT Count(*) cc FROM comments WHERE post_id=?", [$post['id']])->fetch();
    $post['comments_count'] = $countComments['cc'];
    // reactions count
    $countReactions = $db->Query("SELECT Count(*) rc FROM reactions WHERE post_id=?", [$post['id']])->fetch();
    $post['reactions_count'] = $countReactions['rc'];
    // applicants count
    $countApplicants = $db->Query("SELECT Count(*) ac FROM applicants WHERE job_post_id=?", [$post['id']])->fetch();
    $post['applicants_count'] = $countApplicants['ac'];
    // check is liked
    $isLiked = $db->Query("SELECT * FROM reactions WHERE post_id=? AND author_id=?", [$post['id'], $_SESSION['user']['id']])->fetch();
    $post['is_liked'] = $isLiked;
    $posts[$i] = $post;
}
$db->CloseConnection();