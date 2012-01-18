<?php
/**
 * All AJAX calls go here
 * @author RadoRado
 */

/**
 * JSON is the default transport serialization
 */
header('Content-type: application/json');

require_once ("../include_me.php");

/**
 * Simple encapsulation for the Gateway class
 * Proxies and their methods are added via addProxy($className, $methodsArray) method
 */
class Gateway extends DatabaseAware {
	/**
	 * Assoc array that holds the proxy classes and the methods that can be called
	 */	
	private $proxyArray = array();

	public function delegate($request, $model) {
		if ($this -> isValidCall($request["class"], $request["method"])) {
			$proxy = new $request["class"]($this -> database);
			$result = array();
			if (isset($request["params"])) {
				$result = $proxy -> $request["method"]($model, $request["params"]);
			} else {
				$result = $proxy -> $request["method"]($model);
			}
			$result["success"] = "true";

			return json_encode($result);
		} else {
			return json_encode(array("success" => "false"));
		}
	}

	public function addProxy($className, $methodsArray) {
		$this -> proxyArray[$className] = $methodsArray;
	}

	private function isValidCall($className, $methodName) {
		if (isset($this -> proxyArray[$className])) {
			return in_array($methodName, $this -> proxyArray[$className]);
		} else {
			return FALSE;
		}
	}

}

$gateway = new Gateway($database);
// add the classes and their corresponding methods
$gateway -> addProxy("CoursesProxy", array("getCourses"));
$gateway -> addProxy("TeachersProxy", array("getTeachers"));
$gateway -> addProxy("FeedbackProxy", array("sendFeedback"));
$gateway -> addProxy("FollowUp", array("count"));

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$res = $gateway -> delegate($_POST, $feedback);
	echo $res;
}
