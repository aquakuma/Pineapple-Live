<?php include("./includes/header.php");?>
<title>Pineapple</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="./js/top.js"></script>
<?php 
    session_start();
    include("./includes/navbar.php");
?>

<main role="main">

<div class="container">
    <div class="d-flex align-items-center">
        <i class="fa fa-video-camera fa-2x mr-3" aria-hidden="true"></i><h4 class="my-2">現在ライブ中</h4>
    </div>

    <hr>
    <div id = 'now_live' class="row">
        
    </div>
</div>


<div class="container">
    <div class="d-flex align-items-center">
        <i class="fa fa-shopping-basket  fa-2x mr-3" aria-hidden="true"></i><h4 class="my-4">最新商品</h4>
    </div>

    <hr>
    <div id = 'new_product' class="row">
        
    </div>
    
</div>

<div class="container">
    <div class="d-flex align-items-center">
        <i class="fa fa-film fa-2x mr-3" aria-hidden="true"></i><h4 class="my-4">最新動画</h4>
    </div>

    <hr>
    <div id = 'new_video' class="row">
        
    </div>
</div>



</main>


<?php include("./includes/footer.php");?>
<script>//ここで自分のJSを書く</script>
<?php include("./includes/script.php");?>
