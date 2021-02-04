<?php
    session_start();
    $push_jquery = "";
    include("../db/pineapple.php");
    if(isset($_GET['live_id'])) 
    { 
        $live_id = $_GET['live_id']; 
        $push_jquery = "<input id='live_id' type='hidden' value='$live_id' name='live_id'>";

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
    
        //live_id 存在　チェック
        $sql = "select live_id  from live where live_id = $live_id";
        $dbh = $pdo->query($sql);
        $record = $dbh->fetch(PDO::FETCH_ASSOC);
        if(!$record){
            header("Location: main");
            exit;
        }

    }
    else{
        header("Location: main");
        exit;
    }

    $input_button = "";
    $user_id = "";
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['user_name'];
        $input_button = '<div id="inputField">
        <p>Message: <input type="text" name="message" id="message"><input type="button" id="greet" value="send"></p></div>';



        //jquery 値渡す処理
        $push_jquery .= "<input id='user_id' type='hidden' value='$user_id' name='user_id'>
                        <input id='user_name' type='hidden' value='$user_name' name='user_name'>";
    }


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
        
        //LIVE_TITLE ゲット
        $sql = "select title  from live where live_id = $live_id";
        $dbh = $pdo->query($sql);


        while($record = $dbh->fetch(PDO::FETCH_ASSOC)){
            //インスタンスのみ→PDO::FETCH_NUM
            //連想配列のみ→PDO::FETCH_ASSOC
            //両方→PDO::FETCH_BOTH（メモリの無駄）
            //print_r($record);
            $title= $record["title"];
        }
    }

    catch (PDOException $e) {
        print('接続失敗:' . $e->getMessage());
        die();
    }

?>