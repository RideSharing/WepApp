<?php
session_start();

$id = $_POST{'itinerary_id'};

$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,"http://192.168.10.132/RESTFul/v1/itinerary/"+$id);

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