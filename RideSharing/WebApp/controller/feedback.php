<?php

if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['message'])) {
	$email = $_POST['email'];
	$name = $_POST['name'];
	$content = $_POST['message'];

	$data = array('email' => $email, 'name' => $name, 'content' => $content);

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, "http://192.168.10.74/RESTFul/v1/feedback");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);


	// execute the request
	$result = curl_exec($ch);

	// close curl resource to free up system resources
	curl_close($ch);

	$json = json_decode($result,true);

	$error = $json['error'];
	$message = $json['message'];

	echo $error?'1':'0'.'&'.$message;
} else {
	header('Location: ../index.php');
	die();
}

?>