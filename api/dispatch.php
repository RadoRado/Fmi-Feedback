<?php

// load Tonic library
require_once 'tonic.php';
require_once 'resources/teacher_resource.php';

// handle request
$request = new Request( array('baseUri' => '/fmifeedback/api'));
$resource = $request -> loadResource();
$response = $resource -> exec($request);
$response -> output();
