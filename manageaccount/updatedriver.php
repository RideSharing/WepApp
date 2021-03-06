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
<title><?php echo $lang['UPDATE_DRIVER'] ?></title>
	<!-- Header -->
	<header>
		<div class="container" style="padding-top: 100px">
			<div class="row">
				<div class="col-lg-12">
					<div class="intro-text">
						<!-- form -->
						<form class="form-horizontal">
							<fieldset>
								<legend><?php echo $lang['DRIVER_INFO'] ?></legend>
								<div class="form-group">
									<label class="col-sm-5 control-label"><?php echo $lang['AVATAR'] ?></label>
									<div class="col-sm-3" style="width: 180px; height: 150px;">
										<img src="" class="img-thumbnail"
											style="height: 150px; width: 180px;" id="avatar" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-5 control-label"><?php echo $lang['DRIVER_LICENSE'] ?></label>
									<div class="col-sm-4">
										<input type="text" class="form-control" name="driver_license"
											id="driver_license">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-5 control-label"><?php echo $lang['DRIVER_LICENSE_PHOTO'] ?></label>
									<input type="file" class="col-sm-4" name="imageDL"
										id="upimageDL">
									<div class="col-sm-4">
										<img src="" class="img-thumbnail"
											style="height: 200px; width: 400px;" id="imageDL" />
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-5 col-sm-1">
										<input class="btn btn-primary btn-block" type="button"
											name="request" id="request" value="<?php echo $lang['UPDATE']?>">
									</div>
									<div class="col-sm-2">
										<a class="btn btn-primary btn-block" href="vehicles.php"><?php echo $lang['VEHICLE_MANAGEMENT'] ?></a>
									</div>
									<div class="col-sm-1">
										<a class="btn btn-primary btn-block" href="../manageaccount"><?php echo $lang['BACK'] ?></a>
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

	var tmp;

	$.ajax({
		url: '../controller/getdriverinform.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        data: "nothing",         	                
        type: 'post',
        success: function(string){
            
        	var getData = $.parseJSON(string);
        	
        	if(!getData['error']){

        		$("#driver_license").val(getData['driver_license']);	
        		$("#imageDL").attr('src',"data:image/jpeg;base64,"+getData['driver_license_img']);

        		if($("#driver_license").val() == "" && $("#imageDL").attr('src') == "") {

        			tmp = 1;

        		}else {

        			tmp = 0;

        		}
        		
            }else {

            	showError(getData['message']);

                }
        	
        },
        error: function(){

        	showError("Error unknow! Can not get Data!");

            }
    });	

	$("#upimageDL").change(function(){
		
	    readURL(this,"#imageDL");
	    
	});

	$("#request").click(function(){

		var form_data = new FormData();  

		form_data.append("driver_license",$("#driver_license").val());

		var imageDL = $("#imageDL").attr('src');
		
		if(imageDL.indexOf("data:image/jpeg;base64,") == 0){

			var imageDLfix = imageDL.replace("data:image/jpeg;base64,","");

			form_data.append("driver_license_img",imageDLfix);

		}

		var link;

		if(tmp == 1) {

			link = '../controller/registerdriver.php';
			
		}else {

			link = '../controller/updatedriver.php';

		}
		
		$.ajax({
			url: link, // point to server-side PHP script 
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
</body>
</html>
