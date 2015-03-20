<?php
$ch = curl_init();

$data = array (
	"email" => "thanhbkdn92@live.com",
	"password" => "1231234"
	);
// json encode data

$data_string = json_encode($data); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_URL, "http://localhost/RESTFul/v1/user/login");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string)                                                                       
));     


// execute the request
$result = curl_exec($ch);

// close curl resource to free up system resources
curl_close($ch);

$json = json_decode($result);
$res = $json->{'users'};
foreach ($res as $value) {
    echo $value->{'email'};
}
?>
