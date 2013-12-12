<?php


if ($d == "general") { 

	$companyname = gpc_check($_POST[companyname]);
	$administrator = gpc_check($_POST[administrator]);
	$logo = $_FILES[logo];
	$logo_border = gpc_check($_POST[logo_border]);
	$logo_delete = gpc_check($_POST[logo_delete]);
	$accountid = $GLOBALS[account][id];
	
	
	
	$logo_border = floor($logo_border);
	
	if ($companyname == "") { 
		$_SESSION[msg] = "You have not entered a company name - you must enter a company name.";
		$_SESSION[msg_type] = "error";
		}
	
	elseif ($administrator == "") { 
		$_SESSION[msg] = "You have not selected an administrator.";
		$_SESSION[msg_type] = "error";
		}
	else { 
			
	$query = "UPDATE accounts SET companyname = '$companyname', admin = '$administrator', logo_border = '$logo_border' WHERE id = '$accountid'";
	mysql_query($query);
	
	
	// update the logo if needed
	
	if ($logo_delete == 1) { 
		$query = "UPDATE accounts SET logo = '', logo_border = '0' WHERE id = '$accountid'";
		
		mysql_query($query);
	
	}
	
	
	if ($logo[name] <> "") { 
			
		// Check to see if the image type is wrong
		if ($logo[type] <> "image/gif" AND $logo[type] <> "image/jpeg") {
			$_SESSION[msg] = "The file you have uploaded is not an image - you can only upload GIF &amp; JPEG files.";
			$_SESSION[msg_type] = error;
			header("Location: /settings/general");
			exit;
		}
		
		// Check to see if the file is too big
		if ($logo[size] > 60000) { 
			$_SESSION[msg] = "The filesize for the image you have uploaded is too large - the maximum file size is 60kb.";
			$_SESSION[msg_type] = error;
			header("Location: /settings/general");
			exit;
		}
		
		// Check the actual image size
		$imageInfo = getimagesize($logo[tmp_name]);
		$w = $imageInfo[0];
		$h = $imageInfo[1];
		
		if ($w > 200 OR $h > 200) { 
			$_SESSION[msg] = "The image dimensions are too large (Maximum Width/Height: 200px)";
			$_SESSION[msg_type] = error;
			header("Location: /settings/general");
			exit;
		}
		
		// Make an extension for the image
		$extarray = explode(".", $logo[name]);
		$c = count($extarray);
		$ext = $extarray[$c-1];
		
		$random = rand(111111,999999);
		$path = "c:\\inetpub\\desklamp\\images\\logos\\";
		$filename = $random."-".$GLOBALS[account][id].".".$ext;
		$uploadto = $path . $filename;
		
		
		move_uploaded_file($logo[tmp_name], $uploadto);
		// update the database with the new name
		$query = "UPDATE accounts SET logo = '$filename' WHERE id = '".$GLOBALS[account][id]."'";
		mysql_query($query);
		
		// Now, we can't delete the old file due to permission issues - but I will write a script to clean up the logos folder at some point.
		
	}
	
	$_SESSION[msg] = "Settings Updated Successfully.";
	$_SESSION[msg_type] = "info";
	
	

	}

	header("Location: /settings/general");
	exit;
}
elseif ($d == "design") { 
	$colourscheme = gpc_check($_POST[colourscheme]);
	$accountid = $GLOBALS[account][id];
	
	if ($colourscheme == "") { 
		$_SESSION[msg] = "You have not selected a colour scheme - you must select a colour scheme.";
		$_SESSION[msg_type] = "error";
	}
	else  { 
		$query = "UPDATE accounts SET colourscheme = '$colourscheme' WHERE id = '$accountid'";
		mysql_query($query);
		$_SESSION[msg] = "Colour Scheme Updated Successfully.";
		$_SESSION[msg_type] = "info";
	}
	header("Location:/settings/design");
	exit;
	
}
elseif ($d == "domains") { 
	if (isset($_GET[delreg])) { 
		$domain = gpc_check($_GET[delreg]);
		$query = "DELETE FROM domain_registrars WHERE id = '$domain' AND accountid = '" . $GLOBALS[account][id] . "'";
		mysql_query($query);
		$_SESSION[msg] = "Domain Registrar Deleted Successfully.";
		$_SESSION[msg_type] = "info";
		header("Location:/settings/domains");
		exit;
	}
	if (isset($_POST[newreg])) { 
		$domain = gpc_check($_POST[newreg]);
		$query = "INSERT INTO domain_registrars (accountid, name) VALUES ('" . $GLOBALS[account][id] . "', '$domain')";
		mysql_query($query);
		$_SESSION[msg] = "Domain Registrar Added Successfully.";
		$_SESSION[msg_type] = "info";
		header("Location:/settings/domains");
		exit;
	}

}
elseif ($d == "logochange") { 

}

elseif($d == "hosting") { 
	if (isset($_POST[addserver])) { 
		$servername = gpc_check($_POST[servername]);
		$ipaddress = gpc_check($_POST[ipaddress]);
		$ftp_host = gpc_check($_POST[ftp_host]);
		$cp_url = gpc_check($_POST[cp_url]);
		
		if ($servername == "" || $ipaddress == "") { 
			$_SESSION[msg] = "An error occured - you did not enter required data and because you have tried to disable javascript to get around the validation we havn't saved whatever data you did enter - so there!";
			$_SESSION[msg_type] = error;
			header("Location:/settings/hosting");
			die;
		}
		
		$query = "INSERT INTO servers (accountid, name, ipaddress, ftp_host, cp_url) VALUES ('".$GLOBALS[account][id]."', '$servername', '$ipaddress', '$ftp_host', '$cp_url')";
		mysql_query($query);
		$_SESSION[msg] = "Server Added Successfully.";
		$_SESSION[msg_type] = "info";
		header("Location:/settings/hosting");
		exit;
	}
	
	if(isset($_GET[delserver])) { 
		$serverid= gpc_check($_GET[delserver]);
		$query = "DELETE FROM servers WHERE id = '$serverid' AND accountid = '".$GLOBALS[account][id]."'";
		mysql_query($query);
		$_SESSION[msg] = "Server Deleted Successfully.";
		$_SESSION[msg_type] = "info";
		header("Location:/settings/hosting");
		exit;
	}
	
	if (isset($_POST[editserver])) { 
		$servername = gpc_check($_POST[servername]);
		$ipaddress = gpc_check($_POST[ipaddress]);
		$ftp_host = gpc_check($_POST[ftp_host]);
		$cp_url = gpc_check($_POST[cp_url]);
		$id= gpc_check($_POST[id]);
		
		if ($servername == "" || $ipaddress == "") { 
			$_SESSION[msg] = "An error occured - you did not enter required data and because you have tried to disable javascript to get around the validation we havn't saved whatever data you did enter - so there!";
			$_SESSION[msg_type] = error;
			header("Location:/settings/hosting");
			die;
		}
		
		$query = "UPDATE servers SET name = '$servername', ipaddress = '$ipaddress', ftp_host = '$ftp_host', cp_url = '$cp_url' WHERE id = '$id' AND accountid = '".$GLOBALS[account][id]."'";
		mysql_query($query);
		$_SESSION[msg] = "Server Details Editted Successfully.";
		$_SESSION[msg_type] = "info";
		header("Location:/settings/hosting");
		exit;
	}
}
?>