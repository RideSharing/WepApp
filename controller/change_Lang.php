<?php
session_start();
if ($_COOKIE['lang'] == "en") {
	
	setcookie('lang', 'vi', time() + (86400 * 365), "/");
	
} else {
	
	setcookie('lang', 'en', time() + (86400 * 365), "/");
	
}
?>