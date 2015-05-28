<?php
session_start ();

if(isset($_COOKIE['lang'])) {
    if ($_COOKIE['lang'] == "en") {
        require_once '../includes/lang_en.php';
    } else {
        require_once '../includes/lang_vi.php';
    }
} else {
    setcookie('lang', 'en', time() + (86400 * 365), "/");
}

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
								<legend><b><?php echo $lang['PROFILE'] ?></b></legend>
								<div class="form-group">
									<label class="col-sm-5 control-label"><?php echo $lang['AVATAR'] ?></label>
									<div class="col-sm-3" style="width: 180px; height: 150px;">
										<img src="" class="img-thumbnail"
											style="height: 150px; width: 180px;" id="avatar"
											onclick="$('#fileToUpload').trigger('click')" /> <input
											type="file" name="fileToUpload" id="fileToUpload"
											style="display: none;" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-5 control-label"><?php echo $lang['FULLNAME'] ?></label>
									<div class="col-sm-4">
										<input type="text" class="form-control" name="fullname"
											id="fullname">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-5 control-label"><?php echo $lang['EMAIL'] ?></label>
									<div class="col-sm-4">
										<input type="email" class="form-control" id="email" disabled>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-5 control-label"><?php echo $lang['PHONE'] ?></label>
									<div class="col-sm-4">
										<input type="text" class="form-control" name="phonenumber"
											id="phonenumber">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-5 control-label"><?php echo $lang['PERSONAL_ID'] ?></label>
									<div class="col-sm-4">
										<input type="text" class="form-control" name="numberID"
											id="numberID">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-5 control-label"><?php echo $lang['PERSONAL_ID_PHOTO'] ?></label>
									<input type="file" class="col-sm-4" name="imageID" id="upImage">
									<div class="col-sm-4">
										<img src="" class="img-thumbnail"
											style="height: 200px; width: 400px;" id="imageID" />
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-4 col-sm-1">
										<input class="btn btn-primary btn-block" type="button"
											name="update" id="update" value="<?php echo $lang['UPDATE']?>">
									</div>
									<div class="col-sm-2">
										<a class="btn btn-primary btn-block" href="changepassword.php"><?php echo $lang['CHANGE_PASS']?></a>
									</div>
									<div class="col-sm-2">
										<a class="btn btn-primary btn-block" href="updatedriver.php"><?php echo $lang['UPDATE_DRIVER']?></a>
									</div>
									<div class="col-sm-1">
										<a class="btn btn-primary btn-block" href="../"><?php echo $lang['BACK']?></a>
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
