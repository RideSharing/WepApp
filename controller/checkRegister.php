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
		'email' => $_POST ['email'],
		'password' => $_POST ['password'] 
);

$ch = curl_init ();

curl_setopt ( $ch, CURLOPT_URL, IP_ADDRESS."/RESTFul/v1/user?lang=$lang" );

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