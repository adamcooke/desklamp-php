<?php
	if ($GLOBALS[called] == false) { 
		header("Location:/");
	}
	define(PageTitle, "Dashboard"); 
	include ("includes/header.php"); 

?>
	<!--- Content Start -->
	
	<div id="container">
		<div id="content">
			<h1>Dashboard</h1>
			<div class="links"><a href="/clients/add">Add Client</a> | <a href="#">Add Hosting Package</a> | <a href="#">Add Domain</a> | <a href="#">Add Invoice</a></div>
			
			<hr />
			
			<p class="news"><strong>Latest News</strong> - Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque et lacus et leo laoreet dapibus. Suspendisse nec lacus sit amet erat blandit vehicula. Sed porta, mi lobortis auctor condimentum, purus libero egestas dui, at pulvinar erat sapien ac purus. Maecenas condimentum fringilla eros. Sed eget nunc at orci porttitor vulputate. Nulla at sapien sed ipsum rutrum ultricies. Suspendisse purus enim, congue ut, varius vel, convallis at, diam. Etiam blandit. Integer id quam et lorem vulputate scelerisque. Nam congue magna eget enim. Integer non neque.</p>
			
			<hr />
			
			<!--- Recent Invoices -->
			<div class="home-listing">
				<h2>Recent Invoices</h2>
				<p><a href="#" class="sublink">Open Invoices</a></p>
				
				<table width="99%" cellpadding="0" cellspacing="0" border="0" class="datatable">
					<thead>
						<tr class="th">
							<th width="6%">Inv #</th>
							<th width="25%">Client</th>
							<th width="20%">Item Type</th>
							<th width="15%">Date Due</th>
							<th width="20%">Total Payable</th>
							<th width="14%">Invoice Status</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><a href="#">H1891</a></td>
							<td>Clayesmore School</td>
							<td>Hosting</td>
							<td>04/05/2006</td>
							<td>£123</td>
							<td><img src="/images/icons/email.gif" alt="" /> Sent</td>
						</tr>
						<tr>
							<td><a href="#">H1891</a></td>
							<td>Clayesmore School</td>
							<td>Hosting</td>
							<td>04/05/2006</td>
							<td>£123</td>
							<td><img src="/images/icons/check_green.gif" alt="" /> Paid</td>
						</tr>
						<tr>
							<td><a href="#">H1891</a></td>
							<td>Clayesmore School</td>
							<td>Hosting</td>
							<td>04/05/2006</td>
							<td>£123</td>
							<td><img src="/images/icons/file.gif" alt="" /> Not Sent</td>
						</tr>
						<tr>
							<td><a href="#">H1891</a></td>
							<td>Clayesmore School</td>
							<td>Hosting</td>
							<td>04/05/2006</td>
							<td>£123</td>
							<td><img src="/images/icons/file.gif" alt="" /> Not Sent</td>
						</tr>
						<tr>
							<td><a href="#">H1891</a></td>
							<td>Clayesmore School</td>
							<td>Hosting</td>
							<td>04/05/2006</td>
							<td>£123</td>
							<td><img src="/images/icons/file.gif" alt="" /> Not Sent</td>
						</tr>
					</tbody>
				</table>
				
				
			</div>
			<!--- Recent Invoices End -->

			<hr />
			
			<!--- Recent Domains -->
			<div class="home-listing">
				<h2>Recently Added Domains</h2>
				<p><a href="#" class="sublink">Open Domains</a></p>
				
				<table width="99%" cellpadding="0" cellspacing="0" border="0" class="datatable">
					<thead>
						<tr class="th">
							<th width="45%">Domain Name </th>
							<th width="26%">Client</th>
							<th width="15%">Date Registered </th>
							<th width="14%">Invoice Status</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><a href="#">clayesmore-access.com</a></td>
							<td>Clayesmore School</td>
							<td>04/05/2006</td>
							<td><img src="/images/icons/check_green.gif" alt="" width="10" height="10" /> Active </td>
						</tr>
						<tr>
							<td><a href="#">clayesmore.net</a></td>
							<td>Clayesmore School</td>
							<td>04/05/2006</td>
							<td><img src="/images/icons/close.gif" alt="" width="11" height="11" /> Expired </td>
						</tr>
						<tr>
							<td><a href="#">clayesmore.com</a></td>
							<td>Clayesmore School</td>
							<td>04/05/2006</td>
							<td><img src="/images/icons/close_yellow.gif" alt="" width="11" height="11" /> To Expire </td>
						</tr>
					</tbody>
				</table>

			</div>
			<!--- Recent Domains End -->
			
			<hr />
			
			
			
			
			
		</div>
		<div id="rightbar">
			<p class="companylogo">
				<?php
					if ($GLOBALS[account][logo] <> "") { 
						if ($GLOBALS[account][logo_border] == 1) { $border = "class=\"logoborder\""; }
						print "<img id=\"companylogo\" src=\"/images/logos/".$GLOBALS[account][logo]."\" $border>";
					}
				?>			</p>
			<p>Welcome to DeskLamp - the hosting &amp; domain management solution for web designers. You are currently subscribed to our <strong>BASIC</strong> package - you can easily upgrade your package in your <a href="#">account settings area</a>.</p>
			<p>If you require assistance with the system, please visit our <a href="#">knowledge base</a> or contact the <a href="#">DeskLamp support team</a>.</p>
			<ul>
				<li><img src="/images/icons/rss.gif" alt="" width="16" height="17" /> <a href="#">RSS Feeds</a></li>
				<li><img src="/images/icons/config.gif" alt="" /> <a href="#">System Settings</a></li>
				<li><img src="/images/icons/locked.gif" alt="" /> <a href="#">Privacy Policy</a></li>
				<li><img src="/images/icons/pages.gif" width="16" height="16" /> <a href="#">Terms of Service</a></li>
				<li><img src="/images/icons/stop.gif" width="16" height="16" /> <a href="/login/logout">Logout</a></li>
			</ul>
		</div>
	</div>
	<!--- Content End -->
<?
	include ("includes/footer.php"); 
?>
