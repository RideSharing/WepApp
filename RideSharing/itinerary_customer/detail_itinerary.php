<?php
session_start ();
if (! isset ( $_SESSION ["api_key"] )|| $_SESSION['driver'] == 'driver') {
	header ( 'Location: ../' );
	die ();
}
require_once '../header_master.php';
?>
<title>Detail Itinerary</title>
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
								<div class="col-sm-4 control-label" style="text-align: left;">
									<a href="driver_profile.php?driver_id=<?php echo $_REQUEST{'driver_id'}?>" style="color: blue; text-decoration: underline;" data-toggle="tooltip" data-original-title="Click to see Driver Information"><?php echo $_REQUEST{'driver'}?></a>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label">Start Place:</label>
								<label class="col-sm-4 control-label" id="start_address" style="text-align: left; color:maroon; "></label>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label">End Place:</label>
								<label class="col-sm-4 control-label" id="end_address" style="text-align: left; color:maroon; "></label>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label">Departure Time:</label>
								<label class="col-sm-4 control-label" id="time" style="text-align: left; color:maroon; "></label>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label">Duration:</label>
								<label class="col-sm-4 control-label" id="duration" style="text-align: left; color:maroon; "></label>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label">Distance:</label>
								<label class="col-sm-4 control-label" id="distance" style="text-align: left; color:maroon; "></label>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label">Cost:</label>
								<label class="col-sm-4 control-label" id="cost" style="text-align: left; color:maroon; "></label>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label">Description:</label>
								<label class="col-sm-4 control-label" id="description" style="text-align: left; color:maroon; "></label>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-5 col-sm-2">
									<input class="btn btn-primary btn-block" type="button"
										id="join" value="Join in Itinerary">
								</div>
								<div class="col-sm-2">
									<a class="btn btn-primary btn-block" href="../itinerary_customer">Back</a>
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
	 
	form_data.append("itinerary_id",<?php echo $_REQUEST{'itinerary_id'}?>);
	
	$.ajax({
		url: '../controller/detail_itinerary.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,         	                
        type: 'post',
        success: function(string){
        	 
        	var getData = $.parseJSON(string);

        	if(!getData['error']){

        		document.getElementById("start_address").innerHTML = getData['start_address'];
        		document.getElementById("end_address").innerHTML = getData['end_address'];
        		document.getElementById("time").innerHTML = getData['leave_date'];
        		document.getElementById("duration").innerHTML = getData['duration']+" minutes";
        		document.getElementById("distance").innerHTML = getData['distance']+" km";
        		document.getElementById("cost").innerHTML = "VND "+getData['cost'];
        		document.getElementById("description").innerHTML = getData['description'];
        		
            }
        	
        }
    });

	$("#join").click(function(){

		var form_data = new FormData();   
		
		form_data.append("itinerary_id",<?php echo $_REQUEST{'itinerary_id'}?>);
		
		$.ajax({
			url: '../controller/join_itinerary.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,         	                
            type: 'post',
            success: function(string){

            	var getData = $.parseJSON(string);

            	if(getData['error'])
            		showError(getData['message']);
            	else
            		showSuccess(getData['message']);
            }
        });

	});

	// Initialize tooltip
    $('[data-toggle="tooltip"]').tooltip({
        placement : 'top'
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
