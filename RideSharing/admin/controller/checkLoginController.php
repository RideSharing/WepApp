<?php

if (isset($_POST['email']) && isset($_POST['password'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
}

//Initial curl
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "http://localhost/RESTFul/v1/staff/login");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization: 1960b607ce2d462afff9b9644284490e'));
curl_setopt($ch, CURLOPT_POSTFIELDS, array('email: '.$email));

// execute the request
$result = curl_exec($ch);

// close curl resource to free up system resources
curl_close($ch);

$json = json_decode($result);
//$res = $json->{'users'};
$i = 1;
echo $json->{'message'};

?>