<?php
session_start();
require_once 'header.php';
?>
    <!-- Contact Section -->
    <section id="profile">
      
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