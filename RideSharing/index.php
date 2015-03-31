<?php
session_start ();
if (isset ( $_SESSION ["api_key"] )) {
	header ( 'Location: homepage' );
	die ();
}
?>
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

</head>
<body>
	<!-- form -->
	<form class="form-horizontal">
		<fieldset>
			<legend>Ride Sharing</legend>
			<div class="form-group">
				<label for="email" class="col-sm-5 control-label">Email</label>
				<div class="col-sm-3">
					<input type="text" name="email" class="form-control"
						placeholder="Email" id="email">
				</div>
			</div>
			<div class="form-group">
				<label for="password" class="col-sm-5 control-label">Password</label>
				<div class="col-sm-3">
					<input type="password" name="password" class="form-control"
						autocomplete="off" placeholder="Password" id="password">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-5 col-sm-7">
					<div class="checkbox">
						<label> <input type="checkbox"> Remember me -
						</label> <a href="forgotpass">Forgotten Password?</a>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-5 col-sm-3">
					<input type="button" class="btn btn-primary btn-block"
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

	<!-- jQuery -->
	<script src="http://code.jquery.com/jquery-1.11.2.js"></script>
	<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	<!-- Bootstrap JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<script>
$("document").ready(function(){
			
	$("#login").click(function(){

		var _data = "email="+$("#email").val()+"&password="+$("#password").val();

		$.ajax({
			url: 'controller/checkLogin.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            data: _data,         	                
            type: 'post',
            success: function(string){
                
            	var getData = $.parseJSON(string);
            	
            	if(getData['error']){

            		alert(getData['message']);
            		
                }else{
					
                	window.location.assign("homepage");

                }
            	
            },
            error: function(){

            	alert("Error unknow!");

                }
        });
			                	             				            
	});
});
</script>
</body>
</html>