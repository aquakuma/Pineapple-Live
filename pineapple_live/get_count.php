<?php
require_once('./log_db.php'); // db.phpファイルの読み込み（同一階層格納時）
echo getLogs($_POST['uri']); // 1分以内のユニークアクセス数を取得してajaxに返す
//echo json_encode(getLogs($_POST['uri']),JSON_UNESCAPED_UNICODE, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
?>