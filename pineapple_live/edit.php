<?php
session_start();
require 'common_kanri.php';
$error = '';
$pdo = connect();

$product_id = $_GET['product_id'];
$cate_id = '';
$st = $pdo->query("SELECT * FROM products WHERE product_id=$product_id");
$row = $st->fetch();
$cate_id = $row['category_id'];
$p_id = $row['user_id'];

$st = $pdo->query("SELECT * FROM products_size WHERE product_id=$product_id");
$db_size = $st->fetch();

//商品所有者確認
if($_SESSION['user_id'] != $p_id){
    header("Location: main.php");
    exit;
}


if (isset($_POST['post_flag'])) {
    

    $product_name = $_POST['product_name'];
    //$category = $_POST['category'];
    $description = $_POST['product_description'];
    $product_description = "'" .$description. "'";
    $product_price = $_POST['product_price'];
    $product_inventory = $_POST['product_inventory'];
    $product_maker = "'" . $_POST['product_maker'] . "'";
    $product_number = "'" . $_POST['product_number'] . "'";
    $size = "'" . $_POST['size'] . "'";

    if (isset($_POST['category_id'])) {
        $category_id = $_POST['category_id'];
    } else {
        // $error .= '商品カテゴリーを選択していません。<br>';
        $category_id = 'NULL';
    }

    if (!$product_name) $error .= '商品名がありません。<br>';
    if (!$product_price) $error .= '価格情報がありません。<br>';
    if (!$product_inventory) $product_inventory = 0;
    if (!$product_maker) $product_maker = 'NULL';
    if (!$product_number) $product_number = 'NULL';
    if (!$product_description) $product_description = 'NULL';
    if (!$size) $size = 'NULL';
    if (preg_match('/\D/', $product_price)) $error .= '価格が不正です。<br>';

    if (!$error) {
        $pdo->query("UPDATE products SET category_id=$category_id,product_name='$product_name',product_price=$product_price,product_inventory=$product_inventory,product_maker=$product_maker,product_number=$product_number,product_description=$product_description
         WHERE product_id=$product_id");

         if(isset($size) && isset($product_inventory)){
            $pdo->query("INSERT INTO products_size (product_id, product_size, product_inventory) values ($product_id, $size, $product_inventory) ON DUPLICATE KEY UPDATE product_inventory = $product_inventory");
         }
         $st = $pdo->query("SELECT count(*) as size_count FROM products_size where product_id = $product_id");
         $size_count = $st->fetch();


         if($size_count['size_count']>1){
             $sql = "DELETE FROM products_size WHERE product_id = :product_id AND product_size = ' ';";
             //プリペアードステートメントの設定と取得
             $prestmt = $pdo->prepare($sql);
             //値の設定
             $prestmt->bindValue(':product_id', $product_id);
             //SQL実行
             $prestmt->execute();
         }

        header('Location: index_kanri.php');
        exit();
    }
} else {
    $product_id = $_GET['product_id'];
    $st = $pdo->query("SELECT * FROM products WHERE product_id=$product_id");
    $row = $st->fetch();
    $category_id = $row['category_id'];
    $product_name = $row['product_name'];
    $product_price = $row['product_price'];
    $product_inventory = $row['product_inventory'];
    $product_maker = $row['product_maker'];
    $product_number = $row['product_number'];
    $product_description = $row['product_description'];
    $size = $db_size['product_size'];
}
require 't_edit.php';
?>


<script>
    //Jquery form送信  （data-action）
    $('.submit').click(function() {
    $(this).parents('form').attr('action', $(this).data('action'));
    $(this).parents('form').submit();
    });
</script>