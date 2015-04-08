<?php
session_start ();

$getreq = array (
		'email' => $_POST{'email'},
		'password' => $_POST{'password'} 
);

$ch = curl_init ();

curl_setopt ( $ch, CURLOPT_URL, "http://192.168.10.132/RESTFul/v1/user/login" );

curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );

// Thiết lập sử dụng POST
curl_setopt ( $ch, CURLOPT_POST, 1 );

// Thiết lập các dữ liệu gửi đi
curl_setopt ( $ch, CURLOPT_POSTFIELDS, $getreq );

// execute the request
$result = curl_exec ( $ch );

$httpCode = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );

if ($httpCode == 404) {
	
	$res = array (
			'error' => true,
			'message' => 'Server is maintaining!' 
	);
	
	echo json_encode($res);
	
} else {
	
	$json = json_decode ( $result );
	
	if (! $json->{'error'}) {
		
		$_SESSION ['api_key'] = $json->{'apiKey'};
		
	}
	
	echo $result;
}
// close curl resource to free up system resources
curl_close ( $ch );

?>