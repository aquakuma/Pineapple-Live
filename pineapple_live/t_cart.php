<?php include("./includes/header.php");?>
<?php include("./includes/navbar.php");?>
​
​
​
<main class="mx-5 my-3 px-5">
    <h4 class="my-4">ショッピングカート</h4>
    <div class="row mb-3">
        <div class="col-6">
            <a href="main_product" class="btn btn-link float-left">お買い物に戻る</a>　
            <a href="cart_empty.php?mode=cart" class="btn btn-link float-left">カートを空にする</a>
        </div>
        <div class="col-6">
            <form action="buy.php?mode=cart"  method="post" enctype="multipart/form-data" class="float-right">
            <?php
                foreach ($cart as $r) {
                    $product_price = $r['product_price'];
                    $quantity = $r['quantity'];
                    $totally = $r['totally'];
                    $product_name = $r['product_name'];
                    $size = $r['size'];
                    echo "<input type='hidden' value='$product_price' name='product_price[]'>";
                    echo "<input type='hidden' value='$quantity' name='quantity[]'>";
                    echo "<input type='hidden' value='$totally' name='totally[]'>";
                    echo "<input type='hidden' value='$size' name='size[]'>";
                    if($size == " "){
                        echo "<input type='hidden' value='$product_name' name='product_name[]'>";
                    }
                    else{
                        //$product_name .='('.$size.')';
                        echo "<input type='hidden' value='$product_name' name='product_name[]'>";
                    }
                    
                }
            ?>
                
                <input  type='hidden' value="<?php echo $sum ?>" name='sum'>
                <input type="submit" class="btn btn-primary" value="購入する">
            </form>
        </div>
    </div>
​
    <table class="table">
​
    <thead>
        <tr>
        <th scope="col">商品名</th>
        <th scope="col">単価</th>
        <th scope="col">数量</th>
        <th scope="col">小計</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            if(!empty($cart)){
                foreach ($cart as $r) { ?>
        <tr>
        <td><a href="product_detail.php?product_id=<?php echo $r['product_id'] ?>"><?php echo $r['product_name'] ?></td>
        <td>￥<?php echo $r['product_price'] ?></td>
        <td><?php echo $r['quantity'] ?></td>
        <td>￥<?php echo $r['totally']?></td>
        </tr>
        <?php 
                }
            } ?>
        <tfoot>
        <td colspan='2'></td>
        <td class="text-end"><strong>合計:</strong></td>
        <td>￥<?php echo $sum ?> </td>
        </tfoot>
    </tbody>
    </table>
</main>
​
​
​
<?php include("./includes/footer.php");?>
<?php include("./includes/script.php");?>
