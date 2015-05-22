<?php
include_once 'Constant.php';
session_start();

$api_key = $_SESSION["api_key"];

$start_place = "";
$end_place = "";

if(isset($_POST{'start_place_Lat'})&&$_POST{'start_place_Lat'}!=""&&isset($_POST{'start_place_Lng'})&&$_POST{'start_place_Lng'}!=""){
	$start_place = "start_address_lat=".$_POST{'start_place_Lat'}."&start_address_long=".$_POST{'start_place_Lng'};
}
if(isset($_POST{'end_place_Lat'})&&$_POST{'end_place_Lat'}!=""&&isset($_POST{'end_place_Lng'})&&$_POST{'end_place_Lng'}!=""){
	$end_place = "end_address_lat=".$_POST{'end_place_Lat'}."&end_address_long=".$_POST{'end_place_Lng'};
}

$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,IP_ADDRESS."/RESTFul/v1/itineraries?$start_place&$end_place");

curl_setopt( $ch,CURLOPT_RETURNTRANSFER,1);

curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization: '.$api_key));

// Thiết lập sử dụng GET
curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "GET");


// execute the request
$result = curl_exec($ch);

$httpCode = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );

echo $result;


// close curl resource to free up system resources
curl_close($ch);

?>