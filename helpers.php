<?php

	// function to replace last occurence

	function str_replace_last( $search , $replace , $str ) {
		if( ( $pos = strrpos( $str , $search ) ) !== false ) {
			$search_length  = strlen( $search );
			$str    = substr_replace( $str , $replace , $pos , $search_length );
		}
		return $str;
	}

	// function to get request parameters

	function getRequestParams() {

		$requestArgs = new stdClass();

		$requestArgs->type = $_GET["type"];

		$requestArgs->id = $_GET["id"];

		if (isset($_GET["extra"])) {
			parse_str($_GET["extra"], $requestArgs->extra);
			$requestArgs->extra = (object) $requestArgs->extra;
		}

		return $requestArgs;

	}

	function setHeaders() {

		// enable CORS

		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");

		// set JSON content-type

		header("Content-Type: application/json");

	}

	function page404() {
		header("HTTP/1.1 404 Not Found");

		echo "404 Page Not Found";
	}

function makeHttpRequest($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    $result = curl_exec($curl);
    curl_close($curl);
    return json_decode($result, true); // Decode here and return the array
}


?>