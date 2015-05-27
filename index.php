<?php
session_start();

if(isset($_COOKIE['lang'])) {
    if ($_COOKIE['lang'] == "en") {
        require_once 'includes/lang_en.php';
    } else {
        require_once 'includes/lang_vi.php';
    }
} else {
    setcookie('lang', 'en', time() + (86400 * 365), "/");
    require_once 'includes/lang_en.php';
}

require_once 'header.php';
?>
    <!-- Header -->
    <header>
        <div class="container" style="padding-top:100px">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" style="max-width: 15%;" src="images/motor.png" alt="">
                    <div class="intro-text">
                        <span class="name"><?php echo $lang['YOU_WANT_FIND_MOTORBIKE'] ?></span>
                        <hr class="star-light">
                        <form name="search" novalidate>
                            <div class="row control-group" style="border: 1px solid #eee;">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <span style="font-size: 35px  !important; position: absolute; z-index: 10; color: rgba(0, 0, 0, 0.55); top: 5px; left: 10px;"><i class="fa fa-map-marker"></i></span>
                                    <input style="margin-top:10px;" type="text" class="form-control" placeholder="<?php echo $lang['ADDRESS_ENTER'];?>" id="searchQry" required data-validation-required-message="<?php echo $lang['ADDRESS_REQUIRED'];?>">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <br>
                            <div class="col-lg-8 col-lg-offset-2 text-center">
                                <button type="submit" onclick="searchFunc()" class="btn btn-lg btn-outline">
                                    <i class="fa fa-search"></i> <?php echo $lang['SEARCH'] ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2><?php echo $lang['CUSTOMER_FEEDBACK'] ?></h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                                <p class="text-center">"Tuyệt vời ông mặt trời, tôi chưa bao giờ thấy trang web nào đẹp như thế này!" -Mark Zuckerberg - CEO FaceBook.</p>
                            </div>
                        </div>
                        <img src="images/portfolio/fb.png" class="img-responsive customer-img" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                                <p class="text-center">"Một trang web phải gọi là đỉnh của đỉnh, các chú đúng là không phải dạng vừa đâu!" -Obama - Tổng thống Mỹ.</p>
                            </div>
                        </div>
                        <img src="images/portfolio/obama.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="images/portfolio/circus.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="images/portfolio/game.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="images/portfolio/safe.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="images/portfolio/submarine.png" class="img-responsive" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <?php
    if (!isset($_SESSION['api_key'])) {
    ?>
    <!-- Contact Section -->
    <section id="register">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2><?php echo $lang['REGISTER']?></h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                    <form name="register" id="regForm" novalidate>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label><?php echo $lang['EMAIL']?></label>
                                <input type="email" class="form-control" placeholder="<?php echo $lang['EMAIL']?>" id="reg_email" required data-validation-required-message="<?php echo $lang['EMAIL_REQUIRED'];?>">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label><?php echo $lang['PASSWORD']?></label>
                                <input type="password" class="form-control" placeholder="<?php echo $lang['PASSWORD']?>" id="reg_password" required data-validation-required-message="<?php echo $lang['PASSWORD_REQUIRED'];?>">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="reg_success"></div>
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2 text-center">
                                <div id="action"></div>
                                <button class="btn btn-lg btn-outline1" id="reg_button">
                                    <i class="fa fa-bus"></i> <?php echo $lang['REGISTER']?>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php 
    }
    ?>

    <!-- About Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2><?php echo $lang['AUTHOR']?></h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <img src="images/hoang.png" class="img-responsive circle-member center-block" alt="">
                    <h4 class="text-center"><?php echo $lang['HOANG_NAME'] ?></h4>
                    <p class="text-center"> <?php echo $lang['CLASST3_UNIVERSITY'] ?> <br><?php echo $lang['FRONT_END'] ?></p>
                </div>
                <div class="col-lg-6">
                    <img src="images/thanh.png" class="img-responsive circle-member center-block" alt="">
                    <h4 class="text-center"><?php echo $lang['THANH_NAME'] ?></h4>
                    <p class="text-center"><?php echo $lang['CLASST1_UNIVERSITY'] ?><br><?php echo $lang['BACK_END'] ?> </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2><?php echo $lang['CONTACT']?></h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label><?php echo $lang['FULLNAME']?></label>
                                <input type="text" class="form-control" placeholder="<?php echo $lang['FULLNAME']?>" id="contact_name" required data-validation-required-message="<?php echo $lang['NAME_REQUIRED'];?>">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label><?php echo $lang['EMAIL']?></label>
                                <input type="email" class="form-control" placeholder="<?php echo $lang['EMAIL']?>" id="contact_email" required data-validation-required-message="<?php echo $lang['EMAIL_REQUIRED'];?>">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label><?php echo $lang['FEEDBACK_CONTENT']?></label>
                                <textarea rows="5" class="form-control" placeholder="<?php echo $lang['FEEDBACK_CONTENT']?>" id="contact_message" required data-validation-required-message="<?php echo $lang['CONTENT_REQUIRED'];?>"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="contact_success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button class="btn btn-success btn-lg" id="contact_button"><?php echo $lang['SEND_FEEDBACK']?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php
    require_once 'footer.php';
    ?>
