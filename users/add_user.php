<?php
	
	$data[usersname] = gpc_check($_POST[usersname]);
	$data[email] = gpc_check($_POST[email]);
	$data[username] = gpc_check($_POST[username]);
	$data[password] = gpc_check($_POST[password]);
	$data[type] = gpc_check($_POST[type]);
	$accountid = $GLOBALS[account][id];
	$required = array("usersname", "email", "username", "password"); 
	foreach ($required as $field) { 
		if ($data[$field] == "") { 
			$_SESSION[msg] = "A required field was not entered ($field) - please rectify this issue and re-submit";
			$_SESSION[msg_type] = "error";
			header("Location:/users");
			exit;
		}
	}
	
	// check the username and e-mail address don't already exist
	
	$querycheck = mysql_query("SELECT username, email FROM users WHERE accountid = '$accountid'");
	while ($check = mysql_fetch_array($querycheck)) { 
		if ($check[username] == $data[username]) { 
			$_SESSION[msg] = "An account with this username already exists - please choose an alternative username.";
			$_SESSION[msg_type] = "error";
			header("Location:/users");
			exit;
		}
		if ($check[email] == $data[email]) { 
			$_SESSION[msg] = "An account with this e-mail address already exists - please choose an alternative e-mail address.";
			$_SESSION[msg_type] = "error";
			header("Location:/users");
			exit;
		}
		
	
	}
	
	$query = "INSERT INTO users (name, email, username, password, type, accountid)
				VALUES ('$data[usersname]', '$data[email]', '$data[username]', '$data[password]', '$data[type]', '$accountid')";
	mysql_query($query);
	$_SESSION[msg] = "User Added Successfully";
	$_SESSION[msg_type] = "info";
	header("Location:/users");
	

?>