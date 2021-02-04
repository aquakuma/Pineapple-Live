<?php include("./includes/header.php");?>
<link href="./css/bootstrap.min.css" rel="stylesheet">
<link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/checkout/">
<?php include("./includes/navbar.php");?>
<main>
    <div class="container">
    </div>
    <div class="container">
        <div class="row">
            <div class="conrtainer left">            
                <div class="col-xs-10 col-xs-offset-1" style="margin-top:30px; margin-bottom:30px;">

                    <table class="table" style="table-layout:fixed;">
                    <thead>
                        <th class="table-light"><h3>お客様情報確認</h3></th>
                        <th class="table-light"></th>
                    </thead>

                        <tbody>
                            <tr>
                                <td>お名前 :</td>
                                <td><?php echo $family_name."  ".$first_name?></td>
                            </tr>
                            <tr>
                                <td>メールアドレス:</td>
                                <td><?php echo $email?></td>
                            </tr>
                            <tr>
                                <td>住所:</td> 
                                <td><?php echo $address?></td>
                            </tr>

                            <tr>
                              <td>価格（消費税込み）:</td>
                              <td><?php echo "￥".$sum?></td>
                          </tr>
                        </tbody>
                    </table>
                    <form action="buy_process" method="Post">


                        <input  type='hidden' value='<?php echo $_GET['mode']?>' name='mode'>
                        <input  type='hidden' value='<?php echo $product_id?>' name='product_id'>
                        <input  type='hidden' value='<?php echo $product_buy_num?>' name='product_buy_num'>
                        <input  type='hidden' value='<?php echo $product_buy_size?>' name='product_buy_size'>
                        <input  type='hidden' value='<?php echo $product_price?>' name='product_price'>
                        <input  type='hidden' value='<?php echo $product_name?>' name='product_name'>
                        <input  type='hidden' value='<?php echo $sum?>' name='sum'>

                        <div class="row">
                            <div class="col-6"></div>
                            <div class="col-6 d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary mr-4" onclick="history.back()">戻る</button>
                                <button type="submit" class="btn btn-primary">注文</button>
                            </div>
                        </div>
                    </form>
                    
        

                </div>
              </div>  
          </div>
        </div>
    </div>
</main>
<?php include("./includes/footer.php");?>
<?php include("./includes/script.php");?>