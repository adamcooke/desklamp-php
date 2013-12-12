<?php
// DeskLamp - Hosting & Domain Management Solution
// (C) 2006 Q3 interactive. All Rights Reserved. 
// This code must not be distributed without full permission from Q3 interactive.


function dbconnect($sql) { 
	$link = mysql_connect( "$sql[host]", "$sql[username]", "$sql[password]" );
	if ( ! $link ) { trigger_error("Unable to establish a database connection", E_USER_ERROR); die; }
	$db = mysql_select_db( "$sql[database]" );
	if ( ! $db ) {  trigger_error("Unable to open database", E_USER_ERROR); die;}
}

function seterrorhandling() { 
	ini_set("error_prepend_string", "<p style=\"font-family:tahoma, sans-serif; font-size:12px; color:darkorange; \">");
	ini_set("error_append_string", "</p>");
}

function accessrestrist($type) { 
	if ($_SESSION[user][type] != $type) { 
		makeinlineerror("Access Denied", "You do not have permission to view this area"); 
		die("Access Denied"); 
	}
}

function dbLogQuery($query, $type) {
global $globalvar;
	if (mysql_query($query)) {
		$insertid = mysql_insert_id();
		// Log the query (into the DB)
		$query_to_log = mysql_real_escape_string($query);
		$ipaddress = $_SERVER['REMOTE_ADDR']; 
		$referer = $_SERVER['SCRIPT_NAME'];
		$user = $_SESSION[user][code];
		$datetime = time();
		$type = strtoupper($type);
		$log_qry = "INSERT INTO sql_logs (query, user, datetime, type, referer, ipaddress) VALUES ('$query_to_log', '$user', '$datetime', '$type', '$referer', '$ipaddress')";
			if ($globalvar[development] == false) { 
				mysql_query($log_qry);
			}
		return $insertid;
	}
	
	else {
		$error = mysql_error();
		trigger_error("A SQL error has occured: <span style=\"color:gray;\">$error</span>");
		die;
		return false;
	}
	
}

function makesafe($data, $html) {
	// We use this function to make the data we import into SQL safe by passing it through a few php functions.
	// Generally we will only call this through the GPC check function below (otherwise we would always have issues if magic quotes are on)
	$data = mysql_real_escape_string($data);

	if (!$html == 1) {  $data = strip_tags($data);$data = htmlentities($data); }
	else { 
		$data = strip_tags($data, "<b>, <em>, <tr>, <td>, <thead>, <tbody>, <table>, <strong>, <ul>, <li>, <div>, <u>, <strike>, <p>, <img>, <a>, <blockquote>, <h1>, <h2>, <h3>, <h4>, <h5>, <h5>");
	}
	
	return $data;
	}

function gpc_check($data) {
	if (get_magic_quotes_gpc()) {
		$data = stripslashes($data);
	}
	
	$data = makesafe($data, $html);
	
	return $data;
}

function convertdate($unixdate, $format) {

if ($unixdate == "") { $output = "--"; }
else { 

switch($format) { 
		case fulldate :
			$output = date("l jS F Y", $unixdate);
			break;
		;

		case fulldatetime :
			$output = date("l jS F Y, g:ia", $unixdate);
			break;
		;
		case ddmmyyyy :
			$output = date("d/m/Y", $unixdate);
			break;
		;
		case ddmmyyyyhhmm :
			$output = date("d/m/Y, g:ia", $unixdate);
			break;
		;
	
		default :
			$output = "--";
		;
	}
}
return $output;
}

function striptrailingcomma($data) { 
	if (substr($data, -2) == ", ") { $data = substr($data, 0, -2); }
	return $data;
}

function striptrailingand($data) { 
	if (substr($data, -4) == "AND ") { $data = substr($data, 0, -4); }
	return $data;
}

//// LOGIN/USER FUNCTIONS ////

function updateLastLogin($date, $userid) { 
	$query = "UPDATE users SET lastlogin = '$date' WHERE id = '$userid'";
	if (mysql_query($query)) { return true; } 
	else { return false; }	
}

//// DATA VALIDATION FUNCTIONS ////
function validatePresent($data) { 
	if ($data == "") { return false; }
	else { return true; }
}


function saveCSV($content, $source, $description) {
	$content = addslashes($content);
	$query = "INSERT INTO csv_repos (user, datetime,description, source, content)
				VALUES ('" . $_SESSION[user][username] . "', '$datenow', '$description', '$source', '$content')";
	if ($insertid = dbLogQuery($query, 'insert')) { return $insertid; }
}

function csvMessage($id) { 
		$output .="<div class=\"message-csv\">
			  <p><b>CSV File Added to Respository </b> | 
			    <img src=\"/gfx/icons/save.gif\" /> <a target=\"_blank\" href=\"/system/csv/exportcsv.smi?id=$id\">Download CSV File</a> |
				<img src=\"/gfx/icons/trash.gif\" /> <a target=\"_blank\" href=\"/system/csv/exportcsv.smi?id=$id&amp;delete\">Download CSV File and Delete from Repository</a></p>
			</div>";
		return $output;
}

function makeError($title, $text) { 
	include("error.php");
	die;
}

function makeInlineError($title, $text) {
	print "<div style=\"margin:10px;\">";
	showMessage("$title - $text", error);
	print "</div>";
	include ("includes/footer.php");
	die;
}

function showMessage($message, $type) { 
	$output .= "<div id=\"message\" class=\"message-" . $type . "\">";
	if ($type == info) { $output .= ""; }
	if ($type == error) { $output .= ""; }
	$output .= "<strong>" . $message . "</strong></div>";
	print $output;
}

function messageArea() { 
	if ($_SESSION[msg] <> "") { 
		
		print "<script type=\"text/javascript\">
				function fade() { 
					Effect.Fade('message');
				}
				function hideMessage() { 
					setTimeout('fade()',2000);
					
					}
				addLoadEvent(hideMessage);
				</script>";
		
		showMessage("$_SESSION[msg]", "$_SESSION[msg_type]");
		$_SESSION[msg] = "";
		$_SESSION[msg_type] = "";
	
	}
}


?>