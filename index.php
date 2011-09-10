<?php

header("Content-Type: text/html; charset=utf-8");
require_once("classes/Smarty.class.php");
require_once("class_loader.php");
require_once("config/db_config.php");

$smarty = new Smarty();
$database = new Database($db_config);

$questions = array(); // array that will hold the questions
// will move to class in the future
$sql = "SELECT * FROM questions";
$res = $database->query($sql);

while ($row = $database->fetchObject($res)) {
    $questions[$row->id] = $row->text;
}


$smarty->setTemplateDir("templates/");
$smarty->assign("questions", $questions);

$smarty->display("index.tpl");
?>
