<?php

$getreq = array (
 'email' => 'abc@gmail.com',
 'password' => '123123'
);

$ch = curl_init();

echo 'abc';

curl_setopt($ch,CURLOPT_URL,"http://192.168.10.74/RESTFul/v1/user/login");

curl_setopt( $ch,CURLOPT_RETURNTRANSFER,1);

// Thiết lập sử dụng POST
curl_setopt($ch,CURLOPT_POST,1);

// Thiết lập các dữ liệu gửi đi
curl_setopt($ch,CURLOPT_POSTFIELDS,$getreq);

// execute the request
$result = curl_exec($ch);

// close curl resource to free up system resources
curl_close($ch);

$json = json_decode($result);
$res = $json->{'error'};

if ($res) {
 echo "Error!";
 header("Location: ../manageaccount/");
 
}else{
 
 echo "Error!";
 
}
?>