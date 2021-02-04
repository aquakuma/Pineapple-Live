
<!DOCTYPE html>
<html>

<?php include("./includes/header.php");?>
<!-- <link href="#" rel="stylesheet"> ここで自分のCSSを入れる -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<title>購入 | pineapple</title>
<?php include("./includes/navbar.php");?>



<main>
    <div class="container">
    <div class="mb-5 text-center">
    <h2><br>情報入力</h2>
    </div>

    <div class="row">
    
        <div class="col-md-4 order-md-2 mb-4">
        <h4 class="mb-3">カートの中身</h4>
        <ul class="list-group mb-3">
            <?php foreach ($product_name_list as $key => $value) {?>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
                <h6 class="my-0"><?php echo $product_name_list[$key]?></h6>
                <small class="text-muted">￥<?php echo $product_price_list[$key]?>
                <br>個数:<?php echo $product_num_list[$key]?></small>
                
            </div>
            <span class="text-muted">￥<?php echo $product_totally_list[$key]?></span>
            </li>
            <?php } ?>
            <li class="list-group-item d-flex justify-content-between">
            <span>合計金額(JPY)</span>
            <strong>￥<?php echo $sum?></strong>
            </li>
        </ul>
        <form class="needs-validation" action='<?php echo "buy_confirmation?mode=".$_GET['mode']?>' method="post">
        <button  data-action ="buy_confirmation" class="btn btn-primary btn-lg btn-block">決済</button>
        <button class="btn btn-secondary btn-lg btn-block" onclick="history.back()">戻る</button>
        </div>
        <div class="col-md-8 order-md-1 mb-4">
        <h4 class="mb-3">請求先住所</h4>
        

            <input  type='hidden' value='<?php echo $_GET['mode']?>' name='mode'>

            <input  type='hidden' value='<?php echo $product_id?>' name='product_id'>
            <input  type='hidden' value='<?php echo $product_buy_num?>' name='product_buy_num'>
            <input  type='hidden' value='<?php echo $product_buy_size?>' name='product_buy_size'>
            <input  type='hidden' value='<?php echo $product_price?>' name='product_price'>
            <input  type='hidden' value='<?php echo $product_name?>' name='product_name'>
            <input  type='hidden' value='<?php echo $sum?>' name='sum'>


            <div class="row">
                
            <div class="col-md-6 mb-3">
                <label for="firstName">苗字</label>
                <input name='family_name' type="text" class="form-control" id="firstName" value ="<?php echo $family_name ?>" placeholder="山田" required >
                <div class="invalid-feedback">
                苗字を入力してください！
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="lastName">名前</label>
                <input name='first_name' type="text" class="form-control" id="lastName" value ="<?php echo $first_name ?>" placeholder="太郎" required >
                <div class="invalid-feedback">
                名前を入力してください！
                </div>
            </div>
            </div>

            <div class="mb-3">
            <label for="email">メールアドレス Email <span class="text-muted"></span></label>
            <input name='email' type="email" class="form-control" value ="<?php echo $email ?>" id="email" placeholder="you@example.com" required>
            <div class="invalid-feedback">
                メールアドレスを入力してください
            </div>
            </div>

            <div class="mb-3">
            <label for="address">住所</label>
            <input name='address' type="text" class="form-control" value ="<?php echo $address ?>" id="address" placeholder="○○県○○○市○○町1-2-3-4"  required >
            <div class="invalid-feedback">
                住所を入力してください
            </div>
            </div>



            <hr class="mb-4">
            <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="same-address">
            <label class="custom-control-label" for="same-address">請求先住所が送り先と同じである</label>
            </div>
            <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="save-info">
            <label class="custom-control-label" for="save-info">
                次回のためにこの情報を保存します</label>
            </div>
            <hr class="mb-4">

            <h4 class="mb-3">Payment</h4>

            <div class="d-block my-3">
            <div class="custom-control custom-radio">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                <label class="custom-control-label" for="credit">クレジットカード・Credit card</label>
            </div>
            <div class="custom-control custom-radio">
                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="debit">デビットカード・Debit card</label>
            </div>
            <div class="custom-control custom-radio">
                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="paypal">PayPal</label>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6 mb-3">
                <label for="cc-name">カード名義</label>
                <input type="text" class="form-control" id="cc-name" placeholder="○○○○" >
                <small class="text-muted">カードに表示されているフルネームを記載してください</small>

            </div>
            <div class="col-md-6 mb-3">
                <label for="cc-number">カード番号</label>
                <input type="text" class="form-control" id="cc-number" placeholder="xxxx-xxxx-xxxx" >

            </div>
            </div>
            <div class="row">
            <div class="col-md-3 mb-3">
                <label for="cc-expiration">カード期限</label>
                <input type="text" class="form-control" id="cc-expiration" placeholder="" >

            </div>
            <div class="col-md-3 mb-3">
                <label for="cc-cvv">CVV</label>
                <input type="text" class="form-control" id="cc-cvv" placeholder="" >

            </div>
            </div>

            <h2><?php echo $error?></h2>
            <hr class="mb-4">

            





        </form>
        </div>
    </div>

</main>








<?php include("./includes/footer.php");?>
<script>//ここで自分のJSを書く</script>
<?php include("./includes/script.php");?>

</html>