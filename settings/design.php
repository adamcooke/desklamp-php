<?php
	if ($GLOBALS[called] == false) { 
		header("Location:/");
	}
	define(PageTitle, "Design Preferences"); 
	include ("includes/header.php"); 
	
?>
	<!--- Content Start -->
	
	<div id="container">
	  <div id="content">
			<h1><img src="/images/icons/dashboard.gif" /> Design Preferences </h1>
			<hr />
			
			<?php messageArea(); ?>

		<form action="/settings/save_settings/design" method="post">
			<div class="setting-block">
			<p><strong>Colour Scheme </strong></p>
			<p class="subtext">You can choose from a variety of different pre-defined colour schemes to use with your DeskLamp system. </p>
			<?php
			
			function iscolscheme($scheme) { 
				if ($GLOBALS[account][colourscheme] == $scheme) { 
					print "checked=\"checked\"";
				}
			
			}
			?>
			<table width="99%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="2%"><input name="colourscheme" type="radio" value="blue" <? if (iscolscheme('blue')); ?> /> </td>
                <td width="15%" align="center"><strong>Default </strong></td>
				<td width="83%"><img src="../images/schemes/defautlblue.gif" width="300" height="50" /></td>
              </tr>
              <tr>
                <td><input name="colourscheme" type="radio" value="red" <? if (iscolscheme('red')); ?> /> </td>
                <td align="center"><strong>Red</strong></td>
				<td><img src="../images/schemes/red.gif" width="300" height="50" /></td>
              </tr>
              <tr>
                <td><input name="colourscheme" type="radio" value="green" <? if (iscolscheme('green')); ?> /> </td>
                <td align="center"><strong>Green </strong></td>
				<td><img src="../images/schemes/green.gif" width="300" height="50" /></td>
              </tr>
              <tr>
                <td><input name="colourscheme" type="radio" value="pink" <? if (iscolscheme('pink')); ?> /> </td>
                <td align="center"><strong>Pink </strong></td>
				<td><img src="../images/schemes/pink.gif" width="300" height="50" /></td>
              </tr>
              <tr>
                <td><input name="colourscheme" type="radio" value="grey" <? if (iscolscheme('grey')); ?> /> </td>
                <td align="center"><strong>Grey </strong></td>
				<td><img src="../images/schemes/grey.gif" width="300" height="50" /></td>
              </tr>
            </table>
			<p>If you have any colour schemes you would like to submit, please <a href="mailto:hello@getdesklamp.com">contact us</a>.</p>
			</div>
			<input type="submit" name="submit" value="Save Settings" />
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
