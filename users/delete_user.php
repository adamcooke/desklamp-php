<?php
	
	$accountid = $GLOBALS[account][id];
	
	if ($d == $GLOBALS[account][admin]) { 
		$_SESSION[msg] = "You cannot delete your account administrator.";
		$_SESSION[msg_type] = "error";
	}
	
	elseif ($d == $_SESSION[user][id]) { 
		$_SESSION[msg] = "You cannot delete the active account.";
		$_SESSION[msg_type] = "error";
	}
	else { 
	
		$query = "DELETE FROM users WHERE id = '$d' AND accountid = '$accountid'";
		mysql_query($query);
		$_SESSION[msg] = "User Account Deleted Successfully. ";
		$_SESSION[msg_type] = "info";
	}
	
	header("Location:/users");
	exit;
	
?>