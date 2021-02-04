<?php
    
    include('./db_connect.php');
    $video_id = "";
    if(isset($_GET['video_id'])){
        $video_id = $_GET['video_id'];
    }
    else{
        header('location:video_all');
        exit;
    }


    $uri = $_SERVER["REQUEST_URI"]; // アクセスしたページのURI
    $ipaddress = $_SERVER["REMOTE_ADDR"]; // IPアドレス取得

    $pdo = db_connect();
    

    //SQL文作成
    $sql = "SELECT * FROM video WHERE video_id = $video_id";
    //プリペアードステートメントの設定と取得
    $prestmt = $pdo->prepare($sql);

    //SQL実行
    $prestmt->execute();
    //抽出結果取得
    $video_array = $prestmt->fetch(PDO::FETCH_ASSOC);
    //削除確認
    if(!empty($video_array['delete_date'])){
        header("Location: video_all");
        exit;
    }




    //SQL文作成
    $sql = "SELECT * FROM video v LEFT JOIN products p ON v.product_id = p.product_id LEFT JOIN user u ON u.user_id = v.user_id";
    //プリペアードステートメントの設定と取得
    $prestmt = $pdo->prepare($sql);

    //SQL実行
    $prestmt->execute();
    //抽出結果取得
    $video_list = $prestmt->fetchAll(PDO::FETCH_ASSOC);


    $flag = 0;
    $video_path ="";
    $uploader ="";
    $title = "";
    $upload_date ="";
    $views ="";
    $product_id = "";
    foreach($video_list as $video){
        if($video_id == $video['video_id']){
            $flag = 1;
            $video_path =$video['video_path'];
            $uploader =$video['user_name'];
            $title = $video['video_title'];
            $upload_date =$video['upload_date'];
            $views =$video['views'];
            $product_id = $video['product_id'];
            $product_name = $video['product_name'];
            $product_img = $video['image_id'];
            $description = $video['description'];
            $user_icon = $video['user_icon'];
            $product_price = number_format($video['product_price']);
            break;
        }
    }
    if($flag == 0){
        header('location:video_all');
        exit;
    }

    //商品処理
    $product_delete_flag = 0;
    if(!empty($product_id)){
        //SQL文作成
        $sql = "SELECT * FROM products WHERE product_id = $product_id";
        //プリペアードステートメントの設定と取得
        $prestmt = $pdo->prepare($sql);

        //SQL実行
        $prestmt->execute();
        //抽出結果取得
        $product_array = $prestmt->fetch(PDO::FETCH_ASSOC);
        //削除確認
        if(!empty($product_array['delete_date'])){
            $product_id = "";
            $product_name = "";
            $product_img = "";
        }
        else{
            $product_delete_flag = 1;
        }
    }



    $file_extension = pathinfo($video_path, PATHINFO_EXTENSION);








    //おすすめ動画処理

    //SQL文作成
    $sql = "SELECT v.video_id,v.thumbnail,v.video_title,u.user_icon,u.user_name FROM video v,user u WHERE v.user_id = u.user_id AND v.delete_date IS NULL AND v.video_id != $video_id ORDER BY RAND() LIMIT 3";
    //プリペアードステートメントの設定と取得
    $prestmt = $pdo->prepare($sql);

    //SQL実行
    $prestmt->execute();
    //抽出結果取得
    $recommend_video = $prestmt->fetchAll(PDO::FETCH_ASSOC);
    $recommend_video_json = json_encode($recommend_video); 


    
?>

