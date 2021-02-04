<?php
include("../db/pineapple.php");
// アクセスログの格納
function setLogs($uri, $ipaddress){


    /*
    // データベースからリスト取得
    $db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
    // 文字コードセット
    $db->query('SET NAMES utf8');
    // SQL文作成
    $sql = "INSERT INTO logs (uri, ipaddress) VALUES (:uri, :ipaddress);";
    // クエリ
    $stt = $db->prepare($sql);
    // 変数設定
    $stt->bindParam(':uri', $uri);
    $stt->bindParam(':ipaddress', $ipaddress);
    // クエリ実行
    $ret = $stt->execute();
    */
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
    
        //live_id 存在　チェック
        $sql = "INSERT INTO access_logs (uri, ipaddress,created) VALUES ('$uri', '$ipaddress',now());";
        $dbh = $pdo->query($sql);
        return $dbh;
    }
    catch (PDOException $e) {
        print('接続失敗:' . $e->getMessage());
        return $e->getMessage();
        die();

    }
}
    // 閲覧者数の取得（1分以内のユニークアクセスを取得）
function getLogs($uri){

    /*
    // データベースからリスト取得
    $db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
    // 文字コードセット
    $db->query('SET NAMES utf8');
    // SQL文作成
    $sql = "SELECT COUNT(*) as cnt FROM logs WHERE uri = :uri AND created > current_timestamp + interval -1 minute GROUP BY ipaddress";
    // クエリ
    $stt = $db->prepare($sql);
    // 変数設定
    $stt->bindParam(':uri', $uri);
    // クエリ実行
    $stt->execute();
    // 結果抽出
    $row = $stt->fetch();
    // 返却
    return $row['cnt'];
    */
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
    
        $sql = "SELECT COUNT(DISTINCT ipaddress) as cnt FROM access_logs WHERE uri = '$uri' AND created > current_timestamp + interval -1 minute";
        $dbh = $pdo->query($sql);
        while($record = $dbh->fetch(PDO::FETCH_ASSOC)){
            //インスタンスのみ→PDO::FETCH_NUM
            //連想配列のみ→PDO::FETCH_ASSOC
            //両方→PDO::FETCH_BOTH（メモリの無駄）
            //print_r($record);
            $cnt = $record["cnt"];
    
        }
        return $cnt;
    }

    catch (PDOException $e) {
        print('接続失敗:' . $e->getMessage());
        return $e->getMessage();
        die();

    }
}


function setvideo_views($uri,$video_id){

    /*
    // データベースからリスト取得
    $db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
    // 文字コードセット
    $db->query('SET NAMES utf8');
    // SQL文作成
    $sql = "SELECT COUNT(*) as cnt FROM logs WHERE uri = :uri AND created > current_timestamp + interval -1 minute GROUP BY ipaddress";
    // クエリ
    $stt = $db->prepare($sql);
    // 変数設定
    $stt->bindParam(':uri', $uri);
    // クエリ実行
    $stt->execute();
    // 結果抽出
    $row = $stt->fetch();
    // 返却
    return $row['cnt'];
    */
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
    
        $sql = "SELECT COUNT(DISTINCT ipaddress) as cnt FROM access_logs WHERE uri = '$uri'";
        $dbh = $pdo->query($sql);
        while($record = $dbh->fetch(PDO::FETCH_ASSOC)){
            //インスタンスのみ→PDO::FETCH_NUM
            //連想配列のみ→PDO::FETCH_ASSOC
            //両方→PDO::FETCH_BOTH（メモリの無駄）
            //print_r($record);
            $cnt = $record["cnt"];
    
        }

        //video tableに視聴者数アップデート
        $sql = "UPDATE video SET views = :views WHERE video_id =:video_id ";
        //プリペアードステートメントの設定と取得
        $prestmt = $pdo->prepare($sql);
        //値の設定
        $prestmt->bindValue(':views', $cnt);
        $prestmt->bindValue(':video_id', $video_id);
        //SQL実行
        $prestmt->execute();


        return $cnt;
    }

    catch (PDOException $e) {
        print('接続失敗:' . $e->getMessage());
        return $e->getMessage();
        die();

    }
}

?>