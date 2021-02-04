<?php
session_start();
include('./db_connect.php');

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
}
else{
    header("Location:". $_SERVER['HTTP_REFERER']);
    exit;
}
$pdo = db_connect();

$sql = "SELECT * FROM products p,product_category c,user u WHERE c.category_id = p.category_id AND u.user_id = p.user_id AND p.product_id=:product_id";
//プリペアードステートメントの設定と取得
$prestmt = $pdo->prepare($sql);
//値の設定
$prestmt->bindValue(':product_id', $product_id);
//SQL実行
$prestmt->execute();
$goods = $prestmt->fetch(PDO::FETCH_BOTH);
/*
echo $goods['delete_date'];
echo "<pre>";
var_dump($goods);
echo "</pre>";
*/
//削除確認
if(!empty($goods[10])){
    header("Location: main_product");
    exit;
}

$st = $pdo->query("SELECT product_size,	product_inventory FROM products_size WHERE product_id=$product_id");
$size = $st->fetchALL();



foreach($size as $s){
    $size_value = $s['product_size'];
}


$size_encode =  json_encode( $size );  //JSONエンコード

$flag = 1;
if(empty($size)){
    $flag = 0;
}

require 't_product_detail.php';
?>


<script>

    //Jquery form送信  （data-action）
    $('.submit').click(function() {
    $(this).parents('form').attr('action', $(this).data('action'));
    $(this).parents('form').submit();
    });


    var param = JSON.parse('<?php echo $size_encode; ?>');  //JSONデコード
    console.log( param );

    
    function select_change(){
        var num_select = document.getElementById('num');
        while (num_select.querySelector('option')) {
            num_select.querySelector('option').remove();
        }
        if(document.getElementById('size_select')){
            var size = document.getElementById('size_select').value;
            
            for(var key in param){
                if(size == param[key]['product_size']){
                    var set_size = param[key]['product_inventory'];
                }
            }
        }
        if(set_size == 0){
                var option = document.createElement("option");
                option.values = 0;
                option.text = 0;
                num_select.appendChild(option);
        }
        for(var i = 1; i <=set_size;i++){
            var option = document.createElement("option");
            option.values = i;
            option.text = i;
            num_select.appendChild(option);
        }
    }


    

    function init(){
        document.title = "<?php echo $goods['product_name']?> - PineappleLive";


        /*
        if(<?php //echo $flag?>)
        {
            window.addEventListener('load', select_change);
        }
        else{
            

            window.addEventListener('load', function(){
                var num_select = document.getElementById('num');
                var set_size = $goods['product_inventory'];
                if(set_size == 0){
                    var option = document.createElement("option");
                    option.values = 0;
                    option.text = 0;
                    num_select.appendChild(option);
                }
                for(var i = 1; i <=set_size;i++){
                    var option = document.createElement("option");
                    option.values = i;
                    option.text = i;
                    num_select.appendChild(option);
                }
            });
        }
        */
    }
    window.addEventListener('load', init);
    window.addEventListener('load', select_change);

</script>
