<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: x-requested-with");

require_once("../config/db_config.php");
require_once("../class_loader.php");

$database = new Database($db_config);
$database->setEncoding("UTF8");

$proxyArray = array(
    "CoursesProxy" => array("getCourses"),
    "TeachersProxy" => array("getTeachers", "getTeachersByCourseId"),
    "SubjectsProxy" => array("getSubjects"));

function valid_call($class, $methodName) {
    global $proxyArray;
    if (isset($proxyArray[$class])) {
        return in_array($methodName, $proxyArray[$class]);
    } else {
        return false;
    }
}

if (valid_call($_POST["class"], $_POST["method"])) {

    $_POST["class"] = $database->escape($_POST["class"]);
    $_POST["method"] = $database->escape($_POST["method"]);

    $proxy = new $_POST["class"]($database);
    $result = $proxy->$_POST["method"]($_POST["params"]);
    $result["success"] = "true";

    echo json_encode($result);
} else {
    echo json_encode(array("success" => "false"));
}
?>