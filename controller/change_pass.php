<?php
include_once 'Constant.php';
session_start ();

$_SESSION ['api_key'] = $_GET{'api_key'};
$_SESSION ['driver'] = 'customer';

header('Location: ../manageaccount/changepassword.php');

?>