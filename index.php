<?php

header("Content-Type: text/html; charset=utf-8");
require_once ("include_me.php");
$smarty = new Smarty();
$smarty -> setTemplateDir("templates/");
$smarty -> assign("error", "");

$captchaHtml = recaptcha_get_html($recaptchaPublicKey);

$validator = new FormValidator();
$validator->SetRequiredFields(array(
	'coursebox' => array('regex' => '/.+/', 'message' => 'Кажи за кой курс става на въпрос'),
	'courseId' => array('regex' => '/^[0-9]+$/', 'message' => 'Нещо май ме баламосваш?', 'serveronly' => true),
	'teacherbox' => array('regex' => '/^[0-9]+$/', 'message' => 'Избери преподавател от списъка'),
	'courseEmoticon' => array('regex' => '/^(-1|0|1)$/', 'message' => 'И да искаш повече не можеш да дадеш :)'),
	'subjectEmoticon' => array('regex' => '/^(-1|0|1)$/', 'message' => 'И да искаш повече не можеш да дадеш :)'),
	
	'student_name' => array('regex' => '/./', 'dependson' => 'authenicated', 'message' => 'Щом си маркирал, че ще си напишеш името поне го направи :)'),
	'student_subject' => array('regex' => '/^[0-9]+$/', 'dependson' => 'authenticated', 'message' => 'Щом си си въвел името поне кажи и специалността :)')
));
$smarty->assign("validatorCode", $validator->GetMetaJS('#just_form', '#error_message'));

if (isset($_POST['positive'])) {
	try {
		$resp = recaptcha_check_answer($recaptchaPrivateKey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
		if(!$resp->is_valid) {
			$smarty->assign("error", "Невалидна captcha, пробвай се пак");
			in_the_end();
			exit;
		}
		
		if ( !$validator->IsValid($_POST) )
		{
			$smarty->assign("error", $validator->GetErrorMessage());
			in_the_end();
			exit;
		}
		
		$feedbackId = $feedback -> insertFeedback($_POST["courseId"], $_POST["teacherbox"], $_POST['positive'], $_POST['negative'], $_POST["courseEmoticon"], $_POST["subjectEmoticon"], $_POST['student_name'], $_POST['student_subject']);
		
		$smarty -> assign("feedbackId", $feedbackId);
		$smarty -> display("feedback_thanks.tpl");
	} catch(Exception $e) {
		$smarty -> assign("errorMessage", $e -> getMessage());
		$smarty -> display("error_page.tpl");
	}

} else {
	in_the_end();
}

function in_the_end()
{
	global $smarty, $feedback, $captchaHtml;	
	
	$smarty -> assign("questions", $feedback -> getQuestions());
	$smarty -> assign("subjects", $feedback -> getSubjects());
	$smarty -> assign("totalFeedback", $feedback -> getFeedbackCount());
	$smarty -> assign("recaptcha", $captchaHtml);
	$smarty -> display("index_styled.tpl");
}