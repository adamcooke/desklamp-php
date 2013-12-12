<?php
	if ($GLOBALS[called] == false) { 
		header("Location:/");
	}
	define(PageTitle, "Settings"); 
	include ("includes/header.php"); 
	
	// Get the Search Fields
	$fields = array("companyname", "accountref",  "contactname");
	foreach ($fields as $field) { 
		$data[$field] = gpc_check($_POST[$field]);
	}
	
		if (!empty($data[companyname])) { $qry .= "companyname LIKE '%" . $data[companyname] . "%' AND "; }	
		if (!empty($data[accountref])) { $qry .= "accountref LIKE '%" . $data[accountref] . "%' AND "; }	
		if (!empty($data[contactname])) { $qry .= "contactname LIKE '%" . $data[contactname] . "%' AND "; }	

?>
	<!--- Content Start -->

	<div id="ajax-output">
	
	</div>
	<div id="container">
	  <div id="content">
			<h1><img src="/images/icons/folder_open.gif" /> Client List</h1>
			<hr />
			<div id="addbox" class="addboxstyle" <? if ($qry == "") { print "style=\"display:none;\""; } ?>>
				<p class="close"><a href="#" onclick="Effect.toggle('addbox', 'blind')">Close</a>
				<h1><img src="/images/icons/search16.gif" /> Search Clients</h1>
				<form action="/clients/" method="post" onsubmit="return validateForm(this)">
				<table width="99%">
					<tr>
					  <td width="25%"><strong>Company Name </strong></td>
						<td width="25%"><input type="text" name="companyname" value="<?=$data[companyname]?>"  /></td>
						<td width="25%"><strong>Account Reference </strong></td>
						<td width="24%"><input type="text" name="accountref" value="<?=$data[accountref]?>" /></td>
					</tr>
					<tr>
					  <td><strong>Contact Name </strong></td>
					  <td><input type="text" name="contactname" value="<?=$data[contactname]?>" /></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
				</table>
				<input type="submit" name="searchsubmit" value="Search" />
				</form>

			</div>
				
			<?php messageArea(); ?>
			
			<?php
					$query = "SELECT * FROM clients WHERE $qry accountid = '" . $GLOBALS[account][id] . "' ORDER BY companyname, datecreated";
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
	
				$query2 = "SELECT * FROM clients WHERE $qry accountid = '" . $GLOBALS[account][id] . "' ORDER BY companyname, datecreated $limit";
				$result2 = mysql_query($query2);
				$rows2 = mysql_num_rows($result2);
				if ($rows2 == 0) { showMessage("No clients matching your search query were found.", error); }
				else { 
			?>
			<p>Showing <b><?=$rows2?></b> of <strong><?=$rows?></strong> client(s).</p>			
			
	        <table width="99%" cellpadding="0" cellspacing="0" border="0" class="datatable">
              <thead>
                <tr class="th">
                  <th width="35%">Company Name </th>
                  <th width="33%">Contact Name </th>
                  <th width="20%">E-Mail Address </th>
                  <th width="10%">Date Created </th>
                  <th width="2%"> Status</th>
				  <th width="2%"></th>
				  <th width="2%"></th>
                </tr>
              </thead>
              <tbody>
			  <?php
			  	while ($client = mysql_fetch_array($result2)) { 

				?>
                <tr id="client-<?=$client[id]?>">
                  <td><a href="/clients/view/<?=$client[id]?>"><?=$client[companyname]?></a></td>
				  <td><?=$client[contactname]?></td>
                  <td><a href="mailto:<?=$client[email]?>"><?=$client[email]?></a></td>
                  <td><? print convertdate($client[datecreated], "ddmmyyyy"); ?></td>
                  <td align="center">
				  	<? if ($client[status] == "1") { 
						print "<img src=\"/images/icons/check_green.gif\" alt=\"\" />";
						}
						else { 
						print "<img src=\"/images/icons/close.gif\" alt=\"\" />";
						}
					?>
				  </td>
				  <td><a href="/clients/edit/<?=$client[id]?>"><img src="/images/icons/edit16.gif" alt="Edit" border="0" /></a></td>
				  <td><a 
				  
				  onclick="if (confirmCheck('Are you sure you wish to delete this client and will records associated with it (hosting, domains and invoices)?\n\nNOTE: This action cannot be reversed.')) { deleteItem('clients', '<?=$client[id]?>'); hidewithcolflash('client-<?=$client[id]?>'); return false; } else { return false; }" href="/clients/delete_client/<?=$client[id]?>" ><img src="/images/icons/trash16.gif" alt="Delete" border="0" /></a></td>
                </tr>
				<?php
				 	}
				?>
              </tbody>
            </table>
			<? } // end no results check ?>
        <p>&nbsp;</p>
	  </div>
	  <div id="rightbar">
		  <p><strong>Client Options</strong></p>
		  <ul>
		  	<li><img src="/images/icons/add16.gif" /> <a href="/clients/add">Add Client</a></li>
		  	<li><img src="/images/icons/search16.gif" /> <a href="#" onclick="Effect.toggle('addbox', 'blind')">Search Clients</a></li>
		  </ul>

		  <p><strong>Clients</strong> - this page allows you to view the clients currently entered into your system. To view a clients hosting &amp; domains click on their name in the list to the left. If you wish to edit or delete a client, use the icons to the right of the client details. </p>
	  </div>
	</div>
	<!--- Content End -->
<?
include ("includes/footer.php");
?>