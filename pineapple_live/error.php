<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
       <?php
            session_start();
            include("../db/pineapple.php");
            echo  $_SESSION['error'].'<br>';
            echo  $_POST['buy_size'].'<br>';
            echo  $_POST['buy_num'].'<br>';
            $_SESSION['error'] = "";
       ?>

    </body>
</html>