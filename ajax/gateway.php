<?php
header('Content-type: application/json');

require_once ("../include_me.php");

class Gateway extends DatabaseAware {
	private $proxyArray = array("CoursesProxy" => array("getCourses"), "TeachersProxy" => array("getTeachers"), "FeedbackProxy" => array("sendFeedback"), "FollowUp" => array("count"));
	
	public function delegate($request, $model) {
		if($this->isValidCall($request["class"], $request["method"])) {
			$proxy = new $request["class"]($this->database);
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
	
	private function isValidCall($className, $methodName) {
		if (isset($this->proxyArray[$className])) {
			return in_array($methodName, $this->proxyArray[$className]);
		} else {
			return false;
		}
	}
}

$gateway = new Gateway($database);
$res = $gateway->delegate($_POST, $feedback);
echo $res;
