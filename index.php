<?php
header("Content-Type: text/html; charset=utf-8");
require_once("include_me.php");
$smarty = new Smarty();
$smarty->setTemplateDir("templates/");

if ( isset($_POST['positive']) )
{
	$feedback->insertFeedback($_POST['positive'], $_POST['negative'], $_POST['question']);
	
	$smarty->display("feedback_thanks.tpl");
}
else
{
	$smarty->assign("questions", $feedback->getQuestions());
	$smarty->assign("subjects", $feedback->getSubjects());
        
    $smarty->display("index.tpl");
}