<script>
	$('#lang_vie').click(function(){
		
		<?php if ($_COOKIE['lang'] == "en") {?>
				change_lang();
		<?php }?>
		
		 
	});
	
	$('#lang_eng').click(function(){
		
		<?php if ($_COOKIE['lang'] == "vi") {?>
				change_lang();
		<?php }?>
		
	});
	$('#reg_button').click(function() {
	
		var _data = "email="+$("#reg_email").val()+"&password="+$("#reg_password").val();
	
		$.ajax({
			url: 'controller/checkRegister.php', // point to server-side PHP script 
		    dataType: 'text',  // what to expect back from the PHP script, if anything
		    cache: false,
		    data: _data,         	                
		    type: 'post',
		    success: function(string){
		    	var getData = $.parseJSON(string);
		    	var message = getData['message'];

                alert(getData['error']);
		    	
		    	if(!getData['error']){
	
			    	//success message
		    		$('#reg_success').html("<div class='alert alert-success'>");
	                $('#reg_success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
	                    .append("</button>");
	                $('#reg_success > .alert-success')
	                    .append("<strong>"+ message + "!</strong>");
	                $('#reg_success > .alert-success')
	                    .append('</div>');
	
	                //clear all fields
	                $('#regForm').trigger("reset");
	
		    		showSuccess(getData['message']);
		    		
		        }else {
	
		        	// Fail message
	                $('#reg_success').html("<div class='alert alert-danger'>");
	                $('#reg_success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
	                    .append("</button>");
	                $('#reg_success > .alert-danger').append("<strong>" + message!=""?message:"Xin lỗi, có lỗi xảy ra trong quá trình đăng kí. Vui lòng thử lại sau!" +"</strong>");
	                $('#reg_success > .alert-danger').append('</div>');
	                //clear all fields
	                $('#regForm').trigger("reset");
	
		        	showError(getData['message']);
	
		            }
		    	
		    }
		});
		
	});

	$('#contact_button').click(function() {

		var _data = "email="+$("#contact_email").val()+"&name="+$("#contact_name").val()+"&content="+$('#contact_message').val();
		
		$.ajax({
			url: 'controller/feedback.php', // point to server-side PHP script 
		    dataType: 'text',  // what to expect back from the PHP script, if anything
		    cache: false,
		    data: _data,         	                
		    type: 'post',
		    success: function(string){
		        
		    	var getData = $.parseJSON(string);
		    	var message = getData['message'];
		    	
		    	if(!getData['error']){
	
		    		// Success message
                    $('#contact_success').html("<div class='alert alert-success'>");
                    $('#contact_success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#contact_success > .alert-success')
                        .append("<strong>"+message+"</strong>");
                    $('#contact_success > .alert-success')
                        .append('</div>');

                    //clear all fields
                    $('#contactForm').trigger("reset");
                } else {
                    // Fail message
                    $('#contact_success').html("<div class='alert alert-danger'>");
                    $('#contact_success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#contact_success > .alert-danger').append("<strong>Xin lỗi " + $("#contact_name").val() + ", có vẻ như có lỗi xảy ra trong quá trình gửi liên lạc. Bạn vui lòng thử lại sau!");
                    $('#contact_success > .alert-danger').append('</div>');
                    //clear all fields
                    $('#contactForm').trigger("reset");
                }
		    	
		    }
		});
		
	});

</script>
<script>
    // This example displays an address form, using the autocomplete feature
    // of the Google Places API to help users fill in the information.

    var autocomplete;

    function initialize() {
        // Create the autocomplete object, restricting the search
        // to geographical location types.
        autocomplete = new google.maps.places.Autocomplete((document.getElementById('searchQry')), { types: ['geocode'] });
        autocomplete = new google.maps.places.Autocomplete((document.getElementById('nav-search')), { types: ['geocode'] });

        <?php
        if (isset($_SESSION["message"])) {
            if (isset($_SESSION["error"])) {
        ?>
        showError('<?php echo $_SESSION["message"] ?>');
        <?php
            } else {
        ?>
        showSuccess('<?php echo $_SESSION["message"] ?>');
        <?php
            }
        $_SESSION["message"] = NULL;
        $_SESSION["error"] = NULL;
        };
        ?>
    }

    function register_func() {
        //Insert action when button is click (Regster form and Contact form)
        $('#action').html('<input type="hidden" value="reg" id="ireg">');
    }

    function contact_func() {
        //Insert action when button is click (Regster form and Contact form)
        $('#action').html('<input type="hidden" value="contact" id="icontact">');
    }

    function searchFunc() {

        if($('#searchQry').val() != ""){

            <?php 
            if (isset($_SESSION['api_key'])) {
            ?>
        	window.location.href = "itinerary_customer?End_Address=" + $('#searchQry').val();

        	<?php 
            } else {
            ?>
            showError('You have to login first!')
            <?php 
            }
            ?>
        }
    
    }

    $(function() {
        $("input,textarea").jqBootstrapValidation({
            preventSubmit: true,
            submitSuccess: function($form, event) {
                event.preventDefault(); // prevent default submit behaviour
            }
        });

        $("a[data-toggle=\"tab\"]").click(function(e) {
            e.preventDefault();
            $(this).tab("show");
        });
    });
</script>
</body>
</html>
