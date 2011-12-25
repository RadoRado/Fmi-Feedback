<?php
header('Content-type: application/json');

require_once ("../include_me.php");

$proxyArray = array("CoursesProxy" => array("getCourses"), "TeachersProxy" => array("getTeachers"), "FeedbackProxy" => array("sendFeedback"), "FollowUp" => array("count"));

function valid_call($class, $methodName) {
	global $proxyArray;
	if (isset($proxyArray[$class])) {
		return in_array($methodName, $proxyArray[$class]);
	} else {
		return false;
	}
}

if (valid_call($_POST["class"], $_POST["method"])) {
	$proxy = new $_POST["class"]($database);
	$result = array();
	if (isset($_POST["params"])) {
		$result = $proxy -> $_POST["method"]($feedback, $_POST["params"]);
	} else {
		$result = $proxy -> $_POST["method"]($feedback);
	}
	$result["success"] = "true";

	echo json_encode($result);
} else {
	echo json_encode(array("success" => "false"));
}