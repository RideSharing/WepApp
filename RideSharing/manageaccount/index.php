<?php
session_start ();
if (! isset ( $_SESSION ["api_key"] )) {
	header ( 'Location: ../' );
	die ();
}
require_once '../header_master.php';
?>
<title>Profile</title>
	<!-- Header -->
	<header>
		<div class="container" style="padding-top: 100px">
			<div class="row">
				<div class="col-lg-12">
					<div class="intro-text">
						<!-- form -->
						<form class="form-horizontal">
							<fieldset>
								<legend><b>Profile</b></legend>
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
									<label class="col-sm-5 control-label">Personal ID Image</label>
									<input type="file" class="col-sm-4" name="imageID" id="upImage">
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
										<a class="btn btn-primary btn-block" href="updatedriver.php">Update
											Driver</a>
									</div>
									<div class="col-sm-1">
										<a class="btn btn-primary btn-block" href="../">Back</a>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</header>
	
	 <?php
    require_once '../footer_master.php';
    ?>
<script>
$("document").ready(function(){

	<?php 
			if(isset($_SESSION['showMessage'])){
			?>
				showSuccess("You became to <?php echo $_SESSION['driver'];?>!");
			<?php	
				$_SESSION['showMessage'] = null;
			}
			?>

	$.ajax({
		url: '../controller/viewprofile.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        data: "nothing",         	                
        type: 'post',
        success: function(string){
            
        	var getData = $.parseJSON(string);
        	
        	if(!getData['error']){

        		$("#fullname").val(getData['fullname']);
        		$("#email").val(getData['email']);
        		$("#phonenumber").val(getData['phone']);
        		$("#numberID").val(getData['personalID']);
        		$("#imageID").attr('src',"data:image/jpeg;base64,"+getData['personalID_img']);
        		
        		
            }else {

            	showError(getData['message']);

                }
        	
        },
        error: function(){

        	showError("Error unknow!");

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
            	
            	if(!getData['error']){

            		showSuccess(getData['message']);
            		
                }else {

                	showError(getData['message']);

                }
            	
            },
            error: function(){

            	showError("Error unknow!");

                }
        });

	});
	
});

//Set image for field
function readURL(input,id) {
	
	var url = input.value;
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    var file = input.files[0];

    if(file.size > 358400){	

    	showError("File size is not big than 350KB!");

    }else {

    	if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(id).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }else {

        	showError("Please add the image!");

            }	

    }
   
}
</script>
<!-- Plugin JavaScript -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/classie.js"></script>
<script src="js/cbpAnimatedHeader.js"></script>
</body>
</html>
