<?php
session_start();
if (isset($_SESSION["api_key"])) {
	header('Location: ../index.php');
	die();
}

if (isset($_POST['email']) && isset($_POST['password'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$data = array('email' => $email, 'password' => $password);

	//Initial curl
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, "http://192.168.10.74/RESTFul/v1/staff/login");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

	// execute the request
	$result = curl_exec($ch);

	// close curl resource to free up system resources
	curl_close($ch);

	$json = json_decode($result);

	if (!$json->{'error'}) {
		$_SESSION['api_key'] = $json->{'apiKey'};
		
		header('Location: ../index.php');
		die();
	} else {
		$_SESSION['message'] = $json->{'message'};
		
		header('Location: ../ajax/login.php');
		die();
	}
} else {
	header('Location: ../ajax/login.php');
	die();
}

?>