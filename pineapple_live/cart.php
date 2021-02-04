<?php
require './db_connect.php';
session_start();
$sum = 0;
$pdo = db_connect();

/*
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = array();
if (@$_POST['submit']) {
    @$_SESSION['cart'][$_POST['product_id']] += $_POST['num'];
}
foreach ($_SESSION['cart'] as $product_id => $num) {
    $st = $pdo->prepare("SELECT * FROM products WHERE product_id=?");
    $st->execute(array($product_id));
    $row = $st->fetch();
    $st->closeCursor();
    $row['num'] = strip_tags($num);
    $sum += $num * $row['product_price'];
    $rows[] = $row;
}
*/


if(isset($_SESSION['user_id'])){

    $user_id = $_SESSION['user_id'];
    $st = $pdo->query("SELECT s.product_id AS product_id,p.product_price AS product_price,p.product_name AS product_name,s.quantity AS quantity,s.size AS size,s.totally AS totally FROM shopping_cart s,products p WHERE s.product_id = p.product_id AND s.user_id = $user_id");
    $cart = $st->fetchALL();

    $sum = 0;
    foreach($cart as $key => $row){
        if(!empty($row['size'])){
            if($row['size'] == " "){
                $cart[$key]['product_name'] = $cart[$key]['product_name'];
            }
            else{
                $cart[$key]['product_name'] = $cart[$key]['product_name']."(".$row['size'].")";
                //$cart[$key]['product_name'] = $cart[$key]['product_name'];
            }
            
        }
        $sum += $row['totally'];
    }
    

}
else{
    if(!empty($_SESSION['cart_product_id'])){

        for($i=0;$i < count($_SESSION['cart_product_id']) ; $i++){
            $cart[$i]['product_id'] = $_SESSION['cart_product_id'][$i];
            $cart[$i]['product_name'] = $_SESSION['cart_name'][$i];
            $cart[$i]['product_price'] = $_SESSION['cart_price'][$i];
            $cart[$i]['quantity'] = $_SESSION['cart_quantity'][$i];
            $cart[$i]['totally'] = $_SESSION['cart_totally'][$i];
            $cart[$i]['size'] = $_SESSION['cart_size'][$i];
        }

    
        $sum = 0;
        foreach($cart as $key => $row){
            if(!empty($row['size'])){
                $cart[$key]['product_name'] = $cart[$key]['product_name']."(".$row['size'].")";
            }
            $sum += $row['totally'];
        }
    }
    else{
        $cart = array();
    }

}




require 't_cart.php';
