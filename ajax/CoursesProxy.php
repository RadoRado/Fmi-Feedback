<?php

class CoursesProxy extends DatabaseAware {

    public function getCourses($params = null) {
        $sql = "SELECT * FROM courses";
        $res = $this->database->query($sql);

        $resultArray = array();
        $resultArray["data"] = array();

        while ($row = ($this->database->fetchAssoc($res))) {
            $resultArray["data"][] = array("id" => $row["uid"], "name" => $row["name"]);
        }

        return $resultArray;
    }

}
