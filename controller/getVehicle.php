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


$ch = curl_init();

// execute the request
$result = getInform($ch, IP_ADDRESS."/RESTFul/v1/vehicles?lang=$lang",$api_key);

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

function getInform($ch, $link, $api_key){
	
	curl_setopt($ch,CURLOPT_URL,$link);
	
	curl_setopt( $ch,CURLOPT_RETURNTRANSFER,1);
	
	curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization: '.$api_key));
	
	// Thiết lập sử dụng GET
	curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "GET");
	
	return curl_exec($ch);
}
?>