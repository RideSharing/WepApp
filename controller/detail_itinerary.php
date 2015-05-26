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

$id = $_POST{'itinerary_id'};

$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,IP_ADDRESS."/RESTFul/v1/itinerary/$id?lang=$lang");

curl_setopt( $ch,CURLOPT_RETURNTRANSFER,1);

// Thiết lập sử dụng GET
curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "GET");


// execute the request
$result = curl_exec($ch);

$httpCode = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );

echo $result;


// close curl resource to free up system resources
curl_close($ch);

?>