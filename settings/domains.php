<?php
	if ($GLOBALS[called] == false) { 
		header("Location:/");
	}
	define(PageTitle, "Domain Settings"); 
	include ("includes/header.php"); 
	
?>
	<!--- Content Start -->
	
	<div id="container">
	  <div id="content">
			<h1><img src="/images/icons/config.gif" /> Domain Settings </h1>
			<hr />
			
			<?php messageArea(); ?>

			<div class="setting-block">
			<p><strong>Registrars </strong></p>
			<p class="subtext">You can enter the domain registrars you use into this area.</p>
				<ul>
				<? $query = mysql_query("SELECT * FROM domain_registrars WHERE accountid = '" . $GLOBALS[account][id] . "' ORDER BY name");
				while ($reg = mysql_fetch_array($query)) { 
					print "<li>$reg[name] <a href=\"/settings/save_settings/domains&delreg=$reg[id]\" onclick=\"return confirmCheck('Are you sure you want to delete this registrar?')\"><img border=\"0\" src=\"/images/icons/trash.gif\" alt=\"Delete\"></a></li>";
				}
				?>
				</ul>
			<div id="addreg">
				<p class="subtext"><B>Add New Registrar</B></p>
				<form action="/settings/save_settings/domains" method="post">
					Name: <input type="text" name="newreg" value="" size="30" /> <input type="submit" name="submit" value="Add" />
				</form>
			</div>
			
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
