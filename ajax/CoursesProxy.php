<?php

class CoursesProxy {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getCourses() {
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
