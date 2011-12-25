<?php

class TeachersProxy extends DatabaseAware {

    public function getTeachers($model, $params = NULL) {
        $resultArray = array();
		if($params === NULL) {
			$resultArray["data"] = $model->getTeachers();
		} else {			
        	$resultArray["data"] = $model->getTeachersByCourseId($params["courseId"]);
		}

        return $resultArray;
    }
}