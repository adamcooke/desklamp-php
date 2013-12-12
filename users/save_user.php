<?php
	
	$data[usersname] = gpc_check($_POST[usersname]);
	$data[email] = gpc_check($_POST[email]);
	$data[username] = gpc_check($_POST[username]);
	$data[password] = gpc_check($_POST[password]);
	$data[type] = gpc_check($_POST[type]);
	$data[userid] = gpc_check($_POST[userid]);
	
	$required = array("usersname", "email", "username", "type"); 
	foreach ($required as $field) { 
		if ($data[$field] == "") { 
			$_SESSION[msg] = "A required field was not entered ($field) - please rectify this issue and re-submit";
			$_SESSION[msg_type] = "error";
			header("Location:/users/edit/$data[userid]");
			exit;
		}
	}
	
	if ($data[password] <> "") { 
		$queryext = ", password = '$data[password]'";
	}
	
	
	$query = "UPDATE users SET username = '$data[username]', name = '$data[usersname]', email = '$data[email]', type = '$data[type]' $queryext WHERE accountid = '" . $GLOBALS[account][id] . "' AND id = '$data[userid]'";
	mysql_query($query);
	$_SESSION[msg] = "User Details have been updated successfully. ";
	if ($data[password] <> "") { $_SESSION[msg] .= "The users password has also been changed."; }
	$_SESSION[msg_type] = "info";
	header("Location:/users/edit/$data[userid]");
	exit;
	
?>