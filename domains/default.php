<?php
	if ($GLOBALS[called] == false) { 
		header("Location:/");
	}
	define(PageTitle, "Domains"); 
	include ("includes/header.php"); 
	
	// Get the Search Fields
	$fields = array("domainname", "registrar",  "clientid", "status");
	foreach ($fields as $field) { 
		$data[$field] = gpc_check($_POST[$field]);
	}
	
		if (!empty($data[domainname])) { $qry .= "domainname LIKE '%" . $data[domainname] . "%' AND "; }	
		if (!empty($data[registrar])) { $qry .= "registrar = '" . $data[registrar] . "' AND "; }	
		if (!empty($data[clientid])) { $qry .= "clientid = '" . $data[clientid] . "' AND "; }
		if (!empty($data[status])) { $qry .= "status = '" . $data[status] . "' AND "; }


?>
	<!--- Content Start -->

	<div id="container">
	  <div id="content">
			<h1><img src="/images/icons/folder_open.gif" /> Domains</h1>
			<hr />
			<div id="addbox"  class="addboxstyle" <? if ($qry == "") { print "style=\"display:none;\""; } ?>>
				<p class="close"><a href="#" onclick="Effect.toggle('addbox', 'blind')">Close</a>
				<h1><img src="/images/icons/search16.gif" /> Search Domains</h1>
				<form action="/domains/" method="post">
				<table width="99%">
					<tr>
					  <td width="25%"><strong>Domain Name </strong></td>
						<td width="25%"><input type="text" name="domainname" value="<?=$data[domainname]?>"  /></td>
						<td width="25%"><strong>Registrar </strong></td>
						<td width="24%"><? selectRegistrar("registrar", "", $data[registrar], 0, "", 1); ?></td>
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
			<div id="addbox2" class="addboxstyle"<? if (isset($_GET[adddomain]) == "") { print "style=\"display:none;\""; } ?>>
				<p class="close"><a href="#" onclick="Effect.toggle('addbox2', 'blind')">Close</a>
				<? include ("adddomain.php"); ?>
			</div>
				
			<?php messageArea(); ?>
			
			<?php
					$query = "SELECT * FROM domains WHERE $qry accountid = '" . $GLOBALS[account][id] . "' ORDER BY domainname";
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
	
				$query2 = "SELECT * FROM domains WHERE $qry accountid = '" . $GLOBALS[account][id] . "' ORDER BY domainname $limit";
				$result2 = mysql_query($query2);
				$rows2 = mysql_num_rows($result2);
				if ($rows2 == 0) { showMessage("No domains matching your search query were found.", error); }
				else { 
			?>
			<p>Showing <b><?=$rows2?></b> of <strong><?=$rows?></strong> domain(s).</p>			
			
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
			  	while ($domain = mysql_fetch_array($result2)) { 

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
				  <td><a href="/domains/delete_domain/<?=$domain[id]?>" onclick="if (confirmCheck('Are you sure you wish to delete this domain?\n\nNOTE: This action cannot be reversed.')) { deleteItem('domains', '<?=$domain[id]?>'); hidewithcolflash('domain-<?=$domain[id]?>'); return false; } else { return false; }" ><img src="/images/icons/trash16.gif" alt="Delete" border="0" /></a></td>
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
		  <p><strong>Domain Options</strong></p>
		  <ul>
		  	<li><img src="/images/icons/add16.gif" /> <a href="#" onclick="Effect.toggle('addbox2', 'blind')">Add Domain</a></li>
		  	<li><img src="/images/icons/search16.gif" /> <a href="#" onclick="Effect.toggle('addbox', 'blind')">Search Domains</a></li>
		  </ul>

		  <p><strong>Clients</strong> - this page allows you to view the clients currently entered into your system. To view a clients hosting &amp; domains click on their name in the list to the left. If you wish to edit or delete a client, use the icons to the right of the client details. </p>
	  </div>
	</div>
	<!--- Content End -->
<?
include ("includes/footer.php");
?>