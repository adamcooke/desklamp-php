<?php
// DeskLamp - Hosting & Domain Management Solution
// (C) 2006 Q3 interactive. All Rights Reserved. 
// This code must not be distributed without full permission from Q3 interactive.

session_start();

require_once("config.php");
require_once("generic.functions.php");
require_once("display.functions.php");
require_once("output.functions.php");


dbConnect($sql);

$domain = gpc_check($_SERVER['HTTP_HOST']);
$module = gpc_check($_GET['m']);
if ($module == "") { $module = "dashboard"; }
$action = gpc_check($_GET['a']);
$data = gpc_check($_GET['d']);

// Debug
if (isset($_GET[debug])) { 
	print "<p><b>Module:</b> $module <b>Action:</b> $action <b>Data:</b> $data</p>";
}

// Query the Database to see if the domain exists
$query = mysql_query("SELECT * FROM accounts WHERE domain = '$domain'");
$result = mysql_fetch_array($query);
if ($result[id] == "") { makeError("Account Not Found", "We cannot find an account matching this domain"); } 
else { 
	// Setup a session variable for the account id
	$GLOBALS[account]	=	$result;
}

?>