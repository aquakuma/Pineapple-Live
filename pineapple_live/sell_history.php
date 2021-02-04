<?php session_start();?>

<?php include("./sell_history_process.php");?>




<?php include("./includes/header.php");?>
<style>
td.centered_text{
    text-align:center; 
    vertical-align: middle;
 }
#order img{
    width: 200px;
    height: 150px;
    object-fit: cover; 
}
</style>
<title>販売履歴</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php include("./includes/navbar.php");?>

<main class="mx-5 px-5">
<h4>販売履歴</h4>
<div id = 'order'>

</div>




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