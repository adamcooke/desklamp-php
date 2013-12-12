<?php
	$accountid = $GLOBALS[account][id];
	if ($editdomain == true) { 
		$d = $domain[clientid];
	}
	
	$query = mysql_query("SELECT * FROM hosting WHERE accountid = '$accountid' AND clientid = '$d'");
	$rows = mysql_num_rows($query);
	print "<select name=\"hostinglink\">";
		print "<option value=\"\">None</option>";
	while ($h = mysql_fetch_array($query)) { 
		if ($hostinglink[selecteditem] == $h[id]) { $selected = "selected=\"selected\""; }
		print "<option value=\"$h[id]\" $selected>$h[package]</option>";
		$selected = "";
	}
	if ($rows == 0) { 
		print "<option disabled=\"disabled\">No hosting packages</option>";
	}
	
	print "</select>";
?>