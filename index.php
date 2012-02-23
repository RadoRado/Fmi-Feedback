<?php
ob_start("ob_gzhandler");
header("Content-Type: text/html; charset=utf-8");
require_once ("include_me.php");

$smarty = new Smarty();
$smarty -> setTemplateDir("templates/");
$smarty -> assign("error", "");

$captchaHtml = recaptcha_get_html($recaptchaPublicKey);

$validator = new FormValidator();
$validator -> SetRequiredFields(array('coursebox' => array('regex' => '/.+/', 'message' => 'Кажи за кой курс става на въпрос'), 'courseId' => array('regex' => '/^[0-9]+$/', 'message' => 'Нещо май ме баламосваш?', 'serveronly' => true), 'teacherbox' => array('regex' => '/^[0-9]+$/', 'message' => 'Избери преподавател от списъка'), 'courseEmoticon' => array('regex' => '/^(-1|0|1)$/', 'message' => 'И да искаш повече не можеш да дадеш :)'), 'subjectEmoticon' => array('regex' => '/^(-1|0|1)$/', 'message' => 'И да искаш повече не можеш да дадеш :)'), 'student_name' => array('regex' => '/./', 'dependson' => 'authenticated', 'message' => 'Щом си маркирал, че ще си напишеш името поне го направи :)'), 'student_subject' => array('regex' => '/^[0-9]+$/', 'dependson' => 'authenticated', 'message' => 'Щом си си въвел името поне кажи и специалността :)')));
$smarty -> assign("validatorCode", $validator -> GetMetaJS('#just_form', '#error_message'));

if (isset($_POST['positive'])) {
	try {
		$resp = recaptcha_check_answer($recaptchaPrivateKey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

		if (!$validator -> IsValid($_POST)) {
			$smarty -> assign("error", $validator -> GetErrorMessage());
			in_the_end();
			exit ;
		}

		if (!$resp -> is_valid) {
			$smarty -> assign("error", "Невалидна captcha, пробвай се пак");
			in_the_end();
			exit ;
		}

		$idsArray = $feedback -> insertFeedback($_POST["courseId"], $_POST["teacherbox"], $_POST['positive'], $_POST['negative'], $_POST["courseEmoticon"], $_POST["subjectEmoticon"], $_POST['student_name'], $_POST['student_subject']);

		$feedbackId = $idsArray[0];
		$studentId = $idsArray[1];

		$smarty -> assign("feedbackId", $feedbackId);
		$smarty -> assign("studentId", $studentId);
		$smarty -> assign("hasStudentAnswered", $feedback -> hasStudentAnswered($studentId) ? "yes" : "no");
		$smarty -> display("feedback_thanks.tpl");
	} catch(Exception $e) {
		$smarty -> assign("error", $e -> getMessage());
		in_the_end();
	}

} else {
	in_the_end();
}

function assign_to_smarty($smarty, $names) {
	foreach ($names as $k) {
		if (isset($_POST[$k])) {
			$smarty -> assign($k, htmlspecialchars($_POST[$k]));
		} else {
			$smarty -> assign($k, '');
		}
	}
}

function in_the_end() {
	global $smarty, $feedback, $captchaHtml;

	// Keep the input contents if there was an error
	assign_to_smarty($smarty, array('coursebox', 'courseId', 'teacherbox', 'positive', 'negative', 'authenticated', 'student_name', 'student_subject'));

	$smarty -> assign("courseEmoticon", isset($_POST['courseEmoticon']) ? (int)$_POST['courseEmoticon'] : 0);
	$smarty -> assign("subjectEmoticon", isset($_POST['subjectEmoticon']) ? (int)$_POST['subjectEmoticon'] : 0);

	if (isset($_POST['courseId']) && is_numeric($_POST['courseId'])) {
		$teacherList = $feedback -> getTeachers($_POST['courseId']);
		$smarty -> assign("teacherList", $teacherList);
	} else
		$smarty -> assign("teacherList", array());

	$smarty -> assign("subjects", $feedback -> getSubjects());
	$smarty -> assign("totalFeedback", $feedback -> getFeedbackCount());
	$smarty -> assign("recaptcha", $captchaHtml);
	$smarty -> display("index.tpl");
}
