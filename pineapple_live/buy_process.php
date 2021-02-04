<?php
require './db_connect.php';
session_start();
date_default_timezone_set('Asia/Tokyo');

if(empty($_POST['mode'])){
    header("Location:index.php");
    exit;
}


//購入決済
if($_POST['mode'] == "buy"){

    $product_id = $_POST['product_id'];
    $product_buy_num = $_POST['product_buy_num'];
    $product_buy_size = $_POST['product_buy_size'];
    $product_price = $_POST['product_price'];
    $product_name = $_POST['product_name'];

    echo $product_buy_num.'<br>'.$product_price;


    $pdo = db_connect();
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        //購入履歴　DB　インサート
        $sql = "INSERT INTO order_list (user_id,purchase_date,summary,shipping_date,tracking_number,delivery_days,receipt_date,completion_date,cancel_date,pay_id) VALUES(:user_id,:purchase_date,:summary,:shipping_date,:tracking_number,:delivery_days,:receipt_date,:completion_date,:cancel_date,:pay_id)";
        //プリペアードステートメントの設定と取得
        $prestmt = $pdo->prepare($sql);
        //値の設定
        $prestmt->bindValue(':user_id', $user_id);
        $date = date('Y-m-d H:i:s');
        $prestmt->bindValue(':purchase_date', $date, PDO::PARAM_STR);
        $prestmt->bindValue(':summary', $product_buy_num*$product_price);

        $prestmt->bindValue(':shipping_date', null, PDO::PARAM_NULL);
        $prestmt->bindValue(':tracking_number', null, PDO::PARAM_NULL);
        $prestmt->bindValue(':delivery_days', null, PDO::PARAM_NULL);
        $prestmt->bindValue(':receipt_date', null, PDO::PARAM_NULL);
        $prestmt->bindValue(':completion_date', null, PDO::PARAM_NULL);
        $prestmt->bindValue(':cancel_date', null, PDO::PARAM_NULL);
        $prestmt->bindValue(':pay_id', null, PDO::PARAM_NULL);
        //SQL実行
        $prestmt->execute();


        //オーダーID取得
        $st = $pdo->query("SELECT count(*) as order_id FROM order_list");
        $order_id = $st->fetch();
        $order_id = $order_id['order_id'];

        //注文　商品明細　DB　インサート

        $sql = "INSERT INTO order_detail (order_id,product_id,size,quantity,product_price) VALUES(:order_id,:product_id,:size,:quantity,:product_price)";
        //プリペアードステートメントの設定と取得
        $prestmt = $pdo->prepare($sql);
        //値の設定
        $prestmt->bindValue(':order_id', $order_id);
        $prestmt->bindValue(':product_id', $product_id);
        $prestmt->bindValue(':size', $product_buy_size);
        $prestmt->bindValue(':quantity', $product_buy_num);
        $prestmt->bindValue(':product_price', $product_price);
        //SQL実行
        $prestmt->execute();

        header("Location: buy_done");
        exit;

    }
    else{
        //購入履歴　DB　インサート
        $sql = "INSERT INTO order_list (user_id,purchase_date,summary,shipping_date,tracking_number,delivery_days,receipt_date,completion_date,cancel_date,pay_id) VALUES(:user_id,:purchase_date,:summary,:shipping_date,:tracking_number,:delivery_days,:receipt_date,:completion_date,:cancel_date,:pay_id)";
        //プリペアードステートメントの設定と取得
        $prestmt = $pdo->prepare($sql);
        //値の設定
        $prestmt->bindValue(':user_id', null, PDO::PARAM_NULL);
        $date = date('Y-m-d H:i:s');
        $prestmt->bindValue(':purchase_date', $date, PDO::PARAM_STR);
        $prestmt->bindValue(':summary', $product_buy_num*$product_price);

        $prestmt->bindValue(':shipping_date', null, PDO::PARAM_NULL);
        $prestmt->bindValue(':tracking_number', null, PDO::PARAM_NULL);
        $prestmt->bindValue(':delivery_days', null, PDO::PARAM_NULL);
        $prestmt->bindValue(':receipt_date', null, PDO::PARAM_NULL);
        $prestmt->bindValue(':completion_date', null, PDO::PARAM_NULL);
        $prestmt->bindValue(':cancel_date', null, PDO::PARAM_NULL);
        $prestmt->bindValue(':pay_id', null, PDO::PARAM_NULL);
        //SQL実行
        $prestmt->execute();


        //オーダーID取得
        $st = $pdo->query("SELECT count(*) as order_id FROM order_list");
        $order_id = $st->fetch();
        $order_id = $order_id['order_id'];

        //注文　商品明細　DB　インサート

        $sql = "INSERT INTO order_detail (order_id,product_id,size,quantity,product_price) VALUES(:order_id,:product_id,:size,:quantity,:product_price)";
        //プリペアードステートメントの設定と取得
        $prestmt = $pdo->prepare($sql);
        //値の設定
        $prestmt->bindValue(':order_id', $order_id);
        $prestmt->bindValue(':product_id', $product_id);
        $prestmt->bindValue(':size', $product_buy_size);
        $prestmt->bindValue(':quantity', $product_buy_num);
        $prestmt->bindValue(':product_price', $product_price);
        //SQL実行
        $prestmt->execute();

        header("Location: buy_done");
        exit;

    }

}

