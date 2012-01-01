<?php

class FollowUp extends DatabaseAware {
	public function count($model, $params = null) {
		$sql = "INSERT INTO gamified(value, feedback_id) VALUES(?, ?)";
		$value = ($params["gamified"] === "yes" ? 1 : 0);
		$this -> database -> exec($sql, array($value, (int)$params["feedbackId"]));
		$res = array("success" => true);
		return $res;
	}

}
