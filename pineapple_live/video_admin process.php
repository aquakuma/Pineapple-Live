<?php  

    include('../db/pineapple.php');
    $error = "";
    if(isset($_SESSION['error'])){
        $error = $_SESSION['error'];
        $_SESSION['error'] = "";
    }
    
    $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
    //let logo = getElementById('id');

    //PDOの設定変更
    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
    $pdo->setAttribute(
        PDO::ATTR_EMULATE_PREPARES,
        false
    );
    //SQL文作成
    $sql = "SELECT * FROM video v left join products p ON v.product_id = p.product_id where v.user_id = :user_id AND v.delete_date IS NULL";
    //プリペアードステートメントの設定と取得
    $prestmt = $pdo->prepare($sql);
    //値の設定
    $prestmt->bindValue(':user_id', $_SESSION['user_id']);
    //SQL実行
    $prestmt->execute();
    //抽出結果取得
    $videos = $prestmt->fetchAll(PDO::FETCH_ASSOC);


?>