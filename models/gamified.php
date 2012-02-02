<?php

class Gamified extends DatabaseAware {
	public function create($value, $feedbackId, $studentId) {
		$sql = "INSERT INTO gamified(value, feedback_id, student_id) VALUES(?, ?, ?)";
		$this -> database -> exec($sql, array($value, (int)$feedbackId, (int)$studentId));
	}

}
