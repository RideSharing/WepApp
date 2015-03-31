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
						style="height: 150px; width: 180px;" id="avatar"
						onclick="$('#fileToUpload').trigger('click')" /> <input
						type="file" name="fileToUpload" id="fileToUpload"
						style="display: none;" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">Full Name</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" name="fullname"
						id="fullname" placeholder="Full Name">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">Email</label>
				<div class="col-sm-4">
					<input type="email" class="form-control" id="email" disabled>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">Phone Number</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" name="phonenumber"
						id="phonenumber" placeholder="Phone Number">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">PersonalID</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" name="numberID"
						id="numberID" placeholder="Personal ID">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">Personal ID Image</label> <input
					type="file" class="col-sm-4" name="imageID" id="upImage">
				<div class="col-sm-4">
					<img src="" class="img-thumbnail"
						style="height: 200px; width: 400px;" id="imageID" />
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-1">
					<input class="btn btn-primary btn-block" type="button"
						name="update" id="update" value="Update">
				</div>
				<div class="col-sm-2">
					<a class="btn btn-primary btn-block" href="changepassword.php">Change
						Password</a>
				</div>
				<div class="col-sm-2">
					<a class="btn btn-primary btn-block" href="updateadvanced.php">Update
						Advanced</a>
				</div>
				<div class="col-sm-1">
					<a class="btn btn-primary btn-block" href="../homepage">Back</a>
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
		url: '../controller/viewprofile.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        data: "nothing",         	                
        type: 'post',
        success: function(string){
            
        	var getData = $.parseJSON(string);
        	
        	if(!getData['error']){

            	
        		$("#avatar").attr('src',"data:image/jpeg;base64,"+getData['link_avatar']);
        		$("#fullname").val(getData['fullname']);
        		$("#email").val(getData['email']);
        		$("#phonenumber").val(getData['phone']);
        		$("#numberID").val(getData['personalID']);
        		$("#imageID").attr('src',"data:image/jpeg;base64,"+getData['personalID_img']);
        		
        		
            }else {

            	alert(getData['message']);

                }
        	
        },
        error: function(){

        	alert("Error unknow!");

            }
    });
	
	$("#fileToUpload").change(function(){
		
		readURL(this,"#avatar");
		                	             				            
	});

	$("#upImage").change(function(){
		
	    readURL(this,"#imageID");
	    
	});

	$("#update").click(function(){

		var form_data = new FormData();   
		
		var avatar = $("#avatar").attr('src');

		if(avatar.indexOf("data:image/jpeg;base64,") == 0){

			var avatarfix = avatar.replace("data:image/jpeg;base64,","");

			form_data.append("avatar",avatarfix);

		}

		var imageID = $("#imageID").attr('src');

		if(imageID.indexOf("data:image/jpeg;base64,") == 0){
			
			var imageIDfix = imageID.replace("data:image/jpeg;base64,","");

			form_data.append("imageID",imageIDfix);

		}
		             
	    form_data.append("fullname", $("#fullname").val());
	    form_data.append("phonenumber",$("#phonenumber").val());
	    form_data.append("numberID",$("#numberID").val());
		
		$.ajax({
			url: '../controller/updateaccount.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,         	                
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

                }
        });

	});
	
});

//Set image for field
function readURL(input,id) {
	
	var url = input.value;
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    var file = input.files[0];

    if(file.size > 51200){	

    	alert("File size is not big than 50KB!");

    }else {

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
