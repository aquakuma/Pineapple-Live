<?php
require 'common_kanri.php';
$error = '';
$pdo = connect();
if (@$_POST['submit']) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    //$category = $_POST['category'];
    $product_description = "'" . $_POST['product_description'] . "'";
    $product_price = $_POST['product_price'];
    $product_inventory = $_POST['product_inventory'];
    $product_maker = "'" . $_POST['product_maker'] . "'";
    $product_number = "'" . $_POST['product_number'] . "'";
    $size = "'" . $_POST['size'] . "'";

    if (isset($_POST['category_id'])) {
        $category_id = $_POST['category_id'];
    } else {
        // $error .= '商品カテゴリーを選択していません。<br>';
        $category_id = 'NULL';
    }

    if (!$product_name) $error .= '商品名がありません。<br>';
    if (!$product_price) $error .= '価格情報がありません。<br>';
    if (!$product_inventory) $product_inventory = 'NULL';
    if (!$product_maker) $product_maker = 'NULL';
    if (!$product_number) $product_number = 'NULL';
    if (!$product_description) $product_description = 'NULL';
    if (!$size) $size = 'NULL';
    if (preg_match('/\D/', $product_price)) $error .= '価格が不正です。<br>';

    if (!$error) {
        $pdo->query("UPDATE products SET category_id=$category_id,product_name='$product_name',product_price=$product_price,product_inventory=$product_inventory,product_maker=$product_maker,product_number=$product_number,product_description=$product_description,size=$size
         WHERE product_id=$product_id");
        header('Location: product_kanri.php');
        exit();
    }
} else {
    $product_id = $_GET['product_id'];
    $st = $pdo->query("SELECT * FROM products WHERE product_id=$product_id");
    $row = $st->fetch();
    $category_id = $row['category_id'];
    $product_name = $row['product_name'];
    $product_price = $row['product_price'];
    $product_inventory = $row['product_inventory'];
    $product_maker = $row['product_maker'];
    $product_number = $row['product_number'];
    $product_description = $row['product_description'];
    $size = $row['size'];
}
require 't_product_edit.php';
