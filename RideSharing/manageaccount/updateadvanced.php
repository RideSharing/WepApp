<?php
session_start ();
if (! isset ( $_SESSION ["api_key"] )) {
	header ( 'Location: ../' );
	die ();
}
?>
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
				<label class="col-sm-5 control-label">Your Avatar</label>
				<div class="col-sm-3" style="width: 180px; height: 150px;">
					<img src="" class="img-thumbnail"
						style="height: 150px; width: 180px;" id="avatar" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">Driver License</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" name="driver_license"
						id="driver_license" placeholder="Driver License">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">Driver License Image</label> <input
					type="file" class="col-sm-4" name="imageDL" id="upimageDL">
				<div class="col-sm-4">
					<img src="" class="img-thumbnail"
						style="height: 200px; width: 400px;" id="imageDL" />
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-5 col-sm-1">
					<input class="btn btn-primary btn-block" type="button"
						name="request" id="request" value="Request">
				</div>
				<div class="col-sm-1">
					<a class="btn btn-primary btn-block" href="../manageaccount">Back</a>
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

	$.ajax({
		url: '../controller/getdriverinform.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        data: "nothing",         	                
        type: 'post',
        success: function(string){
            
        	var getData = $.parseJSON(string);
        	
        	if(!getData['error']){

        		$("#avatar").attr('src',"data:image/jpeg;base64,"+getData['link_avatar']);
        		$("#driver_license").val('123');	
        		$("#imageDL").attr('src',"data:image/jpeg;base64,"+getData['driver_license_img']);
        		
            }else {

            	alert(getData['message']);

                }
        	
        },
        error: function(){

        	alert("Error unknow!");

            }
    });

	$("#request").click(function(){

		var form_data = new FormData();  

		form_data.append("newPassword",$("#newPassword").val());

		$.ajax({
			url: '../controller/updateadvanced.php', // point to server-side PHP script 
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
