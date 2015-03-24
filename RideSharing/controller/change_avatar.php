<?php
// include ImageManipulator class
require_once ('../include/ImageManipulator.php');

$response = array ();

if ($_FILES ['file'] ['error'] > 0) {
	
	$response ["error"] = true;
	$response ["message"] = "File is error!";
	
} else {
	// array of valid extensions
	$validExtensions = array (
			'.jpg',
			'.jpeg',
			'.gif',
			'.png' 
	);
	// get extension of the uploaded file
	$fileExtension = strrchr ( $_FILES ['file'] ['name'], "." );
	// check if file Extension is on the list of allowed ones
	if (in_array ( $fileExtension, $validExtensions )) {
		
		$newNamePrefix = time () . '_';
		$manipulator = new ImageManipulator ( $_FILES ['file'] ['tmp_name'] );
		// resizing to 150x150
		$newImage = $manipulator->resample ( 150, 150 );
		// saving file to uploads folder
		$manipulator->save ('../images/' . $newNamePrefix . $_FILES ['file'] ['name']);
		$response["error"] = false;
		$response ["src"] = '../images/' . $newNamePrefix . $_FILES ['file'] ['name'];
	} else {
		$response["error"] = true;
		$response["message"] = ('You must upload an image...');
	}
	
	echo json_encode ( $response );
}