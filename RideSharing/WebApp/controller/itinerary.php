<?php
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, "http://localhost/RESTFul/v1/itineraries");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array('Authorization: ce657571fcbe01921ce838df4cccddf4'));

	// execute the request
	$result = curl_exec($ch);

	// close curl resource to free up system resources
	curl_close($ch);

	$json = json_decode($result);

	$itineraries = $json->{'itineraries'};

	echo "0&";
	foreach ($itineraries as $itinerary) {
		echo($itinerary->start_address_lat.",".$itinerary->start_address_long."&");
	}
?>