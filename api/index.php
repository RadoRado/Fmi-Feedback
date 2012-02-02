<?php
ob_start("ob_gzhandler");
header('Content-type: application/json');
require_once ("../include_me.php");
require 'Slim/Slim.php';
$app = new Slim();

/**
 * Set Custom 404 page when an API method is not found
 */
$app -> notFound(function() use ($app) {
	$app -> render("api404.html");
});

/**
 * Set Custom Error Page. No sensetive information should be displayed to the user
 */
$app -> error(function() use ($app) {
	// log error
	//$app -> render("apiError.html");
});

/**
 * REST Methods
 */
$app -> get('/teacher/', function() use ($teacherModel) {
	$result = $teacherModel -> get();
	echo json_encode($result);
});

$app -> get('/course/', function() use ($courseModel) {
	$result = $courseModel -> get();
	echo json_encode($result);
});

$app -> get('/teacherByCourse/:id/', function($id) use ($teacherModel) {
	$result = $teacherModel -> getByCourseId($id);
	echo json_encode($result);
});

$app -> post("/followup/", function() use ($gamifiedModel) {
	$value = ($_POST["gamified"] === "yes" ? 1 : 0);
	$gamifiedModel -> create($value, $_POST["feedbackId"], $_POST["studentId"]);
});

$app -> run();
