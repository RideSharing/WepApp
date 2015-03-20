<div class="row">
	<div id="breadcrumb" class="col-xs-12">
		<a href="#" class="show-sidebar">
			<i class="fa fa-bars"></i>
		</a>
		<ol class="breadcrumb pull-left">
			<li><a href="#">Dashboard</a></li>
			<li><a href="#">Tables</a></li>
			<li><a href="#">Data Tables</a></li>
		</ol>
		<div id="social" class="pull-right">
			<a href="#"><i class="fa fa-google-plus"></i></a>
			<a href="#"><i class="fa fa-facebook"></i></a>
			<a href="#"><i class="fa fa-twitter"></i></a>
			<a href="#"><i class="fa fa-linkedin"></i></a>
			<a href="#"><i class="fa fa-youtube"></i></a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
					<thead>
						<tr>
							<th>No</th>
							<th>Full Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Personal ID</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<!-- Start: list_row -->
						<?php
						require_once '/Config.php';
						$ch = curl_init();

						curl_setopt($ch, CURLOPT_URL, "http://localhost/RESTFul/v1/staff/user");
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch,CURLOPT_HTTPHEADER,array('Authorization: 1960b607ce2d462afff9b9644284490e'));

						// execute the request
						$result = curl_exec($ch);

						// close curl resource to free up system resources
						curl_close($ch);

						$json = json_decode($result);
						$res = $json->{'users'};
						$i = 1;
						foreach ($res as $value) {
						?>
						<tr>
							<td><?php echo $i++ ?></td>
							<td><img class="img-rounded" src="data:image/jpeg;base64,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" alt="">
								<?php echo $value->{'fullname'}==NULL?' ':$value->{'fullname'} ?>
							</td>
							<td><?php echo $value->{'email'}==NULL?' ':$value->{'email'} ?></td>
							<td><?php echo $value->{'phone'}==NULL?' ':$value->{'phone'} ?></td>
							<td><?php echo $value->{'personalID'}==NULL?' ':$value->{'personalID'} ?></td>
							<td><?php 
									if ($value->{'status'}==2) {
								?>		
								<div class="progress">
									<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
										<span>66%</span>
									</div>
								</div>
								<?php
									} else if ($value->{'status'}==3) {
								?>
								<div class="progress">
									<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
										<span>100%</span>
									</div>
								</div>
								<?php
									} else {
								?>
								<div class="progress">
									<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;">
										<span>33%</span>
									</div>
								</div>
								<?php
									}
								?>
							</td>
							<td><button id="user_view" type="button" class="btn btn-primary btn-app-sm btn-circle"><i class="fa fa-eye"></i>
								</button>
								<button type="button" class="btn btn-warning btn-app-sm btn-circle"><i class="fa fa-edit"></i>
								</button>
								<button type="button" class="btn btn-danger btn-app-sm btn-circle"><i class="fa fa-trash-o"></i>
								</button> 
							</td>
						</tr>
						<?php
						}
						?>
					<!-- End: list_row -->
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
// Run Datables plugin and create 3 variants of settings
function AllTables(){
	TestTable1();
	TestTable2();
	TestTable3();
	LoadSelect2Script(MakeSelect2);
}
function MakeSelect2(){
	$('select').select2();
	$('.dataTables_filter').each(function(){
		$(this).find('label input[type=text]').attr('placeholder', 'Search');
	});
}
$(document).ready(function() {
	// Load Datatables and run plugin on tables 
	LoadDataTablesScripts(AllTables);
	// Add Drag-n-Drop feature
	WinMove();
});
</script>
