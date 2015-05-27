<?php
include_once 'Constant.php';

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
		'fullname' => $_POST {'fullname'},
		'email' => $_POST {'email'},
		'content' => $_POST {'content'}, 
);

$ch = curl_init ();

curl_setopt ( $ch, CURLOPT_URL, IP_ADDRESS."/v1/user?lang=$lang" );

curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );


// Thiết lập sử dụng PUT
curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "PUT" );

// Thiết lập các dữ liệu gửi đi
curl_setopt ( $ch, CURLOPT_POSTFIELDS, http_build_query ( $getreq ) );

// execute the request
$result = curl_exec ( $ch );

$httpCode = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );

if ($httpCode == 405) {
	
	$res = array (
			'error' => true,
			'message' => 'Server is maintaining!' 
	);
	
	echo json_encode ( $res );
	
} else {
	
	echo $result;
	
}

// close curl resource to free up system resources
curl_close ( $ch );

?>