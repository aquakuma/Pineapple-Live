<?php
session_start();
include("../db/pineapple.php");
$User_id = "";
if(isset($_SESSION['user_id'])){
    //$User_id = $_SESSION['User_id'];
}
else{
	//header("Location: login.php");
}

$outputValue = "";
if($_GET['mode'] == "0"){
	$user_name = htmlspecialchars($_GET['user_name'], ENT_QUOTES, "utf-8");
	$message = htmlspecialchars($_GET['message'], ENT_QUOTES, "utf-8");
	$user_id = htmlspecialchars($_GET['user_id'], ENT_QUOTES, "utf-8");
	$live_id = htmlspecialchars($_GET['live_id'], ENT_QUOTES, "utf-8");





	//DB
	$dsn = "mysql:host = localhost;dbname=hew2_pineapple;charset=utf8mb4";
	//※data source name
	//127.0.0.1=localhost

	$db_user = "root"; //既定の管理ユーザ
	$db_password = "";


	//DB操作用オブジェクトの作成

	$pdo = new PDO(DSN, DB_USER, DB_PASSWORD);

	//PDOの設定変更（エラー黙殺→例外発生）
	$pdo->setAttribute(
		PDO::ATTR_ERRMODE,          //3
		PDO::ERRMODE_EXCEPTION);    //2


	$msg = '"'.$message.'"';
	$date = "now()";

	$sql = "select @insert_chat_num := count(*)+1 from chat where live_id = $live_id;
			INSERT INTO chat (live_id,chat_number,user_id,chat_content,chat_datetime) VALUES ($live_id,@insert_chat_num,$user_id,$msg,$date);";
	$pdo->exec($sql);

	$pdo = new PDO(DSN, DB_USER, DB_PASSWORD);

	//PDOの設定変更（エラー黙殺→例外発生）
	$pdo->setAttribute(
		PDO::ATTR_ERRMODE,          //3
		PDO::ERRMODE_EXCEPTION);    //2
	$sql = "select u.user_name,u.user_icon,c.chat_content,CAST(c.chat_datetime AS time) as date from chat c join user u on c.user_id = u.user_id where c.chat_datetime > current_timestamp - interval 3 HOUR and live_id = $live_id order by c.chat_datetime desc LIMIT 100";
	//SQL実行
	$dbh = $pdo->query($sql);
	$index = 0;
	$id = [];
	$mess = [];
	$time = [];	
	$icon=[];
	while($record = $dbh->fetch(PDO::FETCH_ASSOC)){
		//インスタンスのみ→PDO::FETCH_NUM
		//連想配列のみ→PDO::FETCH_ASSOC
		//両方→PDO::FETCH_BOTH（メモリの無駄）
		//print_r($record);
		$id[$index] = $record["user_name"];
		$mess[$index] = $record["chat_content"];
		$time[$index] = $record['date'];
		if(!$record['user_icon']){
			$icon[$index] = "./files/member/icon/0.png";
		}
		else{
			$icon[$index]=$record['user_icon'];
		}
		$index++;
	}




	// ファイルからデータを読み込み
	// if(!$fp = fopen($testFile, "r")){
	// 	echo "could not open";
	// 	exit;
	// }
	// $outputValue = fread($fp, filesize($testFile));
	// echo $outputValue;
	// fclose($fp);
	for($i = $index-1; $i>=0; $i--){
		$outputValue .='
		<li class="left clearfix"><span class="chat-img pull-left">
			<img src='.$icon[$i].' alt="User Avatar" class="img-circle" width="50" height="50"/>
		</span>
			<div class="chat-body clearfix">
				<div class="header">
					<strong class="primary-font">'.$id[$i].'</strong> <small class="pull-right text-muted">
						<span class="glyphicon glyphicon-time"></span>'.$time[$i].'</small>
				</div>
				<p>'.$mess[$i].'</p>
			</div>
		</li>'
		;
	}


	echo $outputValue;

}
else{

	$live_id = htmlspecialchars($_GET['live_id'], ENT_QUOTES, "utf-8");
	//DB
	$dsn = "mysql:host = 127.0.0.1;dbname=hew2_pineapple;charset=utf8mb4";
	//※data source name
	//127.0.0.1=localhost

	$db_user = "root"; //既定の管理ユーザ
	$db_password = "";


	//DB操作用オブジェクトの作成

	$pdo = new PDO(DSN, DB_USER, DB_PASSWORD);

	//PDOの設定変更（エラー黙殺→例外発生）
	$pdo->setAttribute(
		PDO::ATTR_ERRMODE,          //3
		PDO::ERRMODE_EXCEPTION);    //2


	$sql = "select u.user_name,u.user_icon,c.chat_content,CAST(c.chat_datetime AS time) as date from chat c join user u on c.user_id = u.user_id where c.chat_datetime > current_timestamp - interval 3 HOUR and live_id = $live_id order by c.chat_datetime desc LIMIT 100";
	
	//SQL実行
	$dbh = $pdo->query($sql);
	$index = 0;
	$id = [];
	$mess = [];
	$time = [];
	$icon=[];
	while($record = $dbh->fetch(PDO::FETCH_ASSOC)){
		//インスタンスのみ→PDO::FETCH_NUM
		//連想配列のみ→PDO::FETCH_ASSOC
		//両方→PDO::FETCH_BOTH（メモリの無駄）
		//print_r($record);
		$id[$index] = $record["user_name"];
		$mess[$index] = $record["chat_content"];
		$time[$index] = $record['date'];
		if(!$record['user_icon']){
			$icon[$index] = "./files/member/icon/0.png";
		}
		else{
			$icon[$index]=$record['user_icon'];
		}
		$index++;
	}

	for($i = $index-1; $i>=0; $i--){
		$outputValue .='
		<li class="left clearfix"><span class="chat-img pull-left">
			<img src='.$icon[$i].' alt="User Avatar" class="img-circle" width="50" height="50"/>
		</span>
			<div class="chat-body clearfix">
				<div class="header">
					<strong class="primary-font">'.$id[$i].'</strong> <small class="pull-right text-muted">
						<span class="glyphicon glyphicon-time"></span>'.$time[$i].'</small>
				</div>
				<p>'.$mess[$i].'</p>
			</div>
		</li>'
		;
	}
	echo $outputValue;
}

