<?php
session_start();
require_once 'header.php';
?>
    
    <!-- Contact Section -->
    <section id="profile">
        <div class="container">
          <h1 class="page-header text-center">Thông tin cá nhân</h1>
          <div class="row">
            <!-- left column -->
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="text-center">
                <img src="http://lorempixel.com/200/200/people/9/" class="avatar img-circle img-thumbnail" alt="avatar">
                <h6>Cập nhật hình đại diện...</h6>
                <div class="row">
                    <div class="form-group col-xs-12">
                        <button onclick="contact_func()" type="submit" class="btn btn-success btn-sm">Cập nhật</button>
                    </div>
                </div>
              </div>
            </div>
            <!-- edit form column -->
            <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
              <form class="form-horizontal" role="form">
                <div class="form-group">
                  <label class="col-lg-3 control-label">Họ tên:</label>
                  <div class="col-lg-8">
                    <input class="form-control" value="Jane" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Email:</label>
                  <div class="col-lg-8">
                    <input class="form-control" value="janesemail@gmail.com" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Điện thoại:</label>
                  <div class="col-lg-8">
                    <input class="form-control" value="" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Chứng minh nhân dân:</label>
                  <div class="col-md-8">
                    <input class="form-control" value="janeuser" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label"></label>
                  <div class="col-md-8">
                    <input class="btn btn-primary" value="Lưu thay đổi" type="button">
                    <span></span>
                    <input class="btn btn-default" value="Quay lại" type="reset">
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
        var autocomplete;

        function initialize() {

            autocomplete = new google.maps.places.Autocomplete((document.getElementById('nav-search')), { types: ['geocode'] });
        }
    </script>
</body>
</html>
