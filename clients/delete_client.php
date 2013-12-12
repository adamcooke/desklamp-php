<?php
	
	$accountid = $GLOBALS[account][id];
	
	$query = "DELETE FROM clients WHERE id = '$d' AND accountid = '$accountid'";
	mysql_query($query);
	$_SESSION[msg] = "Client Deleted Successfully. ";
	$_SESSION[msg_type] = "info";
	
	header("Location:/clients");
	exit;
	
?>