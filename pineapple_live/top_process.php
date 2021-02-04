<?php
    $mode = $_POST['mode'];

    include('./db_connect.php');


    try{

    
        $pdo = db_connect();
        //PDOの設定変更（エラー黙殺→例外発生）
        $pdo->setAttribute(
            PDO::ATTR_ERRMODE,          //3
            PDO::ERRMODE_EXCEPTION);    //2
    
        //実況中ライブ
        if ($mode == "live"){
            live($pdo);
        }
        //最新商品
        if ($mode == "product"){
            product($pdo);
        }
        if ($mode == "live_all"){

            live_all($pdo);
        }
        //最新動画
        if ($mode == "video"){
            video($pdo);
        }
        if ($mode == "video_all"){

            video_all($pdo);
        }

        //header icon
        if ($mode == "header_icon"){

            product($pdo,$_POST['user_id']);
        }
    }
    
    catch (PDOException $e) {
        print('接続失敗:' . $e->getMessage());
        die();
    }

    //実況中ライブ
    function live($pdo){
        $result = glob('./hls/*.m3u8');

        $output = [];
        $index = 0;
        foreach($result as $file){
            $output['lives'][$index] = basename($file);
            $output['live_id'][$index] = basename($file,'.m3u8');
            $index++;
        }
    
    
            
        for($index = 0;$index < count($output['live_id']);$index++){
            
            
            $sql = "select * from live l,user u where l.user_id = u.user_id AND l.live_id = ".$output['live_id'][$index];
            $dbh = $pdo->query($sql);
            while($record = $dbh->fetch(PDO::FETCH_ASSOC)){
                //インスタンスのみ→PDO::FETCH_NUM
                //連想配列のみ→PDO::FETCH_ASSOC
                //両方→PDO::FETCH_BOTH（メモリの無駄）
                $output['live_title'][$index] = $record["title"];
                $output['thumbnail'][$index] = $record["thumbnail"];
                $output['user_icon'][$index] = $record["user_icon"];
                $output['user_name'][$index] = $record["user_name"];
                $output['start_date'][$index] = $record["start_date"];
            }
            if(empty($output['thumbnail'][$index])){
                $live_id = $output['live_id'][$index];
                $ts_file = glob("./hls/$live_id-*.ts");
                foreach($ts_file as $ts){
                    //$ret = exec("echo y | ffmpeg -i $ts -s 480*270 -vframes 1 files/thumbnail/$live_id.jpg"); //aws
                    $ret = exec("echo y |\"C:\\ffmpeg\bin\\ffmpeg\" -i $ts -s 480*270 -vframes 1 files/thumbnail/$live_id.jpg 2>&1"); //windows
                    /* 
                    $command1 = "ffmpeg -version";
                    $results = exec($command);*/
                    break;
                }
                $output['thumbnail'][$index] = "./files/thumbnail/$live_id.jpg";
                
            }

        }

        //jsonとして出力
        header('Content-type: application/json');
        echo json_encode($output,JSON_UNESCAPED_UNICODE, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    }


    //最新商品
    function product($pdo){
        $sql = "select * from products p,user u where p.user_id = u.user_id AND p.delete_date is null order by p.product_id DESC limit 4";
        $dbh = $pdo->query($sql);

        $output = [];
        $output = $dbh->fetchALL(PDO::FETCH_ASSOC);
        

        foreach($output as $key => $row){
            $output[$key]['product_price'] = number_format($row['product_price']);
        }
        
        //jsonとして出力
        header('Content-type: application/json');
        echo json_encode($output,JSON_UNESCAPED_UNICODE, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    }

    //最新動画
    function video($pdo){
        $sql = "select * from video v,user u where v.user_id = u.user_id AND v.delete_date is null order by v.video_id DESC limit 4";
        $dbh = $pdo->query($sql);

        $output = [];
        $output = $dbh->fetchALL(PDO::FETCH_ASSOC);
        /*
        $index = 0;
        while($record = $dbh->fetch(PDO::FETCH_ASSOC)){
            //インスタンスのみ→PDO::FETCH_NUM
            //連想配列のみ→PDO::FETCH_ASSOC
            //両方→PDO::FETCH_BOTH（メモリの無駄）
            $output['product_name'][$index] = $record["product_name"];
            $output['product_price'][$index] = $record["product_price"];
            $output['image_id'][$index] = $record["image_id"];
        }
        */
        //jsonとして出力
        header('Content-type: application/json');
        echo json_encode($output,JSON_UNESCAPED_UNICODE, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    }


    //動画一覧ページ
    function video_all($pdo){
        $sql = "select * from video v,user u where v.user_id = u.user_id AND v.delete_date is null order by v.video_id DESC ";
        $dbh = $pdo->query($sql);

        $output = [];
        $output = $dbh->fetchALL(PDO::FETCH_ASSOC);
        /*
        $index = 0;
        while($record = $dbh->fetch(PDO::FETCH_ASSOC)){
            //インスタンスのみ→PDO::FETCH_NUM
            //連想配列のみ→PDO::FETCH_ASSOC
            //両方→PDO::FETCH_BOTH（メモリの無駄）
            $output['product_name'][$index] = $record["product_name"];
            $output['product_price'][$index] = $record["product_price"];
            $output['image_id'][$index] = $record["image_id"];
        }
        */
        //jsonとして出力
        header('Content-type: application/json');
        echo json_encode($output,JSON_UNESCAPED_UNICODE, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    }




    /*
    function header_icon($pdo,$user_id){
        $sql = "select user_icon from user where user_id = '$user_id'";
        $dbh = $pdo->query($sql);

        $output = [];

        while($record = $dbh->fetch(PDO::FETCH_ASSOC)){
            //インスタンスのみ→PDO::FETCH_NUM
            //連想配列のみ→PDO::FETCH_ASSOC
            //両方→PDO::FETCH_BOTH（メモリの無駄）
            $output['user_icon'] = $record["user_icon"];

        }

        //jsonとして出力
        header('Content-type: application/json');
        echo json_encode($output,JSON_UNESCAPED_UNICODE, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    }*/

    //ライブ一覧ページ
    function live_all($pdo){
        $result = glob('./hls/*.m3u8');

        $output = [];
        $index = 0;
        foreach($result as $file){
            $output['lives'][$index] = basename($file);
            $output['live_id'][$index] = basename($file,'.m3u8');
            $index++;
        }
    
    
            
        for($index = 0;$index < count($output['live_id']);$index++){
            
            
            $sql = "select * from live l, user u where l.user_id = u.user_id AND live_id = ".$output['live_id'][$index];
            $dbh = $pdo->query($sql);
            while($record = $dbh->fetch(PDO::FETCH_ASSOC)){
                //インスタンスのみ→PDO::FETCH_NUM
                //連想配列のみ→PDO::FETCH_ASSOC
                //両方→PDO::FETCH_BOTH（メモリの無駄）
                $output['live_title'][$index] = $record["title"];
                $output['thumbnail'][$index] = $record["thumbnail"];
                $output['user_name'][$index] = $record["user_name"];
                $output['user_icon'][$index] = $record["user_icon"];
                if(isset($record["user_icon"])){
                    $output['start_date'][$index] = $record["start_date"];
                }
                else{
                    $output['start_date'][$index] = "";
                }
            }
            if(empty($output['thumbnail'][$index])){
                $live_id = $output['live_id'][$index];
                $ts_file = glob("./hls/$live_id-*.ts");
                foreach($ts_file as $ts){
                    //$ret = exec("echo y | ffmpeg -i $ts -s 480*270 -vframes 1 files/thumbnail/$live_id.jpg"); //aws
                    $ret = exec("echo y |\"C:\\ffmpeg\bin\\ffmpeg\" -i $ts -s 480*270 -vframes 1 files/thumbnail/$live_id.jpg 2>&1"); //windows
                    /*
                    $command1 = "ffmpeg -version";
                    $results = exec($command);
                    */
                    break;
                }
                $output['thumbnail'][$index] = "./files/thumbnail/$live_id.jpg";
                
            }

        }

        //jsonとして出力
        header('Content-type: application/json');
        echo json_encode($output,JSON_UNESCAPED_UNICODE, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    }

?>