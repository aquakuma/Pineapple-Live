<?php
include("login_check.php");
require 'common_kanri.php';
$pdo = connect();
$user_id = $_SESSION['user_id'];
$st = $pdo->query("SELECT * FROM products p,product_category c where user_id = $user_id AND p.category_id = c.category_id");
$goods = $st->fetchAll();
$st = $pdo->query("SELECT * FROM products_size");
$size = $st->fetchAll();
require 't_index_kanri.php';
