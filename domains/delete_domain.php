<?php
	
	$accountid = $GLOBALS[account][id];
	
	if (isset($_GET[clients])) { 
		$query = mysql_query("SELECT clientid FROM domains WHERE id = '$d' AND accountid = '$accountid'");
		$res = mysql_fetch_array($query);
		$clientid = $res[0];
	
	}
	
	$query = "DELETE FROM domains WHERE id = '$d' AND accountid = '$accountid'";
	mysql_query($query);
	$_SESSION[msg] = "Domain Deleted Successfully. ";
	$_SESSION[msg_type] = "info";
	
	if (isset($_GET[clients])) { 
		header("Location:/clients/view/$clientid");
	}
	else { 
		header("Location:/domains");
	}
	exit;
	
?>