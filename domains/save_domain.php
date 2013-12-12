<?php
	

	$accountid = $GLOBALS[account][id];

// Function to handle sending the user back to an appropriate location
function goBackTo($clientid, $sendadd) { 
	if ($sendadd = 1) { $sendadd = "&add"; }
	$backto = gpc_check($_POST[backto]);
	if ($backto == "clients") { 
		header("Location:/clients/view/$clientid");
	}
	else { 
		header("Location:/domains/$sendadd");
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
		

		// Before we do anything lets check that the domain doesn't already exist in the database
		$domain = gpc_check($_POST[domainname]);
		$query = mysql_query("SELECT clientid FROM domains WHERE domainname = '$domain'");
		$res = mysql_fetch_array($query);
		
		if ($res != "") { 
			$_SESSION[msg] = "The domain you entered ($domain) already exists in the database.";
			$_SESSION[msg_type] = error;
			goBackTo($res[0], 0);
			exit;
		}

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
		$query = "INSERT INTO domains ($fieldlist) VALUES ($datalist)";
		mysql_query($query);
		$newid = mysql_insert_id();
		$_SESSION[msg] = "Domain (" . $data[domainname][value] . ") Added Successfully.";
		$_SESSION[msg_type] = "info";
		
		goBackTo($data[clientid][value], 1);
			
		exit;
		
		
	
	}

?>