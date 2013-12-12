<?php

	$sentUsername = gpc_check($_POST[username]);
	$sentPassword = gpc_check($_POST[password]);
	$account = $GLOBALS[account][id];
	
	$query = mysql_query("SELECT * FROM users WHERE username = '$sentUsername' AND password = '$sentPassword' AND accountid = '$account'");
	if ($result = mysql_fetch_array($query)) { 
		session_regenerate_id();
		$sid = session_id();

		// Save user login details to the database for a short time
		$query = "INSERT INTO user_sessions (accountid, userid, sessionid, ip, time) 
					VALUES ('$account', '$result[id]', '$sid', '$_SERVER[REMOTE_ADDR]', '" . time() . "')";
					
		mysql_query($query);
		
		$_SESSION[user] = $result;
		header("Location:/dashboard");
		exit;
	}
	else { 
		$_SESSION[msg] = "Access Denied - your username and/or password is incorrect.";
		$_SESSION[msg_type] = "error";
		$_SESSION[username] = $sentUsername;
		header("Location:/login");
		exit;
	}


?>