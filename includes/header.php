<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>DeskLamp - <? print $GLOBALS[account][companyname]; ?> - <?=PageTitle?></title>
<link href="/css/core.css" rel="stylesheet" type="text/css" />
<link href="/css/colours.<? print $GLOBALS[account][colourscheme]; ?>.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="/favicon.ico" >
<script src="/javascript/generic.js" type="text/javascript"></script>
<script src="/javascript/prototype.js" type="text/javascript"></script>
<script src="/javascript/scrip/scriptaculous.js" type="text/javascript"></script>

<script type="text/javascript" src="/javascript/pngfix.js"></script>
<script type="text/javascript" src="/javascript/ajax/generic.js"></script>
</head>

<body>
<div id="wrapper">

	<!--- Header Start -->
	<div id="headerstripe"></div>
	<div id="header">
		<div class="logo"><img src="/images/desklamp.png" alt="DeskLamp" /></div>
		<div class="q3ilogo"><img src="/images/q3i.png" alt="Powered by Q3 interactive" /></div>
		<div class="name"><?=$GLOBALS[account][companyname]?></div>
		<div class="nav">
			<ul>
				<li><a href="/dashboard/" <? if ($_GET[m] == "dashboard") { print "class=\"active\""; } ?>>Dashboard</a></li>
				<li><a href="/clients/" <? if ($_GET[m] == "clients") { print "class=\"active\""; } ?>>Clients</a></li>
				<li><a href="/hosting/" <? if ($_GET[m] == "hosting") { print "class=\"active\""; } ?>>Hosting</a></li>
				<li><a href="/domains/" <? if ($_GET[m] == "domains") { print "class=\"active\""; } ?>>Domains</a></li>
				<li><a href="/invoicing/">Invoicing</a></li>
				<? if ($_SESSION[user][type] == "admin") { ?>
				<li><a href="/settings/" <? if ($_GET[m] == "settings" || $_GET[m] == "users") { print "class=\"active\""; } ?>>Settings</a></li>
				<? } ?>
			</ul>
		</div>
	</div>
	<!--- Header End -->
	