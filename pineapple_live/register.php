<?php
session_start();
$error_mesage = "";
if(isset($_SESSION['error'])){
    $error_mesage = $_SESSION['error'];
    $_SESSION['error'] = "";
}
if(isset($_SESSION['user_id'])){
    header("Location:index.php");
    exit;
}
?>

<?php include("includes/header.php");?>


</head>
<body>
<main class="my-3 mx-5">
    <form action="create_account" name="register"  method = "post">
        <div class="info_input">
        
            <table class="table table-bordered align-middle">
                <thead>
                    <tr class="table-primary"><th colspan="2">新規登録</th></tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">メールアドレス【半角英数字】<small class="text-danger">必須</small></th>
                    <td><input type="email" name="email" size="40"  required></td>
                    </tr>

                    <tr>
                    <th scope="row">パスワード【半角英数字_ 7-15文字】<small class="text-danger">必須</small></th>
                    <td><input type="password" name="password" size="40"  required></td>
                    </tr>

                    <tr>
                    <th scope="row">パスワード再入力 <small class="text-danger">必須</small></th>
                    <td><input type="password" name="password_again" size="40"  required></td>
                    </tr>

                    <tr>
                    <th scope="row">ユーザー名【全角文字】<small class="text-danger">必須</small></th>
                    <td><input type="text" name="user_name"  required></td>
                    </tr>

                    <tr>
                    <th scope="row">氏名【全角文字】<small class="text-danger">必須</small></th>
                    <td>姓 <input type="text" name="Applicant_family" id = "f_name" size = 15  required> 名 <input type="text" name="Applicant_first" id = "first_name" size = 15  required></td>
                    </tr>

                    <tr>
                    <th scope="row">氏名【カタカナ】<small class="text-danger">必須</small></th>
                    <td>セイ <input type="text" name="Applicant_family_katakana"  id = "f_name_kana" size = 15 required> メイ <input type="text" name="Applicant_first_katakana"  id = "first_name_kana" size = 15 required></td>
                    </tr>

                    <tr>
                    <th scope="row">住所【全角文字】</th>
                    <td><input type="text" name="address" size = 40></td>
                    </tr>

                    <tr>
                    <th scope="row">郵便番号【半角数字】</th>
                    <td>〒 <input type="text" name="zip_1" size = 5 oninput="value = value.replace(/[^0-9]+/i,'');"><small> ― </small><input type="text" name="zip_2" size = 6 oninput="value = value.replace(/[^0-9]+/i,'');"></td>
                    </tr>

                    <tr>
                    <th scope="row">カード番号</th>
                    <td>
                        <input type="text" name="card_number" size = 40 oninput="value = value.replace(/[^0-9]+/i,'');">  <span class="ml-4">CVV <input type="text" name="card_cvv" size = 5 oninput="value = value.replace(/[^0-9]+/i,'');"></span><br><br>
                        年
                        <select name="card_valid_year">
                        <option disabled selected value></option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        </select>
                        月
                        <select name="card_valid_month">
                        <option disabled selected value></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        </select>
                    </td>
                    </tr>
                
                </tbody>
            </table>
        </div>
        <div class="sent">
            <input type = "submit" class="btn btn-primary float-right" value ="送信">
            <a href="login" style = "margin-right:20px;" class="btn btn-secondary float-right">戻る</a>
        </div>         
    </form>
    <h2 style = 'color: red;'><?php echo $error_mesage; ?></h2>
</main>
</body>
<?php include("includes/script.php");?>