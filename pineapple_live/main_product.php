<?php
session_start();
require './db_connect.php';
$pdo = db_connect();

$category_id ="";
$category_name ="";
if(isset($_GET['category_id'])){
    $category_id = $_GET['category_id'];

    $sql = "SELECT * FROM products WHERE category_id = $category_id AND delete_date IS NULL";
    $st = $pdo->query("SELECT category_name FROM product_category WHERE category_id = $category_id");
    $category_name = $st->fetch();
    $category_name = $category_name['category_name'];
}
else{
    $sql = "SELECT * FROM products WHERE delete_date IS NULL";
}

$st = $pdo->query($sql);
// 配列goodsに productsテーブルの値を格納
$goods = $st->fetchAll();
require 't_main_product.php';

?>

<script>
    function init(){
        category_name_text = '<?php echo $category_name ?>';
        var category_name = document.getElementById('category_name');
        category_name.textContent = category_name_text;
    }

    window.addEventListener('load', init);

</script>



