<?php
session_start();
if($_SESSION['driver'] == 'customer'){
	
	$_SESSION['driver'] = 'driver';
	
} else {
	
	$_SESSION['driver'] = 'customer';
	
}
?>