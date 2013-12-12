<?php
	if ($GLOBALS[called] == false) { 
		header("Location:/");
	}
	define(PageTitle, "Hosting"); 
	include ("includes/header.php"); 
	
	// Get the Search Fields
	$fields = array("domainname", "server",  "clientid", "status");
	foreach ($fields as $field) { 
		$data[$field] = gpc_check($_POST[$field]);
	}
	
		if (!empty($data[domainname])) { $qry .= "domains.domainname LIKE '%" . $data[domainname] . "%' AND "; }	
		if (!empty($data[server])) { $qry .= "hosting.server = '" . $data[server] . "' AND "; }	
		if (!empty($data[clientid])) { $qry .= "hosting.clientid = '" . $data[clientid] . "' AND "; }
			if (!empty($data[status])) { $qry .= "hosting.status = '" . $data[status] . "' AND "; }


?>
	<!--- Content Start -->

	<div id="container">
	  <div id="content">
			<h1><img src="/images/icons/folder_open.gif" /> Hosting</h1>
			<hr />
			<div id="addbox"  class="addboxstyle" <? if ($qry == "") { print "style=\"display:none;\""; } ?>>
				<p class="close"><a href="#" onclick="Effect.toggle('addbox', 'blind')">Close</a>
				<h1><img src="/images/icons/search16.gif" /> Search Packages </h1>
				<form action="/hosting/" method="post">
				<table width="99%">
					<tr>
					  <td width="25%"><strong>Primary Domain </strong></td>
						<td width="25%"><input type="text" name="domainname" value="<?=$data[domainname]?>"  /></td>
						<td width="25%"><strong>Server</strong></td>
						<td width="24%"><? selectServer("server", "", $data[server], 0, "", 1); ?></td>
					</tr>
					<tr>
					  <td><strong>Client </strong></td>
					  <td colspan="3"><? selectClient("clientid", "", $data[clientid], 0, "", 1); ?></td>
					 </tr>
					<tr>
					  <td><strong>Status </strong></td>
					  <td colspan="3"><? selectDomainStatus("status", "", $data[status], 0, "", 1); ?></td>
					</tr>
				</table>
				<input type="submit" name="searchsubmit" value="Search" />
				</form>

			</div>

			<?php messageArea(); ?>
			
			<?php
					$query = "SELECT * FROM hosting, domains, clients WHERE hosting.domain = domains.id AND hosting.clientid =clients.id AND $qry hosting.accountid = '" . $GLOBALS[account][id] . "' ORDER BY domains.domainname $limit";
					$result = mysql_query($query);
					$rows = mysql_num_rows($result);
					$count = $rows;
					$page = gpc_check($_GET[a]);	

			if ($qry == "") { 
					if ($page == "") { $page = "1"; }
					$itemsperpage = "25";
					if($count > $itemsperpage) {
							$pages .= "<div id=\"pagenumbers\"><strong>Select a Page</strong> ";
						for($i = 0; $i < $count; $i=$i+$itemsperpage) { 
							$thispage = ($i/$itemsperpage)+1;		
							$pages .= "<a href=\"$thispage\" "; 
								if ($page == "$thispage") { $pages .= "class=\"active\""; }
							$pages .= ">$thispage</a> "; 
						}
							$pages .= "</div>";
					}
					print $pages;
					$page = ($page-1)*$itemsperpage;
					$limit = "LIMIT $page,$itemsperpage";
				}				
	
				$query2 = "SELECT * FROM hosting, domains, clients, servers WHERE hosting.domain = domains.id AND hosting.clientid = clients.id AND hosting.server = servers.id AND $qry hosting.accountid = '" . $GLOBALS[account][id] . "' ORDER BY domains.domainname $limit";
				$result2 = mysql_query($query2);
				print mysql_error();
				$rows2 = mysql_num_rows($result2);
				if ($rows2 == 0) { showMessage("No domains matching your search query were found.", error); }
				else { 
			?>
			<p>Showing <b><?=$rows2?></b> of <strong><?=$rows?></strong> hosting package(s).</p>			
			
	        <table width="99%" cellpadding="0" cellspacing="0" border="0" class="datatable">
              <thead>
                <tr class="th">
                  <th width="35%">Primary Domain Name </th>
                  <th width="33%">Client </th>
                  <th width="15%">Server</th>

                  <th width="15%">Registered Date</th>
                  <th width="15%">Renewal Date </th>
                  <th width="2%"> Status</th>
				  <th width="2%"></th>
				  <th width="2%"></th>
                </tr>
              </thead>
              <tbody>
			  <?php
			  	while ($package = mysql_fetch_array($result2)) {
				?>
                <tr id="hosting-<?=$package[0]?>">
                  <td><a href="/hosting/edit/<?=$package[id]?>"><?=$package[domainname]?></a></td>
				  <td><?=$package[companyname]?></td>
				  <td><?=$package[name]?></td>
                  <td><? print convertdate($package[datecreated], "ddmmyyyy"); ?></td>
                  <td><? print convertdate($package[renewaldate], "ddmmyyyy"); ?></td>
                  <td align="center">
				  	<? if ($package[14] == "active") { 
						print "<img src=\"/images/icons/check_green.gif\" alt=\"\" />";
						}
						elseif ($domain[14] == "toexpire") { 
						print "<img src=\"/images/icons/close_yellow.gif\" alt=\"\" />";
						}
						else { 
						print "<img src=\"/images/icons/close.gif\" alt=\"\" />";
						}
					?>
				  </td>
				  <td><a href="/hosting/edit/<?=$package[0]?>"><img src="/images/icons/edit16.gif" alt="Edit" border="0" /></a></td>
				  <td><a href="/hosting/delete_hosting/<?=$package[0]?>" onclick="if (confirmCheck('Are you sure you wish to delete this hosting package (the primary domain will remain in the system)?\n\nNOTE: This action cannot be reversed.')) { deleteItem('hosting', '<?=$package[0]?>'); hidewithcolflash('hosting-<?=$package[0]?>'); return false; } else { return false; }" ><img src="/images/icons/trash16.gif" alt="Delete" border="0" /></a></td>
                </tr>
				<?php
				 	}
				?>
              </tbody>
            </table>
			<div id="ajax-output">
			
			</div>
			<? } // end no results check ?>
        <p>&nbsp;</p>
	  </div>
	  <div id="rightbar">
		  <p><strong>Hosting Options</strong></p>
		  <ul>
		  	<li><img src="/images/icons/add16.gif" /> <a href="/hosting/add">Add Hosting Package </a></li>
		  	<li><img src="/images/icons/search16.gif" /> <a href="#" onclick="Effect.toggle('addbox', 'blind')">Search Packages </a></li>
		  </ul>		  
		  <p><strong>Hosting</strong> - this page allows you to view and manageall the hosting accounts which you have setup. </p>
	  </div>
	</div>
	<!--- Content End -->
<?
include ("includes/footer.php");
?>