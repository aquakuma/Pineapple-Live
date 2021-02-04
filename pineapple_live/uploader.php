<?php
session_start();
if(isset($_POST['upload_mode'])){
    date_default_timezone_set('Asia/Tokyo');
    include("../db/pineapple.php");
    /////////メンバー　ICON　アップロッド処理/////////
    if($_POST['upload_mode'] == 'member_icon'){
        $user_id = $_POST['user_id'];
        $tempfile = $_FILES['fname']['tmp_name'];
        //アップロッドしたファイルの拡張子取得
        $extension = pathinfo($_FILES['fname']['name'], PATHINFO_EXTENSION);

        //アップロッドしたファイルの拡張子チェック
        $ok_file = ['jpg','jpeg','bmp','png','gif'];
        $flag = FALSE;
        foreach($ok_file as $type){
            if(strtolower($extension) == $type ){
                $flag = TRUE;
            }
        }
        if($flag == FALSE){
            $_SESSION['error'] = 'jpg,jpeg,bmp,png,gif　ファイルにしてください';
            header("Location: member_info.php");
            exit;
        }
        
        //サーバに保存ファイル名を指定
        $filename = './files/member/icon/'.$user_id.'.'.$extension ;

        if (is_uploaded_file($tempfile)) {
            if ( move_uploaded_file($tempfile , $filename )) {
                $_SESSION['error'] = $_FILES['fname']['name']. "をアップロードしました。";

                //ファイルパスをデータベースにインサート
                try{
                    $dsn = "mysql:host = 127.0.0.1;dbname=hew2_pineapple;charset=utf8mb4";
                    //※data source name
                    //127.0.0.1=localhost
                
                    $db_user = "root"; //既定の管理ユーザ
                    $db_password = "";
                    
                
                    //DB操作用オブジェクトの作成
                
                    $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
                
                    //PDOの設定変更（エラー黙殺→例外発生）
                    $pdo->setAttribute(
                        PDO::ATTR_ERRMODE,          //3
                        PDO::ERRMODE_EXCEPTION);    //2

                    $sql = "update user set user_icon = '$filename' where user_id = $user_id";
                    $pdo->exec($sql);
                    $_SESSION["user_icon"] = $filename;

                }
                catch (PDOException $e) {
                    print('接続失敗:' . $e->getMessage());
                    die();
                }
            } 
            else {
                $_SESSION['error'] =  "ファイルをアップロードできません。";
            }
        } 
        else{
            $_SESSION['error'] =  "ファイルが選択されていません。";
        }
        header("Location: member_info.php");
        exit;
    }


    /////////ライブページ　処理/////////
    if($_POST['upload_mode'] == 'live_page'){
    
        $title = "";
        if(isset($_POST['title'])){
            $title = $_POST['title'];
            $description=$_POST['live_description'];
            //$description = nl2br($description);
        }
        $user_ID = "";
        if(isset($_POST['user_id'])){
            $user_ID = $_POST['user_id'];
        }
        $live_id="";
        if(isset($_POST['live_key'])){
            $live_id=$_POST['live_key'];
        }
        
        if(isset($_FILES['thumbnail']['tmp_name'])){
            $tempthumbnail = $_FILES['thumbnail']['tmp_name']; 
            $t_extension = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
            $ok_file = ['jpg','jpeg','bmp','png','gif'];
            $flag = FALSE;
            foreach($ok_file as $type){
                if($t_extension == $type ){
                    $flag = TRUE;
                }
            }
            if($flag == FALSE && is_uploaded_file($tempthumbnail)){
                $_SESSION['error'] = 'サムネイルをjpg,jpeg,bmp,png,gifファイルにしてください！';
                header("Location: live_admin.php");
                exit;
            }
        }
        $thumbnail_name = 'files/thumbnail/'.$live_id.'.'.$t_extension ;


        try{
            $dsn = "mysql:host = localhost;dbname=hew2_pineapple;charset=utf8mb4";
            //※data source name
            //127.0.0.1=localhost
        
            $db_user = "root"; //既定の管理ユーザ
            $db_password = "";
            
        
            //DB操作用オブジェクトの作成
        
            $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
        
            //PDOの設定変更（エラー黙殺→例外発生）
            $pdo->setAttribute(
                PDO::ATTR_ERRMODE,          //3
                PDO::ERRMODE_EXCEPTION);    //2

            //LIVE情報をデータベースにINSERT
            

            
        

            if (is_uploaded_file($tempthumbnail)) { 
                if ( move_uploaded_file($tempthumbnail , $thumbnail_name )) {
                    $sql = "INSERT INTO live (user_id,product_id,title,start_date,end_date,thumbnail,sum_live_tip,description) VALUES ('$user_ID',default,'$title', CURRENT_TIMESTAMP() ,default,'$thumbnail_name',default,'$description')";  
                }
                else{
                    $sql = "INSERT INTO live (user_id,product_id,title,start_date,end_date,thumbnail,sum_live_tip,description) VALUES ('$user_ID',default,'$title', CURRENT_TIMESTAMP() ,default,default,default,'$description')";  
                }
            }
            else{
                $sql = "INSERT INTO live (user_id,product_id,title,start_date,end_date,thumbnail,sum_live_tip,description) VALUES ('$user_ID',default,'$title', CURRENT_TIMESTAMP() ,default,default,default,'$description')";  
            }

            
            $pdo->exec($sql);
            
            }
            catch (PDOException $e) {
                print('接続失敗:' . $e->getMessage());
                die();
            }


        header("Location: live_admin.php");
        exit;
    }

    //Edit live products
    if($_POST['upload_mode'] == 'edit_live_product'){
        if(isset($_POST['live_id'])){
            $live_id=$_POST['live_id'];
        }else{
            $_SESSION['error'] ="ライブが存在しません。";
        }
        $products=array();
        $exist_products=array();
        if(isset($_POST['product'])){
            $products= array_filter($_POST['product']);
            if(empty($products)){
                $_SESSION['error'] ="商品リンクを入力してください！";
                header("Location: edit_live_product.php");
                exit;
            }
        }
        print_r($products);   
        $dsn = "mysql:host = 127.0.0.1;dbname=hew2_pineapple;charset=utf8mb4";
        $db_user = "root";
        $db_password = "";
        $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
        $pdo->setAttribute(
        PDO::ATTR_ERRMODE,          
        PDO::ERRMODE_EXCEPTION);  

        $product_check="SELECT product_id FROM products WHERE delete_date IS NULL";
        $product_check_run=$pdo->query($product_check);
        if($product_check_run){
            $exist_products = $product_check_run->fetchALL(PDO::FETCH_COLUMN);        
        }
        print_r($exist_products); 

        $result = array_diff($products, $exist_products);
        print_r($result); 
        
        if(empty($result)){

            $sql = "DELETE FROM live_products WHERE live_id = :live_id";
            //プリペアードステートメントの設定と取得
            $prestmt = $pdo->prepare($sql);
            //値の設定
            $prestmt->bindValue(':live_id', $live_id);
            //SQL実行
            $prestmt->execute();
            //SQL文作成
            foreach($products as $product_id){
                $sql = "INSERT INTO live_products(live_id,product_id) values (:live_id,:product_id) ON DUPLICATE KEY UPDATE live_id = :live_id,product_id = :product_id";
                //プリペアードステートメントの設定と取得
                $prestmt = $pdo->prepare($sql);
                //値の設定
                $prestmt->bindValue(':live_id', $live_id);
                $prestmt->bindValue(':product_id', $product_id);
                //SQL実行
                $prestmt->execute();
            }

            header("Location: live.php?live_id=$live_id");
            exit;

            /*
            $live_check="SELECT * FROM live_products WHERE live_id='$live_id'";
            $live_check_run=$pdo->query($live_check);
            $count = $live_check_run->rowCount();
            if($count>0){
                $delete_product ="DELETE FROM live_products WHERE live_id='$live_id'";
                $pdo->exec($delete_product);
                foreach($products as $id){  
                    $update_product="INSERT INTO live_products (live_id, product_id) VALUES ('$live_id','$id')";
                    $pdo->exec($update_product);
                    header("Location: live.php?live_id=$live_id");
                    exit;
                }
            }else{
                foreach($products as $id){
                    $insert_product="INSERT INTO live_products (live_id, product_id) VALUES ('$live_id','$id')";
                    $pdo->exec($insert_product);
                    header("Location: live.php?live_id=$live_id");
                    exit;
                }

            } 
            */
        }else{
            $_SESSION['error'] ="登録されてない商品があります！";
            header("Location: edit_live_product.php");
            exit;
            
        }

    }


    /////////商品　アップロッド処理/////////
    if($_POST['upload_mode'] == 'product_upload'){

        try{
            //DB接続オブジェクト
            //PDO…PHP Data Object
            $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
            //let logo = getElementById('id');
        
            //PDOの設定変更
            $pdo->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
            $pdo->setAttribute(
                PDO::ATTR_EMULATE_PREPARES,
                false
            );


            //product_id　取得//
            //SQL文作成
            $sql = "SELECT count(*)+1 as p_id FROM products;";
            //プリペアードステートメントの設定と取得
            $prestmt = $pdo->prepare($sql);
            //SQL実行
            $prestmt->execute();
            //抽出結果取得
            $dbh = $prestmt->fetch(PDO::FETCH_ASSOC);
            //product_id　取得//
            $product_id = $dbh['p_id'];

            $product_name = "";
            $product_price = "";
            $category = "";
            $inventory = "";
            $maker = "";
            $number = "";
            $description = "";
            $size = "";
        

            $category_array = Array('fashion' => 1,
                                    'beauty' => 2,
                                    'sport_outdoor' => 3,
                                    'household_appliances' => 4,
                                    'computer' => 5,
                                    'dvd' => 6,
                                    'book' => 7,
                                    'cooker' => 8,
                                    'food' => 9,
                                    'baby' => 10,
                                    'other' => 11
                                    );

            if(is_numeric($_POST['product_price'])){
                $product_price = $_POST['product_price'];
            }
            else{
                $_SESSION['error'] = "値段は数字のみ入力ください";
                header("Location: product_upload");
                exit;
            }

            if(isset($_POST['product_name'])){
                $product_name = $_POST['product_name'];
            }
            if(isset($_POST['category'])){
                $category = $category_array[$_POST['category']];
            }
            else{
                $category = 11;
            }
            if(!empty($_POST['inventory'])){
                $inventory = $_POST['inventory'];
            }
            if(!empty($_POST['maker'])){
                $maker = $_POST['maker'];
            }
            if(!empty($_POST['number'])){
                $number = $_POST['number'];
            }
            if(!empty($_POST['description'])){
                $description = $_POST['description'];
                //$description = nl2br($description);
            }
            if(!empty($_POST['size'])){
                $size = $_POST['size'];
            }


            $user_id = $_POST['user_id'];
            ///////////画像処理//////////////
            if(is_uploaded_file($_FILES['fname']['tmp_name'])){
                $tempfile = $_FILES['fname']['tmp_name'];
                //アップロッドしたファイルの拡張子取得
                $extension = pathinfo($_FILES['fname']['name'], PATHINFO_EXTENSION);
        
                //アップロッドしたファイルの拡張子チェック
                $ok_file = ['jpg','jpeg','bmp','png','gif'];
                $flag = FALSE;
                foreach($ok_file as $type){
                    if(strtolower($extension) == $type ){
                        $flag = TRUE;
                    }
                }
                if($flag == FALSE){
                    $_SESSION['error'] = 'jpg,jpeg,bmp,png,gif　ファイルにしてください';
                    header("Location: product_upload.php");
                    exit;
                }
                
                //サーバに保存ファイル名を指定
                $filename = './files/products/'.$product_id.'.'.$extension ;
        
                if ( move_uploaded_file($tempfile , $filename )) {
                    $filename = './files/products/'.$product_id.'.'.$extension ;
                }
                else{
                    $filename = './files/products/noimage.jpg';
                }
                
            }
            else{
                $filename = './files/products/noimage.jpg';
            }           
            ///////////画像処理//////////////





            //SQL文作成
            $sql = "INSERT INTO products(user_id,category_id,product_name,product_price,product_inventory,product_maker,image_id,product_number,product_description,delete_date,upload_date,discount) VALUES(:user_id,:category_id,:product_name,:product_price,:product_inventory,:product_maker,:image_id,:product_number,:product_description,:delete_date,:upload_date,:discount)";
        
            //プリペアードステートメントの設定と取得
            $prestmt = $pdo->prepare($sql);
        
            //値の設定
            $prestmt->bindValue(':user_id', $user_id);
            $prestmt->bindValue(':category_id', $category);
            $prestmt->bindValue(':product_name', $product_name);
            $prestmt->bindValue(':product_price', $product_price);
            if(!empty($inventory)){
                $prestmt->bindValue(':product_inventory', $inventory);
            }
            else{
                $prestmt->bindValue(':product_inventory', 0);
            }

            if(!empty($maker)){
                $prestmt->bindValue(':product_maker', $maker);
            }
            else{
                $prestmt->bindValue(':product_maker', null, PDO::PARAM_NULL);
            }

            if(!empty($number)){
                $prestmt->bindValue(':product_number', $number);
            }
            else{
                $prestmt->bindValue(':product_number', null, PDO::PARAM_NULL);
            }

            if(!empty($description)){
                $prestmt->bindValue(':product_description', $description);
            }
            else{
                $prestmt->bindValue(':product_description', null, PDO::PARAM_NULL);
            }

            
            $prestmt->bindValue(':image_id', $filename); 
            $prestmt->bindValue(':delete_date', null, PDO::PARAM_NULL);
            $date = date('Y-m-d H:i:s');
            $prestmt->bindValue(':upload_date',  $date, PDO::PARAM_STR);
            $prestmt->bindValue(':discount', null, PDO::PARAM_NULL);

            $_SESSION['debug2']  = $sql;
            //SQL実行
            $prestmt->execute();

            //sizeテーブルインサート
  
            //SQL文作成
            $sql = "INSERT INTO products_size(product_id,product_size,product_inventory) VALUES(:product_id,:product_size,:product_inventory)";
        
            //プリペアードステートメントの設定と取得
            $prestmt = $pdo->prepare($sql);
        
            //値の設定
            $prestmt->bindValue(':product_id', $product_id);
            if(empty($size)){
                $prestmt->bindValue(':product_size', " ");
            }
            else{
                $prestmt->bindValue(':product_size', $size);
            }
            
            $prestmt->bindValue(':product_inventory', $inventory);
            //SQL実行
            $prestmt->execute();


        }catch(PDOException $error){
            //エラー時の処理を書く
            echo $error->getMessage();
            $_SESSION['error'] = $error->getMessage();
            echo $error->getCode();
            $_SESSION['error2'] = $error->getCode();

            $_SESSION['debug1'] = $size;
            //本来は、上記ログ出力し、下記のようになる。
            header('Location: error.php');
            exit;
        }
        header("Location: index_kanri.php");
        exit;
    }



    /////////商品画像変更/////////
    if($_POST['upload_mode'] == 'product_img'){
        $product_id = $_POST['product_id'];
        try{
            //DB接続オブジェクト
            //PDO…PHP Data Object
            $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
            //let logo = getElementById('id');
        
            //PDOの設定変更
            $pdo->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
            $pdo->setAttribute(
                PDO::ATTR_EMULATE_PREPARES,
                false
            );

            $tempfile = $_FILES['fname']['tmp_name'];
            //アップロッドしたファイルの拡張子取得
            $extension = pathinfo($_FILES['fname']['name'], PATHINFO_EXTENSION);
        
            //アップロッドしたファイルの拡張子チェック
            $ok_file = ['jpg','jpeg','bmp','png','gif'];
            $flag = FALSE;
            foreach($ok_file as $type){
                if(strtolower($extension) == $type ){
                    $flag = TRUE;
                }
            }
            if($flag == FALSE){
                $_SESSION['error'] = 'jpg,jpeg,bmp,png,gif　ファイルにしてください';
                //header("Location: index_kanri.php");
                header("Location:". $_SERVER['HTTP_REFERER']);
                exit;
            }
        
            //サーバに保存ファイル名を指定
            $filename = './files/products/'.$product_id.'.'.$extension ;
        
            if (is_uploaded_file($tempfile)) {
                if ( move_uploaded_file($tempfile , $filename )) {
        
                    $st = $pdo->query("UPDATE products SET image_id='$filename' WHERE product_id=$product_id");
                    header('Location: index_kanri.php');
                    exit();
                } 
                else {
                    $_SESSION['error'] =  "ファイルをアップロードできません。";
                }
            } 
            else{
                $_SESSION['error'] =  "ファイルが選択されていません。";
            }



        }catch(PDOException $error){
            //エラー時の処理を書く
            echo $error->getMessage();
            $_SESSION['error2'] = $error->getMessage();
            echo $error->getCode();
            $_SESSION['error3'] = $error->getCode();
            //本来は、上記ログ出力し、下記のようになる。
            header('Location: error.php');
            exit;
        }
        header("Location: main.php");
        exit;


    }


    /////////動画アップロッド/////////
    if($_POST['upload_mode'] == 'video_upload'){

        try{
            //DB接続オブジェクト
            //PDO…PHP Data Object
            $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
            //let logo = getElementById('id');
        
            //PDOの設定変更
            $pdo->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
            $pdo->setAttribute(
                PDO::ATTR_EMULATE_PREPARES,
                false
            );

            $user_id = $_POST['user_id'];

            $title = "";
            $product_id = "";
            $description = "";
            $thumbnail = "";

            if(!empty($_POST['title'])){
                $title = $_POST['title'];
            }
            if(!empty($_POST['product'])){
                $product_id = $_POST['product'];
            }
            if(!empty($_POST['description'])){
                $description = $_POST['description'];
                
                //$description = nl2br($description);
                /*$description = str_replace("<br />",'\n',$description);
                */
            }


            //////////動画ファイル処理////////////
            $tempfile = $_FILES['video_file']['tmp_name'];
            //アップロッドしたファイルの拡張子取得
            $extension = pathinfo($_FILES['video_file']['name'], PATHINFO_EXTENSION);
        
            //アップロッドしたファイルの拡張子チェック
            $ok_file = ['mp4','webm','ogv'];
            $flag = FALSE;
            foreach($ok_file as $type){
                if(strtolower($extension) == $type ){
                    $flag = TRUE;
                }
            }
            if($flag == FALSE){
                $_SESSION['error'] = 'mp4,webm,ogv　ファイルにしてください';
                header("Location: video_upload.php");
                exit;
            }

            //video_id　取得//
            //SQL文作成
            $sql = "SELECT count(*)+1 as video_id FROM video;";
            //プリペアードステートメントの設定と取得
            $prestmt = $pdo->prepare($sql);
            //SQL実行
            $prestmt->execute();
            //抽出結果取得
            $dbh = $prestmt->fetch(PDO::FETCH_ASSOC);
            $video_id = $dbh['video_id'];
            //product_id　取得//
        
            //サーバに保存ファイル名を指定
            $filename = './files/video/'.$video_id.'.'.$extension ;
            $video_path = "";
            
            if (is_uploaded_file($tempfile)) {
                if ( move_uploaded_file($tempfile , $filename )) {
                    //サムネイルキャプチャ
                    //$ret = exec("echo y | ffmpeg -i $filename -s 480*270 -vframes 1 files/video_thumbnail/$video_id.jpg"); //aws serever
                    $ret = exec("echo y |\"C:\\ffmpeg\bin\\ffmpeg\" -i $filename -s 480*270 -vframes 1 files/video_thumbnail/$video_id.jpg 2>&1");
                    $thumbnail = "./files/video_thumbnail/$video_id.jpg";
                    $video_path = $filename;
                } 
                else {
                    $_SESSION['error'] =  "ファイルをアップロードできません。";
                }
            } 
            else{
                $_SESSION['error'] =  "ファイルが選択されていません。";
            }
            ////////////////////////////////////////////


            //////////サムネイル画像処理////////////
            
            $tempfile = $_FILES['thumbnail_file']['tmp_name'];
            if (is_uploaded_file($tempfile)){
                //アップロッドしたファイルの拡張子取得
                $extension = pathinfo($_FILES['thumbnail_file']['name'], PATHINFO_EXTENSION);
            
                //アップロッドしたファイルの拡張子チェック
                $ok_file = ['jpg','jpeg','bmp','png','gif'];
                $flag = FALSE;
                foreach($ok_file as $type){
                    if(strtolower($extension) == $type ){
                        $flag = TRUE;
                    }
                }
                if($flag == FALSE){
                    $_SESSION['error'] = 'jpg,jpeg,bmp,png,gif　ファイルにしてください';
                    header("Location: video_upload.php");
                    exit;
                }
            }


            //サーバに保存ファイル名を指定
            $filename = './files/video_thumbnail/'.$video_id.'.'.$extension ;

            if (is_uploaded_file($tempfile)) {
                if ( move_uploaded_file($tempfile , $filename )) {
                    $thumbnail = $filename;
                } 
            }
            ///////////////////////////////////////




            //SQL文作成
            $sql = "INSERT INTO video(user_id,product_id,video_title,views,upload_date,delete_date,thumbnail,description,video_path) VALUES(:user_id,:product_id,:video_title,:views,:upload_date,:delete_date,:thumbnail,:description,:video_path)";

            //プリペアードステートメントの設定と取得
            $prestmt = $pdo->prepare($sql);
        
            //値の設定
            $prestmt->bindValue(':user_id', $user_id);
            if(!empty($product_id)){
                $prestmt->bindValue(':product_id', $product_id);
            }
            else{
                $prestmt->bindValue(':product_id', null, PDO::PARAM_NULL);
            }
            
            $prestmt->bindValue(':video_title', $title);
            $prestmt->bindValue(':views', 0);
            $date = date('Y-m-d H:i:s');
            $prestmt->bindValue(':upload_date', $date, PDO::PARAM_STR);
            $prestmt->bindValue(':delete_date', null, PDO::PARAM_NULL);
            $prestmt->bindValue(':thumbnail', $thumbnail);
            $prestmt->bindValue(':video_path', $video_path);
            if(!empty($description)){
                $prestmt->bindValue(':description', $description);
            }
            else{
                $prestmt->bindValue(':description', null, PDO::PARAM_NULL);
            }

            //SQL実行
            $prestmt->execute();
            header('Location: video_admin.php');
            exit();



        }catch(PDOException $error){
            //エラー時の処理を書く
            echo $error->getMessage();
            $_SESSION['error2'] = $error->getMessage();
            echo $error->getCode();
            $_SESSION['error3'] = $error->getCode();
            //本来は、上記ログ出力し、下記のようになる。
            header('Location: error.php');
            exit;
        }
        header("Location: main.php");
        exit;

    }



        /////////動画修正/////////
        if($_POST['upload_mode'] == 'video_edit'){

            try{
                //DB接続オブジェクト
                //PDO…PHP Data Object
                $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
                //let logo = getElementById('id');
            
                //PDOの設定変更
                $pdo->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );
                $pdo->setAttribute(
                    PDO::ATTR_EMULATE_PREPARES,
                    false
                );
    
                $user_id = $_POST['user_id'];
                $video_id = $_POST['video_id'];
                $title = "";
                $product_id = "";
                $description = "";
                $thumbnail = "";
    
                if(!empty($_POST['title'])){
                    $title = $_POST['title'];
                }
                if(!empty($_POST['product'])){
                    $product_id = $_POST['product'];
                }
                if(!empty($_POST['description'])){
                    $description = $_POST['description'];
                    
                    //$description = nl2br($description);
                    /*$description = str_replace("<br />",'\n',$description);
                    */
                }
    
    
                //////////動画ファイル処理////////////
                $tempfile = $_FILES['video_file']['tmp_name'];
                //アップロッドしたファイルの拡張子取得
                $extension = pathinfo($_FILES['video_file']['name'], PATHINFO_EXTENSION);
            
                //アップロッドしたファイルの拡張子チェック
                $ok_file = ['mp4','webm','ogv'];
                $flag = FALSE;
                foreach($ok_file as $type){
                    if(strtolower($extension) == $type ){
                        $flag = TRUE;
                    }
                }

                if($flag == FALSE && is_uploaded_file($tempfile)){
                    $_SESSION['error'] = 'mp4,webm,ogv　ファイルにしてください';
                    header("Location: video_edit.php?video_id=$video_id");
                    exit;
                }
    
            
                //サーバに保存ファイル名を指定
                $filename = './files/video/'.$video_id.'.'.$extension ;
                $video_path = "";

                if (is_uploaded_file($tempfile)) {
                    if ( move_uploaded_file($tempfile , $filename )) {
                        //サムネイルキャプチャ
                        //$ret = exec("echo y | ffmpeg -i $filename -s 480*270 -vframes 1 files/video_thumbnail/$video_id.jpg"); //aws serever
                        $ret = exec("echo y |\"C:\\ffmpeg\bin\\ffmpeg\" -i $filename -s 480*270 -vframes 1 files/video_thumbnail/$video_id.jpg 2>&1"); //windows
                        $thumbnail = "./files/video_thumbnail/$video_id.jpg";
                        $video_path = $filename;
                    } 
                    else {
                        $_SESSION['error'] =  "ファイルをアップロードできません。";
                    }
                } 
                else{
                    $_SESSION['error'] =  "ファイルが選択されていません。";
                }
                ////////////////////////////////////////////
    
    
                //////////サムネイル画像処理////////////
                
                $tempfile = $_FILES['thumbnail_file']['tmp_name'];
                if (is_uploaded_file($tempfile)){
                    //アップロッドしたファイルの拡張子取得
                    $extension = pathinfo($_FILES['thumbnail_file']['name'], PATHINFO_EXTENSION);
                
                    //アップロッドしたファイルの拡張子チェック
                    $ok_file = ['jpg','jpeg','bmp','png','gif'];
                    $flag = FALSE;
                    foreach($ok_file as $type){
                        if(strtolower($extension) == $type ){
                            $flag = TRUE;
                        }
                    }
                    if($flag == FALSE){
                        $_SESSION['error'] = 'jpg,jpeg,bmp,png,gif　ファイルにしてください';
                        header("Location: video_edit.php?video_id=$video_id");
                        exit;
                    }
                }
    
    
                //サーバに保存ファイル名を指定
                $filename = './files/video_thumbnail/'.$video_id.'.'.$extension ;
    
                if (is_uploaded_file($tempfile)) {
                    if ( move_uploaded_file($tempfile , $filename )) {
                        $thumbnail = $filename;
                    } 
                }
                ///////////////////////////////////////
    
                
                //INSERT
                if(!empty($thumbnail) && !empty($video_path)){
                    $sql = "UPDATE video SET thumbnail=:thumbnail,video_path=:video_path,product_id=:product_id,video_title=:video_title,description=:description WHERE video_id=:video_id;";
                    //プリペアードステートメントの設定と取得
                    $prestmt = $pdo->prepare($sql);
                    //値の設定
                    $prestmt->bindValue(':video_id', $video_id);
                    $prestmt->bindValue(':thumbnail', $thumbnail);
                    $prestmt->bindValue(':video_path', $video_path);

                    $prestmt->bindValue(':video_title', $title);
                    if(!empty($product_id)){
                        $prestmt->bindValue(':product_id', $product_id);
                    }
                    else{
                        $prestmt->bindValue(':product_id', null, PDO::PARAM_NULL);
                    }
                    if(!empty($description)){
                        $prestmt->bindValue(':description', $description);
                    }
                    else{
                        $prestmt->bindValue(':description', null, PDO::PARAM_NULL);
                    }
                }
                else if(!empty($thumbnail)){
                    $sql = "UPDATE video SET thumbnail=:thumbnail,product_id=:product_id,video_title=:video_title,description=:description WHERE video_id=:video_id;";
                    //プリペアードステートメントの設定と取得
                    $prestmt = $pdo->prepare($sql);
                    //値の設定
                    $prestmt->bindValue(':video_id', $video_id);
                    $prestmt->bindValue(':thumbnail', $thumbnail);

                    $prestmt->bindValue(':video_title', $title);
                    if(!empty($product_id)){
                        $prestmt->bindValue(':product_id', $product_id);
                    }
                    else{
                        $prestmt->bindValue(':product_id', null, PDO::PARAM_NULL);
                    }
                    if(!empty($description)){
                        $prestmt->bindValue(':description', $description);
                    }
                    else{
                        $prestmt->bindValue(':description', null, PDO::PARAM_NULL);
                    }

                }
                else if(!empty($video_path)){
                    $sql = "UPDATE video SET video_path=:video_path,product_id=:product_id,video_title=:video_title,description=:description WHERE video_id=:video_id;";
                    //プリペアードステートメントの設定と取得
                    $prestmt = $pdo->prepare($sql);
                    //値の設定
                    $prestmt->bindValue(':video_id', $video_id);
                    $prestmt->bindValue(':video_path', $video_path);

                    $prestmt->bindValue(':video_title', $title);
                    if(!empty($product_id)){
                        $prestmt->bindValue(':product_id', $product_id);
                    }
                    else{
                        $prestmt->bindValue(':product_id', null, PDO::PARAM_NULL);
                    }
                    if(!empty($description)){
                        $prestmt->bindValue(':description', $description);
                    }
                    else{
                        $prestmt->bindValue(':description', null, PDO::PARAM_NULL);
                    }
                }
                else{
                    $sql = "UPDATE video SET product_id=:product_id,video_title=:video_title,description=:description WHERE video_id=:video_id;";
                    //プリペアードステートメントの設定と取得
                    $prestmt = $pdo->prepare($sql);
                    //値の設定
                    $prestmt->bindValue(':video_id', $video_id);
                    $prestmt->bindValue(':video_title', $title);
                    if(!empty($product_id)){
                        $prestmt->bindValue(':product_id', $product_id);
                    }
                    else{
                        $prestmt->bindValue(':product_id', null, PDO::PARAM_NULL);
                    }
                    if(!empty($description)){
                        $prestmt->bindValue(':description', $description);
                    }
                    else{
                        $prestmt->bindValue(':description', null, PDO::PARAM_NULL);
                    }
                }

    
                //SQL実行
                $prestmt->execute();
                header('Location: video_admin.php');
                exit();
    
    
    
            }catch(PDOException $error){
                //エラー時の処理を書く
                echo $error->getMessage();
                $_SESSION['error2'] = $error->getMessage();
                echo $error->getCode();
                $_SESSION['error3'] = $error->getCode();
                //本来は、上記ログ出力し、下記のようになる。
                header('Location: error.php');
                exit;
            }
            header("Location: main.php");
            exit;
    
        }
        

}else{
    header("Location: main.php");
    exit;
}


?>