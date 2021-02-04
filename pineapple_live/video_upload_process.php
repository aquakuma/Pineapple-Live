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
    $sql = "SELECT product_id,product_name,u.user_name as user_name FROM products p inner join user u on p.user_id = u.user_id WHERE p.delete_date IS NULL";
    //プリペアードステートメントの設定と取得
    $prestmt = $pdo->prepare($sql);
    //SQL実行
    $prestmt->execute();
    //抽出結果取得
    $products = $prestmt->fetchAll(PDO::FETCH_ASSOC);
?>