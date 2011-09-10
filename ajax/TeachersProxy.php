<?php

class TeachersProxy extends DatabaseAware {

    public function getTeachers($params = null) {
        $sql = "SELECT * FROM teachers 
                WHERE uid 
                IN(
                    SELECT teacher_id 
                    FROM teacher_to_course 
                    WHERE course_id = %d)";
         
        $sql = sprintf($sql, mysql_real_escape_string($params["courseId"]));
        $res = $this->database->query($sql);

        $resultArray = array();
        $resultArray["data"] = array();

        while ($row = ($this->database->fetchAssoc($res))) {
            $resultArray["data"][] = array("id" => $row["uid"], "name" => $row["name"]);
        }

        return $resultArray;
    }
}