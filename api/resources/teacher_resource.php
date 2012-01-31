<?php
/**
 * @uri /teacher
 */
class TeacherResource extends Resource {
	public function get($request) {
		$response = new Response($request);
		$response -> code = Response::OK;
		$response -> addHeader('content-type', 'application/json');

		$response -> body = "works";
		return $response;
	}

}
