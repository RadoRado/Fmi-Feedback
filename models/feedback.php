<?php
class feedback extends DatabaseAware
{
	public function getQuestions()
	{
		$questions = array(); // array that will hold the questions

		$questionsQuery = "SELECT * FROM questions";
		$questionsRes = $this->database->query($questionsQuery);
		
		while ( $row = $questionsRes->fetch() ) {
		    $questions[$row->uid] = $row->text;
		}
		
		return $questions;
	}
	
	public function getSubjects()
	{
		$subjects = array();
		$subjectsQuery = "SELECT * FROM subjects";
		$subjectsRes = $this->database->query($subjectsQuery);
        
		while ($row = $subjectsRes->fetch()) {
			$subjects[$row->uid] = $row->name;
		}
		
		return $subjects;
	}
	
	public function insertFeedback($positive_text, $negative_text, $questions, $student_name = '', $student_subject = '')
	{
		// Insert student info (If available)
		if ( !empty($student_name) && is_numeric($student_subject) && $this->validateSubject($student_subject) )
			$student_id = $this->insertStudent($student_name, $student_subject);
		else
			$student_id = null;
		
		// Insert feedback info
		$this->database->exec("INSERT INTO feedback (positive_text, negative_text, student_id) VALUES (?, ?, ?)", array(
			$positive_text, $negative_text, $student_id
		));
		
		$feedback_id = $this->database->lastInsertId();
		
		// Insert question ratings
		if ( is_array($questions) )
		foreach ( $questions as $question_id => $rating )
		{
			if ( $rating === '' || $rating < -1 || $rating > 1 )
				continue;
			
			$this->database->exec("INSERT INTO question_to_feedback (feedback_id, question_id, rating) VALUES (?, ?, ?)", array(
				(int)$feedback_id, (int)$question_id, (int)$rating
			));
		}
		
		return $feedback_id;
	}
	
	public function insertStudent($name, $subject_id)
	{
		$res = $this->database->query("SELECT uid FROM students WHERE name = ? AND subject_id = ?", array(
			$name, (int)$subject_id
		));
		
		$uid = $res->fetchColumn();
		
		if ( $uid !== false )
			return $uid;
			
		$this->database->exec("INSERT INTO students (name, subject_id) VALUES (?, ?)", array(
			$name, (int)$subject_id
		));
		
		return $this->database->lastInsertId();
	}
	
	public function validateSubject($id)
	{
		return (bool)$this->database->query("SELECT COUNT(*) FROM subjects WHERE uid = ?", array(
			(int)$id
		))->fetchColumn();
	}
}
?>