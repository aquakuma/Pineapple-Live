<?php
include('./db_connect.php');
$pdo = db_connect();
session_start();
$video_id = "";
if(isset($_GET['video_id'])){
    $video_id = $_GET['video_id'];
}

$st = $pdo->query("SELECT * FROM video WHERE video_id=$video_id");
$row = $st->fetch();
$p_id = $row['user_id'];

//動画所有者確認
if($_SESSION['user_id'] != $p_id){
    header("Location: mypage");
    exit;
}

$st = $pdo->query("UPDATE video SET delete_date=now() WHERE video_id={$video_id}");


header('Location: video_admin');
?>