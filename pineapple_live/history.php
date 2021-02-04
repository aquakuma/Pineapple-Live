<?php include("./includes/header.php");?>
<style>
td.centered_text{
    text-align:center; 
    vertical-align: middle;
 }
</style>
<?php include("./includes/navbar.php");?>

<main class="mx-5 px-5">
<h4>購入履歴</h4>

<table class="table my-5 px-5">
  <thead>
    <tr class="text-center ">
        <th scope="col" colspan="2">商品</th>
        <th scope="col">単価</th>
        <th scope="col">数量</th>  
    </tr>
    <tr class="table-secondary text-left">
        <th scope="col" colspan="3">
            <div class="row">
                <div class="col-4">注文日時：２０２０年１１月１３日　１５：１８</div>
                <div class="col-4">注文番号：１２３４５６７</div>
                <div class="col-4">販売者：ファッション１０１</div>
            </div>
        </th>
        <th scope="col"><button type="button" class="btn btn-link float-right">注文の詳細</button></th>
    </tr>
    
  </thead>
  <tbody>
    <tr>
        <td ><img src="https://dummyimage.com/300x200/000/fff" alt="product_img"></td>
        <td class="centered_text">ウールブレザー</td>
        <td class="centered_text">￥１４９９０</td>
        <td class="centered_text">１</td>
    </tr>
    <tr>
        <td><img src="https://dummyimage.com/300x200/000/fff" alt="product_img"></td>
        <td class="centered_text">ウールブレザー</td>
        <td class="centered_text">￥１４９９０</td>
        <td class="centered_text">１</td>
    </tr>
    <tr class="table-secondary text-right">
        <td scope="col" colspan="4">
            <div class="row">
                 <div class="col-8">操作：キャンセル</div> <!-- do we still need this? -->
                <div class="col-2">注文状況：受注済み</div>
                <div class="col-2">合計金額：￥２９９８０</div>
            </div>
        </td>
    </tr>
  </tbody>
</table>


<table class="table my-3 px-5">
  <thead>
    <tr class="text-center ">
        <th scope="col" colspan="2">商品</th>
        <th scope="col">単価</th>
        <th scope="col">数量</th>  
    </tr>
    <tr class="table-secondary text-left">
        <th scope="col" colspan="3">
            <div class="row">
                <div class="col-4">注文日時：２０２０年１１月１３日　１５：１８</div>
                <div class="col-4">注文番号：１２３４５６７</div>
                <div class="col-4">販売者：ファッション１０１</div>
            </div>
        </th>
        <th scope="col"><button type="button" class="btn btn-link float-right">注文の詳細</button></th>
    </tr>
    
  </thead>
  <tbody>
    <tr>
        <td ><img src="https://dummyimage.com/300x200/000/fff" alt="product_img"></td>
        <td class="centered_text">ウールブレザー</td>
        <td class="centered_text">￥１４９９０</td>
        <td class="centered_text">１</td>
    </tr>
    <tr>
        <td><img src="https://dummyimage.com/300x200/000/fff" alt="product_img"></td>
        <td class="centered_text">ウールブレザー</td>
        <td class="centered_text">￥１４９９０</td>
        <td class="centered_text">１</td>
    </tr>
    <tr class="table-secondary text-right">
        <td scope="col" colspan="4">
            <div class="row">
                 <div class="col-8">操作：キャンセル</div> <!-- do we still need this? -->
                <div class="col-2">注文状況：受注済み</div>
                <div class="col-2">合計金額：￥２９９８０</div>
            </div>
        </td>
    </tr>
  </tbody>
</table>

<div class="row my-4">
    <div>
    <a href="mypage.php" class="btn btn-secondary float-right mr-4">戻る</a>
    </div>
</div>

</main>

<!-- 注文日時：２０２０年１１月１３日　１５：１８</td>
      <td>注文番号：１２３４５６７</td>
      <td>販売者：ファッション１０１</td> 
       <td><button type="button" class="btn btn-link">注文の詳細</button></td>
      -->

<?php include("./includes/footer.php");?>
<?php include("./includes/script.php");?>