<?php

header("Content-Type: text/html; charset=utf-8");
require_once ("include_me.php");
$smarty = new Smarty();
$smarty -> setTemplateDir("templates/");

if (isset($_POST['positive'])) {
	try {

		$feedback -> insertFeedback($_POST["courseId"], $_POST["teacherbox"], $_POST['positive'], $_POST['negative'], $_POST["courseEmoticon"], $_POST["subjectEmoticon"] , $_POST['student_name'], $_POST['student_subject']);
		$smarty -> display("feedback_thanks.tpl");
	} catch(Exception $e) {
		$smarty -> assign("errorMessage", $e -> getMessage());
		$smarty -> display("error_page.tpl");
	}

} else {
	$smarty -> assign("questions", $feedback -> getQuestions());
	$smarty -> assign("subjects", $feedback -> getSubjects());
	$smarty -> assign("totalFeedback", $feedback -> getFeedbackCount());
	$smarty -> display("index_styled.tpl");
}
