<?php

abstract class DatabaseAware {

    protected $database;

    /*
    I dont think we need this now
	protected function escapeParams(&$params) {
        foreach ($params as $key => &$value) {
            if (is_array($value)) {
                $this->escapeParams($value);
            } else {
                $value = $this->database->escape($value);
            }
        }
    }
	*/

    public function __construct($database) {
        $this->database = $database;
    }

}
