<?php

	$_SESSION = array();
	session_destroy();
	session_start();
	$_SESSION[msg] = "You have been successfully logged out from DeskLamp";
	$_SESSION[msg_type] = "info";
	header("Location:/login");
	exit;
	
?>