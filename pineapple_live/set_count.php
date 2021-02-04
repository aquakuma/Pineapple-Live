<?php
require_once('./log_db.php'); // db.phpファイルの読み込み（同一階層格納時）
setLogs($_POST['uri'], $_POST['ipaddress']); // アクセスログを登録

?>