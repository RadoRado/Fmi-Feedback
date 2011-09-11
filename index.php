<?php
header("Content-Type: text/html; charset=utf-8");
require_once("include_me.php");
$smarty = new Smarty();

$questions = array(); // array that will hold the questions
// will move to class in the future
$sql = "SELECT * FROM questions";
$res = $database->query($sql);

while ($row = $res->fetch()) {
    $questions[$row->uid] = $row->text;
}


$smarty->setTemplateDir("templates/");
$smarty->assign("questions", $questions);

$smarty->display("index.tpl");