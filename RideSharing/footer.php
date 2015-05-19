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

<!-- Portfolio Modals -->
<div class="portfolio-modal modal fade" id="portfolioModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <h2>Project Title</h2>
                        <hr class="star-primary">
                        <img src="img/portfolio/fb.png" class="img-responsive img-centered" alt="">
                        <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                        <ul class="list-inline item-details">
                            <li>Client:
                                <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                </strong>
                            </li>
                            <li>Date:
                                <strong><a href="http://startbootstrap.com">April 2014</a>
                                </strong>
                            </li>
                            <li>Service:
                                <strong><a href="http://startbootstrap.com">Web Development</a>
                                </strong>
                            </li>
                        </ul>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title" id="myModalLabel">Đăng nhập hệ thống</h4>
            </div>
            <form novalidate>
            <div class="modal-body">
            
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label>Địa chỉ email</label>
                                    <input type="email" class="form-control" placeholder="Địa chỉ email" id="log_email" required data-validation-required-message="Vui lòng nhập địa chỉ email của bạn.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label>Mật khẩu</label>
                                    <input type="password" class="form-control" placeholder="Nhập mật khẩu..." id="log_password" required data-validation-required-message="Vui lòng nhập mật khẩu.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <br>
                            <div>
                            	<a href="#" data-toggle="modal" data-target="#forgotPassModal">Forgotten password? </a>
                            </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <div id="action"></div>
                        <button onclick="log_func()" href="#" class="btn btn-lg btn-outline1"> Đăng nhập</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="forgotPassModal" tabindex="-1" role="dialog" aria-labelledby="forgotPassModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title" id="myModalLabel">Forgot Password</h4>
            </div>
            <form novalidate>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label>Email</label>
                                    <input type="email" class="form-control" placeholder="Email" id="forgot_email" required data-validation-required-message="Vui lòng nhập địa chỉ email của bạn.">
                                    <p class="help-block text-danger"></p>                        			
                                </div>
                        		
                    		</div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <button onclick="getPass_func()" href="#" class="btn btn-lg btn-outline1">Request</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
    

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/classie.js"></script>
<script src="js/cbpAnimatedHeader.js"></script>

<!-- Contact Form JavaScript -->
<script src="js/jqBootstrapValidation.js"></script>
<script src="js/contact_me.js"></script>
<script src="js/toastr.js"></script>
<script src="js/BeatPicker.min.js"></script>
<script src="js/markerclusterer_compiled.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/freelancer.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
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

    function getPass_func() {
        // get values from FORM
        var _data = "email="+$("#forgot_email").val();

        $.ajax({
			url: 'controller/forgotpass.php', // point to server-side PHP script 
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            data: _data,         	                
            type: 'post',
            success: function(string){
                
            	var getData = $.parseJSON(string);
            	var message = getData['message'];
            	
            	if(getData['error']){

            		showError(getData['message']);
            		
                }else{
					
                	showSuccess(getData['message']);

                }
            	
            },
            error: function(){

            	showError("Error unknow!");

                }
        });
        
    }
    
    function change_mode(message){
    	$.ajax({
			url: 'controller/changemode.php', // point to server-side PHP script 
            cache: false,
            data: "nothing",         	                
            type: 'post',
            success: function(){
            	location.reload();
            }
		});
    }
</script>
<script>
$('document').ready(function(){

	<?php 
	if(isset($_SESSION['showMessage'])){
	?>
		showSuccess("You became to <?php echo $_SESSION['driver'];?>!");
	<?php	
		$_SESSION['showMessage'] = null;
	}
	?>

	$.ajax({
		url: 'controller/get_avatar.php', // point to server-side PHP script 
	    dataType: 'text',  // what to expect back from the PHP script, if anything
	    cache: false,
	    data: "nothing",         	                
	    type: 'post',
	    success: function(string){
	        
	    	var getData = $.parseJSON(string);
	    	
	    	if(!getData['error']){

	    		$("#mini_avatar").attr('src',"data:image/jpeg;base64,"+getData['link_avatar']);
	    		
	        }else {

	        	showError("Can not get your avatar!");

	            }
	    	
	    },
	    error: function(){

	    	showError("Error unknow!");

	        }
	});

	$('#driver').click(function(){
	
		if("<?php echo $_SESSION['driver'];?>" == 'driver') {
	
			showSuccess("You're already a Driver!");
			
		} else {
			
			change_mode("driver");
			
		}
		 
	});

	$('#customer').click(function(){
					
		
		if("<?php echo $_SESSION['driver'];?>" == 'customer') {

			showSuccess("You're already a Customer!");
			
		} else {
			
			change_mode("customer");
						
		}
				
	});
	
});
</script>