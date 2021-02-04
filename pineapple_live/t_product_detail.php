<?php include("./includes/header.php");?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
	#product_detail img{
		height:400px;
		width:600px;
		object-fit:cover;
	}
</style>

<?php include("./includes/navbar.php");?>
<?php $uri = $_SERVER["REQUEST_URI"]; // アクセスしたページのURI?>

<main>
    <!--Section: Block Content-->
<section class="m-5 px-5">
	<div class="row">
		<div class="col-md-6 mb-4 " id ="product_detail">	
			<?php echo img_tag($goods['image_id']) ?>
		</div>

		<div class="col-md-6" >

			<h5><?php //商品名 表示
                    echo "商品名:" . $goods['product_name'] ?></h5>
			<p class="mb-2 text-muted small"><?php echo $goods['category_name']?></p>

			<p><span class="mr-1"><strong><?php echo "￥".number_format($goods['product_price']) ?></strong></span></p>
			<div class="table-responsive">
			<table class="table table-sm table-borderless ">
				<tbody>
				<tr>
					<th class="pl-0 w-25" scope="row"><strong>出品者</strong></th>
					<td><?php echo $goods['user_name'] ?></td>
				</tr>
				<tr>
					<th class="pl-0 w-25" scope="row"><strong>品番</strong></th>
					<td><?php echo $goods['product_number'] ?></td>
				</tr>
				<tr>
					<th class="pl-0 w-25" scope="row"><strong>サイズ</strong></th>
					<td><?php 
							if(!empty($size))
							{
								foreach($size as $s){
									echo $s['product_size']." ";
								}
							}

					?></td>
				</tr>
				</tbody>
			</table>
			</div>
			<hr>
			<form action="cart_add.php" method="post" enctype="multipart/form-data">
			<div class="table-responsive mb-2">
			<table class="table table-sm table-borderless ">
				<tbody>
				<tr>
					<td class="pl-0 pb-0 w-25">数量</td>
					<td class="pb-0">サイズ</td>
				</tr>
				<tr>
					
					<td class="pl-0">
					<select class="form-select form-select-sm" aria-label=".form-select-sm" name="product_buy_num" id ="num">

					</select>
					</td>
					<td>
					<select class="form-select form-select-sm" aria-label=".form-select-sm" name="product_buy_size" id = "size_select" onchange = "select_change();">
					<?php
						foreach($size as $s){
							$size_value = $s['product_size'];
							echo "<option value ='$size_value'>$size_value</option>";
						}
						
					?>
					</select>
					</td>
				
				</tr>
				</tbody>
			</table>
			</div>
			<input  type='hidden' value='<?php echo $_GET["product_id"]?>' name='product_id'>
			<input  type='hidden' value='<?php echo $goods['product_price']?>' name='price'>
			<input  type='hidden' value='<?php echo $goods['product_name']?>' name='product_name'>
			<input  type='hidden' value='<?php echo $uri?>' name='page'>
			<button  data-action ="buy.php?mode=buy" class="btn btn-primary btn-md mr-1 mb-2 submit">今すぐ買う</button>
			<button  data-action ="cart_add.php" class="btn btn-light btn-md mr-1 mb-2 submit"><i
				class="fa fa-shopping-cart pr-2"></i>カートに入れる</button>
		</form>
		</div>
	</div>
	<div class="row">
		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">商品の説明</a>
			</div>
		</nav>
	<div class="tab-content" id="nav-tabContent">
		<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
			<div class="p-5">
				<?php echo nl2br($goods['product_description']) ?>
			</div>
		</div>

	</div>	
</section>
<!--Section: Block Content-->




</main>



<?php include("./includes/footer.php");?>
<?php include("./includes/script.php");?>