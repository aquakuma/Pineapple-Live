<?php
require 'common_kanri.php';
$pdo = connect();
session_start();
$product_id = $_GET['product_id'];
$st = $pdo->query("SELECT * FROM products WHERE product_id=$product_id");
$row = $st->fetch();
$p_id = $row['user_id'];

//商品所有者確認
if($_SESSION['user_id'] != $p_id){
    header("Location: mypage");
    exit;
}

$st = $pdo->query("UPDATE products SET delete_date=now() WHERE product_id={$product_id}");


header('Location: index_kanri.php');
