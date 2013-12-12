<?php

function displaySystem($m, $a, $d) { 
	
	switch ($m) { 
		
		case login :
			
				switch ($a) { 
					case process :
						include ("login/process.php");
						break;
					;
					case logout :
						include ("login/logout.php");
						break;
					;
					default : 
						include("login/default.php");
						break;
					;
				}
				
			break;
		;
		
		case dashboard :
			include ("dashboard/default.php");
			break;
		;
		
		case clients :			
			$items = array("default", "edit", "view", "save_client", "add", "delete_client");
			if (in_array($a, $items)) { 
				
				include ("clients/$a.php");
			}
			else { 
				include ("clients/default.php");
			}
					
			break;
		;

		
		case settings :			
			$items = array("default", "design", "accountsettings", "save_settings", "domains", "hosting");
			if (in_array($a, $items)) { 
				
				include ("settings/$a.php");
			}
			else { 
				include ("settings/default.php");
			}
					
			break;
		;

		case domains :			
			$items = array("default", "add", "edit", "delete_domain", "save_domain", "hostinglist", "checkdomain");
			if (in_array($a, $items)) { 
				include ("domains/$a.php");
			}
			else { 
				include ("domains/default.php");
			}
					
			break;
		;

		case hosting :			
			$items = array("default", "add", "edit", "delete_hosting", "save_hosting","domainlist", "serverdetails");
			if (in_array($a, $items)) { 
				include ("hosting/$a.php");
			}
			else { 
				include ("hosting/default.php");
			}
					
			break;
		;


		case users :
			$items = array("default", "edit", "add_user", "delete", "save_user", "delete_user");
	
			if (in_array($a, $items)) { 
				include ("users/$a.php");
			}
			else { 
				include ("users/default.php");
			}
			
			break;
		;
		
		default : 
			makeError("No Module Specified", "");
		;
		
	}
	
}


?>