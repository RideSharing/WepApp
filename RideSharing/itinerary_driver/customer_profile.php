<?php
session_start ();
if (! isset ( $_SESSION ["api_key"] )|| $_SESSION['driver'] == 'customer') {
	header ( 'Location: ../' );
	die ();
}
require_once '../header_master.php';
?>
<title>Customer Profile</title>
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
								<b>Customer Profile</b>
							</legend>
							<div class="form-group">
									<label class="col-lg-3 control-label"></label>
									<div class="col-lg-3" style="width: 180px; height: 150px;">
										<img src="" class="img-thumbnail"
											style="height: 150px; width: 180px;" id="customer_avatar"/>
									</div>
									<div class="col-lg-7" style="text-align: left;" >
										<label class="col-lg-3">Customer Name:</label>
										<label class="col-lg-4" id="customer_name"  style="text-align: left; color:#2C3E50; "></label>
									</div>
									<div class="col-lg-7" style="text-align: left;">
										<label class="col-lg-3" >Email:</label>
										<label class="col-lg-4" id="customer_email" style="text-align: left; color:#2C3E50; "></label>
									</div>
									<div class="col-lg-7" style="text-align: left;">
										<label class="col-lg-3">Phone Number:</label>
										<label class="col-lg-4" id="customer_phone" style="text-align: left; color:#2C3E50; "></label>
									</div>
									<div class="col-lg-7" style="text-align: left;">
										<label class="col-lg-3">Personal ID:</label>
										<label class="col-lg-4" id="customer_id" style="text-align: left; color:#2C3E50; "></label>
									</div>
									<div class="col-lg-7" style="text-align: left;">
										<label class="col-lg-7">Do you want to accept this itinerary?</label>
									</div>
									<div class="col-sm-7">
										<div class="col-lg-2">
											<input type="button" class="btn btn-primary btn-block" id="yes" value="Yes" />
										</div>
										<div class="col-lg-2">
											<input type="button" class="btn btn-primary btn-block" id="no" value="No" />
										</div>
										<div class="col-lg-2">
											<a class="btn btn-primary btn-block" href="detail_itinerary.php?itinerary_id=<?php echo $_REQUEST{'itinerary_id'}; ?>&driver=<?php echo $_REQUEST{'driver'}; ?>">Back</a>
										</div>
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
	 
	form_data.append("user_id",<?php echo $_REQUEST{'customer_id'};?>);
	
	$.ajax({
		url: '../controller/view_OtherProfile.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,         	                
        type: 'post',
        success: function(string){
        	 
        	var getData = $.parseJSON(string);

        	if(!getData['error']){
        		
        		$("#customer_avatar").attr('src','data:image/jpeg;base64,'+getData['link_avatar']);
        		document.getElementById("customer_name").innerHTML = getData['fullname'];
        		document.getElementById("customer_email").innerHTML = getData['email'];
        		document.getElementById("customer_phone").innerHTML = getData['phone'];
        		document.getElementById("customer_id").innerHTML = getData['personalID'];
        		
            }
        	
        }
    });

	$("#yes").click(function(){

		var form_data = new FormData(); 
		 
		form_data.append("itinerary_id",<?php echo $_REQUEST{'itinerary_id'};?>);

		$.ajax({
			url: '../controller/accept_itinerary.php', // point to server-side PHP script 
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
	        	
	        }
	    });
		
	});

	$('#no').click(function(){

		var form_data = new FormData();   
		
		form_data.append("itinerary_id",<?php echo $_REQUEST{'itinerary_id'}?>);
		
		$.ajax({
			url: '../controller/driver_reject_itinerary.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,         	                
            type: 'post',
            success: function(string){

            	var getData = $.parseJSON(string);

            	if(getData['error']){

            		showError(getData['message']);
            		
                }
            		
            	else {

            		showSuccess(getData['message']);

                }      	
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
