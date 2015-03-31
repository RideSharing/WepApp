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
			<legend>FeedBack</legend>
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-4">
					<input type="text" class="form-control" name="fullname"
						id="fullname" placeholder="Full Name">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-4">
					<input type="email" class="form-control" id="email" name="email"
						placeholder="Email">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-4">
					<textarea class="form-control" rows="5" cols=""
						placeholder="Content"></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-5 col-sm-2">
					<input class="btn btn-primary btn-block" type="button"
						name="sendFeedback" id="sendFeedback" value="Send">
				</div>
			</div>
		</fieldset>
	</form>

	<!-- Bootstrap JavaScript -->
	<script src="../js/bootstrap.min.js"></script>

	<!-- jQuery -->
	<script src="http://code.jquery.com/jquery.js"></script>
	<script>
	$("document").ready(function(){

		$("#sendFeedback").click(function(){

			var form_data = new FormData();   
			
			if("" == $("#fullname").val() || "" == $("#email").val() || "" == $("#content").val()) {

				alert("Please success typing in the field!");

			}else{

				form_data.append("fullname", $("#fullname").val());
			    form_data.append("email",$("#email").val());
			    form_data.append("content",$("#content").val());
				
				$.ajax({
					url: '../controller/sendfeedback.php', // point to server-side PHP script 
		            dataType: 'text',  // what to expect back from the PHP script, if anything
		            cache: false,
		            contentType: false,
		            processData: false,
		            data: form_data,         	                
		            type: 'post',
		            success: function(string){
		                
		            	var getData = $.parseJSON(string);
		            	
		            	alert(getData['message']);
		            	
		            	
		            },
		            error: function(){

		            	alert("Error unknow!");

		                }
		        });

			}
			             
		    

		});

	});
	</script>
</body>
</html>