//ショッピングカート　決済
if($_POST['mode'] == "cart"){
    //会員
    if(isset($_SESSION['user_id'])){

        $pdo = db_connect();
        $user_id = $_SESSION['user_id'];
        $st = $pdo->query("SELECT s.product_id AS product_id,p.product_price AS product_price,p.product_name AS product_name,s.quantity AS quantity,s.size AS size,s.totally AS totally FROM shopping_cart s,products p WHERE s.product_id = p.product_id AND s.user_id = $user_id");
        $cart = $st->fetchALL();

        $sum = 0;
        foreach($cart as $key => $row){
            if(!empty($row['size'])){
                $cart[$key]['product_name'] = $cart[$key]['product_name']."(".$row['size'].")";
            }
            $sum += $row['totally'];
        }
        
        //購入履歴　DB　インサート
        $sql = "INSERT INTO order_list (user_id,purchase_date,summary,shipping_date,tracking_number,delivery_days,receipt_date,completion_date,cancel_date,pay_id) VALUES(:user_id,:purchase_date,:summary,:shipping_date,:tracking_number,:delivery_days,:receipt_date,:completion_date,:cancel_date,:pay_id)";
        //プリペアードステートメントの設定と取得
        $prestmt = $pdo->prepare($sql);
        //値の設定
        $prestmt->bindValue(':user_id', $user_id);
        $date = date('Y-m-d H:i:s');
        $prestmt->bindValue(':purchase_date', $date, PDO::PARAM_STR);
        $prestmt->bindValue(':summary', $sum);

        $prestmt->bindValue(':shipping_date', null, PDO::PARAM_NULL);
        $prestmt->bindValue(':tracking_number', null, PDO::PARAM_NULL);
        $prestmt->bindValue(':delivery_days', null, PDO::PARAM_NULL);
        $prestmt->bindValue(':receipt_date', null, PDO::PARAM_NULL);
        $prestmt->bindValue(':completion_date', null, PDO::PARAM_NULL);
        $prestmt->bindValue(':cancel_date', null, PDO::PARAM_NULL);
        $prestmt->bindValue(':pay_id', null, PDO::PARAM_NULL);
        //SQL実行
        $prestmt->execute();

        //オーダーID取得
        $st = $pdo->query("SELECT count(*) as order_id FROM order_list");
        $order_id = $st->fetch();
        $order_id = $order_id['order_id'];

        //注文　商品明細　DB　インサート
        foreach($cart as $key => $row){

            $sql = "INSERT INTO order_detail (order_id,product_id,size,quantity,product_price) VALUES(:order_id,:product_id,:size,:quantity,:product_price)";
            //プリペアードステートメントの設定と取得
            $prestmt = $pdo->prepare($sql);
            //値の設定
            $prestmt->bindValue(':order_id', $order_id);
            $prestmt->bindValue(':product_id', $row['product_id']);
            $prestmt->bindValue(':size', $row['size']);
            $prestmt->bindValue(':quantity', $row['quantity']);
            $prestmt->bindValue(':product_price', $row['product_price']);
            //SQL実行
            $prestmt->execute();
        }

        header("Location: cart_empty.php?mode=buy");
        exit;

    }
    //ゲスト
    else{

        $pdo = db_connect();
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

            //購入履歴　DB　インサート
            $sql = "INSERT INTO order_list (user_id,purchase_date,summary,shipping_date,tracking_number,delivery_days,receipt_date,completion_date,cancel_date,pay_id) VALUES(:user_id,:purchase_date,:summary,:shipping_date,:tracking_number,:delivery_days,:receipt_date,:completion_date,:cancel_date,:pay_id)";
            //プリペアードステートメントの設定と取得
            $prestmt = $pdo->prepare($sql);
            //値の設定
            $prestmt->bindValue(':user_id', null, PDO::PARAM_NULL);
            $date = date('Y-m-d H:i:s');
            $prestmt->bindValue(':purchase_date', $date, PDO::PARAM_STR);
            $prestmt->bindValue(':summary', $sum);

            $prestmt->bindValue(':shipping_date', null, PDO::PARAM_NULL);
            $prestmt->bindValue(':tracking_number', null, PDO::PARAM_NULL);
            $prestmt->bindValue(':delivery_days', null, PDO::PARAM_NULL);
            $prestmt->bindValue(':receipt_date', null, PDO::PARAM_NULL);
            $prestmt->bindValue(':completion_date', null, PDO::PARAM_NULL);
            $prestmt->bindValue(':cancel_date', null, PDO::PARAM_NULL);
            $prestmt->bindValue(':pay_id', null, PDO::PARAM_NULL);
            //SQL実行
            $prestmt->execute();

            //オーダーID取得
            $st = $pdo->query("SELECT count(*) as order_id FROM order_list");
            $order_id = $st->fetch();
            $order_id = $order_id['order_id'];

            //注文　商品明細　DB　インサート
            foreach($cart as $key => $row){

                $sql = "INSERT INTO order_detail (order_id,product_id,size,quantity,product_price) VALUES(:order_id,:product_id,:size,:quantity,:product_price)";
                //プリペアードステートメントの設定と取得
                $prestmt = $pdo->prepare($sql);
                //値の設定
                $prestmt->bindValue(':order_id', $order_id);
                $prestmt->bindValue(':product_id', $row['product_id']);
                $prestmt->bindValue(':size', $row['size']);
                $prestmt->bindValue(':quantity', $row['quantity']);
                $prestmt->bindValue(':product_price', $row['product_price']);
                //SQL実行
                $prestmt->execute();
            }
        }

        header("Location: cart_empty.php?mode=buy");
        exit;

    }


}


