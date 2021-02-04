<?php

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


$pdo = db_connect();
//SQL文作成
$sql = "SELECT * FROM user WHERE user_id =:user_id";
//プリペアードステートメントの設定と取得
$prestmt = $pdo->prepare($sql);

//値の設定
$prestmt->bindValue(':user_id', $user_id);
//SQL実行
$prestmt->execute();
//抽出結果取得
$user_array = $prestmt->fetch(PDO::FETCH_ASSOC);


$user_name =$user_array["user_name"];
$family_name = $user_array["family_name"];
$first_name =$user_array["first_name"];
$furigana_family_name =$user_array["furigana_family_name"];
$furigana_first_name = $user_array["furigana_first_name"];
$user_icon =$user_array["user_icon"];
$user_address = $user_array["user_address"];
$user_zip =$user_array["user_zip"];;
$tel =$user_array["tel"];
$card_number = $user_array["card_number"];
$card_cvv = $user_array["card_cvv"];
$card_valid = $user_array["card_valid"];

//カード有効期限取得
$sql = "SELECT DATE_FORMAT(card_valid,'%Y') AS year,DATE_FORMAT(card_valid,'%m') AS month FROM user WHERE user_id =:user_id";
//プリペアードステートメントの設定と取得
$prestmt = $pdo->prepare($sql);

//値の設定
$prestmt->bindValue(':user_id', $user_id);
//SQL実行
$prestmt->execute();
$card_valid = $prestmt->fetch(PDO::FETCH_ASSOC);
?>

<script>
    function init(){

        var user_icon = '<?php echo $user_icon?>';
        var emg = '<?php echo $error_mesage?>';
        var user_name_text = '<?php echo $user_name?>';
        var family_name = '<?php echo $family_name?>';
        var first_name = '<?php echo $first_name?>';
        var furigana_family_name = '<?php echo $furigana_family_name?>';
        var furigana_first_name = '<?php echo $furigana_first_name?>';
        var user_address = '<?php echo $user_address?>';
        var user_zip = '<?php echo $user_zip?>';
        var card_number_text = '<?php echo $card_number?>';
        var card_cvv_text = '<?php echo $card_cvv?>';
        var tel_text = '<?php echo $tel?>';


        var user_img = document.getElementById('user_img');
        user_img.setAttribute('src', user_icon); 
        var error_message = document.getElementById('error_message');
        error_message.textContent=emg; 



        var user_name = document.getElementById('user_name');
        user_name.setAttribute('value', user_name_text); 
        var Applicant_family = document.getElementById('Applicant_family');
        Applicant_family.setAttribute('value', family_name); 
        var Applicant_first = document.getElementById('Applicant_first');
        Applicant_first.setAttribute('value', first_name); 
        var Applicant_family_katakana = document.getElementById('Applicant_family_katakana');
        Applicant_family_katakana.setAttribute('value', furigana_family_name); 
        var Applicant_first_katakana = document.getElementById('Applicant_first_katakana');
        Applicant_first_katakana.setAttribute('value', furigana_first_name); 
        var address = document.getElementById('address');
        address.setAttribute('value', user_address); 
        var zip = document.getElementById('zip');
        zip.setAttribute('value', user_zip); 
        var card_number = document.getElementById('card_number');
        card_number.setAttribute('value', card_number_text); 
        var card_number = document.getElementById('card_number');
        card_number.setAttribute('value', card_number_text); 
        var card_cvv = document.getElementById('card_cvv');
        card_cvv.setAttribute('value', card_cvv_text); 
        var tel = document.getElementById('tel');
        tel.setAttribute('value', tel_text); 


    }
    window.addEventListener('load', init);
</script>