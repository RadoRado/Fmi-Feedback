<?php

class feedback extends DatabaseAware {

	public function getQuestions() {
		$questions = array();
		// array that will hold the questions

		$questionsQuery = "SELECT * FROM questions";
		$questionsRes = $this -> database -> query($questionsQuery);

		while ($row = $questionsRes -> fetch()) {
			$questions[$row -> uid] = $row -> text;
		}

		return $questions;
	}

	public function getSubjects() {
		$subjects = array();
		$subjectsQuery = "SELECT * FROM subjects";
		$subjectsRes = $this -> database -> query($subjectsQuery);

		while ($row = $subjectsRes -> fetch()) {
			$subjects[$row -> uid] = $row -> name;
		}

		return $subjects;
	}

	public function getTeachersByCourseId($courseId) {
		$sql = "SELECT uid, name FROM teachers 
                WHERE uid
                IN(
                    SELECT teacher_id 
                    FROM teacher_to_course 
                    WHERE course_id = ?)";

		$res = $this -> database -> query($sql, array((int)$courseId));

		return $res -> fetchAll(PDO::FETCH_ASSOC);
	}

	public function getTeachers() {
		$sql = "SELECT uid, name FROM teachers";
		$res = $this -> database -> query($sql);
		return $res -> fetchAll(PDO::FETCH_ASSOC);
	}

	public function linkTeachers($courseId, $teachersArray) {
		$sql = "INSERT INTO teacher_to_course(course_id, teacher_id) VALUES";
		$values = array();

		for ($i = 0; $i < sizeof($teachersArray); $i++) {
			$values[] = sprintf("(%d, %d)", (int)$courseId, (int)$teachersArray[$i]);
		}
		$values = implode(",", $values);

		$sql = $sql . $values . " ON DUPLICATE KEY UPDATE course_id = VALUES(course_id), teacher_id = VALUES(teacher_id)";

		// for better speed of inserts
		try {

			$this -> database -> beginTransaction();
			$rowCount = $this -> database -> exec($sql);
			$this -> database -> commit();

		} catch (PDOException $ex) {
			$this -> database -> rollBack();
			return FALSE;
		}
		return $rowCount;
	}

	public function getFeedbackCount() {
		$query = "SELECT COUNT(uid) as CNT FROM feedback";
		$res = $this -> database -> query($query);
		return $res -> fetchColumn();
	}

	/**
	 * Inserts the given feedback into the database.
	 * Also inserts all related things to the feedback as the student name (if provided)
	 * And the answers to the questions
	 * @param Integer $courseId - the unique id of the course
	 * @param Integer $teacherId - the unique id of the teacher
	 * @param String $positiveText
	 * @param String $negativeText
	 * @param Array $questions
	 * @param String $studentName - if provided, delegates to insertStudent method
	 * @param Integer $studentSubjectId - if provided, delegates to insertStudent method
	 * @return Integer, the created feedback Id
	 */
	public function insertFeedback($courseId, $teacherId, $positiveText, $negativeText, $courseRating, $teacherRating, $studentName = '', $studentSubjectId = '') {
		// check if the courseId or teacherId are correct (!= -1)
		if ($courseId == -1 || $teacherId == -1) {
			throw new Exception("Something is fishy. Try again");
		}

		// Insert student info (If available)
		if (!empty($studentName) && is_numeric($studentSubjectId) && $this -> validateSubject($studentSubjectId)) {
			$studentId = $this -> insertStudent($studentName, $studentSubjectId);
		} else {
			$studentId = null;
		}

		// Insert feedback info
		$this -> database -> exec("INSERT INTO feedback (course_id, teacher_id, positive_text, negative_text, student_id, course_rating, teacher_rating) VALUES (?, ?, ?, ?, ?, ?, ?)", array((int)$courseId, (int)$teacherId, $positiveText, $negativeText, $studentId, (int)$courseRating, (int)$teacherRating));

		$feedbackId = $this -> database -> lastInsertId();
		return array($feedbackId, $studentId);
	}

	public function insertStudent($name, $subject_id) {
		$res = $this -> database -> query("SELECT uid FROM students WHERE name = ? AND subject_id = ?", array($name, (int)$subject_id));

		$uid = $res -> fetchColumn();

		if ($uid !== FALSE) {
			return $uid;
		}

		$this -> database -> exec("INSERT INTO students (name, subject_id) VALUES (?, ?)", array($name, (int)$subject_id));

		return $this -> database -> lastInsertId();
	}

	public function hasStudentAnswered($studentId) {
		if($studentId === NULL) {
			return FALSE;
		}
		
		$sql = "SELECT id FROM gamified WHERE student_id = ?";
		$res = $this -> database -> query($sql, array((int)$studentId));

		return $res -> fetchColumn() !== FALSE;
	}

	public function validateSubject($id) {
		return (bool)$this -> database -> query("SELECT COUNT(*) FROM subjects WHERE uid = ?", array((int)$id)) -> fetchColumn();
	}

}
