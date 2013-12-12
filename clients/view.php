<?php
	if ($GLOBALS[called] == false) { 
		header("Location:/");
	}
	define(PageTitle, "Client Dashboard"); 
	include ("includes/header.php"); 
	
	$query = "SELECT * FROM clients WHERE id = '$d' AND accountid = '" . $GLOBALS[account][id] . "'";
	$res = mysql_query($query);
	$client = mysql_fetch_array($res);

?>
	<!--- Content Start -->

	<div id="container">
	  <div id="content">
			<h1><img src="/images/icons/home.gif" class="icon" /> <?=$client[companyname]?></h1>
			<? if ($client == "") { 
				showMessage("No client was found matching the ID provided.", error);
			}
			else { 
			?>
			<hr />
			
			<div id="addbox" class="addboxstyle" style="display:none;">
				<p class="close"><a href="#" onclick="Effect.toggle('addbox', 'blind')">Close</a></p>
				<h1><img class="icon" src="/images/icons/file16.gif" /> Client Notes</h1><input type="hidden" name="clientid" value="<?=$client[id]?>" />
				<p><? print nl2br($client[notes]); ?></p>
				<p class="subtext"><a href="/clients/edit/<?=$client[id]?>&amp;editnotes">Edit Notes</a></p>
			</div>
			
			<div id="addbox2" class="addboxstyle" style="display:none;">
				<p class="close"><a href="#" onclick="Effect.toggle('addbox2', 'blind')">Close</a></p>
				<h1><img class="icon" src="/images/icons/info16.gif" /> Contact Details</h1>
				<table width="99%">
					<tr>
					  <td width="25%" valign="top"><strong>Telephone Number </strong></td>
						<td width="25%"><?=$client[telephone]?></td>
					  <td width="25%" valign="top"><strong>Contact Name </strong></td>
						<td width="24%"><?=$client[contactname]?></td>
					</tr>
					<tr>
					  <td valign="top"><strong>E-Mail Address </strong></td>
						<td valign="top"><?=$client[email]?></td>
					  <td valign="top"><strong>Address</strong></td>
						<td valign="top"><? print nl2br($client[address]); ?></td>
					</tr>
				</table>
			</div>
			
			<?php messageArea(); ?>
			<div class="home-listing">
				<h2>Invoices</h2>
				<p><a href="#" class="sublink">Add New Invoice</a> | <a href="#" class="sublink">View All Invoices</a></p>

			</div>
			<hr />	
			<div class="home-listing">
				<h2>Domains</h2>
				<p><a href="#" class="sublink" onclick="Effect.toggle('addbox3', 'blind')">Add New Domain</a></p>						
					<div id="addbox3" class="addboxstyle" <? if (isset($_GET[adddomain]) == "") { print "style=\"display:none;\""; } ?>>
						<p class="close"><a href="#" onclick="Effect.toggle('addbox3', 'blind')">Close</a>
						<? 
						$data[clientid] = $client[id];
						$backto = "clients";
						include ("domains/adddomain.php"); ?>
					</div>
			<?
			
					$query = "SELECT * FROM domains WHERE $qry accountid = '" . $GLOBALS[account][id] . "' AND clientid = '$client[id]' ORDER BY domainname";
					$result = mysql_query($query);
					$rows = mysql_num_rows($result);

			?>
	        <table width="99%" cellpadding="0" cellspacing="0" border="0" class="datatable">
              <thead>
                <tr class="th">
                  <th width="35%">Domain Name </th>
                  <th width="33%">Client </th>
                  <th width="15%">Registered Date</th>
                  <th width="15%">Renewal Date </th>
                  <th width="2%"> Status</th>
				  <th width="2%"></th>
				  <th width="2%"></th>
                </tr>
              </thead>
              <tbody>
			  <?php
			  	while ($domain = mysql_fetch_array($result)) { 
					$dataexists = "1";
				?>
                <tr id="domain-<?=$domain[id]?>">
                  <td><a href="/domains/edit/<?=$domain[id]?>"><?=$domain[domainname]?></a></td>
				  <td><? print getClientName($domain[clientid]); ?></td>
                  <td><? print convertdate($domain[registereddate], "ddmmyyyy"); ?></td>
                  <td><? print convertdate($domain[renewaldate], "ddmmyyyy"); ?></td>
                  <td align="center">
				  	<? if ($domain[status] == "active") { 
						print "<img src=\"/images/icons/check_green.gif\" alt=\"\" />";
						}
						elseif ($domain[status] == "toexpire") { 
						print "<img src=\"/images/icons/close_yellow.gif\" alt=\"\" />";
						}
						else { 
						print "<img src=\"/images/icons/close.gif\" alt=\"\" />";
						}
					?>
				  </td>
				  <td><a href="/domains/edit/<?=$domain[id]?>"><img src="/images/icons/edit16.gif" alt="Edit" border="0" /></a></td>
				  <td><a onclick="if (confirmCheck('Are you sure you wish to delete this domain?\n\nNOTE: This action cannot be reversed.')) { deleteItem('domains', '<?=$domain[id]?>'); hidewithcolflash('domain-<?=$domain[id]?>'); return false; } else { return false; }" href="/domains/delete_domain/<?=$domain[id]?>&clients" ><img src="/images/icons/trash16.gif" alt="Delete" border="0" /></a></td>
                </tr>
				<?php

				 	}
					if ($dataexists != true) { 
						print "<tr class=\"th\"><td colspan=\"7\">This client has no domains.</em></td></tr>";
					}
				?>
              </tbody>
            </table>
			</div>
			<hr />
			<div class="home-listing">
				<h2>Hosting Packages</h2>
				<p><a href="#" class="sublink">Add New Hosting Package</a></p>
			</div>
			<hr />
			<? } // end check an ID was entered ?>
        <p>&nbsp;</p>
	  </div>
	
	<div id="rightbar">
		<p><strong>Client Options</strong></p>
		<ul>
			<li><img src="/images/icons/user16.gif" /> <a href="#" onclick="Effect.toggle('addbox2', 'blind')">Contact Details</a></li>
			<li><img src="/images/icons/file16.gif" /> <a href="#" onclick="Effect.toggle('addbox', 'blind')">Client Notes</a></li>
			<li><img src="/images/icons/edit16.gif" /> <a href="/clients/edit/<?=$client[id]?>">Edit Client</a></li>
			<li><img src="/images/icons/back16.gif"  /> <a href="/clients">Back to Client List</a>
		</ul>
	</div>
	
	</div>
	<!--- Content End -->

<?
	include ("includes/footer.php"); 
?>
