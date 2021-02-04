<?php include("./includes/header.php");?>
<title>商品修正</title>

<?php include("./includes/navbar.php");?>




<main class="mx-5 py-3">
<?php if ($error) echo "<span class=\"error\">$error</span>" ?>

<form action="edit?product_id=<?php echo $product_id?>" method="post">
    <!--upload_mode値とメンバー情報をuploaderに渡す-->
    <input  type='hidden' value='product_upload' name='upload_mode'>
    <input  type='hidden' value=1 name='post_flag'>
    <input  type='hidden' value='<?php echo $_SESSION["user_id"]?>' name='user_id'>
​
    <div class="d-flex justify-content-center">
        <table class="table table-bordered" style="width: 900px;">
        <thead>
            <tr class="table-light"><th colspan="2"><h4>商品修正</h4></th></tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">商品名 <small class="text-danger">必須</small></th>
                <td><input type="text"name="product_name" value="<?php echo $product_name ?>" size="80"  required></td>
            </tr>
            <tr>
                <th scope="row">単価 <small class="text-danger">必須</small></th>
                <td><input type="text" name="product_price" value="<?php echo $product_price ?>" size="80" oninput="value = value.replace(/[^0-9]+/i,'');" required></td>
            </tr>
            <tr>
                <th scope="row">カテゴリー <small class="text-danger">必須</small></th>
                <td>
                    <div class="row">
                        <div class="col-4">
                            <ul class="list-group list-group-flush">
                                <?php
                                    $category = array('ファッション',
                                                        'ビューティー',
                                                        'スポーツ・アウトドア',
                                                        '家電・カメラ・AV機器',
                                                        'パソコン・周辺機器',
                                                        'DVD・楽器・ゲーム',
                                                        '本・コミック・雑誌',
                                                        'キッチン・ホーム',
                                                        '食品・飲料',
                                                        'ベビー・おもちゃ',
                                                        'その他');
                                    for($i=1;$i<6;$i++){
                                        echo '<li class="list-group-item">';
                                        if($cate_id == $i){
                                            echo '<input type="radio" name="category_id" value="'.$i.'" checked>';
                                        }
                                        else{
                                            echo '<input type="radio" name="category_id" value="'.$i.'">';
                                        }
                                        $category_name = $category[$i-1];
                                        echo "<label for='$category_name'>".$category_name."</label>";
                                        echo "</li>";
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class="col-4">
                            <ul class="list-group list-group-flush">
                            <?php
                                    $category = array('ファッション',
                                                        'ビューティー',
                                                        'スポーツ・アウトドア',
                                                        '家電・カメラ・AV機器',
                                                        'パソコン・周辺機器',
                                                        'DVD・楽器・ゲーム',
                                                        '本・コミック・雑誌',
                                                        'キッチン・ホーム',
                                                        '食品・飲料',
                                                        'ベビー・おもちゃ',
                                                        'その他');
                                    for($i=6;$i<12;$i++){
                                        echo '<li class="list-group-item">';
                                        if($cate_id == $i){
                                            echo '<input type="radio" name="category_id" value="'.$i.'" checked>';
                                        }
                                        else{
                                            echo '<input type="radio" name="category_id" value="'.$i.'">';
                                        }
                                        $category_name = $category[$i-1];
                                        echo "<label for='$category_name'>".$category_name."</label>";
                                        echo "</li>";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th scope="row">商品説明</th>
                <td><textarea name="product_description" rows="8" cols="80" placeholder="ここに商品説明を記入してください。"><?php echo $product_description ?></textarea></td>
            </tr>
            <tr>
                <th scope="row">サイズ</th>
                <td><input type="text" name="size" value="<?php echo $size ?>" size="80"></td>
            </tr>
            <tr>
                <th scope="row">在庫数</th>
                <td><input type="text" name="product_inventory" value="<?php echo $product_inventory ?>" size="80" oninput="value = value.replace(/[^0-9]+/i,'');"></td>
            </tr>
            <tr>
                <th scope="row">メーカー</th>
                <td><input type="text" name="product_maker" value="<?php echo $product_maker ?>" size="80"></td>
            </tr>
            <tr>
                <th scope="row">品番</th>
                <td><input type="text" name="product_number" value="<?php echo $product_number ?>" size="80"></td>
            </tr>
        </tbody>
    </table>
    </div>
    <input type="hidden" name="product_id" value="<?php echo $product_id ?>">
    <div class="row my-5 pr-5" style="margin-right: 80px;">
        <div class="mr-5 pr-5">

            <input type="submit" class="btn btn-primary float-right ml-3 mr-5" value = "送信">

            <a class="btn btn-secondary float-right" href='index_kanri'>戻る</a>
        </div>
    </div>
    
</form>
</main>






<?php include("./includes/footer.php");?>
<script>//ここで自分のJSを書く</script>
<?php include("./includes/script.php");?>