<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.geticon.php
 * Type:     function
 * Name:     geticon
 * Purpose:  outputs the corresponding emoticon
 * -------------------------------------------------------------
 */

function smarty_function_geticon($params, &$smarty) {
	switch($params['rating']){
		case -1:
			echo "<img class='emoticon' src='../images/icon_sad_color.png' width='20' height='20' alt ='' />";
			break;
		case 0:
			echo "<img class='emoticon' src='../images/icon_neutral_color.png' width='20' height='20' alt ='' />";
			break;
		case 1:
			echo "<img class='emoticon' src='../images/icon_happy_color.png' width='20' height='20' alt ='' />";
			break;
	}
}

?>