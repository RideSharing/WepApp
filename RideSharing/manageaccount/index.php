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

<!-- Bootstrap JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<!-- jQuery -->
<script src="http://code.jquery.com/jquery.js"></script>
<script>
$("document").ready(function(){
	$("#fileToUpload").change(function(){
		
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
			                	             				            
});
});
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
					<img src="" class="img-thumbnail"
						style="height: 150px; width: 150px;" id="avatar"
						onclick="$('#fileToUpload').trigger('click')" /> 
					<input type="file" name="fileToUpload" id="fileToUpload" style="display: none;" />
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
</body>
</html>
