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

$vehicle_ID = $_POST{'vehicle_ID'};

$getreq = array (
		'type' => $_POST {'type'},
		'license_plate' => $_POST {'license_plate'},
		'reg_certificate' => $_POST {'reg_certificate'},
		'license_plate_img' => $_POST {'license_plate_img'},
		'vehicle_img' => $_POST {'vehicle_img'},
		'motor_insurance_img' => $_POST {'motor_insurance_img'}
);

$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,IP_ADDRESS."/RESTFul/v1/vehicle/$vehicle_ID?lang=$lang");

curl_setopt( $ch,CURLOPT_RETURNTRANSFER,1);

curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization: '.$api_key));

// Thiết lập sử dụng GET
curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "PUT");

curl_setopt ( $ch, CURLOPT_POSTFIELDS, http_build_query ( $getreq ) );

// execute the request
$result = curl_exec($ch);

echo $result;
//close curl resource to free up system resources
curl_close ( $ch );
	
?>