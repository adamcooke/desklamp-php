<?php
	if ($GLOBALS[called] == false) { 
		header("Location:/");
	}
	define(PageTitle, "Users"); 
	include ("includes/header.php"); 
?>
	<!--- Content Start -->
	
	<div id="container">
	  <div id="content">
			<h1><img src="/images/icons/edit16.gif" /> Edit User</h1>
			
			<?php
				if ($d == "") { 
					print showMessage("You need to specify a user to edit - please follow links from within the system", info);
				}
				else { 
					$query = "SELECT * FROM users WHERE accountid = '" . $GLOBALS[account][id] . "' AND id = '$d'";
					$result = mysql_query($query);
					$user = mysql_fetch_array($result);
					if ($user[id] == "") { 
						print showMessage("No user could be found matching your criteria", error);
						
					}
					else { 
										
						print "<hr />";
						
						messageArea();
						
						print "<form action=\"/users/save_user\" method=\"post\" onsubmit=\"return validateForm(this)\"><input type=\"hidden\" name=\"userid\" value=\"$user[id]\">";
						print "<h2>Personal Details</h2>";	
						print "<div class=\"setting-block\">";
						print "<p><strong>User's Name</strong></p>";
						print "<p class=\"subtext\">The user's full name (surname and forenames)</p>";
						print "<p><input type=\"text\" name=\"usersname\" size=\"30\" value=\"$user[name]\" dl:validate=\"presence\" title=\"User's Name\">";
						print "</div>";
						
						print "<div class=\"setting-block\">";
						print "<p><strong>E-Mail Address</strong></p>";
						print "<p class=\"subtext\">The e-mail address for this user will be used to send reminder e-mails as well as forgotton password requests.</p>";
						print "<p><input type=\"text\" name=\"email\" size=\"30\" value=\"$user[email]\" dl:validate=\"presence\" title=\"E-Mail Address\">";
						print "</div>";
						print "<hr />";
						print "<h2>Login Details</h2>";	
						print "<div class=\"setting-block\">";
						print "<p><strong>Username</strong></p>";
						print "<p class=\"subtext\">This is the name the will login to the system with.</p>";
						print "<p><input type=\"text\" name=\"username\" size=\"30\" value=\"$user[username]\" dl:validate=\"presence\" title=\"Username\">";
						print "</div>";
						
						print "<div class=\"setting-block\">";
						print "<p><strong>Change Password</strong></p>";
						print "<p class=\"subtext\">If you wish to change this user's password, just type in your new password in the box below.</p>";
						print "<p><input type=\"text\" name=\"password\" size=\"30\">";
						print "</div>";
						
						print "<div class=\"setting-block\">";
						print "<p><strong>User Group</strong></p>";
						print "<p class=\"subtext\">Should this user be a system administrator or a standard user. Administrators have access to System Settings whereas other users do not. </p>";
						print "<p>".selectUserType('type', '', $user[type], '', 'dl:validate="presence" title="User Type"', 1)."</p>";
						print "</div>";
						
						
						print "<input type=\"submit\" name=\"submit\" value=\"Save User\">";
						print "</form>";
					
					}
				} // end presence of $d chec
			?>
			
			
        <p>&nbsp;</p>
	  </div>
	  <div id="rightbar">
	  	
	  		<p><b>User Options</b></p>
			<ul>
				<li><img src="/images/icons/trash16.gif" alt="" /> <a onclick="return confirmCheck('Are you sure you wish to delete this user?')" href="/users/delete_user/<?=$user[id]?>" >Delete User</a></li>
				<li><img src="/images/icons/back16.gif" alt="" /> <a href="/users">Return to User List</a></li>
			</ul>
	  </div>
	</div>
	<!--- Content End -->

<?
	include ("includes/footer.php"); 
?>
