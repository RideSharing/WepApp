<?php
include_once 'Constant.php';
session_start();

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

$api_key = $_SESSION["api_key"];

$user_id = $_POST{'user_id'};

$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,IP_ADDRESS."/RESTFul/v1/users/$user_id?lang=$lang");

curl_setopt( $ch,CURLOPT_RETURNTRANSFER,1);

curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization: '.$api_key));

// Thiết lập sử dụng GET
curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "GET");


// execute the request
$result = curl_exec($ch);

$httpCode = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );

if ($httpCode == 404) {
	
	$res = array (
			'error' => true,
			'message' => 'Eror cannot load the information!' 
	);
	
	echo json_encode($res);
	
} else {
	
	echo $result;
}

// close curl resource to free up system resources
curl_close($ch);

?>