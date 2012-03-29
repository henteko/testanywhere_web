<?php
require('./config.inc');

//URLチェック
//引数やっぱナシ


//SQL実行
$sql = "SELECT id, question, answer FROM ta_questions q WHERE id = " . date('Ymd');
$result = $dbcon->query($sql);
if($result === false) {
	echo json_encode(array('ERROR' => "SQL exec error: {$dbcon->error}"));
	exit;
}

$row = $result->fetch_assoc();
//カラッポの場合でも、空を返す
echo json_encode($row);

$dbcon->close();
?>