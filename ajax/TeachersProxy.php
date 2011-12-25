<?php

class TeachersProxy extends DatabaseAware {

    public function getTeachers($params = null) {
		global $feedback;		
		
        $resultArray = array();
        $resultArray["data"] = $feedback->getTeachersByCourseId($params["courseId"]);

        return $resultArray;
    }
}