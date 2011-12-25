<?php

class TeachersProxy extends DatabaseAware {

    public function getTeachers($model, $params = NULL) {
        $resultArray = array();
		if((int)$params["courseId"] === -1) {
			$resultArray["data"] = $model->getTeachers(); // all teachers
		} else {			
        	$resultArray["data"] = $model->getTeachersByCourseId($params["courseId"]);
		}

        return $resultArray;
    }
}