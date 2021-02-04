<?php
require './db_connect.php';
session_start();

if(isset($_SESSION['user_id'])){

    $user_id = $_SESSION['user_id'];

    $pdo = db_connect();
    $sql = "DELETE FROM shopping_cart WHERE user_id = :user_id;";
    //プリペアードステートメントの設定と取得
    $prestmt = $pdo->prepare($sql);
    //値の設定
    $prestmt->bindValue(':user_id', $user_id);
    //SQL実行
    $prestmt->execute();
}
else{
    unset($_SESSION['cart_product_id']);
    unset($_SESSION['cart_quantity']);
    unset($_SESSION['cart_name']);
    unset($_SESSION['cart_price']);
    unset($_SESSION['cart_totally']);
    unset($_SESSION['cart_size']);

}

if($_GET['mode'] == 'cart'){
    header('Location: cart');
    exit;
}
if($_GET['mode'] == 'buy'){
    header('Location: buy_done');
    exit;
}
?>