<?php
    header("Content-Type: text/html; charset=utf-8");
    require_once("classes/Smarty.class.php");
    
    $smarty = new Smarty();
    
    $smarty->setTemplateDir("templates/");
    $smarty->display("index.tpl");
?>
