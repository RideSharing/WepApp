<?php
session_start ();
if (! isset ( $_SESSION ["api_key"] )) {
	header ( 'Location: ../' );
	die ();
}
require_once '../header_master.php';
?>
<html lang="">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Profile</title>

<!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/toastr.css">

<!-- Custom CSS -->
<link href="../css/freelancer.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/BeatPicker.min.css">

<!-- Custom Fonts -->
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet"
	type="text/css">
<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700"
	rel="stylesheet" type="text/css">
<link
	href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic"
	rel="stylesheet" type="text/css">


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->


</head>
<body>
	<!-- Header -->
	<header>
		<div class="container" style="padding-top: 100px">
			<div class="row">
				<div class="col-lg-12">
					<div class="intro-text">
						<!-- form -->
						<form class="form-horizontal">
							<fieldset>
								<legend>Change Password</legend>
								<div class="form-group">
									<label class="col-sm-5 control-label">Your Avatar</label>
									<div class="col-sm-3" style="width: 180px; height: 150px;">
										<img src="" class="img-thumbnail"
											style="height: 150px; width: 180px;" id="avatar" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-5 control-label"
										style="font-style: italic;">Old Password</label>
									<div class="col-sm-4">
										<input type="password" class="form-control" name="oldPassword"
											id="oldPassword" placeholder="Old Password" disabled>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-5 control-label"
										style="font-style: italic;">New Password</label>
									<div class="col-sm-4">
										<input type="password" class="form-control" id="newPassword"
											name="newPassword" placeholder="New Password">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-5 control-label"
										style="font-style: italic;">Retype Password</label>
									<div class="col-sm-4">
										<input type="password" class="form-control"
											name="retypePassword" id="retypePassword"
											placeholder="RetypePassword">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-5 col-sm-1">
										<input class="btn btn-primary btn-block" type="button"
											name="oK" id="oK" value="OK">
									</div>
									<div class="col-sm-1">
										<a class="btn btn-primary btn-block" href="../manageaccount">Back</a>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- Bootstrap JavaScript -->
	<script src="../js/bootstrap.min.js"></script>

	<!-- jQuery -->
	<script src="http://code.jquery.com/jquery.js"></script>
	<script>
$("document").ready(function(){

	$.ajax({
		url: '../controller/get_avatar.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        data: "nothing",         	                
        type: 'post',
        success: function(string){
            
        	var getData = $.parseJSON(string);
        	
        	if(!getData['error']){

        		$("#mini_avatar").attr('src',"data:image/jpeg;base64,"+getData['link_avatar']);
        		$("#avatar").attr('src',"data:image/jpeg;base64,"+getData['link_avatar']);	
        		
            }else {

            	alert(getData['message']);

                }
        	
        },
        error: function(){

        	alert("Error unknow!");

            }
    });

	$("#oK").click(function(){

		if($("#newPassword").val() != $("#retypePassword").val()){

			alert("Retyping your password is wrong!");

		}else {

			var form_data = new FormData();  

			form_data.append("newPassword",$("#newPassword").val());

			$.ajax({
				url: '../controller/change_password.php', // point to server-side PHP script 
	            dataType: 'text',  // what to expect back from the PHP script, if anything
	            cache: false,
	            contentType: false,
	            processData: false,
	            data: form_data,         	                
	            type: 'post',
	            success: function(string){
	                
	            	var getData = $.parseJSON(string);
	            	
	            	alert(getData['message']);

	            	location.reload();
	            	
	            },
	            error: function(){

	            	alert("Error unknow!");

	                }
	        });

		} 

	});
	
});

//Set image for field
function readURL(input,id) {
	
	var url = input.value;
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    
    if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }else {

    	alert("Please add the image!");

        }
}
</script>
	<!-- 
var file_data = $('#fileToUpload').prop('files')[0]; 
		var form_data = new FormData();                  
	    form_data.append("file", file_data)            
	
		$.ajax({
			url: '../controller/change_avatar.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(string){
            	var getData = $.parseJSON(string);
            	if(getData['error']){

            		alert(getData['message']);
            		
                	}else{

                		$("#avatar").attr("src",getData['src']);

                    }
            	
            },
        	error: function(){

        		alert("Error occured!");
        		
            	}
        });
-->
</body>
</html>
