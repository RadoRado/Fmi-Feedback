<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: x-requested-with");

require_once("../config/db_config.php");
require_once("../class_loader.php");

$database = new Database($db_config);

?>
