<?php session_start();?>
<?php include("./includes/header.php");?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<title>会員情報変更</title>
<?php include("./member_info_process.php");?>
<?php include("./includes/navbar.php");?>
​
<main class="my-4 mx-5">
    <!--エラーメッセージ　表示-->
    <h2 id = "error_message" style = 'color:red;'></h2>
    <div class="row mt-4">
        <div class="text-center">
            <img style = "height: 100px; width:100;" class="rounded-circle" src="" alt="user_icon" id = "user_img">
            <h6 class="mt-4">ユーザーアイコンを変更する：</h6>
        </div>
    </div>
    <div class="row mb-2">
        <div class="text-center">
            <!--ICONアップロッド-->
            <form action="uploader" method="post" enctype="multipart/form-data">
                <input type="file" name="fname" class="btn btn-link">
                <input type="submit" value="アップロード" class="btn btn-primary">
                <!--upload_mode値とメンバー情報をuploaderに渡す-->
                <input  type='hidden' value='member_icon' name='upload_mode'>
                <input  type='hidden' value='<?php echo $_SESSION["user_id"]?>' name='user_id'>
            </form>
        </div>
    </div>
​
    <form action="member_info_change" name="register"  method = "post">
        <div class="info_input">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr class="table-light"><th colspan="2">会員情報変更</th></tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">パスワード 変更【半角英数字_ 7-15文字】<small class="text-danger"></small></th>
                    <td><input type="password" name="password" size="40" id="password"  ></td>
                    </tr>
​
                    <tr>
                    <th scope="row">パスワード再入力 <small class="text-danger"></small></th>
                    <td><input type="password" name="password_again" id="password_again" size="40" ></td>
                    </tr>
​
                    <tr>
                    <th scope="row">ユーザー名【全角文字】<small class="text-danger">必須</small></th>
                    <td><input type="text" name="user_name" id = "user_name"  required ></td>
                    </tr>
​
                    <tr>
                    <th scope="row">氏名【全角文字】<small class="text-danger">必須</small></th>
                    <td>姓 <input type="text" name="Applicant_family" id = "Applicant_family" size = 15  required> 名 <input type="text" name="Applicant_first" id = "Applicant_first" size = 15  required></td>
                    </tr>
​
                    <tr>
                    <th scope="row">氏名【カタカナ】<small class="text-danger">必須</small></th>
                    <td>セイ <input type="text" name="Applicant_family_katakana"  id = "Applicant_family_katakana" size = 15 required> メイ <input type="text" name="Applicant_first_katakana"  id = "Applicant_first_katakana" size = 15 required></td>
                    </tr>
​
                    <tr>
                    <th scope="row">住所【全角文字】</th>
                    <td><input type="text" name="address" id = "address" size = 40></td>
                    </tr>
​
                    <tr>
                    <th scope="row">郵便番号【半角数字】（ハイフンなし）</th>
                    <td>〒 <input type="text" name="zip" id = "zip" size = 10 oninput="value = value.replace(/[^0-9]+/i,'');"><small></td>
                    </tr>
​
                    <tr>
                    <th scope="row">電話番号【半角数字】（ハイフンなし）</th>
                    <td><input type="text" name="tel" id = "tel" size = 40 oninput="value = value.replace(/[^0-9]+/i,'');"></td>
                    </tr>
​
                    <tr>
                    <th scope="row">カード番号</th>
                    <td>
                        <input type="text" name="card_number" id="card_number" size = 40 oninput="value = value.replace(/[^0-9]+/i,'');">  <span class="ml-4">CVV <input type="text" name="card_cvv" id="card_cvv" size = 5 oninput="value = value.replace(/[^0-9]+/i,'');"></span><br><br>
                        年
                        <select name="card_valid_year" id="card_valid_year">
                        <option disabled selected value></option>
                        <?php
                            $year = date('Y');
                            $limit_year = $year + 8;
                            for($i = $year;$i <= $limit_year;$i++){
                                if($i == $card_valid['year']){
                                    echo "<option value='$i' selected>$i</option>";
                                }
                                else{
                                    echo "<option value='$i'>$i</option>";
                                }
                                
                            }
                        ?>
                        
​
                        </select>
                        月
                        <select name="card_valid_month">
                        <option disabled selected value></option>
                        <?php
                            for($i = 1;$i <= 12;$i++){
                                if($i == $card_valid['month']){
                                    echo "<option value='$i' selected>$i</option>";
                                }
                                else{
                                    echo "<option value='$i'>$i</option>";
                                }
                            }
                        ?>
                        </select>
                    </td>
                    </tr>
                
                </tbody>
            </table>
        </div>
        <div class="sent mb-4">
            <input type = "submit" class="btn btn-primary float-right" value ="送信">
        </div>         
    </form>
<a href="mypage">戻る</a>
​
​
</main>
​
<?php include("./includes/footer.php");?>
<script>//ここで自分のJSを書く</script>
<?php include("./includes/script.php");?>
