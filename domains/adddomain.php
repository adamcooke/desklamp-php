				<h1><img src="/images/icons/add16.gif" /> Add Domain</h1>
				<form action="/domains/save_domain" method="post" onsubmit="return validateForm(this)" id="form">
				<table width="99%">
					<tr>
					  <td width="25%"><strong>Domain Name </strong></td>
						<td width="25%"><input type="text" id="domainname" name="domainname" value="<?=$data[domainname]?>" title="Domain Name" dl:validate="presence" onchange="checkDomainExists(this)" /></td>
						<td width="25%"><strong>Registrar </strong></td>
						<td width="24%"><? selectRegistrar("registrar", "", $data[registrar], "title=\"Registrar\" dl:validate=\"presence\"", "", 1); ?></td>
					</tr>
					<tr>
					  <td><strong>Client </strong></td>
					  <td><? selectClient("clientid", "clientid", $data[clientid], "onchange=\"getHostingPackages(this)\" title=\"Client\" dl:validate=\"presence\"", "", 1); ?></td>
					  <td><strong>Price</strong></td>
					  <td><input type="text" name="price" value="<?=$data[price]?>" title="Price" dl:validate="presence" />
					 </tr>
					<tr>
					  <td><strong>Status </strong></td>
					  <td><? selectDomainStatus("status", "", "active", "title=\"Domain Status\" dl:validate=\"presence\"", "", 0); ?></td>
					  <td><strong>Registration Date</strong></td>
					  <td><input type="text" name="registereddate" value="<? print convertdate(time(), "ddmmyyyy"); ?>" title="Registration Date" dl:validate="presence"/></td>
					</tr>
					<tr>
					  <td><strong>Renewal Date </strong></td>
					  <td><? $dateplusyear = time() + 31556926; ?><input type="text" name="renewaldate" value="<? print convertdate($dateplusyear, "ddmmyyyy"); ?>" title="Renewal Date" dl:validate="presence" /></td>
					  <td><strong>Invoice Date</strong></td>
					  <td><input type="text" name="invoicedate" value="<? print convertdate(time(), "ddmmyyyy"); ?>" title="Invoice Date" dl:validate="presence" /></td>
					</tr>
					<tr>
						<td><strong>Hosing Link</strong></td>
						<td>
							<div id="ajax-output"><? include ("hostinglist.php"); ?></div>
						</td>
						<td></td>
						<td></td>
					</tr>
				</table>
				<input type="submit" name="submitadd" value="Add Domain" />
				<input type="hidden" name="backto" value="<?=$backto?>" />
				
				</form>