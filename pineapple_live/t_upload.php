<?php include("./includes/header.php");?>
<title>商品画像アップロード</title>

<style>
    form{
        width:600px;
        margin: 50px auto;
        border:solid 1px;
        padding: 20px;
    }
    form img{
        height:300px;
        width:250px;
        object-Fit:cover;
        margin-bottom:30px;
    }
    form h2{
        border-bottom:solid 1px;
    }

</style>
<?php include("./includes/navbar.php");?>

<maim>
    <div class="base">
        <?php if ($error) echo "<span class=\"error\">$error</span>" ?>
        <form action="uploader.php" method="post" enctype="multipart/form-data">
            <p>
                <h2>商品画像変更</h2>
                <img src="<?php echo $p_img?>" alt="">
                <br>
                <input type="file" name="fname" accept="image/*">
                <input type="submit" class="btn btn-primary float-right" name="submit" value="変更">
            </p>

                <input type="hidden" name="product_id" value="<?php echo $product_id ?>">
                <input  type='hidden' value='product_img' name='upload_mode'>
                
            <div id="button_area">
                <a href="index_kanri.php" class="btn btn-secondary float-right">一覧に戻る</a>　
            </div>
        </form>
    </div>

</maim>

<?php include("./includes/footer.php");?>
<script>//ここで自分のJSを書く</script>
<?php include("./includes/script.php");?>