<?php
session_start();
require_once 'header.php';
?>
    <!-- Header -->
    <header>
        <div class="container" style="padding-top:100px">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" style="max-width: 15%;" src="img/motor.png" alt="">
                    <div class="intro-text">
                        <span class="name">Bạn muốn tìm xe để đi chung?</span>
                        <hr class="star-light">
                        <form name="search" novalidate>
                            <div class="row control-group" style="border: 1px solid #eee;">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <span style="font-size: 35px  !important; position: absolute; z-index: 10; color: rgba(0, 0, 0, 0.55); top: 5px; left: 10px;"><i class="fa fa-map-marker"></i></span>
                                    <input searchQry style="margin-top:10px;" type="text" class="form-control" placeholder="Nhập địa điểm mà bạn muốn đến..." id="searchQry" required data-validation-required-message="Vui lòng nhập địa điểm cần đến.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <br>
                            <div class="col-lg-8 col-lg-offset-2 text-center">
                                <button type="submit" onclick="searchFunc()" class="btn btn-lg btn-outline">
                                    <i class="fa fa-search"></i> Tìm kiếm
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
                    <h2>Nhận xét của khách hàng</h2>
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
                        <img src="img/portfolio/fb.png" class="img-responsive customer-img" alt="">
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
                        <img src="img/portfolio/obama.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/circus.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/game.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/safe.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/submarine.png" class="img-responsive" alt="">
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
                    <h2>Đăng kí</h2>
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
                                <label>Địa chỉ email</label>
                                <input type="email" class="form-control" placeholder="Địa chỉ email" id="reg_email" required data-validation-required-message="Vui lòng nhập địa chỉ email của bạn.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Mật khẩu</label>
                                <input type="password" class="form-control" placeholder="Nhập mật khẩu..." id="reg_password" required data-validation-required-message="Vui lòng nhập mật khẩu.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="reg_success"></div>
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2 text-center">
                                <div id="action"></div>
                                <button onclick="register_func()" href="#" class="btn btn-lg btn-outline1">
                                    <i class="fa fa-bus"></i> Đăng kí
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
                    <h2>Nhóm tác giả</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <img src="img/hoang.png" class="img-responsive circle-member center-block" alt="">
                    <h4 class="text-center">Nguyễn Trần Tấn Hoàng</h4>
                    <p class="text-center">Trưởng dự án - Sinh viên đại học Bách Khoa Đà Nẵng, lập trình viên front-end.</p>
                </div>
                <div class="col-lg-4">
                    <img src="img/thanh.png" class="img-responsive circle-member center-block" alt="">
                    <h4 class="text-center">Trần Duy Thành</h4>
                    <p class="text-center">Trưởng nhóm - Sinh viên đại học Bách Khoa Đà Nẵng, lập trình viên back-end.</p>
                </div>
                <div class="col-lg-4">
                    <img src="img/vi.png" class="img-responsive circle-member center-block" alt="">
                    <h4 class="text-center">Lê Trung Vĩ</h4>
                    <p class="text-center">Sinh viên đại học Bách Khoa Đà Nẵng, lập trình viên front-end.</p>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-4">
                    <img src="img/cuong.png" class="img-responsive circle-member center-block" alt="">
                    <h4 class="text-center">Nguyễn Nhật Cường</h4>
                    <p class="text-center">Sinh viên đại học Sư phạm Đà nẵng, lập trình viên ứng dụng Android.</p>
                </div>
                <div class="col-lg-4">
                    <img src="img/huy.png" class="img-responsive circle-member center-block" alt="">
                    <h4 class="text-center">Bùi Quang Huy</h4>
                    <p class="text-center">Sinh viên đại học Sư phạm Đà nẵng, lập trình viên ứng dụng Android.</p>
                </div>
                <div class="col-lg-4">
                    <img src="img/trung.png" class="img-responsive circle-member center-block" alt="">
                    <h4 class="text-center">Nguyễn Quang Trung</h4>
                    <p class="text-center">Sinh viên đại học Sư phạm Đà nẵng, lập trình viên ứng dụng Window Phone.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Liên hệ với chúng tôi</h2>
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
                                <label>Họ tên</label>
                                <input type="text" class="form-control" placeholder="Họ tên" id="contact_name" required data-validation-required-message="Vui lòng nhập họ tên của bạn.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Địa chỉ email</label>
                                <input type="email" class="form-control" placeholder="Địa chỉ email" id="contact_email" required data-validation-required-message="Vui lòng nhập địa chỉ email.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Nội dung liên hệ</label>
                                <textarea rows="5" class="form-control" placeholder="Nội dung" id="contact_message" required data-validation-required-message="Vui lòng nhập nội dung liên hệ."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="contact_success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button onclick="contact_func()" type="submit" class="btn btn-success btn-lg">Gửi liên hệ</button>
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

        window.location.href = "search-itinerary.php?searchQry=" + $('#searchQry').val();
    }

    $(function() {
        $("input,textarea").jqBootstrapValidation({
            preventSubmit: true,
            submitError: function($form, event, errors) {
                showError('Có lỗi xảy ra!');
            },
            submitSuccess: function($form, event) {
                event.preventDefault(); // prevent default submit behaviour
                
                if ($("input#ireg").val() == 'reg') {
                    // get values from FORM
                    var _email = $("input#reg_email").val();
                    var _password = $("input#reg_password").val();

                    $.post("controller/register.php",
                    {
                        email: _email,
                        password: _password
                    },
                    function(data, status){
                        data = data.split('&');
                        error = data[0];
                        message = data[1];
                        if (status == "success" && !error) {
                            // Success message
                            $('#reg_success').html("<div class='alert alert-success'>");
                            $('#reg_success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                                .append("</button>");
                            $('#reg_success > .alert-success')
                                .append("<strong>"+ message + "!</strong>");
                            $('#reg_success > .alert-success')
                                .append('</div>');

                            //clear all fields
                            $('#regForm').trigger("reset");
                        } else {
                            // Fail message
                            $('#reg_success').html("<div class='alert alert-danger'>");
                            $('#reg_success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                                .append("</button>");
                            $('#reg_success > .alert-danger').append("<strong>" + message!=""?message:"Xin lỗi, có lỗi xảy ra trong quá trình đăng kí. Vui lòng thử lại sau!" +"</strong>");
                            $('#reg_success > .alert-danger').append('</div>');
                            //clear all fields
                            $('#regForm').trigger("reset");
                        }
                    });
                } else if ($("input#icontact").val() == 'contact') {
                    var _message = $("textarea#contact_message").val();
                    var _email = $("input#contact_email").val();
                    var _name = $("input#contact_name").val();

                    var firstName = _name; // For Success/Failure Message

                    // Check for white space in name for Success/Fail message
                    if (firstName.indexOf(' ') >= 0) {
                        firstName = _name.split(' ')[_name.split(' ').length - 1];
                    }

                    $.post("controller/feedback.php",
                    {
                        email: _email,
                        name: _name,
                        message: _message
                    },
                    function(data, status){
                        data = data.split('&');
                        error = data[0];
                        message = data[1];
                        if (status == "success" && error == 0) {
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
                            $('#contact_success > .alert-danger').append("<strong>Xin lỗi " + firstName + ", có vẻ như có lỗi xảy ra trong quá trình gửi liên lạc. Bạn vui lòng thử lại sau!");
                            $('#contact_success > .alert-danger').append('</div>');
                            //clear all fields
                            $('#contactForm').trigger("reset");
                        }
                    });
                }
            },
            filter: function() {
                return $(this).is(":visible");
            },
        });

        $("a[data-toggle=\"tab\"]").click(function(e) {
            e.preventDefault();
            $(this).tab("show");
        });
    });
</script>
</body>
</html>
