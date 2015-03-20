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
</head>
<body>
	<!-- form -->
	<form class="form-horizontal">
		<fieldset>
			<legend>Profile</legend>
			<div class="form-group">
				<label for="inputavatar3" class="col-sm-5 control-label">Your Avatar</label>
				<div class="col-sm-3" style="width:150px;height:150px;">
					<img src="#" class="img-thumbnail" width="150px" height="150px">
				</div>
			</div>
			<div class="form-group">
				<label for="inputtext3" class="col-sm-5 control-label">Full Name</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="inputtext3"
						placeholder="Full Name" disabled>
				</div>
			</div>
			<div class="form-group">
				<label for="inputemail3" class="col-sm-5 control-label">Email</label>
				<div class="col-sm-3">
					<input type="email" class="form-control" id="inputemail3"
						placeholder="Email" disabled>
				</div>
			</div>
			<div class="form-group">
				<label for="inputOldPassword3" class="col-sm-5 control-label" style="font-style: italic;" >Old
					Password</label>
				<div class="col-sm-3">
					<input type="password" class="form-control" id="inputOutPassword3"
						placeholder="Old Password">
				</div>
			</div>
			<div class="form-group">
				<label for="inputNewPassword3" class="col-sm-5 control-label" style="font-style: italic;" >New
					Password</label>
				<div class="col-sm-3">
					<input type="password" class="form-control" id="inputNewPassword3"
						placeholder="New Password">
				</div>
			</div>
			<div class="form-group">
				<label for="inputRetypePassword3" class="col-sm-5 control-label" style="font-style: italic;" >Retype
					Password</label>
				<div class="col-sm-3">
					<input type="password" class="form-control"
						id="inputRetypePassword3" placeholder="Retype Password">
				</div>
			</div>
			<div class="form-group">
				<label for="inputPhoneNumber3" class="col-sm-5 control-label">Phone
					Number</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="inputPhoneNumber3"
						placeholder="Phone Number">
				</div>
			</div>
			<div class="form-group">
				<label for="inputPersonalID3" class="col-sm-5 control-label">PersonalID</label>
				<div class="col-sm-3">
					<input type="password" class="form-control" id="inputPersonalID3"
						placeholder="Personal ID">
				</div>
			</div>
			<div class="form-group">
				<label for="inputIDImage3" class="col-sm-5 control-label">Personal
					ID Image</label> <input type="file" id="inputIDImage3">
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
