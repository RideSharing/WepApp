<?php
session_start ();
if (! isset ( $_SESSION ["api_key"] )) {
	header ( 'Location: ../' );
	die ();
}
require_once '../header_master.php';
?>
<title>Manage Vehicles</title>
<!-- Header -->
<header>
	<div class="container" style="padding-top: 100px">
		<div class="row">
		<!-- form -->
			<form class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-5 control-label">Choose your vehicle to view information</label>
					<div class="col-sm-4">
						<select class="selectpicker">
							<option>Mustard</option>
							<option>Ketchup</option>
							<option>Relish</option>
						</select>
					</div>
				</div>
			</form>
		</div>
	</div>
</header>

<?php
require_once '../footer_master.php';
?>
</body>
</html>