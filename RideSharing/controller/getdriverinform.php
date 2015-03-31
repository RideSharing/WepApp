<?php

session_start();

$api_key = $_SESSION["api_key"];


$ch = curl_init();




// execute the request
$result1 = json_decode(getInform($ch, "http://192.168.10.74/RESTFul/v1/user/link_avatar"));


$httpCode = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );

if ($httpCode == 404) {
	
	$res = array (
			'error' => true,
			'message' => 'Eror cannot load the information!' 
	);
	
	echo json_encode($res);
	
} else {
	
	if($result1['error']) {
	
		$res = array (
				'error' => true,
				'message' => 'Eror cannot load the information!'
		);
		
		echo json_encode($res);
		
	}else {
		
		$result = array();
		
		$result['error'] == false;
		$result['link_avatar'] = $result1['link_avatar'];

		
		echo json_encode($result);
		
	}
	
}

// close curl resource to free up system resources
curl_close($ch);

function getInform($ch, $link){
	
	curl_setopt($ch,CURLOPT_URL,$link);
	
	curl_setopt( $ch,CURLOPT_RETURNTRANSFER,1);
	
	curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization: '.$api_key));
	
	// Thiết lập sử dụng GET
	curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "GET");
	
	return curl_exec($ch);
}
?>