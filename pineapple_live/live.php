<?php session_start();?>

<?php include("includes/header.php");?>
<?php include("live_code.php");?>
<!-- css for this page-->

<link href="css/live_chat.css" rel="stylesheet"> 
<link href="https://vjs.zencdn.net/7.4.1/video-js.min.css" rel="stylesheet">
<link rel="stylesheet"  href="css/lightslider.css"/>
<style type="text/css">
  #live{ width: 860px; height: 450px;} 
  #login_area{
    margin:20px auto;
    text-align:center;
  }
  #login_area a{
    color:black;
  }
  #login_area a:hover{
    background:rgb(50, 50, 50,0.1);
  }

  #greet{
    height:38px;
  }

</style> 
<!-- css end-->
<!-- script for this page-->
<!--アクセスカウンター-->
<script>

/* 定期的にcountAll関数を実行 */
setInterval("countAll()",10000);
/* アクセス情報の登録と取得を行う */
function countAll(){
  setCount();
  getCount();
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
        //console.log('通信成功');
    })
    // Ajax通信が失敗した時
    .fail( function(data) {

        //console.log(data);

    })
}
/* アクセスユーザーのログを取得 */
function getCount(){
    $.ajax({
        url:'./get_count.php', //送信先
        type:'POST', //送信方法
        datatype: 'json', //受け取りデータの種類
        data:{
            'uri': '<?php echo $uri; ?>'
        }
  })
    // Ajax通信が成功した時
    .done( function(data) {
        var counter = document.getElementById("show-count");
        counter.textContent = data;
        //console.log('通信成功:'+data);
        //console.log(data);
    })
    // Ajax通信が失敗した時
    .fail( function(data) {
        console.log('通信失敗');
        console.log(data);

    })
}

window.addEventListener('load', setCount);
window.addEventListener('load', getCount);
</script>
<!-- script end-->
<?php include("includes/navbar.php");?>


<main class="overflow-hidden mx-5 mb-4">
<div class="row" >
  <!-- ライブ -->
    <div class="col-md-8">
      <div class="live_area pl-2">
          <video id = "live"  class="video-js" controls autoplay
          preload="auto"  data-setup='{}' techOrder="[ 'html5','flash']">
          <source src="./hls/<?php echo $live_id;?>.m3u8" type="application/x-mpegURL">
          </video>
      </div>
      <div class="row pl-2">
        <div class="col-md-12">
          <div class="icons mt-3 mr-2 text-right float-right">
            <span class="text-center float-right"><i class="fa fa-eye" aria-hidden="true"></i> 視聴者数：<small class="ml-2"><span id = "show-count"></span></small></span>
          </div>
          <div class="d-flex align-items-center p-1 mt-2  ">
            <h3 class="ml-2 lh-100"><?php echo $Title;?></h3> 
          </div> 
          <div class="container align-items-center p-2 border-top border-bottom" style="height:150px;">
          <div class="row">
            <div class="col-1 pt-1">
              <img class="rounded-circle" src="<?php echo $vtuber_icon;?>" alt="user_icon" width="60" height="60">
            </div>
            <div class="col-1 ml-1 mt-4">
              <p><?php echo $vtuber;?></p>
            </div>
          </div>
          <div class="ml-5 pl-4">
            <p><?php echo nl2br($description);?></p>
          </div>
          </div>
        </div>
      </div>
    </div>
  <!-- ライブチャット -->
    <div class="col-md-4 themed-grid-col bg">
        <div class="container_chat" >
            <div class="panel panel-default border border-2 rounded-3"  >
                <div class="panel-heading p-2 border-bottom">
                    <span class="glyphicon glyphicon-comment p-1"></span> ライブチャット
                </div>
                <div class="panel-body p-4" style="height: 575px;" id="talkField">
                    <ul class="chat" id="result"></ul>
                    <div id="end"></div>
                </div>
                <div class="panel-footer">
                    <?php 
                    //ログイン状態なら　チャット入力バー　表示
                    echo $input_button;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 商品一覧 -->
<?php
   include("live_product.php");
?>

</main>

<!--php値をjquery 渡す-->
<?php echo $push_jquery;?> 
</main>

<script>
    function init(){
        document.title = "<?php echo $Title?> - PineappleLive";
    }
    window.addEventListener('load', init);
</script>

<?php include("includes/footer.php");?>
<!-- JS for this page -->
<script src="js/video.min.js"></script>
<script src="js/videojs-contrib-media-sources.min.js"></script>
<script src="js/videojs-contrib-hls.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
<script src="js/main.js"></script>    
<script src="https://vjs.zencdn.net/7.4.1/video.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/videojs-flash@2/dist/videojs-flash.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/lightslider.js"></script> 
<script>
    $(document).ready(function() {
			$("#content-slider").lightSlider({
                item: 4,
                loop:true,
                keyPress:true,
                pager: true
            });
		});


    // Get the input field
    if(document.getElementById("chat_area")){
      var input = document.getElementById("chat_area");

      // Execute a function when the user releases a key on the keyboard
      input.addEventListener("keyup", function(event) {
        // Number 13 is the "Enter" key on the keyboard
        if (event.keyCode === 13) {
          // Cancel the default action, if needed
          event.preventDefault();
          // Trigger the button element with a click
          document.getElementById("greet").click();
          document.getElementById("message").value = "";
        }
      }); 
    }

    </script>
<!-- JS end -->
<?php include("includes/script.php");?>