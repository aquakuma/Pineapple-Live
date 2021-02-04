<?php
session_start();
include("../db/pineapple.php");
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    header("Location: login.php");
}
if(isset($_POST['live_id'])){
    $_SESSION['live_id']=$_POST['live_id'];
}

if(isset($_SESSION['live_id'])){
    $live_id = $_SESSION['live_id'];
}


$error="";
if(isset($_SESSION['error'])){
    $error=$_SESSION['error'];
    $_SESSION['error']="";
}

$dsn = "mysql:host = 127.0.0.1;dbname=hew2_pineapple;charset=utf8mb4";
$db_user = "root";
$db_password = "";
$pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
$pdo->setAttribute(
PDO::ATTR_ERRMODE,          
PDO::ERRMODE_EXCEPTION);    

$sql = "SELECT user_id FROM live WHERE live_id = '$live_id'";
$dbh = $pdo->query($sql);
while($record = $dbh->fetch(PDO::FETCH_ASSOC)){
    $vtuber_id=$record["user_id"];
}

if($user_id!=$vtuber_id){
    header("Location:". $_SERVER['HTTP_REFERER']);
    exit;
}

?>


<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Add prodcut</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/offcanvas/">

    <!-- Bootstrap core CSS -->
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template  -->
    <link href="css/offcanvas.css" rel="stylesheet">   <!--  bootstrap offcanvas -->
    <link href="css/live_product.css" rel="stylesheet"> <!--  product -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!--  icon -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>
<body>

<div class="row justify-content-center">
    <h5 class="text-danger"><?php echo $error;?></h5>
</div>
<div class="row justify-content-center">
    <div class="col-auto">
        <form action="uploader.php" name="register"  method = "post">
            <input  type='hidden' value='edit_live_product' name='upload_mode'>
            <input  type='hidden' value='<?php echo $live_id?>' name='live_id'>
            <ul class="list-group">
                <li class="list-group-item list-group-item-action active">商品リンクを入力してください</li>
                <li class="list-group-item"><i class="fa fa-link mr-3"></i><input type="text" name="product[]" size="60"></li>
                <li class="list-group-item"><i class="fa fa-link mr-3"></i><input type="text" name="product[]" size="60"></li>
                <li class="list-group-item"><i class="fa fa-link mr-3"></i><input type="text" name="product[]" size="60"></li>
                <li class="list-group-item"><i class="fa fa-link mr-3"></i><input type="text" name="product[]" size="60"></li>
                <li class="list-group-item"><i class="fa fa-link mr-3"></i><input type="text" name="product[]" size="60"></li>
                <li class="list-group-item"><i class="fa fa-link mr-3"></i><input type="text" name="product[]" size="60"></li>
                <li class="list-group-item"><i class="fa fa-link mr-3"></i><input type="text" name="product[]" size="60"></li>
                <li class="list-group-item"><i class="fa fa-link mr-3"></i><input type="text" name="product[]" size="60"></li>
            </ul>

            
        <div class="row my-3 justify-content-end">
            <div class="col-auto">
                <input type = "submit" class="btn btn-primary ml-2 pull-right" value ="確認">
                <a href="<?php echo 'live.php?live_id='.$live_id?>"><button class="btn btn-secondary hBack pull-right" type="button">戻る</button></a>
            </div>
        </div>
        </form>
    </div>
</div>




</body>
</html>