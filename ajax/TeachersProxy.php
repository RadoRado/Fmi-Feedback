<?php

class TeachersProxy extends DatabaseAware {

    public function getTeachers($params = null) {
		global $feedback;		
		
        $resultArray = array();
        $resultArray["data"] = $feedback->getTeachers($params["courseId"]);

        return $resultArray;
    }
}