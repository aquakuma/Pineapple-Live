<?php
session_start();
include('../db/pineapple.php');
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION["user_name"];
    $live_link = "";
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
    

          //ライブキー
          $sql = "select live_id,title from live where user_id = '$user_id' order by live_id desc limit 1";
          $dbh = $pdo->query($sql);

          $live_id = "";
          $title = "";

          while($record = $dbh->fetch(PDO::FETCH_ASSOC)){
              //インスタンスのみ→PDO::FETCH_NUM
              //連想配列のみ→PDO::FETCH_ASSOC
              //両方→PDO::FETCH_BOTH（メモリの無駄）
              //print_r($record);
              $live_id= $record["live_id"];
              $title= $record["title"];
          }
		  $record = $dbh->fetch(PDO::FETCH_ASSOC);
          if(!$live_id){
		  }
		  else{
			  $live_url = "live?live_id=".$live_id;
			  $live_link = "<a href='$live_url'>マイライブページ</a>";
		  }

    }

    catch (PDOException $e) {
        print('接続失敗:' . $e->getMessage());
        die();
    }
}
else{
    header("Location: login");
    exit;
}

  
?>