<!-- Footer -->
<footer class="text-center">
    <div class="footer-above">
        <div class="container">
            <div class="row">
                <div class="footer-col col-md-3">
                    <h3><?php echo $lang['ADDRRESS']?></h3>
                    <p><?php echo $lang['HOANG_DIEU']?><br><?php echo $lang['HC_DN']?></p>
                </div>
                <div class="footer-col col-md-4">
                    <h3><?php echo $lang['FIND_US']?></h3>
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
                    <h3><?php echo $lang['ABOUT_RIDESHARING']?></h3>
                    <p><?php echo $lang['RIDESHARING_DEVELOPED_BY']?> <a href="#"><?php echo $lang['RIDESHARING_TEAM']?></a>.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php echo $lang['COPYRIGHT_BY']?> &copy; <?php echo $lang['RIDESHARING_TEAM_2015']?>
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
                        <h2>Customer feedback</h2>
                        <hr class="star-primary">
                        <img src="img/portfolio/fb.png" class="img-responsive img-centered" alt="">
                        <p>Feedback can help guide your decision-making and point out subtle tweaks that may benefit your product. It’s also essential for measuring customer satisfaction among your current customers. !</p>
                        <ul class="list-inline item-details">
                            <li>Client:
                                <strong><a href="http://bao.com">Nguyễn Thiên Hồng Bảo</a>
                                </strong>
                            </li>
                            <li>Date:
                                <strong><a href="http://bao.com">April 2014</a>
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
            <h4 class="modal-title" id="myModalLabel"><?php echo $lang['LOGON']?></h4>
            </div>
            <form novalidate>
            <div class="modal-body">
            
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label><?php echo $lang['EMAIL']?></label>
                                    <input type="email" class="form-control" placeholder="<?php echo $lang['EMAIL']?> 	..." id="log_email" required data-validation-required-message="<?php echo $lang['EMAIL_REQUIRED']?>">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label><?php echo $lang['PASSWORD']?></label>
                                    <input type="password" class="form-control" placeholder="<?php echo $lang['PASSWORD']?> ..." id="log_password" required data-validation-required-message="<?php echo $lang['PASSWORD_REQUIRED']?>">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <br>
                            <div>
                            	<a href="#" data-toggle="modal" data-target="#forgotPassModal"><?php echo $lang['FORGOT_PASSWORD']?> </a>
                            </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <div id="action"></div>
                        <button onclick="log_func()" href="#" class="btn btn-lg btn-outline1"> <?php echo $lang['LOGON']?></button>
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
            <h4 class="modal-title" id="myModalLabel"><?php echo $lang['FORGOT_PASSWORD']?></h4>
            </div>
            <form novalidate>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label><?php echo $lang['EMAIL']?></label>
                                    <input type="email" class="form-control" placeholder="<?php echo $lang['EMAIL']?>" id="forgot_email" required data-validation-required-message="<?php echo $lang['EMAIL_REQUIRED']?>">
                                    <p class="help-block text-danger"></p>                        			
                                </div>
                        		
                    		</div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <button onclick="getPass_func()" href="#" class="btn btn-lg btn-outline1"><?php echo $lang['REQUEST']?></button>
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
    
    function change_mode(){
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

    function change_lang(){
    	$.ajax({
			url: 'controller/change_Lang.php', // point to server-side PHP script 
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
		if(isset($_COOKIE['lang'])) {
			if ($_COOKIE['lang'] == "en") {
			
    ?>
		showSuccess("You became the <?php echo $_SESSION['driver']; ?>!");
	<?php 	

			} else {
	?>
		showSuccess("Bạn đã trở thành <?php echo $_SESSION['driver']; ?>!");
	<?php 
			}
		} else {
	?>
		showSuccess("You became the <?php echo $_SESSION['driver']; ?>!");
	<?php 
		}
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
	    		
	        }
	    }
	});

	$('#driver').click(function(){
	
		if("<?php echo $_SESSION['driver'];?>" == 'driver') {
			<?php 
				
				if(isset($_COOKIE['lang'])) {
					if ($_COOKIE['lang'] == "en") {
					
		    ?>
						showSuccess("You're already a Driver!");
			<?php 	

					} else {
			?>
						showSuccess("Bạn hiện đang là Driver!");
			<?php 
					}
				} else {
			?>
					showSuccess("You're already a Driver!");
			<?php 
				}
			?>
		} else {
			
			change_mode();
			
		}
		 
	});

	$('#customer').click(function(){
					
		
		if("<?php echo $_SESSION['driver'];?>" == 'customer') {
			<?php 
					
					if(isset($_COOKIE['lang'])) {
						if ($_COOKIE['lang'] == "en") {
						
			    ?>
							showSuccess("You're already a Customer!");
				<?php 	

						} else {
				?>
							showSuccess("Bạn hiện đang là Customer!");
				<?php 
						}
					} else {
				?>
						showSuccess("You're already a Customer!");
				<?php 
					}
				?>
		} else {
			
			change_mode();
						
		}
				
	});
	
});
</script>