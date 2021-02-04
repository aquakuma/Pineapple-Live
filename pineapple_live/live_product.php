<div class="row ml-1 my-3">
    <div class="row ">
        <h3 class="col-6 mt-3 pl-2 pt-1 ">商品一覧</h3>
        <?php
            $add_products="";
            $get_product="SELECT * From live_products l JOIN products p on l.product_id = p.product_id WHERE l.live_id = $live_id AND p.delete_date IS NULL";
            $run_get_products = $pdo->query($get_product);
            $count = $run_get_products->rowCount();
            if($count> 0){
                echo"
                <form action='edit_live_product.php' method='POST' class='col-6 pb-2' >
                    <input type='hidden' value='$live_id' name='live_id'>";
                    if($user_id==$vtuber_id){
                        echo"<input type = 'submit' class='btn btn-link float-right mt-4' value='ライブ商品を編集する' style='margin-right:-30px;'>
                        </form>";
                    }
            ?>
    </div>
    <div class="item pl-2">
        <ul id="content-slider" class="content-slider">
        <?php
			foreach($run_get_products as $row){
		?>    
            <li>
            <div class="item border rounded" style="width:310px">
                <div class="box text-center">
                    <img src='<?php echo $row["image_id"]?>' class="rounded mt-4" alt="" style="width:260px;">
                    <div class="row mx-1">
                        <div class="mx-2 pt-2" >
                            <h5 class="text-left">
                                <a href="product_detail.php?product_id=<?php echo $row["product_id"];?>" class="text-dark"><?php echo $row["product_name"];?></a>
                            </h5>
                            <h6 class="text-left text-dark">￥<?php echo number_format($row["product_price"]);?></h6>
                        </div>
                        
                        <div class="col-12 mt-2 border-top" >

                        <p class="btn-details float-right mt-3 col-12">
                            <i class="fa fa-shopping-bag  mb-1"></i><small><a href='<?php echo "product_detail?product_id=".$row["product_id"]?>' class="hidden-sm"> 今すぐ買う</a></small></p>
                        </div>
                    </div>
                    
                </div> 
            </div>
            </li>
            <?php
			}
		}else{
			echo"<div class='col-md-12 mb-3'>
			<h5 class='ml-4'>登録しているライブ商品がありません。</h5>";
			if($user_id==$vtuber_id){
				$add_products="
					<form action='edit_live_product.php'' method='POST' class='float-left' style='margin-top: -38px; margin-left:250px;'>
						<input type='hidden' value='$live_id' name='live_id'>
						<input type='submit' class='btn btn-link ml-3 pt-3' value='ライブ商品を添加する'>
					</form>
				</div>";
				echo $add_products;
			}	
		}
			?>	    
        </ul>
    </div>
</div>


