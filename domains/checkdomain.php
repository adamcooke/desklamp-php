<?php
	$accountid = $GLOBALS[account][id];

	$query = mysql_query("SELECT * FROM domains WHERE accountid = '$accountid' AND domainname = '$d'");
	$rows = mysql_num_rows($query);
	if ($rows > 0) { print "Exists"; }
	else { print "OK"; }
?>