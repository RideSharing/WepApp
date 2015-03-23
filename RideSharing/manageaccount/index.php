<html lang="">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Profile</title>

<!-- Bootstrap CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
<script>
function imageload(){
	<?php
	// include ImageManipulator class
	require_once ('../include/ImageManipulator.php');
	
	if ($_FILES ['fileToUpload'] ['error'] > 0) {
		?>
		var error = <?php echo "Error: " . $_FILES ['fileToUpload'] ['error'] . "<br />";?>
		alert(error);
		<?php
	} else {
		// array of valid extensions
		$validExtensions = array (
				'.jpg',
				'.jpeg',
				'.gif',
				'.png' 
		);
		// get extension of the uploaded file
		$fileExtension = strrchr ( $_FILES ['fileToUpload'] ['name'], "." );
		// check if file Extension is on the list of allowed ones
		if (in_array ( $fileExtension, $validExtensions )) {
			$newNamePrefix = time () . '_';
			$manipulator = new ImageManipulator ( $_FILES ['fileToUpload'] ['tmp_name'] );
			// resizing to 150x150
			$newImage = $manipulator->resample ( 150, 150 );
			// saving file to uploads folder
			$manipulator->save ( '../RideSharing/images/' . $newNamePrefix . $_FILES ['fileToUpload'] ['name'] );
			?>
			var src = <?php echo '../RideSharing/images/' . $newNamePrefix . $_FILES ['fileToUpload'] ['name'] ;?>
			$("#avatar").attr("src",src);
			<?php 
		} else {?>
			alert('You must upload an image...');
			<?php
		}
	}
	?>
}
</script>
</head>
<body>
	<!-- form -->
	<form class="form-horizontal" action="../controller/updateaccount.php"
		method="post" enctype="multipart/form-data">
		<fieldset>
			<legend>Profile</legend>
			<div class="form-group">
				<label class="col-sm-5 control-label">Your Avatar</label>
				<div class="col-sm-3" style="width: 150px; height: 150px;">
					<img src="../images/Photo1.jpg" class="img-thumbnail" width="150px"
						height="150px" id="avatar" alt="Change Avatar"
						onclick="$('#inputavatar').trigger('click')" /> <input type="file"
						id="inputavatar" style="display: none;" onchange="imageload()" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">Full Name</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" name="fullname"
						placeholder="Full Name">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">Email</label>
				<div class="col-sm-3">
					<input type="email" class="form-control" placeholder="Email"
						disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label" style="font-style: italic;">Old
					Password</label>
				<div class="col-sm-3">
					<input type="password" class="form-control" name="oldpassword"
						placeholder="Old Password">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label" style="font-style: italic;">New
					Password</label>
				<div class="col-sm-3">
					<input type="password" class="form-control"
						placeholder="New Password">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label" style="font-style: italic;">Retype
					Password</label>
				<div class="col-sm-3">
					<input type="password" class="form-control"
						placeholder="Retype Password">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">Phone Number</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" name="phonenumber"
						placeholder="Phone Number">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">PersonalID</label>
				<div class="col-sm-3">
					<input type="password" class="form-control" name="IDNum"
						placeholder="Personal ID">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">Personal ID Image</label> <input
					type="file" name="IDImage">
			</div>
			<div class="form-group">
				<div class="col-sm-offset-5 col-sm-1">
					<a class="btn btn-primary btn-block" href="">Update</a>
				</div>
				<div class="col-sm-1">
					<a class="btn btn-primary btn-block" href="../homepage">Back</a>
				</div>
			</div>
		</fieldset>
	</form>

	<!-- jQuery -->
	<script src="http://code.jquery.com/jquery.js"></script>
	<!-- Bootstrap JavaScript -->
	<script src="../js/bootstrap.min.js"></script>
</body>
</html>
