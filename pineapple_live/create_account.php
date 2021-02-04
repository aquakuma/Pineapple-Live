<?php
    session_start();
    include("../db/pineapple.php");
    if(isset($_SESSION['user_id'])){
        header("Location: main");
        exit;
    }

    $email = "";
    $password = "";
    $user_name ="";
    $family_name = "";
    $first_name = "";
    $family_katakana = "";
    $first_katakana = "";


    if(!empty($_POST['email'])){
        $email = '"'.$_POST['email'].'"';
    }
    else{
        header("Location: register");
        //print($_POST['email']);
    
    }
    if(!empty($_POST['password'])){
        $password = $_POST['password'];
    }
    if(!empty($_POST['password_again'])){
        $password_again = $_POST['password_again'];
    }
    if(!empty($_POST['user_name'])){
        $user_name = '"'.$_POST['user_name'].'"';
    }
    if(!empty($_POST['Applicant_family'])){
        $family_name = '"'.$_POST['Applicant_family'].'"';
    }
    if(!empty($_POST['Applicant_first'])){
        $first_name = '"'.$_POST['Applicant_first'].'"';
    }
    if(!empty($_POST['Applicant_family_katakana'])){
        $family_katakana = '"'.$_POST['Applicant_family_katakana'].'"';
    }
    if(!empty($_POST['Applicant_first_katakana'])){
        $first_katakana = '"'.$_POST['Applicant_first_katakana'].'"';
    }


    //住所
    if(!empty($_POST['zip_1'])&!empty($_POST['zip_2'])){
        $zip = '"'.$_POST['zip_1'].$_POST['zip_2'].'"';

        //郵便番号 正規表現
        if(!preg_match("/^[0-9]+$/", $_POST['zip_1'].$_POST['zip_2'])){
            $_SESSION['error'] = '郵便番号は半角数字入力ください';
            header("Location: register");
            exit;
        }
    }
    //空欄入力する場合　データベースに NULLをインサート
    else{
        $zip = 'default';
    }
    if(!empty($_POST['address'])){
        $address = '"'.$_POST['address'].'"';

        //住所　正規表現　半角全角英数字　ひらがな、カタカナ、漢字を許可
        if (!preg_match("/^[a-zA-Z0-9ａ-ｚＡ-Ｚ０-９ぁ-んァ-ヶー一-龠-－]+$/u",$_POST['address'])) {
            $_SESSION['error'] = '住所は決まりに合っていません。';
            header("Location: register");
            exit;
        }
    }
    else{
        $address = 'default';
    }
    //クレジットカード番号
    if(!empty($_POST['card_valid_year'])&!empty($_POST['card_valid_month']) & !empty($_POST['card_number']) & !empty($_POST['card_cvv'])){
        $card_number = '"'.$_POST['card_number'].'"';
        $card_cvv = '"'.$_POST['card_cvv'].'"';
        //有効期限は年月だけので　日は適当30日にする
        $card_valid = '"'.$_POST['card_valid_year'].'-'.$_POST['card_valid_month'].'-30'.'"';

        //カード番号　正規表現　数字14-16桁　
        if(!preg_match("/[0-9]{14,16}$/i", $_POST['card_number'])){
            $_SESSION['error'] = 'カード番号は決まりに合っていません。';
            header("Location: register");
            exit;
        }

        //カード CVV 番号　正規表現　数字3桁　
        if(!preg_match("/^([0-9]{3})$/", $_POST['card_cvv'])){
            $_SESSION['error'] = 'CVV番号は決まりに合っていません。';
            header("Location: register");
            exit;
        }
    }
    else{
        $card_number = 'default';
        $card_cvv = 'default';
        $card_valid = 'default';
    }

    printf('1');
    //パスワード再入力　一致チェック
    if($password != $password_again){
        $_SESSION['error'] = 'パスワー入力不一致';
        header("Location: register");
        exit;
    }
    
    printf('2');
    //メール　正規表現
    if(!preg_match('|^[0-9a-zA-Z./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$|', $_POST['email'])){
        $_SESSION['error'] = 'メールアドレス決まりに合っていません。';
        header("Location: register");
        exit;
    }
    printf('3');
    //パスワード　正規表現
    if(!preg_match("/[a-z0-9_]{7,15}$/i", $password)){
        $_SESSION['error'] = 'パスワードは決まりに合っていません。';
        header("Location: register");
        exit;
    }
    printf('4');
    //ユーザー名　正規表現　半角全角英数字　ひらがな、カタカナ、漢字を許可
    if (!preg_match("/^[a-zA-Z0-9ａ-ｚＡ-Ｚ０-９ぁ-んァ-ヶー一-龠]+$/u",$_POST['user_name'])) {
        $_SESSION['error'] = 'ユーザー名は決まりに合っていません。';
        header("Location: register");
        exit;
    }
    printf('5');
    
    //フリガナ　正規表現
    if(!preg_match("/^[ア-ンァ-ォャ-ョー]+$/u", $_POST['Applicant_family_katakana'] )){
        $_SESSION['error'] = 'フリガナは決まりに合っていません。';
        header("Location: register");
        exit;
    }
    if(!preg_match("/^[ア-ンァ-ォャ-ョー]+$/u", $_POST['Applicant_first_katakana'] )){
        $_SESSION['error'] = 'フリガナは決まりに合っていません。';
        header("Location: register");
        exit;
    }
    

    printf('6');

    #データベース　INSERT

    //DB
    try{
        
        $dsn = "mysql:host = 127.0.0.1;dbname=hew2_pineapple;charset=utf8mb4";
        //※data source name
        //127.0.0.1=localhost
    
        $db_user = "root"; //既定の管理ユーザ
        $db_password = "";
        
        //パスワード　HASH　暗号化
        $hash_pass = '"'.password_hash($password , PASSWORD_DEFAULT).'"';
    
        //DB操作用オブジェクトの作成
    
        $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
    
        //PDOの設定変更（エラー黙殺→例外発生）
        $pdo->setAttribute(
            PDO::ATTR_ERRMODE,          //3
            PDO::ERRMODE_EXCEPTION);    //2
    

        //メール重複　チェック

        $sql = "select user_id from user where email = $email;";
        $debug = $sql;
        $dbh = $pdo->query($sql);
        while($record = $dbh->fetch(PDO::FETCH_ASSOC)){
            //インスタンスのみ→PDO::FETCH_NUM
            //連想配列のみ→PDO::FETCH_ASSOC
            //両方→PDO::FETCH_BOTH（メモリの無駄）
            //print_r($record);
            $id= $record["user_id"];

        }

        if(count($id) > 0){
            $_SESSION['error'] = 'メール重複';
            header("Location: register");
            exit;
        }



        printf('7');



        $user_icon = "./files/member/icon/0.png";

        //ユーザー情報をデータベースにINSERT
        $sql = "insert into user (user_password,email,user_name,family_name,first_name,furigana_family_name,furigana_first_name,user_icon,user_address,user_zip,tel,ban_count,delete_date,ppoint,bank,bank_id,bank_account,card_number,card_cvv,card_valid) values ($hash_pass,$email,$user_name,$family_name,$first_name,$family_katakana,$first_katakana,'$user_icon',$address,$zip,default,0,default,default,default,default,default,$card_number,$card_cvv,$card_valid)";
        $pdo->exec($sql);
        

        $sql = "select user_id,user_name,user_icon  from user where email = $email";
        $dbh = $pdo->query($sql);


        while($record = $dbh->fetch(PDO::FETCH_ASSOC)){
            //インスタンスのみ→PDO::FETCH_NUM
            //連想配列のみ→PDO::FETCH_ASSOC
            //両方→PDO::FETCH_BOTH（メモリの無駄）
            //print_r($record);
            $id= $record["user_id"];
            $user_name= $record["user_name"];
            $user_icon= $record["user_icon"];
        }
        $_SESSION["user_id"] = $id;
        $_SESSION["user_name"] = $user_name;
        $_SESSION["customer_status"] = "member";
        //会員ICON　もしなかったら　default　使う
        if(!$user_icon){
            $_SESSION["user_icon"] = "./files/member/icon/0.png";
        }
        else{
            $_SESSION["user_icon"] = $user_icon;
        }
        
        header("Location: mypage");
        exit;
    }

    catch (PDOException $e) {
        print('接続失敗:' . $e->getMessage());
        die();
    }

?>