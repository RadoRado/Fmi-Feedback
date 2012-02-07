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
	$smarty = new Smarty();
	$smarty -> setTemplateDir("../templates/");
	$smarty -> assign("feedbackCount", count($pack));
	$smarty -> assign("pack", $pack);
	$smarty -> display("pack.tpl");
}
ob_end_flush();
