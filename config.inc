<?php
mb_language('ja');
mb_internal_encoding('UTF-8');
date_default_timezone_set('Asia/Tokyo');

$dbcon = new mysqli("SERVER_NAME", "USER_NAME", "USER_PASS", "USER_NAME");
if ($dbcon->connect_errno) {
	echo json_encode(array("ERROR" => "DB接続に失敗しました: {$dbcon->connect_error}"));
	exit;
}
$dbcon->set_charset("utf8");

?>
