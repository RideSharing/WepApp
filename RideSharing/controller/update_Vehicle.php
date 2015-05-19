<?php
include_once 'Constant.php';
session_start();

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

curl_setopt($ch,CURLOPT_URL,IP_ADDRESS."/RESTFul/v1/vehicle/$vehicle_ID");

curl_setopt( $ch,CURLOPT_RETURNTRANSFER,1);

curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization: '.$api_key));

// Thiết lập sử dụng GET
curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "PUT");

curl_setopt ( $ch, CURLOPT_POSTFIELDS, http_build_query ( $getreq ) );

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