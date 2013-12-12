<?php
	if ($GLOBALS[called] == false) { 
		header("Location:/");
	}
	define(PageTitle, "Edit Domain"); 
	include ("includes/header.php"); 
	
	$query = "SELECT * FROM domains WHERE id = '$d' AND accountid = '" . $GLOBALS[account][id] . "'";
	$res = mysql_query($query);
	$domain = mysql_fetch_array($res);


?>
	<!--- Content Start -->

	<div id="container">
	  <div id="content">
			<h1><img src="/images/icons/edit16.gif" class="icon" /> Edit Domain</h1>
			<? if ($domain == "") { 
				showMessage("No domain was found matching the ID provided.", error);
			}
			else { 
			?>

			<hr />
			
			<div id="addbox" class="addboxstyle" <? if (!isset($_GET[editdomain])) { ?>style="display:none;"<? } ?>>
				<form action="/domains/save_domain" method="post">
				<p class="close"><a href="#" onclick="Effect.toggle('addbox', 'blind')">Close</a></p>
				<h1><img class="icon" src="/images/icons/file16.gif" /> Domain Notes</h1><input type="hidden" name="backto" value="<?=$backto?>" /><input type="hidden" name="domainid" value="<?=$domain[id]?>" />
				<p><textarea style="width:99%;" rows="10" name="notes"><?=$domain[notes]?></textarea></p>
				<p><input type="submit" name="submitnotes" value="Save Notes" /></p>
				</form>
			</div>
			<?php messageArea(); ?>
			<form action="/domains/save_domain" method="post" onsubmit="return validateForm(this)"><input type="hidden" name="domainid" value="<?=$domain[id]?>" />
			<h2>Domain Details</h2>
			<table width="99%">
				<tr>
					<td width="20%"><strong>Domain Name</strong></td>
					<td width="80%"><input type="text" name="domainname" value="<?=$domain[domainname]?>" size="40" dl:validate="presence" title="Company Name" /></td>
				</tr>
				<tr>
				  <td><strong>Client</strong></td>
					  <td><? selectClient("clientid", "clientid", $domain[clientid], "onchange=\"getHostingPackages(this)\" title=\"Client\" dl:validate=\"presence\"", "", 1); ?></td>
				</tr>
				<tr>
				  <td><strong>Registrar</strong></td>
				  <td><? selectRegistrar("registrar", "", $domain[registrar], 0, "", ""); ?></td>
				</tr>
				<tr>
				  <td><strong>Status </strong></td>
				  <td>
				  	<? selectDomainStatus("status", "", $domain[status], 0, "", ""); ?>
				  </td>
				</tr>
				<tr>
				  <td valign="top"><strong>Price</strong></td>
				  <td><input name="price" type="text" id="price" value="<?=$domain[price]?>" size="20" dl:validate="presence" title="Price"/></td>
			  </tr>

				<tr>
				  <td><strong>Registration Date</strong></td>
				  <td><input name="registereddate" type="text" value="<? print convertdate($domain[registereddate], "ddmmyyyy"); ?>" size="20" /> (<strong>Format</strong>: dd/mm/yyyy)</td>
			  </tr>
				<tr>
				  <td><strong>Renewal Date</strong></td>
				  <td><input name="renewaldate" type="text" value="<? print convertdate($domain[renewaldate], "ddmmyyyy"); ?>" size="20" /> (<strong>Format</strong>: dd/mm/yyyy)</td>
			  </tr>
				<tr>
				  <td><strong>Invoice Date </strong></td>
				  <td><input name="invoicedate" type="text" value="<? print convertdate($domain[invoicedate], "ddmmyyyy"); ?>" size="20" /> (<strong>Format</strong>: dd/mm/yyyy)</td>
			  </tr>
				<tr>
				  <td><strong>Linked Hosting Package </strong></td>
				  <td>
					<div id="ajax-output"><? $hostinglink[selecteditem] = $domain[hostinglink]; $editdomain = true; include ("hostinglist.php"); ?></div>
				  </td>
			  </tr>
			</table>
			<p><input type="submit" name="submit" value="Save Domain" /></p>
			<input type="hidden" name="backto" value="<?=$backto?>" />
			</form>
			<? } // end check an ID was entered ?>
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
