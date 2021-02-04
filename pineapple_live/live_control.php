<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location: login.php");
}
$print = "";
$live_key = "";
if (isset($_SESSION['Live_key'])) {
    $live_key = $_SESSION['Live_key'];

    $print = "<h2>ストリームキー</h2>
    <h3 style = 'color = blue;'>$live_key</h3>";
}
?>



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>Video.js Sample</title>
    <link href="./css/video-js.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <script src="./js/video.min.js"></script>
    <script src="./js/videojs-contrib-media-sources.min.js"></script>
    <script src="./js/videojs-contrib-hls.min.js"></script>
    <script src="./js/jquery-2.1.4.min.js"></script>
    <script src="./js/main.js"></script>

    <link href="https://vjs.zencdn.net/7.4.1/video-js.min.css" rel="stylesheet">
    <script src="https://vjs.zencdn.net/7.4.1/video.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/videojs-flash@2/dist/videojs-flash.min.js"></script>



</head>

<body>

    <form action="create_live_key.php" name="register" method="post">
        <div class="info_input">

            <table border="1">

                <tr>
                    <td class="input_style">配信タイトル　　<span class="input_hissu">必須</span> </td>
                    <td><input type="text" name="title" size="40" required></td>
                </tr>

            </table>

        </div>
        <div class="sent">
            <?php echo $print; ?>
            <input type="submit" value="送信">
        </div>

    </form>
    <a href="main.php">main</a>

</body>

</html>