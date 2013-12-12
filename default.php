<?php
	include("system/load.php");
	
	// We have a valid account but we still need to validate a user for this account
	if ($_SESSION[user][id] == "") { 
			$GLOBALS[called] = true;
			displaySystem("login",$action, $data);
	}
	else { 
			$GLOBALS[called] = true;
			displaySystem($module, $action, $data);
	}
	
?>