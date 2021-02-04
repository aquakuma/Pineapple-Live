<?php
    include("./includes/login_check.php");
    include("./video_admin process.php");
    include("./includes/header.php");
?>
<style>
    img{
        width:250px;
        height:auto;
    }
</style>
<?php include("./includes/navbar.php");?>
​
​
<main class="mx-5 my-3 px-5">
    <h4 class="my-4">動画一覧</h4>
    <div class="row mb-3">
        <div class="col-6"></div>
        <div class="col-6">
            <a href="video_upload" class="btn btn-primary float-right">動画をアップロッド</a>
        </div>
    </div>
​
    <table class="table">
    <thead>
        <tr>
        <th scope="col">サムネイル</th>
        <th scope="col">タイトル</th>
        <th scope="col">関連商品</th>
        <th scope="col">再生数</th>
        <th scope="col">説明</th>
        <th scope="col">操作</th>
        </tr>
    </thead>
    <tbody>
        <!--動的生成-->
        <?php
            foreach($videos as $v){
                $video_id = $v['video_id'];
                $thumbnail = $v['thumbnail'];
                $video_title = $v['video_title'];
                $product_id = $v['product_id'];
                $product_name = $v['product_name'];
                $views = $v['views'];
                $description = nl2br($v['description']);

                $row = "<tr>
                <td><img src='$thumbnail' alt=''></td>
                <td><a href='video?video_id=$video_id'>$video_title</a></td>
                <td><a href='product_detail?product_id=$product_id'>$product_name</a></td>
                <td>$views</td>
                <td>$description</td>
                <td><a href='video_edit?video_id=$video_id'>修正</a>
                    <a href='video_delete?video_id=$video_id'>削除</a>
                </td>
                </tr>";
                echo $row;
            }
        ?>
    </tbody>
    </table>
​
    <div class="row my-4">
        <div>
            <a href="mypage" class="btn btn-secondary float-right">戻る</a>
        </div>
    </div>
</main>
​
​
<?php include("./includes/footer.php");?>
<?php include("./includes/script.php");?>