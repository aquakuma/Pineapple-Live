<?php
session_start();
include('./db_connect.php');
$error_mesage = "";
if(isset($_SESSION['error'])){
    $error_mesage = $_SESSION['error'];
    $_SESSION['error'] = "";
}

$user_id = "";
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}
else{
    header("Location: index.php");
    exit;
}

$password ="";
$password_again = "";
$hash_pass ="";

if(!empty($_POST['password'])&&!empty($_POST['password_again'])){
    $password = $_POST['password'];
    $password_again = $_POST['password_again'];

    if($password != $password_again){
        $_SESSION['error'] = "パスワード不一致";
        header("Location: member_info");
        exit;
    }

    //パスワード　正規表現
    if(!preg_match("/[a-z0-9_]{7,15}$/i", $password)){
        $_SESSION['error'] = 'パスワードは決まりに合っていません。';
        header("Location: member_info");
        exit;
    }
    //パスワード　HASH　暗号化
    $hash_pass = password_hash($password , PASSWORD_DEFAULT);
}

$user_name ="";
$family_name = "";
$first_name ="";
$furigana_family_name ="";
$furigana_first_name = "";
$user_icon ="";
$user_address = "";
$user_zip ="";
$tel ="";
$card_number = "";
$card_cvv = "";
$card_valid = "";


if(isset($_POST['user_name'])&&isset($_POST['Applicant_family'])&&isset($_POST['Applicant_first'])&&isset($_POST['Applicant_family_katakana'])&&isset($_POST['Applicant_first_katakana'])){
    $user_name = $_POST['user_name'];
    $family_name = $_POST['Applicant_family'];
    $first_name = $_POST['Applicant_first'];
    $furigana_family_name = $_POST['Applicant_family_katakana'];
    $furigana_first_name = $_POST['Applicant_first_katakana'];
}
else{
    header("Location: member_info");
    exit;
}



//住所
if(!empty($_POST['zip'])){
    $user_zip = $_POST['zip'];

    //郵便番号 正規表現
    if(!preg_match("/^[0-9]+$/", $user_zip)){
        $_SESSION['error'] = '郵便番号は半角数字入力ください';
        header("Location: member_info");
        exit;
    }
}
if(!empty($_POST['address'])){
    $address = $_POST['address'];

    //住所　正規表現　半角全角英数字　ひらがな、カタカナ、漢字を許可
    if (!preg_match("/^[a-zA-Z0-9ａ-ｚＡ-Ｚ０-９ぁ-んァ-ヶー一-龠-－]+$/u",$address)) {
        $_SESSION['error'] = '住所は決まりに合っていません。';
        header("Location: member_info");
        exit;
    }
}

//クレジットカード番号
if(!empty($_POST['card_valid_year'])&!empty($_POST['card_valid_month']) & !empty($_POST['card_number']) & !empty($_POST['card_cvv'])){
    $card_number = $_POST['card_number'];
    $card_cvv = $_POST['card_cvv'];
    //有効期限は年月だけので　日は適当30日にする
    $card_valid = $_POST['card_valid_year'].'-'.$_POST['card_valid_month'].'-30';

    //カード番号　正規表現　数字14-16桁　
    if(!preg_match("/[0-9]{14,16}$/i", $card_number)){
        $_SESSION['error'] = 'カード番号は決まりに合っていません。';
        header("Location: member_info");
        exit;
    }

    //カード CVV 番号　正規表現　数字3桁　
    if(!preg_match("/^([0-9]{3})$/", $card_cvv)){
        $_SESSION['error'] = 'CVV番号は決まりに合っていません。';
        header("Location: member_info");
        exit;
    }
}

//ユーザー名　正規表現　半角全角英数字　ひらがな、カタカナ、漢字を許可
if (!preg_match("/^[a-zA-Z0-9ａ-ｚＡ-Ｚ０-９ぁ-んァ-ヶー一-龠]+$/u",$_POST['user_name'])) {
    $_SESSION['error'] = 'ユーザー名は決まりに合っていません。';
    header("Location: member_info");
    exit;
}

//フリガナ　正規表現
if(!preg_match("/^[ア-ンァ-ォャ-ョー]+$/u", $_POST['Applicant_family_katakana'] )){
    $_SESSION['error'] = 'フリガナは決まりに合っていません。';
    header("Location: member_info");
    exit;
}
if(!preg_match("/^[ア-ンァ-ォャ-ョー]+$/u", $_POST['Applicant_first_katakana'] )){
    $_SESSION['error'] = 'フリガナは決まりに合っていません。';
    header("Location: member_info");
    exit;
}

$pdo = db_connect();
//SQL文作成
if(empty($hash_pass)){
    $sql = "UPDATE user SET user_name = :user_name,family_name = :family_name,first_name = :first_name,furigana_family_name = :furigana_family_name,furigana_first_name = :furigana_first_name,user_address = :user_address,user_zip =:user_zip,tel =:tel,card_number =:card_number,card_cvv =:card_cvv,card_valid =:card_valid WHERE user_id =:user_id";

    //プリペアードステートメントの設定と取得
    $prestmt = $pdo->prepare($sql);
}
else{
    $sql = "UPDATE user SET user_password = :user_password,user_name = :user_name,family_name = :family_name,first_name = :first_name,furigana_family_name = :furigana_family_name,furigana_first_name = :furigana_first_name,user_address = :user_address,user_zip =:user_zip,tel =:tel,card_number =:card_number,card_cvv =:card_cvv,card_valid =:card_valid WHERE user_id =:user_id";

    //プリペアードステートメントの設定と取得
    $prestmt = $pdo->prepare($sql);

    $prestmt->bindValue(':user_password', $hash_pass);
}

//値の設定
$prestmt->bindValue(':user_id', $user_id);
$prestmt->bindValue(':user_name', $user_name);
$prestmt->bindValue(':family_name', $family_name);
$prestmt->bindValue(':first_name', $first_name);
$prestmt->bindValue(':furigana_family_name', $furigana_family_name);
$prestmt->bindValue(':furigana_first_name', $furigana_first_name);
if(empty($user_address)){
    $prestmt->bindValue(':user_address', null, PDO::PARAM_NULL);
}
else{
    $prestmt->bindValue(':user_address', $user_address);
}
if(empty($user_zip)){
    $prestmt->bindValue(':user_zip', null, PDO::PARAM_NULL);
}
else{
    $prestmt->bindValue(':user_zip', $user_zip);
}
if(empty($tel)){
    $prestmt->bindValue(':tel', null, PDO::PARAM_NULL);
}
else{
    $prestmt->bindValue(':tel', $tel);
}
if(empty($card_number)){
    $prestmt->bindValue(':card_number', null, PDO::PARAM_NULL);
}
else{
    $prestmt->bindValue(':card_number', $card_number);
}
if(empty($card_cvv)){
    $prestmt->bindValue(':card_cvv', null, PDO::PARAM_NULL);
}
else{
    $prestmt->bindValue(':card_cvv', $card_cvv);
}
if(empty($card_valid)){
    $prestmt->bindValue(':card_valid', null, PDO::PARAM_NULL);
}
else{
    $prestmt->bindValue(':card_valid', $card_valid);
}



//SQL実行
$prestmt->execute();

$_SESSION['error'] = '変更完了';
header("Location: member_info");

?>