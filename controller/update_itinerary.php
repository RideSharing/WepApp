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

$itinerary_id = $_POST{'itinerary_id'};

$getreq = array (
		'start_address' => $_POST{'start_address'},
		'start_address_lat' => $_POST{'start_address_lat'} ,
		'start_address_long' => $_POST{'start_address_long'},
		'end_address' => $_POST{'end_address'},
		'end_address_lat' => $_POST{'end_address_lat'},
		'end_address_long' => $_POST{'end_address_long'},
		'leave_date' => $_POST{'leave_date'} ,
		'duration' => $_POST{'duration'},
		'distance' => $_POST{'distance'},
		'cost' => $_POST{'cost'},
		'description' => $_POST{'description'}
);

$ch = curl_init ();

curl_setopt ( $ch, CURLOPT_URL, IP_ADDRESS."/RESTFul/v1/itinerary/$itinerary_id?lang=$lang" );

curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );

curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
'Authorization: ' . $api_key
) );

// Thiết lập sử dụng GET
curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "PUT");

curl_setopt ( $ch, CURLOPT_POSTFIELDS, http_build_query ( $getreq ) );

// execute the request
$result = curl_exec ( $ch );

$httpCode = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );

if ($httpCode == 404) {
	
	$res = array (
			'error' => true,
			'message' => 'Server is maintaining!' 
	);
	
	echo json_encode($res);
	
} else {
	
	echo $result;
}
// close curl resource to free up system resources
curl_close ( $ch );

?>