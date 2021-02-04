<?php
session_start();

require './db_connect.php';

$mode = "";
if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
}
else{
    header("Location:". $_SERVER['HTTP_REFERER']);
    exit;
}

$error = "";
$name = "";
$address = "";
$email = "";
$tel = "";
$family_name = "";
$first_name = "";


$product_id = "";
$product_buy_num = "";
$product_buy_size = "";
$product_price = "";
$product_name = "";

if($_POST['mode'] == "buy"){

    $product_id = $_POST['product_id'];
    $product_buy_num = $_POST['product_buy_num'];
    $product_buy_size = $_POST['product_buy_size'];
    $product_price = $_POST['product_price'];
    $product_name = $_POST['product_name'];
}





if(!isset($_POST['mode'])){
    header("Location: index.php");
    exit;
}


if(isset($_POST['family_name'])){
    $family_name = $_POST['family_name'];
}
else{
    $error .='苗字、';
}
if(isset($_POST['first_name'])){
    $first_name = $_POST['first_name'];
}
else{
    $error .='名前、';
}

if(isset($_POST['address'])){
    $address = $_POST['address'];
}
else{
    $error .='住所、';
}
if(isset($_POST['email'])){
    $email = $_POST['email'];
}
else{
    $error .='メール、';
}


if(!empty($error)){
    $error .= "入力してください。";
    header("Location:". $_SERVER['HTTP_REFERER']."&error=".$error);
    exit;
}


$sum = $_POST['sum'];


require 't_buy_confirmation.php';

?>

