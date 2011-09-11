<?php
header("Content-Type: text/html; charset=utf-8");
require_once("include_me.php");
$smarty = new Smarty();
$smarty->setTemplateDir("templates/");

if ( isset($_POST['positive']) )
{
	// Insert feedback info
	$database->exec("INSERT INTO feedback (positive_text, negative_text) VALUES (?, ?)", array(
		$_POST['positive'], $_POST['negative']
	));
	$feedback_id = $database->lastInsertId();
	
	// Insert question ratings
	if ( isset($_POST['question']) && is_array($_POST['question']) )
	foreach ( $_POST['question'] as $question_id => $rating )
	{
		if ( $rating === '' || $rating < -1 || $rating > 1 )
			continue;
		
		$database->exec("INSERT INTO question_to_feedback (feedback_id, question_id, rating) VALUES (?, ?, ?)", array(
			(int)$feedback_id, (int)$question_id, (int)$rating
		));
	}
	
	$smarty->display("feedback_thanks.tpl");
}
else
{
	$questions = array(); // array that will hold the questions
	// will move to class in the future
	$sql = "SELECT * FROM questions";
	$res = $database->query($sql);
	
	while ($row = $res->fetch()) {
	    $questions[$row->uid] = $row->text;
	}
	
	$smarty->assign("questions", $questions);
	$smarty->display("index.tpl");
}