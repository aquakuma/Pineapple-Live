<?php
require 'common_kanri.php';
$pdo = connect();
$st = $pdo->query("UPDATE products SET delete_date=now() WHERE product_id={$_GET['product_id']}");

header('Location: product_kanri.php');
?>
