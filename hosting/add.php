<?php
	if ($GLOBALS[called] == false) { 
		header("Location:/");
	}
	define(PageTitle, "Add Hosting Package"); 
	include ("includes/header.php"); 
	
?>
	<!--- Content Start -->

	<div id="container">
	  <div id="content">
			<h1><img src="/images/icons/add16.gif" class="icon" /> Add Hosting Package</h1>

			<hr />

			<?php messageArea(); ?>
			<form action="/hosting/save_hosting" method="post" onsubmit="return validateForm(this)"> 
			<table width="99%" cellpadding="0" cellspacing="0">
				<tr>
					<td width="49%" valign="top">
						<p><b>Client</b><br />Select which client this hosting package should belong to</p>
						<p><? selectClient("clientid", "clientid", $domain[clientid], "onchange=\"getDomainList(this)\" title=\"Client\" dl:validate=\"presence\"", "", 1); ?><br /><br /></p>
						
						<p><b>Primary Domain Name</b><br />Choose a domain name to associates this package with</p>
						<p><div id="ajax-output"><? include ("domainlist.php"); ?></div></p>If you have not created the domain <a href="/domains/&adddomain">click here</a> to create one.<br />	<br />

						<p><b>Server</b><br />Select which server this package is hosted on</p>
						<p><? selectServer("server", "", $domain[status], 0, "onchange=\"getServerDetails(this)\" dl:validate=\"presence\" title=\"Server\"", 1); ?></p><br />
						
						<p><b>Status</b></p>
						<p><? selectDomainStatus("status", "", $domain[status], 0, "", ""); ?></p>
						<strong>Description</strong><br />
						Information about this hosting page <br />
						<input name="description" type="text" id="description" dl:validate="presence" title="Description" size="35" />
						<br />
						<br />
						
						<h2>Pricing</h2>
						<p><b>Billing Amount</b><br />Enter the billable amount for this package</p>
						<p><input type="text" name="price" dl:validate="presence" title="Price" /></p>

						<p><b>Frequency</b><br />How often should this hosting package be invoiced?</p>
						<p><select name="freq" dl:validate="presence">
							<option value="30">Monthly - Every 30 days</option>
							<option value="90">Quarterly - Every 90 days</option>
							<option value="180">Semi-Annually - Every 180 days</option>
							<option value="360">Annually - Every 360 days</option>
						</select>
						<br /><br /></p>
						
						<p><b>Date Created</b></p>
						<p><input name="datecreated" dl:validate="presence" type="text" title="Date Created" value="<? print convertdate($package[datecreated], "ddmmyyyy"); ?>" size="20" /> (<strong>Format</strong>: dd/mm/yyyy)</p>

						<p><b>Next Renewal Date</b></p>
						<p><input name="renewaldate" dl:validate="presence" type="text" title="Renewal Date" value="<? print convertdate($package[renewaldate], "ddmmyyyy"); ?>" size="20" /> (<strong>Format</strong>: dd/mm/yyyy)</p>

						
					</td>
					
					<td width="50%" valign="top">
					<h2>FTP Access Details</h2>
					
					<p><strong>FTP Host</strong></p>
					<p><input type="text" name="ftp_host" id="ftp_host" size="35" /></p>
					<p><strong>FTP Username</strong></p>
					<p><input type="text" name="ftp_username" size="35" /></p>
					<p><strong>FTP Password</strong></p>
					<p><input type="text" name="ftp_password" size="35" /><br /><br /></p>
					
					<h2>Control Panel Access Details</h2>
					<p><strong>Control Panel URL</strong></p>
					<p><input type="text" name="cp_url" id="cp_url" size="35" /></p>
					<p><strong>Control Panel Username</strong></p>
					<p><input type="text" name="cp_username" size="35" /></p>
					<p><strong>Control Panel Password</strong></p>
					<p><input type="text" name="cp_password" size="35" />
					  <br />
					  <br />
					</p>
					<h2><strong>Notes</strong></h2>
					<p>Any other information you would like to store about this package</p>
					<p><textarea name="notes" style="width:99%" rows="10"></textarea></p></td>
				</tr>
			</table>
			<hr />
			<input type="submit" name="submitadd" value="Add Package" />
			</form>
        <p>&nbsp;</p>
	  </div>
	
	<div id="rightbar">
		<p><strong>Domain Options</strong></p>
		<ul>
			<li><img src="/images/icons/file16.gif" /> <a href="#" onclick="Effect.toggle('addbox', 'blind')">Domain Notes</a></li>
			<li><img src="/images/icons/trash16.gif" /> <a href="/domains/delete_domain/<?=$d?>" onclick="return confirmCheck('Are you sure you wish to delete this domain?\n\nNOTE: This action cannot be reversed.')">Delete Domain</a></li>
			<li><img src="/images/icons/back16.gif"  /> <a href="/domains">Back to Domain List</a>
		</ul>
	</div>
	
	</div>
	<!--- Content End -->

<?
	include ("includes/footer.php"); 
?>
