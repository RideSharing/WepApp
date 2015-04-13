<?php
session_start ();
if (! isset ( $_SESSION ["api_key"] )) {
	header ( 'Location: ../' );
	die ();
}
require_once '../header_master.php';
?>
<!-- Header -->
<header>
	<div class="container" style="padding-top: 100px">
		<div class="row">
			<div class="col-lg-12">
				<div class="intro-text">
					<!-- form -->
					<form class="form-horizontal">
						<fieldset>
							<legend>
								<b>Itinerary Detail</b>
							</legend>
							<div class="form-group">
								<label class="col-sm-5 control-label">Driver Name:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" value="<?php echo $_REQUEST{'drivername'}?>" id="drivername" disabled>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label">Email:</label>
								<div class="col-sm-4">
									<input type="email" class="form-control" id="email" disabled>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label">Phone Number:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="phonenumber" disabled>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label">Personal ID Image</label>
								<div class="col-sm-4">
									<img src="" class="img-thumbnail"
										style="height: 200px; width: 400px;" id="imageID" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label">Driver License Image</label>
								<div class="col-sm-4">
									<img src="" class="img-thumbnail"
										style="height: 200px; width: 400px;" id="imageID" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-5 col-sm-2">
									<input class="btn btn-primary btn-block" type="button"
										id="update" value="Join in Itinerary">
								</div>
								<div class="col-sm-2">
									<a class="btn btn-primary btn-block" href="../itinerary">Back</a>
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
	var form_data = new FormData();  
	form_data.append("itinerary_id",<?php echo $_REQUEST{'itinerary_id='};?>);
	$.ajax({
		url: '../controller/detail_itinerary.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
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
</script>
<!-- Plugin JavaScript -->
<script
	src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/classie.js"></script>
<script src="js/cbpAnimatedHeader.js"></script>
</body>
</html>
