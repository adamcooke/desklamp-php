<?php
	if ($GLOBALS[called] == false) { 
		header("Location:/");
	}
	define(PageTitle, "Hosting Settings"); 
	include ("includes/header.php"); 
	
?>
	<!--- Content Start -->
	
	<div id="container">
	  <div id="content">
			<h1><img src="/images/icons/config.gif" /> Hosting Settings </h1>
			<hr />
			
			<?php messageArea(); ?>

			<div class="setting-block">
			<p><strong>Servers </strong></p>
			<p class="subtext">In order to assign hosting packages to servers, please enter details for the servers you use. This can either be servers you own, shared hosting companies or VPS accounts.</p>
				<table width="99%" cellpadding="3" cellspacing="0" class="datatable">
					<thead>
						<tr class="th">
							<th>Name</th>
							<th>IP Address</th>
							<th>Default FTP Host</th>
							<th>Default CP URL</th>
							<th width="1%"></th>
							<th width="1%"></th>
						</tr>
					</thead>
					<tbody>
						<?
							$query = "SELECT * FROM servers WHERE accountid = '".$GLOBALS[account][id]."'"; 
							$q = mysql_query($query);
							while ($server = mysql_fetch_array($q)) { 
								$done = true;
						?>
							<tr id="server-<?=$server[id]?>">
							<td><?=$server[name]?></td>
							<td><?=$server[ipaddress]?></td>
							<td><?=$server[ftp_host]?></td>
							<td><a href="<?=$server[cp_url]?>" target="_blank"><?=$server[cp_url]?></a></td>
							<td><a href="/settings/hosting/editserver&id=<?=$server[id]?>"><img border="0" src="/images/icons/edit16.gif" alt="Edit" /></a></td>
							<td><a href="/settings/save_settings/hosting&delserver=<?=$server[id]?>" onclick="if (confirmCheck('Are you sure you wish to delete this server?\n\nNOTE: This action cannot be reversed.')) { deleteItem('servers', '<?=$server[id]?>'); hidewithcolflash('server-<?=$server[id]?>'); return false; } else { return false; }"><img border="0" src="/images/icons/trash16.gif" alt="Delete" /></a></td>
							</tr>
						<? } 
							if ($done == false) { 
								print "<tr class=\"th\"><td colspan=\"6\">No servers currently available - please add one below.</td></tr>"; 
							}
						?>
						
					</tbody>
				</table><hr />
				<? if ($d == "editserver") { 
					print "<p class=\"subtext\"><b>Edit Server</b></p>";
					$id = gpc_check($_GET[id]);
					$query = mysql_query("SELECT * FROM servers WHERE accountid = '".$GLOBALS[account][id]."' AND id = '$id'");
					$edits = mysql_fetch_array($query);
					if ($edits == "") { 
						showMessage("No server found", error);
					}
					else { 
				?>
				<form action="/settings/save_settings/hosting" method="post" onsubmit="return validateForm(this)" id="form">
					<table width="50%" cellpadding="0" cellspacing="0">
						<tr>
							<td><strong>Server Name</strong></td>
							<td><input type="text" name="servername" value="<?=$edits[name]?>" size="30" dl:validate="presence" title="Server Name" /> </td>
						</tr>
						<tr>
							<td><strong>IP Address</strong></td>
							<td><input type="text" name="ipaddress" value="<?=$edits[ipaddress]?>" size="30" dl:validate="presence" title="IP Address" /> </td>
						</tr>
						<tr>
							<td><strong>FTP Hostname</strong></td>
							<td><input type="text" name="ftp_host" value="<?=$edits[ftp_host]?>" size="30" /> </td>
						</tr>
						<tr>
							<td><strong>Control Panel URL</strong></td>
							<td><input type="text" name="cp_url" value="<?=$edits[cp_url]?>" size="30" /> </td>
						</tr>
					</table>
					<input type="hidden" name="id" value="<?=$edits[id]?>" />
					<input type="submit" name="editserver" value="Edit" />
					<p><a href="/settings/hosting">Cancel Editting</a></p>
				</form>				<?
				}// server exists check
				}
				else { 
				?>

			<div id="addreg">
				<p class="subtext"><B>Add New Server</B></p>
				<form action="/settings/save_settings/hosting" method="post" onsubmit="return validateForm(this)" id="form">
					<table width="50%" cellpadding="0" cellspacing="0">
						<tr>
							<td><strong>Server Name</strong></td>
							<td><input type="text" name="servername" value="" size="30" dl:validate="presence" title="Server Name" /> </td>
						</tr>
						<tr>
							<td><strong>IP Address</strong></td>
							<td><input type="text" name="ipaddress" value="" size="30" dl:validate="presence" title="IP Address" /> </td>
						</tr>
						<tr>
							<td><strong>FTP Hostname</strong></td>
							<td><input type="text" name="ftp_host" value="" size="30" /> </td>
						</tr>
						<tr>
							<td><strong>Control Panel URL</strong></td>
							<td><input type="text" name="cp_url" value="" size="30" /> </td>
						</tr>
					</table>
					<input type="submit" name="addserver" value="Add" />
				</form>
			</div>
			<? } ?>
			</div>
			<hr />

			
			
	  </div>
	<div id="rightbar">
		<p><strong>System Settings</strong></p>
		<? include ("menu.php"); ?>
	</div>
	</div>
	<!--- Content End -->

<?
	include ("includes/footer.php"); 
?>
