<?php
	if ($GLOBALS[called] == false) { 
		header("Location:/");
	}
	define(PageTitle, "Settings"); 
	include ("includes/header.php"); 
	
?>
	<!--- Content Start -->
	
	<div id="container">
	  <div id="content">
			<h1><img src="/images/icons/alert16.gif" /> Account Settings </h1>
			<hr />
			
			<?php messageArea(); ?>

		<form action="/settings/save/design" method="post">
			<p><strong>Account Settings </strong></p>
		  <p class="subtext">Coming Soon </p>

		</form>

			
			
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
