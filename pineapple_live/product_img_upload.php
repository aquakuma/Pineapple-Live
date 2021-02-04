<?php
require 'common_kanri.php';
$error = '';
$pdo = connect();
if (@$_POST['submit']) {
    $product_id = $_POST['product_id'];
    $image_id = $product_id;
    $st = $pdo->query("UPDATE products SET image_id='$image_id' WHERE product_id=$product_id");
    if (move_uploaded_file($_FILES['pic']['tmp_name'], "files/products/$product_id.jpg")) {
        header('Location: product_kanri.php');
        exit();
    } else {
        $error .= 'ファイルを選択してください。<br>';
    }
} else {
    $product_id = $_GET['product_id'];
}
require 't_product_img_upload.php';
