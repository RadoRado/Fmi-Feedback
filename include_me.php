<?php
require_once ("classes/Smarty.class.php");
require_once ("classes/recaptchalib.php");
require_once ("class_loader.php");
require_once ("config/db_config.php");
require_once ("models/feedback.php");

function pageUrl() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] === "on") {
		$pageURL .= "s";
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] !== "80") {
		$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

$database = new Database('mysql:dbname=' . $db_config['DB_NAME'] . ';host=' . $db_config['DB_HOST'] . ';port=3306', $db_config['DB_USER'], $db_config['DB_PASS'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));

/**
 * Init all models
**/

$feedback = new feedback($database);
$courseModel = new Course($database);
$teacherModel = new Teacher($database);
$gamifiedModel = new Gamified($database);
