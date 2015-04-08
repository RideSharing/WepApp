<?php
session_start ();

$api_key = $_SESSION ["api_key"];

$getreq = array (
		'driver_license' => $_POST{'driver_license'},
		'driver_license_img' => $_POST{'driver_license_img'} 
);

$ch = curl_init ();

curl_setopt ( $ch, CURLOPT_URL, "http://192.168.10.132/RESTFul/v1/driver" );

curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );

curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
'Authorization: ' . $api_key
) );

// Thiết lập sử dụng POST
curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "POST" );

// Thiết lập các dữ liệu gửi đi
curl_setopt ( $ch, CURLOPT_POSTFIELDS, http_build_query ( $getreq ) );

// execute the request
$result = curl_exec ( $ch );

// close curl resource to free up system resources
curl_close ( $ch );

echo $result;
