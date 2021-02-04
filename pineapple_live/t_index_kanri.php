<?php include("./includes/header.php");?>
<style>
    #table img{
        width: 200px;
        height: 150px;
        object-fit: cover; 
    }
</style>
<?php include("./includes/navbar.php");?>
<!-- t_index_kanri.php -->
<main class="my-3 mx-5">
<div class="row">
  <div class="mt-3 ">
    <h4 class="float-left">商品管理</h4>
    <a href="product_upload.php" class="btn btn-primary float-right">新規追加</a>　
  </div>
</div>
<hr>

<div class="table-responsive" id="table">
   <table class="table text-center">
    <thead>
      <tr>
          <th scope="col" >商品画像</th>
          <th scope="col" width=200 >商品名</th>
          <th scope="col" >単価</th>
          <th scope="col" >カテゴリー</th>
          <th scope="col" style="width: 300px;">商品説明</th>
          <th scope="col" >メーカー</th>
          <th scope="col" >品番</th>  
          <th scope="col" >サイズ</th>
          <th scope="col" >在庫数</th>
          <th scope="col" >操作</th>

      </tr>
    </thead>
    <tbody>
      <?php foreach ($goods as $g) {
              if (!isset($g['delete_date'])) { ?>
      <tr>
          <td><?php echo img_tag($g['image_id']) ?></td>
          <td>
            <?php
              $link = "product_detail?product_id=".$g['product_id'];
              echo "<a href='$link' class='btn btn-link'>".$g['product_name'] ."</a>"?>
          </td>
          <td><?php echo "￥".number_format($g['product_price']); ?></td>
          <td ><?php echo $g['category_name']; ?></td>
          <td class="text-left"><?php echo nl2br($g['product_description']); ?></td>
          <td><?php echo $g['product_maker']; ?></td>
          <td><?php echo $g['product_number']; ?></td>
          <td>
            <?php //サイズ 表示
              $size_print = "";
              foreach($size as $s){
                  if($s['product_id'] == $g['product_id']){
                      $size_print .= $s['product_size']." ";
                  }
              }
              echo $size_print; ?></td>
          <td>
          <?php //在庫 表示
            $inventory_print = "";
            foreach($size as $s){
                if($s['product_id'] == $g['product_id']){
                  $product_inventory = $s['product_inventory'];
                  if($s['product_size'] == " "){
                    $inventory_print .= $product_inventory."  ";    
                  }
                  else{
                    $inventory_print .= $s['product_size']."(".$product_inventory.")"."  ";    
                  }

                }
            }
            echo $inventory_print;
            ?>
          </td>
          <td class="text-center">
            <a href="edit.php?product_id=<?php echo $g['product_id'] ?>" class="btn btn-link">修正</a><br>
            <a href="delete.php?product_id=<?php echo $g['product_id'] ?>" class="btn btn-link" onclick="return confirm('削除してよろしいですか？')">削除</a><br>
            <a href="upload.php?product_id=<?php echo $g['product_id'] ?>" class="btn btn-link">画像変更</a>
        </td>
      </tr>
      <?php }
        } ?>
    </tbody>
  </table>
</div>

<div class="row">
  <div>
    <a href="mypage" class="btn btn-secondary float-right">戻る</a>
  </div>
</div>

</main>


<?php include("./includes/footer.php");?>
<?php include("./includes/script.php");?>