<?php

header("Content-Type: text/html; charset=utf-8");
require_once ("include_me.php");
$smarty = new Smarty();
$smarty -> setTemplateDir("templates/");

$captchaHtml = recaptcha_get_html($recaptchaPublicKey);

if (isset($_POST['positive'])) {
	try {
		$resp = recaptcha_check_answer($recaptchaPrivateKey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
		if(!$resp->is_valid) {
			throw new Exception($resp->error, 1);
			
		}
		
		
		$feedbackId = $feedback -> insertFeedback($_POST["courseId"], $_POST["teacherbox"], $_POST['positive'], $_POST['negative'], $_POST["courseEmoticon"], $_POST["subjectEmoticon"], $_POST['student_name'], $_POST['student_subject']);
		
		$smarty -> assign("feedbackId", $feedbackId);
		$smarty -> display("feedback_thanks.tpl");
	} catch(Exception $e) {
		$smarty -> assign("errorMessage", $e -> getMessage());
		$smarty -> display("error_page.tpl");
	}

} else {
	$smarty -> assign("questions", $feedback -> getQuestions());
	$smarty -> assign("subjects", $feedback -> getSubjects());
	$smarty -> assign("totalFeedback", $feedback -> getFeedbackCount());
	$smarty -> assign("recaptcha", $captchaHtml);
	$smarty -> display("index_styled.tpl");
}
