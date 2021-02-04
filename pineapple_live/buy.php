<?php
session_cache_limiter('none');
session_start();

require './db_connect.php';

$mode = "";
if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
}
else{
    //header("Location: error");
    header("Location:index.php");
    exit;
}



if(!(isset($_GET['mode']) || isset($_GET['error']) )){
    header("Location: main_product");
    exit;
}

if($mode == 'cart' && $_POST['sum'] == 0){
    header("Location: cart");
    exit;
}

if($mode == 'buy' && empty($_POST['product_buy_num'])){
    $page = $_POST['page'];
    header("Location: $page");
    //header("Location: error");
    exit;
}



$product_name_list = array();
$product_num_list = array();
$product_price_list = array();
$product_totally_list = array();

if($mode == 'buy'){
    $product_id = $_POST['product_id'];
    $product_buy_num = $_POST['product_buy_num'];
    $product_buy_size = $_POST['product_buy_size'];
    $product_price = $_POST['price'];
    $product_name = $_POST['product_name'];


    $product_name_list[0] = $product_name;
    $product_num_list[0] = $product_buy_num;
    $product_size_list[0] = $product_buy_size;
    $product_price_list[0] = $product_price;
    $product_totally_list[0] = $product_buy_num*$product_price;


    $sum = $_POST['product_buy_num'] * $_POST['price'];
}

if($mode == 'cart'){
    $product_name_list = $_POST['product_name'];
    $product_num_list = $_POST['quantity'];
    $product_price_list = $_POST['product_price'];
    $product_totally_list = $_POST['totally'];
    $product_size_list = $_POST['size'];

    $sum = $_POST['sum'];
}

//価格をカンマー区切り
foreach($product_price_list as $key => $row){
    $product_price_list[$key] = number_format($row);
}
foreach($product_totally_list as $key => $row){
    $product_totally_list[$key] = number_format($row);
}
$sum = number_format($sum);


$error = "";
$name = "";
$address = "";
$email = "";
$tel = "";

if(isset($_GET['error'])){
    $error = $_GET['error'];
}


if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $pdo = db_connect();

    $st = $pdo->query("SELECT * FROM user WHERE user_id = $user_id");
    $user = $st->fetch();
    $name = $user['user_name'];
    $family_name = $user['family_name'];
    $first_name = $user['first_name'];
    $address = $user['user_address'];
    $email = $user['email'];
    $tel = $user['tel'];

}



echo $error;

require 't_buy.php';

?>

<script>
    //Jquery form送信  （data-action）
    $('.submit').click(function() {
    $(this).parents('form').attr('action', $(this).data('action'));
    $(this).parents('form').submit();
    });
</script>