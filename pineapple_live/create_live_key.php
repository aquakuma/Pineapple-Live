<?php

session_start();
include("../db/pineapple.php");
if (isset($_SESSION['user_id'])) {
    $User_ID = $_SESSION['user_id'];
} else {
    header("Location: login.php");
    exit;
}

$title = "";
if (isset($_POST['title'])) {
    $title = '"' . $_POST['title'] . '"';
} else {
    header("Location: live_admin.php");
    exit;
}



//DB
try {

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
        PDO::ERRMODE_EXCEPTION
    );    //2


    //LIVE情報をデータベースにINSERT
    $sql = "INSERT INTO live (User_ID,Product_ID,Title,Start_date,End_date,Thumbnail,Sum_live_tip,Description) VALUES ($User_ID,default,$title,default,default,default,default,default)";
    $pdo->exec($sql);

    //LIVE_ID ゲット
    $sql = "select Live_ID  from live where User_ID = $User_ID";
    $dbh = $pdo->query($sql);


    while ($record = $dbh->fetch(PDO::FETCH_ASSOC)) {
        //インスタンスのみ→PDO::FETCH_NUM
        //連想配列のみ→PDO::FETCH_ASSOC
        //両方→PDO::FETCH_BOTH（メモリの無駄）
        //print_r($record);
        $Live_ID = $record["Live_ID"];
    }
    $_SESSION["Live_key"] = $Live_ID;
    header("Location: live_admin.php");
    exit;
} catch (PDOException $e) {
    print('接続失敗:' . $e->getMessage());
    die();
}
