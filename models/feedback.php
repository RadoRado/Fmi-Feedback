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
	
	public function insertFeedback($positive_text, $negative_text, $questions)
	{
		// Insert feedback info
		$this->database->exec("INSERT INTO feedback (positive_text, negative_text) VALUES (?, ?)", array(
			$positive_text, $negative_text
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
}
?>