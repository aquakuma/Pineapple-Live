<?php include('./main_session.php');?>
<?php include("header.php");?>
<title>会員ページ</title>

<?php include("navbar.php");?>

<main>
    <a href="index.php">top</a>
    <h2>HELLO!<?php echo $user_name;?></h2>
    <img style = "height: 300px; width:auto;" src="<?php echo $_SESSION["user_icon"]?>" alt="">
    <a href="live_admin">ライブ設定</a>
    <a href="member_info">会員情報変更</a>
    <a href="main_product">商品一覧</a>
    <a href="index_kanri">商品管理</a>

    <?php echo $live_link;?>
    <a href="logout">logout</a>
</main>


<?php include("footer.php");?>
<script>//ここで自分のJSを書く</script>
<?php include("script.php");?>