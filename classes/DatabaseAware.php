<?php

abstract class DatabaseAware {

    protected $database;
    
    public function __construct($database) {
        $this->database = $database;
    }

}
