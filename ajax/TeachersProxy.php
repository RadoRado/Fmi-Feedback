<?php

class TeachersProxy extends DatabaseAware {

    public function getTeachers($params = null) {
        $sql = "SELECT * FROM teachers 
                WHERE uid 
                IN(
                    SELECT teacher_id 
                    FROM teacher_to_course 
                    WHERE course_id = ?)";
         
        $res = $this->database->query($sql, array(
			(int)$params["courseId"]
		));

        $resultArray = array();
        $resultArray["data"] = array();

        while ($row = $res->fetch()) {
            $resultArray["data"][] = array("id" => $row->uid, "name" => $row->name);
        }

        return $resultArray;
    }
}