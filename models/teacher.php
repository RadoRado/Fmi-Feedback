<?php

class Teacher extends DatabaseAware {
	public function get() {
		$sql = "SELECT uid, name FROM teachers";
		$res = $this -> database -> query($sql);
		return $res -> fetchAll(PDO::FETCH_ASSOC);
	}

	public function getByCourseId($id) {
		$sql = "SELECT uid, name FROM teachers 
                WHERE uid
                IN(
                    SELECT teacher_id 
                    FROM teacher_to_course 
                    WHERE course_id = ?)";

		$res = $this -> database -> query($sql, array((int)$id));

		return $res -> fetchAll(PDO::FETCH_ASSOC);
	}

}
