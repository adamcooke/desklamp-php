<?php
	$serverid = $d;
	header("Content-type:text/xml");
	print "<?xml version=\"1.0\" ?>";

?>

<server_list>
	<? $query = "SELECT * FROM servers WHERE accountid = '".$GLOBALS[account][id]."' AND id = '$serverid'";
	$res = mysql_query($query);
	while ($s = mysql_fetch_array($res)) { 
	print "<server$s[id]>
		<name>$s[name]</name>
		<ip>$s[ipaddress]</ip>
		<ftp_host>$s[ftp_host]</ftp_host>
		<cp_url>$s[cp_url]</cp_url>
	</server$s[id]>\n";
	}
	?>
</server_list>

	
