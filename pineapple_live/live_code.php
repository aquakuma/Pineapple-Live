<?php

    include("../db/pineapple.php");
    $push_jquery = "";

    //require_once('./log_db.php'); // log_db.phpファイルの読み込み（同一階層格納時）
    $uri = $_SERVER["REQUEST_URI"]; // アクセスしたページのURI
    $ipaddress = $_SERVER["REMOTE_ADDR"]; // IPアドレス取得


    if(isset($_GET['live_id'])) 
    { 
        $live_id = $_GET['live_id']; 
        $push_jquery = "<input id='live_id' type='hidden' value='$live_id' name='live_id'>";

        $dsn = "mysql:host = localhost;dbname=hew2_pineapple;charset=utf8mb4";
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
        $sql = "select live_id from live where live_ID = $live_id";
        $dbh = $pdo->query($sql);
        $record = $dbh->fetch(PDO::FETCH_ASSOC);
        if(!$record){
            header("Location: main.php");
            exit;
        }

    }
    else{
        header("Location: main.php");
        exit;
    }

    $input_button = "";
    $user_id = "";
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['user_name'];
        $input_button = 
        '<div class="input-group" id="chat_area">
            <input id="message" type="text" class="form-control input-sm" placeholder="ここで入力してください..." />
            <span class="input-group-btn">
                <button class="btn btn-primary btn-sm" id="greet">
                    送信</button>
            </span>
        </div>';


        //jquery 値渡す処理
        $push_jquery .= "<input id='user_id' type='hidden' value='$user_id' name='user_id'>
                        <input id='user_name' type='hidden' value='$user_name' name='user_name'>";
    }
    else{
        $input_button = 
        '<div class="input-group">
            <div id ="login_area">
                <h6><a href="login">ログインしてチャットを始める</a></h6>
            </div>
        </div>';

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
        $sql = "select l.user_id, l.title, l.description, u.user_name, u.user_icon from live l JOIN user u ON l.user_id = u.user_id where l.live_id = $live_id";
        $dbh = $pdo->query($sql);


        while($record = $dbh->fetch(PDO::FETCH_ASSOC)){
            //インスタンスのみ→PDO::FETCH_NUM
            //連想配列のみ→PDO::FETCH_ASSOC
            //両方→PDO::FETCH_BOTH（メモリの無駄）
            //print_r($record);
            $Title= $record["title"];
            $vtuber_id=$record["user_id"];
            $vtuber= $record["user_name"];
            $description=$record["description"];
            if(!$record['user_icon']){
                $vtuber_icon = "./files/member/icon/0.png";
            }
            else{
                $vtuber_icon=$record["user_icon"];
            }
            
        }

    }

    catch (PDOException $e) {
        print('接続失敗:' . $e->getMessage());
        die();
    }

?>



