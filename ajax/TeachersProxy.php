<?php

class TeachersProxy {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getTeachers($params = null) {
        $sql = "SELECT * FROM teachers";
        $res = $this->database->query($sql);

        $resultArray = array();
        $resultArray["data"] = array();

        while ($row = ($this->database->fetchAssoc($res))) {
            $resultArray["data"][] = array("id" => $row["uid"], "name" => $row["name"]);
        }

        return $resultArray;
    }

    public function getTeachersByCourseId($params = null) {
        
    }

}