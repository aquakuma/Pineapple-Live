<?php  
    include('./db_connect.php');

    $error = "";
    if(isset($_SESSION['error'])){
        $error = $_SESSION['error'];
        $_SESSION['error'] = "";
    }
    
    $video_id = $_GET['video_id'];
    $pdo = db_connect();
    $st = $pdo->query("SELECT * FROM video WHERE video_id=$video_id");
    $row = $st->fetch();
    $p_id = $row['user_id'];

    //動画所有者確認
    if($_SESSION['user_id'] != $p_id){
        header("Location: main.php");
        exit;
    }

    $product_id = "";
    $video_title = "";
    $description = "";

    $product_id = $row['product_id'];
    $video_title = $row['video_title'];
    $description = $row['description'];

    //SQL文作成
    $sql = "SELECT product_id,product_name,u.user_name as user_name FROM products p inner join user u on p.user_id = u.user_id WHERE p.delete_date IS NULL";
    //プリペアードステートメントの設定と取得
    $prestmt = $pdo->prepare($sql);
    //SQL実行
    $prestmt->execute();
    //抽出結果取得
    $products = $prestmt->fetchAll(PDO::FETCH_ASSOC);
?>