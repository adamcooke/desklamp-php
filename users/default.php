<?php
	if ($GLOBALS[called] == false) { 
		header("Location:/");
	}
	define(PageTitle, "Settings"); 
	include ("includes/header.php"); 
	$a = general;
?>
	<!--- Content Start -->

	<div id="ajax-output">
	
	</div>
	<div id="container">
	  <div id="content">
			<h1><img src="/images/icons/users16.gif" /> Users</h1>
			<hr />
			
			<div id="addbox" class="addboxstyle" style="display:none;">
				<p class="close"><a href="#" onclick="Effect.toggle('addbox', 'blind'); return false;">Close</a></p>
				<h1><img src="/images/icons/add16.gif" alt="" /> Add New User</h1>
				<p class="subtext">Complete the form below to add a new user to your DeskLamp account.</p>			
				<form action="/users/add_user" method="post" onsubmit="return validateForm(this)">
				<table width="99%">
					<tr>
						<td width="25%"><strong>User's name</strong><br />The name of the person using this account</td>
						<td width="25%"><input type="text" name="usersname" dl:validate="presence" title="User's Name" /></td>
						<td width="25%"><strong>E-Mail Address</strong><br />The e-mail address of the person using this account</td>
						<td width="24%"><input type="text" name="email" dl:validate="presence" title="E-Mail Address" /></td>
					</tr>
					<tr>
						<td><strong>Username</strong><br />The username this user should use to login</td>
						<td><input type="text" name="username" dl:validate="presence" title="Username" /></td>
						<td><strong>Password</strong><br />The initial password this user should use to login - they can change it.</td>
						<td><input type="text" name="password" dl:validate="presence" title="Password" /></td>
					</tr>
					<tr>
						<td><strong>User Type</strong><br />What level of access should this user have?</td>
						<td><? selectUserType('type', '', $user[type], '', 'dl:validate="presence" title="User Type"', 1); ?></td>
						<td></td>
						<td></td>
					</tr>
				</table>
				<input type="submit" name="submit" value="Add User" />
				</form>
			</div>
					
			<?php messageArea(); ?>
			
			<?php
				$query = "SELECT * FROM users WHERE accountid = '" . $GLOBALS[account][id] . "'";
				$result = mysql_query($query);
				$rows = mysql_num_rows($result);
			?>
			<p>You currently have <b><?=$rows?></b> user(s).</p>			
			
	        <table width="99%" cellpadding="0" cellspacing="0" border="0" class="datatable">
              <thead>
                <tr class="th">
                  <th width="25%">Name</th>
                  <th width="29%">Username</th>
                  <th width="28%">E-Mail Address</th>
                  <th width="14%">Account Status</th>
				  <th width="2%"></th>
				  <th width="2%"></th>
                </tr>
              </thead>
              <tbody>
			  <?php
			  	while ($user = mysql_fetch_array($result)) { 

				?>
                <tr id="user-<?=$user[id]?>">
                  <td><?=$user[name]?></td>
                  <td><a href="/users/edit/<?=$user[id]?>"><?=$user[username]?></a></td>
                  <td><?=$user[email]?></td>
                  <td><img src="/images/icons/check_green.gif" alt="" /> Active</td>
				  <td><a href="/users/edit/<?=$user[id]?>"><img src="/images/icons/edit16.gif" alt="Edit" border="0" /></a></td>
				  <td><a 
				  onclick="if (confirmCheck('Are you sure you wish to delete this user?\n\nNOTE: This action cannot be reversed.')) { deleteItem('users', '<?=$user[id]?>'); hidewithcolflash('user-<?=$user[id]?>'); return false; } else { return false; }"
				  href="/users/delete_user/<?=$user[id]?>" ><img src="/images/icons/trash16.gif" alt="Delete" border="0" /></a></td>
                </tr>
				<?php
				 	}
				?>
              </tbody>
            </table>
        <p>&nbsp;</p>
	  </div>
	  <div id="rightbar">
	  		<p><strong>User Options</strong></p>
			<ul>
				<li><img src="/images/icons/add16.gif" /> <a href="#" onclick="Effect.toggle('addbox', 'blind')">Add New User</a></li>
				<li><img src="/images/icons/config.gif" /> <a href="/settings"> Back to Settings</a></li>
			</ul>
			<p><strong>User Management </strong> - from here you can manage who can access your DeskLamp account. </p>
	  </div>
	</div>
	<!--- Content End -->

<?
	include ("includes/footer.php"); 
?>
