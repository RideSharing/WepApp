<?php

if (isset($_POST['email']) && isset($_POST['password'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$data = array('email' => $email, 'password' => $password);

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, "http://192.168.10.74/RESTFul/v1/user");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);


	// execute the request
	$result = curl_exec($ch);

	// close curl resource to free up system resources
	curl_close($ch);

	$json = json_decode($result,true);
	echo $json['error'].'&'.$json['message'];
} else if (isset($_GET['active_key'])) {
	$active_key = $_GET['active_key'];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://192.168.10.74/RESTFul/v1/active/".$active_key);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	// execute the request
	$result = curl_exec($ch);

	// close curl resource to free up system resources
	curl_close($ch);

	$json = json_decode($result,true);

	session_start();

	$_SESSION['message'] = $json['message'];

	if ($json['error']) $_SESSION['error'] = 1;

	header('Location: ../index.php');
	die();
} else {
	echo "Bạn chưa điền đủ thông tin";
}
?>