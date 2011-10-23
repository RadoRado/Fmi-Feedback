<?php

class feedback extends DatabaseAware {

    public function getQuestions() {
        $questions = array(); // array that will hold the questions

        $questionsQuery = "SELECT * FROM questions";
        $questionsRes = $this->database->query($questionsQuery);

        while ($row = $questionsRes->fetch()) {
            $questions[$row->uid] = $row->text;
        }

        return $questions;
    }

    public function getSubjects() {
        $subjects = array();
        $subjectsQuery = "SELECT * FROM subjects";
        $subjectsRes = $this->database->query($subjectsQuery);

        while ($row = $subjectsRes->fetch()) {
            $subjects[$row->uid] = $row->name;
        }

        return $subjects;
    }
	
	public function getFeedbackCount() {
		$query = "SELECT COUNT(uid) as CNT FROM feedback";
		$res = $this->database->query($query);
		$row = $res->fetch();
		return $row->CNT;
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
    public function insertFeedback($courseId, $teacherId, $positiveText, $negativeText, $questions, $studentName = '', $studentSubjectId = '') {
        // check if the courseId or teacherId are correct (!= -1)
        if($courseId == -1 || $teacherId == -1) {
        	throw new Exception("Something is fishy. Try again");
        }
        
        // Insert student info (If available)
        if (!empty($studentName) && is_numeric($studentSubjectId) && $this->validateSubject($studentSubjectId)) {
            $studentId = $this->insertStudent($studentName, $studentSubjectId);
        } else {
            $studentId = null;
        }

        // Insert feedback info
        $this->database->exec("INSERT INTO feedback (course_id, teacher_id, positive_text, negative_text, student_id) VALUES (?, ?, ?, ?, ?)", array(
            (int) $courseId, (int) $teacherId, $positiveText, $negativeText, $studentId
        ));

        $feedbackId = $this->database->lastInsertId();
        $ratingSum = 0;
        // Insert question ratings
        if (is_array($questions)) {
            foreach ($questions as $questionId => $rating) {
                if ($rating === '' || $rating < -1 || $rating > 1)
                    continue;
                $ratingSum += (int) $rating;
                $this->database->exec("INSERT INTO question_to_feedback (feedback_id, question_id, rating) VALUES (?, ?, ?)", array(
                    (int) $feedbackId, (int) $questionId, (int) $rating
                ));
            }
        }

        // update the rating field in the feedback table
        $this->database->exec("UPDATE feedback SET rating = ? WHERE uid = ? LIMIT 1", array($ratingSum, $feedbackId));

        return $feedbackId;
    }

    public function insertStudent($name, $subject_id) {
        $res = $this->database->query("SELECT uid FROM students WHERE name = ? AND subject_id = ?", array(
            $name, (int) $subject_id
                ));

        $uid = $res->fetchColumn();

        if ($uid !== false) {
            return $uid;
        }

        $this->database->exec("INSERT INTO students (name, subject_id) VALUES (?, ?)", array(
            $name, (int) $subject_id
        ));

        return $this->database->lastInsertId();
    }

    public function validateSubject($id) {
        return (bool) $this->database->query("SELECT COUNT(*) FROM subjects WHERE uid = ?", array(
                    (int) $id
                ))->fetchColumn();
    }

}

?>