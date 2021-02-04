<?php include("includes/header.php");?>
<link rel="stylesheet"  href="css/lightslider.css"/>
<style type="text/css">#video{ width: 860px; height: 450px;}  </style> 
<?php include("includes/navbar.php");?>


<main class="overflow-hidden mx-5 mb-4">
    <div class="row" >
        <div class="col-md-8">
        <!-- 動画 -->
        <div class="video_area pl-2">
            <video id = "video" controls autoplay preload="auto"  data-setup='{}' techOrder="[ 'html5','flash']">
                <source src="#" type="application/x-mpegURL">
            </video>
        </div>
        <div class="row pl-2">
            <div class="col-md-12">
            <div class="icons mt-3 mr-2 text-right float-right">
                <span class="text-center float-right"><i class="fa fa-eye" aria-hidden="true"></i> 視聴者数：<small class="ml-2"><span id = "show-count"></span></small></span>
            </div>
            <div class="d-flex align-items-center p-1 mt-2  ">
                <h3 class="ml-2 lh-100">タイトル</h3> 
            </div> 
            <div class="container align-items-center p-2 border-top border-bottom" style="height:150px;">
            <div class="row">
                <div class="col-1 pt-1">
                <img class="rounded-circle" src="https://dummyimage.com/60x60/000/fff" alt="user_icon" width="60" height="60">
                </div>
                <div class="col-2 ml-1 mt-4">
                <h5>ユーザー名</h5>
                </div>
            </div>
            <div class="ml-5 pl-5">
                <p>動画説明</p>
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
                        <ul class="list-group">
                            <li class="list-group-item pl-5">
                                <!-- ここでオススメ動画のリンクを入れて↓ -->
                                <a href="#"><img src="https://dummyimage.com/300x200/000/fff" alt="thumbnail" style="height: 200px; width:300px;"></a>
                                <div class="pt-2">
                                    <p class="fw-bolder"><a href="#">タイトル</a></p> 
                                    <div class="d-flex justify-content-start align-items-center">
                                        <img src="https://dummyimage.com/40x40/000/fff" class="rounded-circle float-left" alt="user_icon">
                                        <div class="d-flex align-items-start flex-column ml-3 ">
                                            <small class="text-center text-muted">ユーザー名</small>
                                            <small class="text-muted">2021/01/27 15:18</small>  
                                        </div> 
                                    </div>        
                                </div>
                            </li>
                            <li class="list-group-item pl-5">
                                <!-- ここでオススメ動画のリンクを入れて↓ -->
                                <a href="#"><img src="https://dummyimage.com/300x200/000/fff" alt="thumbnail" style="height: 200px; width:300px;"></a>
                                <div class="pt-2">
                                    <p class="fw-bolder"><a href="#">タイトル</a></p> 
                                    <div class="d-flex justify-content-start align-items-center" >
                                        <img src="https://dummyimage.com/40x40/000/fff" class="rounded-circle float-left" alt="user_icon" style="height: 40px; width:40px;">
                                        <div class="d-flex align-items-start flex-column ml-3 ">
                                            <small class="text-center text-muted">ユーザー名</small>
                                            <small class="text-muted">2021/01/27 15:18</small>  
                                        </div> 
                                    </div>        
                                </div>
                            </li>
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
                <li>
                    <div class="item border rounded" style="width:310px">
                        <div class="box text-center">
                            <img src="http://placehold.it/350x260" class="rounded mt-4" alt="" style="width:260px;">
                            <div class="row mx-1">
                                <div class="mx-2 pt-2" >
                                    <h5 class="text-left">
                                        <a href="#" class="text-dark">商品名</a>
                                    </h5>
                                    <h6 class="text-left text-dark">￥1500</h6>
                                </div>
                                <div class="col-12 mt-2 border-top" >
                                <p class="btn-add float-left mt-3 col-6 border-right">
                                    <i class="fa fa-shopping-cart  mb-1"></i><small><a href="http://www.jquery2dotnet.com" class="hidden-sm"> カートへ入れ</a></small></p>
                                <p class="btn-details float-right mt-3 col-6">
                                    <i class="fa fa-shopping-bag  mb-1"></i><small><a href="http://www.jquery2dotnet.com" class="hidden-sm"> 今すぐ買う</a></small></p>
                                </div>
                            </div>    
                        </div> 
                    </div>
                </li>
            <!-- loop end -->
            </ul>
        </div>
    </div>
</main>


<?php include("includes/footer.php");?>
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
</script>
<?php include("includes/script.php");?>