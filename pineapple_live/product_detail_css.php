<?php include("./includes/header.php");?>
<?php include("./includes/navbar.php");?>


<main>
    <!--Section: Block Content-->
<section class="m-5 px-5">
	<div class="row">
		<div class="col-md-6 mb-4 ">	
			<img src="https://dummyimage.com/600x400/000/fff"  alt="product_img"/>
		</div>

		<div class="col-md-6">

			<h5>商品名</h5>
			<p class="mb-2 text-muted small">商品カテゴリー</p>
			<ul class="list-group list-group-horizontal " style="list-style: none;">
			<li>
				<i class="fa fa-star fa-sm text-primary"></i>
			</li>
			<li>
				<i class="fa fa-star fa-sm text-primary"></i>
			</li>
			<li>
				<i class="fa fa-star fa-sm text-primary"></i>
			</li>
			<li>
				<i class="fa fa-star fa-sm text-primary"></i>
			</li>
			<li>
				<i class="fa fa-star fa-sm text-primary"></i>
			</li>
			</ul>
			<p><span class="mr-1"><strong>￥1299</strong></span></p>
			<div class="table-responsive">
			<table class="table table-sm table-borderless ">
				<tbody>
				<tr>
					<th class="pl-0 w-25" scope="row"><strong>品番</strong></th>
					<td>Shirt 5407X</td>
				</tr>
				<tr>
					<th class="pl-0 w-25" scope="row"><strong>サイズ</strong></th>
					<td>S　M　L</td>
				</tr>
				</tbody>
			</table>
			</div>
			<hr>
			<div class="table-responsive mb-2">
			<table class="table table-sm table-borderless ">
				<tbody>
				<tr>
					<td class="pl-0 pb-0 w-25">数量</td>
					<td class="pb-0">サイズ</td>
				</tr>
				<tr>
					<td class="pl-0">
					<select class="form-select form-select-sm" aria-label=".form-select-sm" name="quantity">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
					</td>
					<td>
					<div class="mt-1">
						<div class="form-check form-check-inline pl-0">
						<input type="radio" class="form-check-input" id="small" name="size_s"
							checked>
						<label class="form-check-label small text-uppercase"
							for="small">S</label>
						</div>
						<div class="form-check form-check-inline pl-0">
						<input type="radio" class="form-check-input" id="medium" name="size_m">
						<label class="form-check-label small text-uppercase"
							for="medium">M</label>
						</div>
						<div class="form-check form-check-inline pl-0">
						<input type="radio" class="form-check-input" id="large" name="size_l">
						<label class="form-check-label small text-uppercase"
							for="large">L</label>
						</div>
					</div>
					</td>
				</tr>
				</tbody>
			</table>
			</div>
			<button type="button" class="btn btn-primary btn-md mr-1 mb-2">今すぐ買う</button>
			<button type="button" class="btn btn-light btn-md mr-1 mb-2"><i
				class="fa fa-shopping-cart pr-2"></i>カートに入れる</button>
		</div>
	</div>
	<div class="row">
		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">商品の説明</a>
				<a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">商品の情報</a>
			</div>
		</nav>
	<div class="tab-content" id="nav-tabContent">
		<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
			<div class="p-5">
				商品説明Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam, sapiente illo. Sit error voluptas repellat rerum quidem, soluta enim perferendis voluptates laboriosam. Distinctio, officia quis dolore quos sapiente tempore alias.
			</div>
		</div>
		<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
			<div class="p-5">
				商品情報Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam, sapiente illo. Sit error voluptas repellat rerum quidem, soluta enim perferendis voluptates laboriosam. Distinctio, officia quis dolore quos sapiente tempore alias.
			</div>
		</div>
	</div>	
</section>
<!--Section: Block Content-->




</main>



<?php include("./includes/footer.php");?>
<?php include("./includes/script.php");?>