<?php
session_start ();

if (isset ( $_SESSION ["api_key"] )) {
	
	session_unset();
	header ( 'Location: ../' );
	die ();
	
}
	
?>