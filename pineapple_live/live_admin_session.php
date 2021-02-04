<?php
session_start();
include("../db/pineapple.php");
if(!$_SESSION['user_id']){
    header("Location: login");
    exit;
}
else{
    $user_id = $_SESSION['user_id'];
    try{

        $dsn = "mysql:host = 127.0.0.1;dbname=hew2_pineapple;charset=utf8mb4";
        //※data source name
        //127.0.0.1=localhost
    
        $db_user = "root"; //既定の管理ユーザ
        $db_password = "";
        
    
        //DB操作用オブジェクトの作成
    
        $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
    
        //PDOの設定変更（エラー黙殺→例外発生）
        $pdo->setAttribute(
            PDO::ATTR_ERRMODE,          //3
            PDO::ERRMODE_EXCEPTION);    //2
        
        //LIVE_ID ゲット
        $sql = "select live_id,title,thumbnail  from live where user_id = $user_id order by live_id desc limit 1";
        $dbh = $pdo->query($sql);


        while($record = $dbh->fetch(PDO::FETCH_ASSOC)){
            //インスタンスのみ→PDO::FETCH_NUM
            //連想配列のみ→PDO::FETCH_ASSOC
            //両方→PDO::FETCH_BOTH（メモリの無駄）
            //print_r($record);
            $live_id= $record["live_id"];
            $title= $record["title"];
            $thumbnail= $record["thumbnail"];

        }
        if(isset($live_id)){
            $live_key = $live_id;
            $live_title = $title;
        }

        //ユーザー販売商品ゲット
        $sql = "select product_id,product_name from products where user_id = $user_id";
        $dbh = $pdo->query($sql);

        $index = 0;

        while($record = $dbh->fetch(PDO::FETCH_ASSOC)){
            //インスタンスのみ→PDO::FETCH_NUM
            //連想配列のみ→PDO::FETCH_ASSOC
            //両方→PDO::FETCH_BOTH（メモリの無駄）
            //print_r($record);
            $product_id[$index]= $record["product_id"];
            $product_name[$index]= $record["product_name"];
            $index++;
        }

    }

    catch (PDOException $e) {
        print('接続失敗:' . $e->getMessage());
        die();
    }
}

//live key 生成されたら　画面に表示
$print = "";

if(!empty($product_id)){

    $product_input =  "";

    for($i = 0 ; $i < count($product_id);$i++){
        $product_input .= "<input type='checkbox' name='products' value='".$product_id[$i]."'>".$product_name[$i];
        //$product_input = count($Product_ID);
    }
}


?>