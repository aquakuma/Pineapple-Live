<?php session_start();?>
<?php include("./includes/header.php");?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet"  href="css/lightslider.css"/>
<style type="text/css">.video{ width: 860px; height: 450px;}  </style> 
<?php include("./video_process.php");?>
<?php include("./includes/navbar.php");?>




<main class="overflow-hidden mx-5 mb-4">
    <div class="row" >
        <div class="col-md-8">
        <!-- 動画 -->
        <div class="video_area pl-2">
            <video class ="video" id = "video_src" controls muted autoplay playinline loop>

            </video>
        </div>
        <div class="row pl-2">
            <div class="col-md-12">
            <div class="icons mt-3 mr-2 text-right float-right">
                <span class="text-center float-right"><i class="fa fa-eye" aria-hidden="true"></i> 再生数：<small class="ml-2"><span id = "show-count"></span></small></span>
            </div>
            <div class="d-flex align-items-center p-1 mt-2  ">
                <h3 class="ml-2 lh-100" id = "video_title"></h3> 
            </div> 
            <div class="container align-items-center p-2 border-top border-bottom" style="height:150px;">
            <div class="row">
                <div class="col-1 pt-1">
                <img class="rounded-circle" id ="u_icon" src="" alt="user_icon" width="60" height="60">
                </div>
                <div class="col-2 ml-1 mt-4">
                <h5 id = "video_uploader"></h5>
                </div>
            </div>
            <div class="ml-5 pl-5">
                <p id = "description"><?php echo nl2br($description)?></p>
            </div>
            </div>
            </div>
        </div>
        </div>

        <!-- オススメ動画 -->
        <div class="col-md-4 themed-grid-col bg">
            <div class="container" >
                <div class="panel panel-default border border-2 rounded-3" >
                    <div class="panel-heading p-2 border-bottom">
                        <span class="glyphicon glyphicon-comment p-1">オススメ動画</span> 
                    </div>
                    <div class="panel-body">
                        <ul class="list-group" id="recommend_video_waku">
                            <!--javascriptで動的追加 video_process.php-->
                        </ul>
                    </div>
                    <div class="panel-footer">
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 商品 -->
    <div class="row ml-1 my-3">
        <div class="row ">
            <h3 class="col-6 mt-3 pl-2 pt-1 ">関連商品</h3>
        </div>
        <div class="item pl-2">
            <ul id="content-slider" class="content-slider" style="list-style: none;">  
            <!-- ここからloop -->
                <li id ="product_waku">
                    <!--javascriptで動的追加 video_process.php-->
                </li>
            <!-- loop end -->
            </ul>
        </div>
    </div>
</main>




<!--########################################################-->









<?php include("includes/footer.php");?>

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
</script>
<?php include("includes/script.php");?>
