<?php
ob_start("ob_gzhandler");
header('Content-type: application/json');
require_once ("../include_me.php");
require 'Slim/Slim.php';
$app = new Slim();
//GET route

$app -> get('/teacher/', function() use(&$teacherModel) {
	$result = $teacherModel->get();
	echo json_encode($result);
});

$app -> get('/course/', function() use(&$courseModel) {
	$result = $courseModel->get();
	echo json_encode($result);
});

$app -> run();
