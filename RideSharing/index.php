<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>

<!-- Bootstrap CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
<!-- jQuery -->
<script src="http://code.jquery.com/jquery.js"></script>
<script src="http://code.jquery.com/jquery.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="js/bootstrap.min.js"></script>
<!--  -->
</head>
<body>
	<!-- form -->
	<form class="form-horizontal" action="controller/checkLogin.php" method="post">
		<fieldset>
			<legend>Ride Sharing</legend>
			<div class="form-group">
				<label for="email" class="col-sm-5 control-label">Email</label>
				<div class="col-sm-3">
					<input type="email" name="email" class="form-control"
						autocomplete="off" placeholder="Email">
				</div>
			</div>
			<div class="form-group">
				<label for="password" class="col-sm-5 control-label">Password</label>
				<div class="col-sm-3">
					<input type="password" name="password" class="form-control"
						autocomplete="off" placeholder="Password">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-5 col-sm-7">
					<div class="checkbox">
						<label> <input type="checkbox"> Remember me -
						</label> <a href="">Forgotten Password?</a>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-5 col-sm-3">
					<input type="submit" class="btn btn-primary btn-block"
						value="Sign in" id="login" />
				</div>
				<br></br>
				<div class="col-sm-offset-5 col-sm-3">
					<a class="btn btn-primary btn-block" href="register">Create New
						Account</a>
				</div>
			</div>
			<div id="error"></div>
		</fieldset>
	</form>
</body>
</html>