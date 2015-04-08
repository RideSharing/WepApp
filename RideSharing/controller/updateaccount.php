<?php
session_start ();

$api_key = $_SESSION ["api_key"];

$getreq = array (
		'fullname' => $_POST {'fullname'},
		'phone' => $_POST {'phonenumber'},
		'personalID' => $_POST {'numberID'},
		'personalID_img' => $_POST {'imageID'},
		'link_avatar' => $_POST {'avatar'} 
);

$ch = curl_init ();

curl_setopt ( $ch, CURLOPT_URL, "http://192.168.10.132/RESTFul/v1/user" );

curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );

curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
		'Authorization: ' . $api_key 
) );

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