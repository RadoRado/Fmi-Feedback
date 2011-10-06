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

    /**
     * Inserts the given feedback into the database.
     * Also inserts all related things to the feedback as the student name (if provided)
     * And the answers to the questions
     * @param String $positiveText
     * @param String $negativeText
     * @param Array $questions
     * @param String $studentName - if provided, delegates to insertStudent method
     * @param Integer $studentSubjectId - if provided, delegates to insertStudent method
     * @return Integer, the created feedback Id 
     */
    public function insertFeedback($positiveText, $negativeText, $questions, $studentName = '', $studentSubjectId = '') {
        // Insert student info (If available)
        if (!empty($studentName) && is_numeric($studentSubjectId) && $this->validateSubject($studentSubjectId)) {
            $studentId = $this->insertStudent($studentName, $studentSubjectId);
        } else {
            $studentId = null;
        }

        // Insert feedback info
        $this->database->exec("INSERT INTO feedback (positive_text, negative_text, student_id) VALUES (?, ?, ?)", array(
            $positiveText, $negativeText, $studentId
        ));

        $feedbackId = $this->database->lastInsertId();

        // Insert question ratings
        if (is_array($questions)) {
            foreach ($questions as $questionId => $rating) {
                if ($rating === '' || $rating < -1 || $rating > 1)
                    continue;

                $this->database->exec("INSERT INTO question_to_feedback (feedback_id, question_id, rating) VALUES (?, ?, ?)", array(
                    (int) $feedbackId, (int) $questionId, (int) $rating
                ));
            }
        }

        return $feedbackId;
    }

    public function insertStudent($name, $subject_id) {
        $res = $this->database->query("SELECT uid FROM students WHERE name = ? AND subject_id = ?", array(
            $name, (int) $subject_id
                ));

        $uid = $res->fetchColumn();

        if ($uid !== false)
            return $uid;

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