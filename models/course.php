<?php

class Course extends DatabaseAware {
	public function get() {
		$sql = "SELECT uid, name FROM subjects";
		$res = $this -> database -> query($sql);
		return $res -> fetchAll(PDO::FETCH_ASSOC);
	}
}
