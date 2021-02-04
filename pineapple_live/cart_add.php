<?php
    session_start();
    date_default_timezone_set('Asia/Tokyo');
    include('./db_connect.php');
    $product_size = "";
    $page = "";
    if(isset($_POST['page'])){
        $page = $_POST['page'];
    }
    if(isset($_POST['page']) && isset($_POST['product_buy_num']) && isset($_POST['product_id'])){
        $page = $_POST['page'];
        $product_buy_num = $_POST['product_buy_num'];
        $product_id = $_POST['product_id'];
        $price = $_POST['price'];
        if(isset($_POST['product_buy_size'])){
            $product_size = $_POST['product_buy_size'];
        }
    }
    else{
        header("Location: $page");
        exit;
    }

    //購入数が0の場合　前のページ戻る
    if(empty($_POST['product_buy_num'])){
        header("Location: $page");
        exit;
    }
    //会員判断
    //ゲストの場合
    if(empty($_SESSION['user_id'])){
        $_SESSION["customer_status"] = "guest";
        $_SESSION["guest_ip"] = $_SERVER["REMOTE_ADDR"];

        if(empty($_SESSION['cart_product_id'])){
            $_SESSION['cart_product_id'] = array();
            $_SESSION['cart_quantity'] = array();
            $_SESSION['cart_totally'] = array();
            $_SESSION['cart_size'] = array();
            $_SESSION['cart_name'] = array();
            $_SESSION['cart_price'] = array();

            array_push($_SESSION['cart_product_id'],$product_id);
            array_push($_SESSION['cart_quantity'],$product_buy_num);
            array_push($_SESSION['cart_name'],$_POST['product_name']);
            array_push($_SESSION['cart_price'],$price);
            array_push($_SESSION['cart_totally'],$price*$product_buy_num);
            array_push($_SESSION['cart_size'],$product_size);
        }

        //同じ商品の場合
        foreach($_SESSION['cart_product_id'] as $key => $pid){
            if($pid == $product_id){
                $_SESSION['cart_quantity'][$key] += $product_buy_num;
                $_SESSION['cart_totally'][$key] += $price*$product_buy_num;
            }
            else{
                array_push($_SESSION['cart_product_id'],$product_id);
                array_push($_SESSION['cart_quantity'],$product_buy_num);
                array_push($_SESSION['cart_name'],$_POST['product_name']);
                array_push($_SESSION['cart_price'],$price);
                array_push($_SESSION['cart_totally'],$price*$product_buy_num);
                array_push($_SESSION['cart_size'],$product_size);
            }
        }


        header("Location: cart");
        exit;
    }
    //会員の場合
    else{
        $user_id = $_SESSION['user_id'];
        $pdo = db_connect();

        $sql = "INSERT INTO shopping_cart(user_id,product_id,quantity,totally,size,add_date) values (:user_id,:product_id,:quantity,:totally,:size,:add_date) ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity),totally = totally + VALUES(totally)";

        //プリペアードステートメントの設定と取得
        $prestmt = $pdo->prepare($sql);
        //値の設定
        $prestmt->bindValue(':user_id', $user_id);
        $prestmt->bindValue(':product_id', $product_id);
        $prestmt->bindValue(':totally', $price*$product_buy_num);
        $prestmt->bindValue(':quantity', $product_buy_num);
        if(!empty($product_size)){
            $prestmt->bindValue(':size', $product_size);
        }
        else{
            $prestmt->bindValue(':size', null, PDO::PARAM_NULL);
        }
        $date = date('Y-m-d H:i:s');
        $prestmt->bindValue(':add_date', $date, PDO::PARAM_STR);
        //SQL実行
        $prestmt->execute();

        header("Location: cart");
        exit;

    }


?>