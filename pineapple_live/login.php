<?php
session_start();
$error_mesage = "";
if(isset($_SESSION['error'])){
    $error_mesage = $_SESSION['error'];
    $_SESSION['error'] = "";
}
if(isset($_SESSION['user_id'])){
    header("Location:index.php");
    exit;
}
if(isset($_SERVER['HTTP_REFERER'])){
    $page = $_SERVER['HTTP_REFERER'];
}
else{
    $page = "mypage";
}

?>


<!doctype html>
<html lang="jp">
  <head>
    <meta charset="utf-8">
    <title>ログイン</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>
  


  <body class="text-center">
    <form action="check.php" name="register" class="form-signin" method="post">
    <a href="index.php"><img class="mb-4" src="files/pineapple_logo.png" alt="logo" width="250" height="140"></a>
    
    <input type="email" name="email" id="email" class="form-control" placeholder="メールアドレス" required autofocus>

    <input type="password" name="password" id="password" class="form-control" placeholder="パスワード" required>
    
    <?php echo '<p class="text-danger" >'.$error_mesage.'</p>';?>
    
    <input type='hidden' value='<?php echo $page?>' name='page'>

    <button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
    <a href="register" class="btn btn-secondary btn-lg btn-block" type="">新規登録</a>
    <p class="mt-5 mb-3 text-muted">&copy; Pineapple　2020</p>
</form>
</body>
</html>
