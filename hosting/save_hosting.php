<?php
	

	$accountid = $GLOBALS[account][id];

// Function to handle sending the user back to an appropriate location
function goBackTo($clientid, $sendadd) { 
	$backto = gpc_check($_POST[backto]);
	if ($backto == "clients") { 
		header("Location:/clients/view/$clientid");
	}
	else { 
		header("Location:/hosting/");
	}
}


	if(isset($_POST[submit])) { 
	$data[domainid] = gpc_check($_POST[domainid]);	

		$required = array("domainname", "registrar", "clientid", "price", "status", "registereddate", "renewaldate", "invoicedate"); 
		$fields = array("domainname", "registrar", "clientid", "price", "status", "registereddate", "renewaldate", "invoicedate", "hostinglink"); 
		$dates = array("registereddate", "renewaldate", "invoicedate");
		
		foreach ($fields as $field) { 
			$data[$field][value] = gpc_check($_POST[$field]);
			$data[$field][name] = $field;
			
			
			// as we have dates we need to deal with them differently.
			if (in_array($field, $dates)) { 
				$date = $data[$field][value];
				$day = substr($date, 0,2);
				$month = substr($date, 3, 2);
				$year = substr($date, 6,4);
				$date = mktime(12,0,0,$month,$day,$year);
				$qry_where .= $field . " = '" . $date . "', ";

			}
			// otherwise they are just normal data inputs
			else { 
				$qry_where .= $data[$field][name] . " = '" . $data[$field][value] . "', ";
			}
			
		}
		
		// for each of the required fields - check that it is present - otherwise return an error
		// this is just to backup the javascript check
		foreach ($required as $req) { 
			if ($data[$req][value] == "") { 
				$_SESSION[msg] = "A required field was not entered ($req).";
				$_SESSION[msg_type] = "error";
				header("Location:/domains/");
				exit;
			}
		}
			
	$qry_where = striptrailingcomma($qry_where);
	$query = "UPDATE domains SET $qry_where WHERE id = '$data[domainid]' AND accountid = '$accountid'";
	mysql_query($query);
	
	$_SESSION[msg] = "Domain (" . $data[domainname][value] . ") Updated Successfully.";
	$_SESSION[msg_type] = "info";
	header("Location:/domains/");
	exit;
	
	}
	elseif (isset($_POST[submitnotes])) { 
	
		$data[notes] = gpc_check($_POST[notes]);
		$data[domainid] = gpc_check($_POST[domainid]);
		$query = "UPDATE domains SET notes = '$data[notes]' WHERE id = '$data[domainid]' AND accountid = '$accountid'";
		mysql_query($query);
		$_SESSION[msg] = "Notes Updated Successfully";
		$_SESSION[msg_type] = "info";
		goBackTo($data[clientid], 0);
		exit;
	
	}
	
	elseif(isset($_POST[submitadd])) { 
		
		// As domains can come the client page and the domains page - we need to decide where to send the user to.
		
		$required = array("domain", "server", "clientid", "price", "status", "freq", "datecreated", "renewaldate", "description"); 
		$fields = array("domain", "server", "clientid", "price", "status", "freq", "datecreated", "renewaldate", "ftp_host", "ftp_username", "ftp_password", "cp_url", "cp_username", "cp_password", "description", "notes"); 
		$dates = array("datecreated", "renewaldate");
		
		foreach ($fields as $field) { 
			$data[$field][value] = gpc_check($_POST[$field]);
			$data[$field][name] = $field;
			
			
			// as we have dates we need to deal with them differently.
			if (in_array($field, $dates)) { 
				$date = $data[$field][value];
				$day = substr($date, 0,2);
				$month = substr($date, 3, 2);
				$year = substr($date, 6,4);
				$date = mktime(12,0,0,$month,$day,$year);
				$datalist  .= "'$date', ";
				$fieldlist.= "$field, ";
			}
			// otherwise they are just normal data inputs
			else { 
				$fieldlist .= $data[$field][name] . ", ";
				$datalist .= "'" . $data[$field][value] . "', ";
			}
			
		}
		
		// for each of the required fields - check that it is present - otherwise return an error
		// this is just to backup the javascript check
		foreach ($required as $req) { 
			if ($data[$req][value] == "") { 
				$_SESSION[msg] = "A required field was not entered ($req).";
				$_SESSION[msg_type] = "error";
				header("Location:/domains/&add");
				exit;
			}
		}
		
	
		

		$fieldlist .= "accountid, ";
		$datalist .= "'" . $GLOBALS[account][id] . "', ";
		
		$fieldlist = striptrailingcomma($fieldlist);
		$datalist = striptrailingcomma($datalist);
		$query = "INSERT INTO hosting ($fieldlist) VALUES ($datalist)";
		mysql_query($query);
		print mysql_error();
		$newid = mysql_insert_id();
		$_SESSION[msg] = "Hosting Package (" . $data[description][value] . ") Added Successfully.";
		$_SESSION[msg_type] = "info";
		
		goBackTo($data[clientid][value], 1);
			
		exit;
		
		
	
	}

?>