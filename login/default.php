<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>DeskLamp - Login</title>
<link href="/css/core.css" rel="stylesheet" type="text/css" />
<link href="/css/colours.blue.css" rel="stylesheet" type="text/css" />

<script src="/javascript/generic.js" type="text/javascript"></script>
<script src="/javascript/prototype.js" type="text/javascript"></script>
<script src="/javascript/scrip/scriptaculous.js" type="text/javascript"></script>
<script type="text/javascript" src="/javascript/pngfix.js"></script>
<script language="javascript" type="text/javascript">
	function setfocus() { 
	 var username = document.getElementById("username");
	 username.focus(); 
	}
	addLoadEvent(setfocus);
</script>

</head>

<body class="login">
<div id="login">
	<p>
		<?php
			if ($GLOBALS[account][logo] <> "") { 
				if ($GLOBALS[account][logo_border] == 1) { $border = "class=\"logoborder\""; }
				print "<img id=\"companylogo\" src=\"/images/logos/".$GLOBALS[account][logo]."\">";
			}
		?>			<form action="/login/process" method="post" id="form" onsubmit="validateLogin(this); return false;">
			
			<?php
				messageArea();
			?>
			
			<p>Username<br /> <input type="text" name="username" id="username" value="<?=$_SESSION[username]?>" /></p>
			<p>Password<br /> <input type="password" name="password" /></p>
			<p class="subtext"><input type="checkbox" name="remember" onchange="Effect.toggle('remember-text', 'blind')" /> Remember my account on this computer</p>
			<p id="remember-text" style="display:none;">
				<b>Please Note:</b> only remember your login on computers you trust - remember anybody with access to this computer will have access to your DeskLamp system.
			</p>
			<p><input type="submit" name="Submit" value="Login" /></p>

		</form>

			<p><a href="#" onclick="Effect.toggle('forgotpassword', 'blind')">Forgot your password?</a></p>
			<div id="forgotpassword" style="display:none;">
				<form action="" method="post">
					<h1>Forgotton Password Request</h1>
					<p>Please enter your username and we will e-mail your password to your registered e-mail. If you have forgotton your username you need to contact your DeskLamp administrator.</p>
					<p><input type="text" name="forgotpassword" /></p>
					<p><input type="submit" name="submit"  value="Submit Request"/></p>
					<p><a href="#" onclick="Effect.toggle('forgotpassword', 'blind')">Cancel Request</a></p>
				</form>
			</div>
</div>
</body>
</html>
<? $_SESSION[username] = ""; ?>
