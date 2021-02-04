<?php include("./includes/login_check.php");?>
<?php include("./includes/header.php");?>
<?php include("./includes/navbar.php");?>
​
<main class="mx-5 py-3">
<form action="uploader" method="post" enctype="multipart/form-data">
    <!--upload_mode値とメンバー情報をuploaderに渡す-->
    <input  type='hidden' value='product_upload' name='upload_mode'>
    <input  type='hidden' value='<?php echo $_SESSION["user_id"]?>' name='user_id'>
​
    <div class="d-flex justify-content-center">
        <table class="table table-bordered" style="width: 900px;">
        <thead>
            <tr class="table-light"><th colspan="2"><h4>商品登録</h4></th></tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">商品名 <small class="text-danger">必須</small></th>
                <td><input type="text" name="product_name" size="80"  required></td>
            </tr>
            <tr>
                <th scope="row">単価 <small class="text-danger">必須</small></th>
                <td><input type="text" name="product_price" size="80" oninput="value = value.replace(/[^0-9]+/i,'');" required></td>
            </tr>
            <tr>
                <th scope="row">カテゴリー <small class="text-danger">必須</small></th>
                <td>
                    <div class="row">
                        <div class="col-4">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <input type="radio" id="fashion" name="category" value="fashion" checked>
                                    <label for="fashion">ファッション</label>
                                </li>
                                <li class="list-group-item">
                                    <input type="radio" id="beauty" name="category" value="beauty">
                                    <label for="beauty">ビューティー</label>
                                </li>
                                <li class="list-group-item">
                                    <input type="radio" id="sport_outdoor" name="category" value="sport_outdoor">
                                    <label for="sport_outdoor">スポーツ・アウトドア</label>
                                </li>
                                <li class="list-group-item">
                                    <input type="radio" id="household_appliances" name="category" value="household_appliances">
                                    <label for="household_appliances">家電・カメラ・AV機器</label>
                                </li>
                                <li class="list-group-item">
                                    <input type="radio" id="computer" name="category" value="computer">
                                    <label for="computer">パソコン・周辺機器</label>
                                </li>
                                <li class="list-group-item">
                                    <input type="radio" id="dvd" name="category" value="dvd">
                                    <label for="dvd">DVD・楽器・ゲーム</label>
                                </li>
                            </ul>
                        </div>
                        <div class="col-4">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <input type="radio" id="book" name="category" value="book">
                                    <label for="book">本・コミック・雑誌</label>
                                </li>
                                <li class="list-group-item">
                                    <input type="radio" id="cooker" name="category" value="cooker">
                                    <label for="cooker">キッチン・ホーム</label>
                                </li>
                                <li class="list-group-item">
                                    <input type="radio" id="food" name="category" value="food">
                                    <label for="food">食品・飲料</label>
                                </li>
                                <li class="list-group-item">
                                    <input type="radio" id="baby" name="category" value="baby">
                                    <label for="baby">ベビー・おもちゃ</label>
                                </li>
                                <li class="list-group-item">
                                    <input type="radio" id="other" name="category" value="other">
                                    <label for="other">その他</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th scope="row">商品説明</th>
                <td><textarea name="description" rows="8" cols="80" placeholder="ここに商品説明を記入してください。"></textarea></td>
            </tr>
            <tr>
                <th scope="row">サイズ</th>
                <td><input type="text" name="maker" size="80"></td>
            </tr>
            <tr>
                <th scope="row">在庫数</th>
                <td><input type="text" name="inventory" size="80" oninput="value = value.replace(/[^0-9]+/i,'');"></td>
            </tr>
            <tr>
                <th scope="row">メーカー</th>
                <td><input type="text" name="maker" size="80"></td>
            </tr>
            <tr>
                <th scope="row">品番</th>
                <td><input type="text" name="number" size="80"></td>
            </tr>
            <tr>
                <th scope="row">商品画像</th>
                <td><input type="file" name="fname" accept="image/*"></td>
            </tr>
        </tbody>
    </table>
    </div>
    <div class="row my-5 pr-5" style="margin-right: 80px;">
        <div class="mr-5 pr-5">
            <input type="submit" class="btn btn-primary float-right ml-3 mr-5" value="送信" >
            <button class="btn btn-secondary float-right" onclick="location.href='index_kanri.php'">戻る</button>
        </div>
    </div>
    
</form>
</main>
​
​
​
​
<?php include("./includes/footer.php");?>
<?php include("./includes/script.php");?>