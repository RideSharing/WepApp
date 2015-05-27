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

$itinerary_id = $_POST{'itinerary_id'};

$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,IP_ADDRESS."/RESTFul/v1/itinerary/$itinerary_id?lang=$lang");

curl_setopt( $ch,CURLOPT_RETURNTRANSFER,1);

curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization: '.$api_key));

// Thiết lập sử dụng GET
curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "DELETE");


// execute the request
$result = curl_exec($ch);

echo $result;


// close curl resource to free up system resources
curl_close($ch);

?>