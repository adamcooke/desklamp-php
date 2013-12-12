<?php
	
	$data[clientid] = gpc_check($_POST[clientid]);
	$accountid = $GLOBALS[account][id];

	if(isset($_POST[submit])) { 
	
	$required = array("companyname"); 
	$fields = array("companyname", "address", "telephone", "fax", "email", "website", "contactname", "invoiceaddress", "taxable", "currency", "paymenttype", "status", "accountref");
	
	foreach ($fields as $field) { 
		$data[$field][value] = gpc_check($_POST[$field]);
   		$data[$field][name] = $field;
			$qry_where .= $data[$field][name] . " = '" . $data[$field][value] . "', ";

	}
	foreach ($required as $req) { 
		if ($data[$req][value] == "") { 
			$_SESSION[msg] = "A required field was not entered ($req).";
			$_SESSION[msg_type] = "error";
			header("Location:/clients/edit/$data[clientid]");
			exit;
		}
	}
	$qry_where = striptrailingcomma($qry_where);
	$query = "UPDATE clients SET $qry_where WHERE id = '$data[clientid]' AND accountid = '$accountid'";
	mysql_query($query);
	$_SESSION[msg] = "Client Updated Successfully.";
	$_SESSION[msg_type] = "info";
	header("Location:/clients/edit/$data[clientid]");
	exit;
	
	}
	elseif (isset($_POST[submitnotes])) { 
	
		$data[notes] = gpc_check($_POST[notes]);
		$query = "UPDATE clients SET notes = '$data[notes]' WHERE id = '$data[clientid]' AND accountid = '$accountid'";
		mysql_query($query);
		$_SESSION[msg] = "Notes Updated Successfully";
		$_SESSION[msg_type] = "info";
	header("Location:/clients/edit/$data[clientid]");
	exit;
	
	}
	
	elseif(isset($_POST[submitadd])) { 
		$required = array("companyname"); 
		$fields = array("companyname", "address", "telephone", "fax", "email", "website", "contactname", "invoiceaddress", "taxable", "currency", "paymenttype", "status", "accountref");
		
		foreach ($fields as $field) { 
			$data[$field][value] = gpc_check($_POST[$field]);
			$data[$field][name] = $field;
				$qry_where .= $data[$field][name] . " = '" . $data[$field][value] . "', ";
				$fieldlist .= $data[$field][name] . ", ";
				$datalist .= "'" . $data[$field][value] . "', ";
	
		}
		foreach ($required as $req) { 
			if ($data[$req][value] == "") { 
				$_SESSION[msg] = "A required field was not entered ($req).";
				$_SESSION[msg_type] = "error";
				header("Location:/clients/add");
				exit;
			}
		}
		
		$fieldlist .= "accountid, ";
		$datalist .= "'" .$GLOBALS[account][id] . "', ";
		
		$fieldlist .= "datecreated, ";
		$datalist .= "'" . time() . "', ";
		
		$fieldlist = striptrailingcomma($fieldlist);
		$datalist = striptrailingcomma($datalist);
		$query = "INSERT INTO clients ($fieldlist) VALUES ($datalist)";
		mysql_query($query);
		print mysql_error();
		$newid = mysql_insert_id();
		$_SESSION[msg] = "Client Added Successfully.";
		$_SESSION[msg_type] = "info";
		header("Location:/clients/edit/$newid");
		exit;
		
	
	}

?>