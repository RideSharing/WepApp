<?php
session_start ();

$getreq = $_POST{'email'};

$ch = curl_init ();

curl_setopt ( $ch, CURLOPT_URL, "http://192.168.10.132/RESTFul/v1/forgotpass/$getreq" );

curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );

// Thiết lập sử dụng POST
curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "GET" );

// execute the request
$result = curl_exec ( $ch );

$httpCode = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );

if ($httpCode == 404) {
	
	$res = array (
			'error' => true,
			'message' => 'Please enter your email!' 
	);
	
	echo json_encode($res);
	
} else {
	
		echo $result;
	
}

// close curl resource to free up system resources
curl_close ( $ch );

?>