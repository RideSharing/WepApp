<html lang="">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Create New Account</title>

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
	<form class="form-horizontal" action="../controller/checkRegister.php" method="post">
		<fieldset>
			<legend>Create New Account</legend>
			<!-- FullName
			<div class="form-group">
				<label class="col-sm-5 control-label">Full Name</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" name="fullName"
						placeholder="Full Name">
				</div>
			</div>
			 -->
			<div class="form-group">
				<label class="col-sm-5 control-label">Email</label>
				<div class="col-sm-3">
					<input type="email" class="form-control" name="email"
						placeholder="Email">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label" style="font-style: italic;">
					Password</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" name="password"
						placeholder="New Password" id="password">
				</div>
			</div>
			<!-- 
			<div class="form-group">
				<label class="col-sm-5 control-label" style="font-style: italic;">Retype
					Password</label>
				<div class="col-sm-3">
					<input type="password" class="form-control" name="retypePassword"
						placeholder="Retype Password" id="retypePassword">
				</div>
			</div> 
			-->
			<div class="form-group">
				<div class="col-sm-offset-5 col-sm-3">
					<input type="submit" class="btn btn-primary btn-block"
						value="Register" id="register">
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
