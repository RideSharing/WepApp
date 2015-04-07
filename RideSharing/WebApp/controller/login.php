<?php
session_start();
if (isset($_POST['email']) && isset($_POST['password'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$data = array('email' => $email, 'password' => $password);

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, "http://192.168.10.74/RESTFul/v1/user/login");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);


	// execute the request
	$result = curl_exec($ch);

	// close curl resource to free up system resources
	curl_close($ch);

	$json = json_decode($result,true);

	if (!$json['error']) {
		$_SESSION['api_key'] = $json['apiKey'];
		$_SESSION['message'] ='Đăng nhập thành công!';
		echo '0&'.$json['apiKey'];
	} else {
		echo '1&'.$json['message'];
	}
} else {
	header('Location: ../index.php');
	die();
}
?>