<?php
include_once 'Constant.php';
session_start ();
$lang = "";
if(isset($_COOKIE['lang'])) {
	if ($_COOKIE['lang'] == "en") {
		$lang = "en";
	} else {
		$lang = "vi";
	}
} else {
	$lang = "en";
}

$getreq = array (
		'email' => $_POST{'email'},
		'password' => $_POST{'password'} 
);

$ch = curl_init ();

curl_setopt ( $ch, CURLOPT_URL, IP_ADDRESS."/RESTFul/v1/user/login?lang=$lang" );

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
		$_SESSION ['driver'] = 'customer';
		
	}
	
	echo $result;
}
// close curl resource to free up system resources
curl_close ( $ch );

?>