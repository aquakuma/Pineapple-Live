<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>商品画像アップロード</title>
    <link rel="stylesheet" href="css/kanri.css">
</head>

<body>
<?php include("header.html");?>

    <div class="base">
        <?php if ($error) echo "<span class=\"error\">$error</span>" ?>
        <form action="product_img_upload.php" method="post" enctype="multipart/form-data">
            <p>
                商品画像（JPEGのみ）<br>
                <input type="file" name="pic">
            </p>
            <p>
                <input type="hidden" name="product_id" value="<?php echo $product_id ?>">
                <input type="submit" name="submit" value="追加">
            </p>
        </form>
    </div>
    <div class="base">
        <a href="product_kanri">一覧に戻る</a>　
    </div>


<?php include("footer.html");?>
</body>

</html>