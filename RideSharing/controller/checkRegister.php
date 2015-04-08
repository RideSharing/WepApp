<?php
$getreq = array (
		'email' => $_POST ['email'],
		'password' => $_POST ['password'] 
);

$ch = curl_init ();

curl_setopt ( $ch, CURLOPT_URL, "http://192.168.10.132/RESTFul/v1/user" );

curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );

// Thiết lập sử dụng POST
curl_setopt ( $ch, CURLOPT_POST, 1 );

// Thiết lập các dữ liệu gửi đi
curl_setopt ( $ch, CURLOPT_POSTFIELDS, $getreq );

// execute the request
$result = curl_exec ( $ch );

// close curl resource to free up system resources
curl_close ( $ch );
	
$json = json_decode($result,true);
echo $json['error'].'&'.$json['message'];

?>