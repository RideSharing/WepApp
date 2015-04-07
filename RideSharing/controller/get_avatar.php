<?php

session_start();

$api_key = $_SESSION["api_key"];


$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,"http://192.168.10.74/RESTFul/v1/user/link_avatar");

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