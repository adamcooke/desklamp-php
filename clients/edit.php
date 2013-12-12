<?php
	if ($GLOBALS[called] == false) { 
		header("Location:/");
	}
	define(PageTitle, "Settings"); 
	include ("includes/header.php"); 
	
	$query = "SELECT * FROM clients WHERE id = '$d' AND accountid = '" . $GLOBALS[account][id] . "'";
	$res = mysql_query($query);
	$client = mysql_fetch_array($res);


?>
	<!--- Content Start -->

	<div id="ajax-output">
	
	</div>
	<div id="container">
	  <div id="content">
			<h1><img src="/images/icons/edit16.gif" class="icon" /> Edit Client</h1>
			<? if ($client == "") { 
				showMessage("No client was found matching the ID provided.", error);
			}
			else { 
			?>
			
			<script type="text/javascript">

				function copyAddress(check) { 
					var mainaddress = document.getElementById("address");
					var invaddress = document.getElementById("invaddress");
					var ma = mainaddress.value;
					var ia = invaddress.value;
					invaddress.value = mainaddress.value;
					check.onchange = function() { clearAddress(check); return false; }
					
				}
				function clearAddress(check) { 
					var invaddress = document.getElementById("invaddress");
					invaddress.value = "";
					check.onchange = function() { copyAddress(this); return false; }
				}
			</script>

			<hr />
			
			<div id="addbox" class="addboxstyle" <? if (!isset($_GET[editnotes])) { ?>style="display:none;"<? } ?>>
				<form action="/clients/save_client" method="post">
				<p class="close"><a href="#" onclick="Effect.toggle('addbox', 'blind')">Close</a></p>
				<h1><img class="icon" src="/images/icons/file16.gif" /> Client Notes</h1><input type="hidden" name="clientid" value="<?=$client[id]?>" />
				<p><textarea style="width:99%;" rows="10" name="notes"><?=$client[notes]?></textarea></p>
				<p><input type="submit" name="submitnotes" value="Save Notes" /></p>
				</form>
			</div>
			<?php messageArea(); ?>
			<form action="/clients/save_client" method="post" onsubmit="return validateForm(this)"><input type="hidden" name="clientid" value="<?=$client[id]?>" />
			<h2>Client Details</h2>
			<table width="99%">
				<tr>
					<td width="20%"><strong>Company Name</strong></td>
					<td width="80%"><input type="text" name="companyname" value="<?=$client[companyname]?>" size="40" dl:validate="presence" title="Company Name" /></td>
				</tr>
				<tr>
				  <td><strong>Account Reference </strong></td>
				  <td><input name="accountref" type="text" id="accountref" value="<?=$client[accountref]?>" size="10" /></td>
				</tr>
				<tr>
				  <td><strong>Status </strong></td>
				  <td>
				  	<input type="radio" name="status" value="1" <? if ($client[status] == 1) { print "checked=\"checked\""; } ?> /> Active
					<input type="radio" name="status" value="0" <? if ($client[status] != 1) { print "checked=\"checked\""; } ?> /> Inactive
				  </td>
				</tr>
				<tr>
				  <td valign="top"><strong>Address</strong></td>
				  
				  <td><textarea name="address" cols="40" rows="5" id="address" ><?=$client[address]?></textarea></td>
			  </tr>

				<tr>
				  <td><strong>Telephone </strong></td>
				  <td><input name="telephone" type="text" id="telephone" value="<?=$client[telephone]?>" size="20" /></td>
			  </tr>
				<tr>
				  <td><strong>Fax</strong></td>
				  <td><input name="fax" type="text" id="fax" value="<?=$client[fax]?>" size="20" /></td>
			  </tr>
				<tr>
				  <td><strong>E-Mail Address </strong></td>
				  <td><input name="email" type="text" id="email" value="<?=$client[email]?>" size="40" /></td>
			  </tr>
				<tr>
				  <td><strong>Contact Name </strong></td>
				  <td><input name="contactname" type="text" id="contactname" value="<?=$client[contactname]?>" size="40" /></td>
			  </tr>
			</table>
			<p><input type="submit" name="submit" value="Save Client" /></p>

			<hr />
			<h2>Invoicing Details</h2>
			<table width="99%">
				<tr>
					<td width="20%" valign="top"><strong>Invoice Address</strong></td>
					<td width="80%"><textarea name="invoiceaddress" id="invaddress" cols="40" rows="5"><?=$client[invoiceaddress]?></textarea><br /><input id="copyaddress" type="checkbox" name="" onchange="copyAddress(this)" /> Copy from Primary Address</td>
				</tr>
				<tr>
				  <td><strong>Taxable</strong></td>
				  <td><select name="taxable" id="taxable">
				    <option value="1">Yes</option>
				    <option value="0">No</option>
				    </select>
				  </td>
			  </tr>
				<tr>
				  <td><strong>Currency</strong></td>
				  <td><? selectCurrency("currency", "", $client[currency], 0, "", ""); ?></td>
			  </tr>
				<tr>
				  <td><strong>Payment Type </strong></td>
				  <td><? selectPaymentType("paymenttype", "", $client[paymenttype], 0, "", ""); ?></td>
			  </tr>
			</table>
			
			<p><input type="submit" name="submit" value="Save Client" /></p>
			</form>
			<? } // end check an ID was entered ?>
        <p>&nbsp;</p>
	  </div>
	
	<div id="rightbar">
		<p><strong>Client Options</strong></p>
		<ul>
			<li><img src="/images/icons/dashboard.gif" /> <a href="/clients/view/<?=$client[id]?>">View Client Dashboard</a></li>
			<li><img src="/images/icons/file16.gif" /> <a href="#" onclick="Effect.toggle('addbox', 'blind')">Client Notes</a></li>
			<li><img src="/images/icons/trash16.gif" /> <a href="/clients/delete_client/<?=$d?>" onclick="return confirmCheck('Are you sure you wish to delete this client and will records associated with it (hosting, domains and invoices)?\n\nNOTE: This action cannot be reversed.')">Delete Client</a></li>
			<li><img src="/images/icons/back16.gif"  /> <a href="/clients">Back to Client List</a>
		</ul>
	</div>
	
	</div>
	<!--- Content End -->

<?
	include ("includes/footer.php"); 
?>
