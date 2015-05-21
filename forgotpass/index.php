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
			<legend>Forgot Password</legend>
			<div class="form-group">
				<div class="col-sm-3">
					<input type="text" name="email" class="form-control"
						placeholder="Your Email" id="email"> 
						<input type="button" class="btn btn-primary btn-block" value="Request" id="getPassword" />
				</div>
			</div>
		</fieldset>
	</form>
<script>
$("document").ready(function(){

	$("#getPassword").click(function(){

		$.ajax({
			url: '../controller/forgotpass.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            data: $("#email").val(),         	                
            type: 'post',
            success: function(string){
                
            	var getData = $.parseJSON(string);
            	
            	alert(getData['message']);
            	
            	if(!getData['error']){

            		location.reload();
            		
                }
            	
            },
            error: function(){

            	alert("Error unknow!");

                }});

		});
	
});
</script>
</body>
</html>