<script>

    function init(){
        
        var vtitle = '<?php echo $title?>';
        var path = '<?php echo $video_path?>';
        var uploader_text = '<?php echo $uploader?>';
        var upload_date_text = '<?php echo $upload_date?>';
        var file_extension = '<?php echo $file_extension?>';
        var views_text = '<?php echo $views?>';
        var product_name_text = '<?php echo $product_name?>';
        var product_id = '<?php echo $product_id?>';
        var product_img_path = '<?php echo $product_img?>';
        var description_text = '<?php echo ''?>';
        var user_icon = '<?php echo $user_icon?>';
        var product_price = '<?php echo $product_price?>';
        var product_delete_flag = '<?php echo $product_delete_flag?>';

        var recommend_video = JSON.parse('<?php echo $recommend_video_json; ?>');


        document.title = vtitle+" - PineappleLive";
        console.log(user_icon);
        console.log(path);
        var video_src = document.getElementById('video_src');
        video_src.setAttribute('src', path); 

        var video_title = document.getElementById('video_title');
        video_title.textContent = vtitle;

        var video_uploader = document.getElementById('video_uploader');
        video_uploader.textContent = uploader_text;
/*
        var description = document.getElementById('description');
        description.textContent = '';
*/
        var u_icon = document.getElementById('u_icon');
        u_icon.setAttribute('src', user_icon); 


        //関連商品

        console.log(product_delete_flag);
        if(product_delete_flag == 1){
                var product_waku = document.getElementById("product_waku");
            while (product_waku.querySelector('div')) {
                product_waku.querySelector('div').remove();
            }
            
            var div1 = document.createElement("div");
            div1.classList.add('item','border','rounded');
            div1.style.width = "310px";
            var div2 = document.createElement("div");
            div2.classList.add('box','text-center');

            var img = document.createElement("img");
            img.classList.add('rounded','mt-4');
            img.style.width = "260px";
            img.style.height = "200px";
            img.style.objectFit = "cover";
            img.setAttribute('src', product_img_path); 
            div2.appendChild(img);

            var div3 = document.createElement("div");
            div3.classList.add('row','mx-1');

            var div4_1 = document.createElement("div");
            div4_1.classList.add('mx-2','pt-2');

            var h5 = document.createElement("h5");
            h5.classList.add('text-left');
            var a = document.createElement("a");
            a.classList.add('text-dark');
            a.setAttribute('href', 'product_detail?product_id='+product_id); 
            a.textContent = product_name_text;
            h5.appendChild(a);
            div4_1.appendChild(h5);

            var h6 = document.createElement("h6");
            h6.classList.add('text-left','text-dark');
            h6.textContent = "￥"+product_price;
            div4_1.appendChild(h6);
            div3.appendChild(div4_1);

            var div4_2 = document.createElement("div");
            div4_2.classList.add('col-12','mt-2','border-top');
            var p = document.createElement("p");
            p.classList.add('btn-add','float-left','mt-3','col-12');
            var i = document.createElement("i");
            i.classList.add('fa','fa-shopping-bag','fa-shopping-bag','mb-1');
            p.appendChild(i);

            var small = document.createElement("small");
            var a = document.createElement("a");
            a.classList.add('hidden-sm');
            a.setAttribute('href', 'product_detail?product_id='+product_id); 
            a.textContent = '今すぐ買う';
            small.appendChild(a);
            p.appendChild(small);
            div4_2.appendChild(p);
            div3.appendChild(div4_2);
            div2.appendChild(div3);
            div1.appendChild(div2);
            product_waku.appendChild(div1);
        }

////////////////////////////////////////////
        var recommend_video_waku = document.getElementById("recommend_video_waku");
        while (recommend_video_waku.querySelector('li')) {
            recommend_video_waku.querySelector('li').remove();
        }

        for(var row in recommend_video){
            var li = document.createElement("li");
            li.classList.add('list-group-item','pl-5');

            var a = document.createElement("a");
            a.setAttribute('href', 'video?video_id='+recommend_video[row]['video_id']); 

            var img = document.createElement("img");
            img.style.width = "300px";
            img.style.height = "200px";
            img.style.objectFit = "cover";
            img.setAttribute('src', recommend_video[row]['thumbnail']); 
            a.appendChild(img);
            li.appendChild(a);

            var div1 = document.createElement("div");
            div1.classList.add('pt-2');
            var p = document.createElement("p");
            p.classList.add('fw-bolder');
            var a = document.createElement("a");
            a.setAttribute('href', 'video?video_id='+recommend_video[row]['video_id']); 
            a.textContent = recommend_video[row]['video_title'];
            p.appendChild(a);
            div1.appendChild(p);

            var div2 = document.createElement("div");
            div2.classList.add('d-flex','justify-content-start','align-items-center');

            var img = document.createElement("img");
            img.style.width = "40px";
            img.style.height = "40px";
            img.style.objectFit = "cover";
            img.classList.add('rounded-circle','float-left');
            img.setAttribute('src', recommend_video[row]['user_icon']); 
            div2.appendChild(img);

            var div3 = document.createElement("div");
            div3.classList.add('d-flex','align-items-start','flex-column','ml-3');

            var small = document.createElement("small");
            small.classList.add('text-center','text-muted');
            small.textContent = recommend_video[row]['user_name'];
            div3.appendChild(small);

            var small = document.createElement("small");
            small.classList.add('text-muted');
            small.textContent = recommend_video[row]['upload_date'];
            div3.appendChild(small);

            div2.appendChild(div3);
            div1.appendChild(div2);
            li.appendChild(div1);
            recommend_video_waku.appendChild(li);
        }



    }

    /* アクセスユーザーのログを記録 */
    function setCount(){
        $.ajax({
            url:'./set_count.php', //送信先
            type:'POST', //送信方法
            datatype: 'json', //受け取りデータの種類
            data:{
                'uri': '<?php echo $uri; ?>',
                'ipaddress': '<?php echo $ipaddress; ?>'
            }
            
        })
        // Ajax通信が成功した時
        .done( function(data) {
            console.log('通信成功');
        })
        // Ajax通信が失敗した時
        .fail( function(data) {

            console.log(data);

        })
    }

    /* アクセスユーザーのログを取得 */
    function getCount(){
        $.ajax({
            url:'./setvideo_views.php', //送信先
            type:'POST', //送信方法
            datatype: 'json', //受け取りデータの種類
            data:{
                'uri': '<?php echo $uri; ?>',
                'video_id': '<?php echo $video_id; ?>'
            }
    })
        // Ajax通信が成功した時
        .done( function(data) {
            console.log('通信成功:'+data);
            var views = document.getElementById('show-count');
            views.textContent = data;

        })
        // Ajax通信が失敗した時
        .fail( function(data) {
            console.log('通信失敗');
            console.log(data);
            //console.log('<?php echo $uri; ?>');
        })
    }

    window.addEventListener('DOMContentLoaded', init);
    window.addEventListener('DOMContentLoaded', setCount);
    window.addEventListener('DOMContentLoaded', getCount);
</script>