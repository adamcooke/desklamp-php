<?php
	$accountid = $GLOBALS[account][id];

	if ($editpackage == true) { 
		$d = $hosting[clientid];
	}

	$q ="SELECT * FROM domains WHERE accountid = '$accountid' AND clientid = '$d'";
	$query = mysql_query($q);
	$rows = mysql_num_rows($query);
	print "<select name=\"domain\" dl:validate=\"presence\" title=\"Primary Domain Name\">";
		print "<option value=\"\">None</option>";
	while ($h = mysql_fetch_array($query)) { 
		if ($hostinglink[selecteditem] == $h[id]) { $selected = "selected=\"selected\""; }
		print "<option value=\"$h[id]\" $selected>$h[domainname]</option>";
		$selected = "";
	}
	if ($rows == 0) { 
		print "<option disabled=\"disabled\">No domains available</option>";
	}
	
	print "</select>";
?>