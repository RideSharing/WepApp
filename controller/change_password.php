<?php 
session_start();
$_SESSION['api_key'] = $_REQUEST['api_key'];
echo $_SESSION['api_key'];
header ( 'Location: ../manageaccount/changepassword.php' );
?>