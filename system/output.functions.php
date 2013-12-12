<?php

function selectUser($fieldname, $fieldid, $selectedvalue, $disabled, $additional, $showselect) { 
	$accountid = $GLOBALS[account][id];
	if ($disabled == 1) { 
		$disabled = "disabled=\"disabled\""; }
	
	$output .= "<select name=\"$fieldname\" id=\"$fieldid\" $disabled $additional>";
	if ($showselect == 1) { 
		$output .= "<option value=\"\">select:</option>";
	}
	$query = mysql_query("SELECT * FROM users WHERE accountid = '$accountid' ORDER BY username");
	while ( $user = mysql_fetch_array($query)) { 
		if ($user[id] == $selectedvalue) { $select = "selected=\"selected\""; }
		$output .= "<option value=\"$user[id]\" $select>$user[name] ($user[username])</option>";
		$select = "";
	}
	$output .= "</select>";
	print $output;
	
}

function selectCurrency($fieldname, $fieldid, $selectedvalue, $disabled, $additional, $showselect) { 
	$accountid = $GLOBALS[account][id];
	if ($disabled == 1) { 
		$disabled = "disabled=\"disabled\""; }
	
	$output .= "<select name=\"$fieldname\" id=\"$fieldid\" $disabled $additional>";
	if ($showselect == 1) { 
		$output .= "<option value=\"\">select:</option>";
	}
	$query = mysql_query("SELECT * FROM currencies ORDER BY name");
	while ( $curr = mysql_fetch_array($query)) { 
		if ($curr[code] == $selectedvalue) { $select = "selected=\"selected\""; }
		$output .= "<option value=\"$curr[code]\" $select>$curr[name]</option>";
		$select = "";
	}
	$output .= "</select>";
	print $output;
	
}

function selectPaymentType($fieldname, $fieldid, $selectedvalue, $disabled, $additional, $showselect) { 
	$accountid = $GLOBALS[account][id];
	if ($disabled == 1) { 
		$disabled = "disabled=\"disabled\""; }
	
	$output .= "<select name=\"$fieldname\" id=\"$fieldid\" $disabled $additional>";
	if ($showselect == 1) { 
		$output .= "<option value=\"\">select:</option>";
	}
	$query = mysql_query("SELECT * FROM payment_types ORDER BY name");
	while ( $pt = mysql_fetch_array($query)) { 
		if ($pt[name] == $selectedvalue) { $select = "selected=\"selected\""; }
		$output .= "<option value=\"$pt[name]\" $select>$pt[name]</option>";
		$select = "";
	}
	$output .= "</select>";
	print $output;
	
}

function selectClient($fieldname, $fieldid, $selectedvalue, $disabled, $additional, $showselect) { 
	$accountid = $GLOBALS[account][id];
	if ($disabled == 1) { 
		$disabled = "disabled=\"disabled\""; }
	
	$output .= "<select name=\"$fieldname\" id=\"$fieldid\" $disabled $additional>";
	if ($showselect == 1) { 
		$output .= "<option value=\"\">select:</option>";
	}
	$query = mysql_query("SELECT * FROM clients WHERE accountid = '" . $GLOBALS[account][id] . "' ORDER BY companyname");
	while ( $client = mysql_fetch_array($query)) { 
		if ($client[id] == $selectedvalue) { $select = "selected=\"selected\""; }
		$output .= "<option value=\"$client[id]\" $select>$client[companyname]</option>";
		$select = "";
	}
	$output .= "</select>";
	print $output;
	
}


function selectRegistrar($fieldname, $fieldid, $selectedvalue, $disabled, $additional, $showselect) { 
	$accountid = $GLOBALS[account][id];
	if ($disabled == 1) { 
		$disabled = "disabled=\"disabled\""; }
	
	$output .= "<select name=\"$fieldname\" id=\"$fieldid\" $disabled $additional>";
	if ($showselect == 1) { 
		$output .= "<option value=\"\">select:</option>";
	}
	$query = mysql_query("SELECT * FROM domain_registrars WHERE accountid = '" . $GLOBALS[account][id] . "' ORDER BY name");
	while ( $reg= mysql_fetch_array($query)) { 
		if ($reg[name] == $selectedvalue) { $select = "selected=\"selected\""; }
		$output .= "<option value=\"$reg[name]\" $select>$reg[name]</option>";
		$select = "";
	}
	$output .= "</select>";
	print $output;
	
}

function selectServer($fieldname, $fieldid, $selectedvalue, $disabled, $additional, $showselect) { 
	$accountid = $GLOBALS[account][id];
	if ($disabled == 1) { 
		$disabled = "disabled=\"disabled\""; }
	
	$output .= "<select name=\"$fieldname\" id=\"$fieldid\" $disabled $additional>";
	if ($showselect == 1) { 
		$output .= "<option value=\"\">select:</option>";
	}
	$query = mysql_query("SELECT * FROM servers WHERE accountid = '" . $GLOBALS[account][id] . "' ORDER BY name");
	while ( $reg= mysql_fetch_array($query)) { 
		if ($reg[id] == $selectedvalue) { $select = "selected=\"selected\""; }
		$output .= "<option value=\"$reg[id]\" $select>$reg[name]</option>";
		$select = "";
	}
	$output .= "</select>";
	print $output;
	
}


function selectDomainStatus($fieldname, $fieldid, $selectedvalue, $disabled, $additional, $showselect) { 
	$accountid = $GLOBALS[account][id];
	if ($disabled == 1) { 
		$disabled = "disabled=\"disabled\""; }
	
	$output .= "<select name=\"$fieldname\" id=\"$fieldid\" $disabled $additional>";
	if ($showselect == 1) { 
		$output .= "<option value=\"\">select:</option>";
	}
	
	$output .= "<option value=\"active\""; if ($selectedvalue == "active") { $output .= "selected=\"selected\""; } $output .= ">Active</option>";
	$output .= "<option value=\"toexpire\""; if ($selectedvalue == "toexpire") { $output .= "selected=\"selected\""; } $output .= ">To Expire</option>";
	$output .= "<option value=\"expired\""; if ($selectedvalue == "expired") { $output .= "selected=\"selected\""; } $output .= ">Expired</option>";
	
	
	$output .= "</select>";
	print $output;
	
}

function selectUserType($fieldname, $fieldid, $selectedvalue, $disabled, $additional, $showselect) { 
	$accountid = $GLOBALS[account][id];
	if ($disabled == 1) { 
		$disabled = "disabled=\"disabled\""; }
	
	$output .= "<select name=\"$fieldname\" id=\"$fieldid\" $disabled $additional>";
	if ($showselect == 1) { 
		$output .= "<option value=\"\">select:</option>";
	}
	
	$output .= "<option value=\"admin\""; if ($selectedvalue == "admin") { $output .= "selected=\"selected\""; } $output .= ">Administrator</option>";
	$output .= "<option value=\"user\""; if ($selectedvalue == "user") { $output .= "selected=\"selected\""; } $output .= ">User</option>";
	
	
	$output .= "</select>";
	print $output;
	
}

function getClientName($clientid) { 
	$accountid = $GLOBALS[account][id];
	$query = mysql_query("SELECT companyname FROM clients WHERE id = '$clientid' AND accountid = '$accountid'");
	$res = mysql_fetch_array($query);
	return $res[0];
}
?>
