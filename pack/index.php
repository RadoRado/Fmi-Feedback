<?php
ob_start();
header("Content-Type: text/html; charset=utf-8");
require_once ("../include_me.php");

$packer = new FeedbackPacker($database);
$pack = $packer -> packFeedback();

if (isset($_GET["format"]) && strtolower($_GET["format"]) === "json") {
	header('Content-type: application/json');
	echo json_encode($pack);
} else {
	echo "<pre>";
	var_dump($pack);
	echo "</pre>";
}
ob_end_flush();
