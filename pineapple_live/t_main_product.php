<?php include("./includes/header.php");?>
<!-- <link href="#" rel="stylesheet"> ここで自分のCSSを入れる -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
<style>
#product_img{

    object-fit:cover;
}
.slider img{
  object-fit: cover; 
  height:400px;
}
</style>
<title>商品ページ</title>
<?php include("./includes/navbar.php");?>





  <main role="main">

    <div class="slider">
      <img src="./images/slide/slide_1.png">
      <img src="./images/slide/slide_2.png">
      <img src="./images/slide/slide_3.png">
    </div>


    <div class="container">
    <h3 id = "category_name"></h3> <!--カテゴリ名-->
    <h4 class="my-4">商品一覧</h4>
    <div class="row">
        <?php foreach ($goods as $g) {
            if (is_null($g['delete_date'])) { ?>
      <div class="col-md-3">
        <div class="card mb-3 shadow-sm" style="height:380px">
          <img id = "product_img" src="<?php echo $g['image_id'];?>" alt="procust_img" style="height:200px; ">
          <div class="card-body card-body d-flex flex-column justify-content-center">
            <p class="card-text text-center fw-bolder h6"><a href="<?php echo 'product_detail?product_id='.$g['product_id']?>">
            <?php echo $g['product_name'] ?></a></p>
              <span class="small"><p class="text-center text-muted"><?php echo $g['product_maker']?></p></span>
              <p class="text-center h6"><?php echo "￥".number_format($g['product_price'])?></p>
          </div>
        </div>
      </div>
      <?php }};?>

    </div>
    <div class="row">
      <div>
        <a id="back-to-top" href="#" class="btn btn-light back-to-top btn-lg my-3 float-right" role="button"><i class="fa fa-chevron-up"></i></a>
      </div>
    </div>
  </div>

    


</main>

<?php include("./includes/footer.php");?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('.slider').bxSlider({
    auto: true,
    pause: 5000,
  });
});


$(document).ready(function(){
		// scroll body to 0px on click
		$('#back-to-top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 100);
			return false;
		});
});
</script>

<?php include("./includes/script.php");?>

