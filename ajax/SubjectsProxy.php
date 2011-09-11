<?php

class SubjectsProxy extends DatabaseAware {

    public function getSubjects($params = null) {
        $sql = "SELECT * FROM subjects";
        $res = $this->database->query($sql);

        $resultArray = array();
        $resultArray["data"] = array();

        while ($row = $res->fetch()) {
            $resultArray["data"][] = array("id" => $row->uid, "name" => $row->name);
        }

        return $resultArray;
    }

}

?>
