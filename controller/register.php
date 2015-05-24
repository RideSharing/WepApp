<?php
include_once 'Constant.php';
session_start ();

$getreq = $_GET{'active_key'};

$ch = curl_init ();

curl_setopt ( $ch, CURLOPT_URL, IP_ADDRESS."/RESTFul/v1/active/".$getreq );

curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );

// Thiết lập sử dụng POST
curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "GET" );

// execute the request
$result = curl_exec ( $ch );

$res = json_decode($result);

$_SESSION['message'] = $res->{'message'};

if ($_SESSION['error'] == true) {
	$_SESSION['error'] = $res->{'error'};
}

//close curl resource to free up system resources
curl_close ( $ch );

header('Location: ../index.php');

?>