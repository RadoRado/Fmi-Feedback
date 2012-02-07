<?php

class FeedbackPacker extends DatabaseAware {
	/**
	 * Packs all of the feedback as an JSON document
	 * No student names are included
	 */
	public function packFeedback() {
		$feedbackSql = "SELECT uid, positive_text, negative_text, course_id, teacher_id, course_rating, teacher_rating, created FROM feedback";
		$feedbackRes = $this -> database -> query($feedbackSql);

		/*assoc array*/
		$result = array();

		while ($feedbackRow = $feedbackRes -> fetch()) {
			$result[$feedbackRow -> uid] = array("positive" => $feedbackRow -> positive_text, "negative" => $feedbackRow -> negative_text, "teacherRating" => $feedbackRow -> teacher_rating, "courseRating" => $feedbackRow -> course_rating, "courseName" => "", "teacherName" => "", "createdDate" => $feedbackRow -> created);

			$result[$feedbackRow -> uid]["teacherName"] = $this -> teacherNameById($feedbackRow -> teacher_id);
			$result[$feedbackRow -> uid]["courseName"] = $this -> courseNameById($feedbackRow -> course_id);
		}

		return $result;
	}

	/**
	 * Can be migrated to a separate model
	 * @return the name of the teacher
	 * FALSE means not found
	 */
	public function teacherNameById($uid) {
		$teacherNameSql = "SELECT name FROM teachers WHERE uid = ? LIMIT 1";
		$teacherNameRes = $this -> database -> query($teacherNameSql, array((int)$uid));

		return $teacherNameRes -> fetchColumn();
	}

	/**
	 * Can be migrated to a separate model
	 */
	public function courseNameById($uid) {
		$courseNameSql = "SELECT name FROM courses WHERE uid = ? LIMIT 1";
		$courseNameRes = $this -> database -> query($courseNameSql, array((int)$uid));

		return $courseNameRes -> fetchColumn();
	}

}
