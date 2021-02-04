<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>商品修正</title>
    <link rel="stylesheet" href="css/kanri.css">
</head>

<body>
<?php include("header.html");?>

    <div class="base">
        <?php if ($error) echo "<span class=\"error\">$error</span>" ?>
        <form action="product_edit.php" method="post">

            <p>
                商品カテゴリー<br>
                <input type="radio" name="category_id" value="1">本・コミック・雑誌
                <input type="radio" name="category_id" value="2">DVD・楽器・ゲーム
                <input type="radio" name="category_id" value="3">家電・カメラ・AV機器
                <input type="radio" name="category_id" value="4">パソコン・周辺機器
                <input type="radio" name="category_id" value="5">キッチン・ホーム
                <input type="radio" name="category_id" value="6">食品・飲料
                <input type="radio" name="category_id" value="7">ビューティー
                <input type="radio" name="category_id" value="8">ベビー・おもちゃ
                <input type="radio" name="category_id" value="9">ファッション
                <input type="radio" name="category_id" value="10">スポーツ・アウトドア

            </p>

            <p>
                商品名<br>
                <input type="text" name="product_name" value="<?php echo $product_name ?>">
            </p>
            <p>
                価格<br>
                <input type="text" name="product_price" value="<?php echo $product_price ?>">
            </p>
            <p>
                在庫数<br>
                <input type="text" name="product_inventory" value="<?php echo $product_inventory ?>">
            </p>
            <p>
                メーカー<br>
                <input type="text" name="product_maker" value="<?php echo $product_maker ?>">
            </p>
            <p>
                品番<br>
                <input type="text" name="product_number" value="<?php echo $product_number ?>">
            </p>
            <p>
                商品説明<br>
                <textarea name="product_description" rows="10" cols="60"><?php echo $product_description ?></textarea>
            </p>
            <p>
                サイズ<br>
                <input type="text" name="size" value="<?php echo $size ?>">
            </p>

            <p>
                <input type="hidden" name="product_id" value="<?php echo $product_id ?>">
                <input type="submit" name="submit" value="更新">
            </p>
        </form>
    </div>
    <div class="base">
        <a href="product_kanri">一覧に戻る</a>　
    </div>

<?php include("footer.html");?>
</body>

</html>