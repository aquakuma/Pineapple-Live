<?php
include("login_check.php");

require 'common_kanri.php';
$error = '';
$pdo = connect();
$product_id = $_GET['product_id'];
$st = $pdo->query("SELECT * FROM products WHERE product_id=$product_id");
$row = $st->fetch();
$p_id = $row['user_id'];
$p_img = $row['image_id'];

//商品所有者確認
if($_SESSION['user_id'] != $p_id){
    header("Location: main.php");
    exit;
}



require 't_upload.php';
