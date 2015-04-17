<!-- Footer -->
<footer class="text-center">
    <div class="footer-above">
        <div class="container">
            <div class="row">
                <div class="footer-col col-md-3">
                    <h3>Địa chỉ</h3>
                    <p>453 - 455 Hoàng Diệu<br>Hải Châu - Đà Nẵng</p>
                </div>
                <div class="footer-col col-md-4">
                    <h3>Tìm chúng tôi trên:</h3>
                    <ul class="list-inline">
                        <li>
                            <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-dribbble"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="footer-col col-md-5">
                    <h3>Thông tin về RideSharing</h3>
                    <p>RideSharing là hệ thống cho phép đi chung xe phát triển bởi <a href="#">RideSharing Group</a>.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    Bản quyền thuộc về &copy; Ride Sharing Group 2015
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="scroll-top page-scroll visible-xs visble-sm">
    <a class="btn btn-primary" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>

<!-- jQuery -->
<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="../js/classie.js"></script>
<script src="../js/cbpAnimatedHeader.js"></script>

<!-- Contact Form JavaScript -->
<script src="../js/jqBootstrapValidation.js"></script>
<script src="../js/contact_me.js"></script>
<script src="../js/toastr.js"></script>
<script src="../js/BeatPicker.min.js"></script>
<script src="../js/markerclusterer_compiled.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/freelancer.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
<script>
    function showSuccess(message) {
        toastr.options = {
            "positionClass": "toast-bottom-right",
            "closeButton": true
        };
        toastr["success"](message);
    }

    function showError(message) {
        toastr.options = {
            "positionClass": "toast-bottom-right",
            "closeButton": true
        };
        toastr["error"](message);
    }
    function log_func() {
        // get values from FORM
        var _data = "email="+$("#log_email").val()+"&password="+$("#log_password").val();

        $.ajax({
			url: 'controller/checkLogin.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            data: _data,         	                
            type: 'post',
            success: function(string){
                
            	var getData = $.parseJSON(string);
            	
            	if(getData['error']){

            		showError(getData['message']);
            		
                }else{
					
                	location.reload();

                }
            	
            },
            error: function(){

            	showError("Error unknow!");

                }
        });
        
    }
    function change_mode(message){
    	$.ajax({
			url: '../controller/changemode.php', // point to server-side PHP script 
            cache: false,
            data: "nothing",         	                
            type: 'post',
            success: function(){
                showSuccess("Change mode to "+ message +" successful!");
            }
		});
    }
</script>
<script>
$('document').ready(function(){

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

	        	showError("Can not get your avatar!");

	            }
	    	
	    },
	    error: function(){

	    	showError("Error unknow!");

	        }
	});

	$('#driver').click(
			function(){
				
				if("<?php echo $_SESSION['driver'];?>" == 'driver') {

					showSuccess("You're already a Driver!");
					
				} else {

					change_mode("driver");

					location.reload();
					
				}

			}
	);

	$('#customer').click(
			function(){
					
				if("<?php echo $_SESSION['driver'];?>" == 'customer') {

					showSuccess("You're already a Customer!");
					
				} else {

					change_mode("customer");

					location.reload();
					
				}
				
			}
	);
	
});
</script>