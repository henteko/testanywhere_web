<?php
require('./config.inc');

$data = $_POST['data'];

$d = json_decode($data);

$question_id = $d->question_id;
$fb_user_id = $d->fb_user_id;
$answer = $d->answer;
$is_correct = $d->is_correct;
$answer_time = $d->answer_time;

$sql_ins = "INSERT INTO ta_answers (question_id,fb_user_id,answer,is_correct,answer_time,created,updated) VALUES (?,?,?,?,?,NOW(),NOW());";
$stmt = $dbcon->prepare($sql_ins);
$stmt->bind_param("iiiii",$question_id,$fb_user_id,$answer,$is_correct,$answer_time);
$res = $stmt->execute();

// is_correct
if($is_correct){
  $sql_get = "SELECT fb_user_id, COUNT(answer_time)+1 as rank FROM ta_answers WHERE answer_time < (SELECT answer_time FROM ta_answers WHERE question_id = %d AND is_correct = 1 AND fb_user_id = %d ORDER BY created DESC LIMIT 1) AND question_id = %d AND is_correct = 1;";
  $result = $dbcon->query(sprintf($sql_get,$question_id,$question_id,$fb_user_id));
  if($result === false) {
	echo json_encode(array('ERROR' => "SQLå®è¡å¤±æ: {$dbcon->error}"));
  }  
  $row = $result->fetch_assoc();
  if(!empty($row)) {
	echo json_encode($row);
  } else {
	echo json_encode(array('ERROR' => 'åé¡ããã¾ãã'));
  }
}
$dbcon->close();

?>
