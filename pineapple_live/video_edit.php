<?php include("./includes/login_check.php");?>
<?php include("video_edit_process.php");?>
<?php include("./includes/header.php");?>
<?php include("./includes/navbar.php");?>


<main class="mx-5 my-3 px-5 pb-3">
    <h4 class="my-2">動画修正</h4>
    <h6 class="my-2"><?php echo $error?></h6>  
    <form action="uploader" method="post" enctype="multipart/form-data">
        <!--upload_mode値とメンバー情報をuploaderに渡す-->
        <input  type='hidden' value='video_edit' name='upload_mode'>
        <input  type='hidden' value='<?php echo $_SESSION["user_id"]?>' name='user_id'>
        <input  type='hidden' value='<?php echo $_GET["video_id"]?>' name='video_id'>

        <table class="table table-bordered align-middle">
            <thead>
                <tr class="table-secondary"><th colspan="2"></th></tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">タイトル</th>
                <td> <input type="text" name="title" size="40" value = "<?php echo $video_title;?>"></td>
                </tr>

                <tr>
                <th scope="row">動画ファイル <small class="text-danger">(最大50MB)</small></th>
                <td><input type="file" name="video_file" accept="video/*"></td>
                </tr>

                <tr>
                <th scope="row">関連商品</th>
                <td>
                    <select name="product" id="product">
                        <option value="" selected disabled>選択ください</option>
                        <!--商品名　動的追加-->
                    <?php
                        foreach($products as $good){
                            $val = $good['product_id'];
                            $product_name = $good['product_name'];
                            $user_name = $good['user_name'];
                            if($val == $product_id){
                                echo "<option selected value='$val'>$product_name($user_name)</option>";
                            }
                            else{
                                echo "<option value='$val'>$product_name($user_name)</option>";
                            }
                        }
                    ?>
                    </select>
                </td>
                </tr>
                <tr>
                <th scope="row">サムネイル</th>
                <td><input type="file" name="thumbnail_file" accept="image/*"></td>
                </tr>

                <tr>
                <th scope="row">動画説明</th>
                <td><textarea name="description" rows="4" cols="40" placeholder="ここに説明を記入してください。"><?php echo $description;?></textarea></td>
                </tr>
            </tbody>
        </table>

        <div class="row my-4">
            <div>
            <input type="submit" value="送信" class="btn btn-primary float-right">
            <button onclick="location.href='video_admin'" class="btn btn-secondary float-right mr-4">戻る</button>
            </div>
        </div>
    </form>
    
</main>


<?php include("./includes/footer.php");?>
<?php include("./includes/script.php");?>
