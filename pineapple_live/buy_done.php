<?php
require './db_connect.php';
session_start();
?>

<?php include("./includes/header.php");?>
<link href="./css/bootstrap.min.css" rel="stylesheet">
<link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/checkout/">

<style>
    .base{
        width:500px;
        text-align:center;
        margin: 100px auto;
    }
    .id{
        margin: 0 auto;
        width:200px;
        text-align:center;
        padding-right:20px;
    }
</style>
<?php include("./includes/navbar.php");?>

<main>
    <div class="base">
        <h2>購入完了しました。</h2><br>
        <h2>ご購入ありがとうございます。</h2>

        
    </div>
    <div class='id'>
        <a href="index.php">お買い物に戻る</a>
    </div>

        　

</main>



<?php include("./includes/footer.php");?>
<script>//ここで自分のJSを書く</script>
<?php include("./includes/script.php");?>
