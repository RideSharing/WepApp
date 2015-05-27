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

$api_key = $_SESSION ["api_key"];

$id = $_POST{'itinerary_id'};

$ch = curl_init ();

curl_setopt ( $ch, CURLOPT_URL, IP_ADDRESS."/RESTFul/v1/driver_reject_itinerary/$id?lang=$lang" );

curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );

curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
		'Authorization: ' . $api_key 
) );

// Thiết lập sử dụng PUT
curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "PUT" );

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