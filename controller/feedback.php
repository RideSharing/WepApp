<?php
include_once 'Constant.php';
session_start ();

$getreq = array (
		'email' => $_POST['email'],
		'name' => $_POST['name'] ,
		'content' => $_POST['content']
);

$ch = curl_init ();

curl_setopt ( $ch, CURLOPT_URL, IP_ADDRESS."/RESTFul/v1/feedback" );

curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );

// Thiết lập sử dụng POST
curl_setopt ( $ch, CURLOPT_POST, 1 );

// Thiết lập các dữ liệu gửi đi
curl_setopt ( $ch, CURLOPT_POSTFIELDS, $getreq );

// execute the request
$result = curl_exec ( $ch );

echo $result;

// close curl resource to free up system resources
curl_close ( $ch );

?>