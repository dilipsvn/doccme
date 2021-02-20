<?php
/*
 * Created on Oct 31, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<div id="ContentMainDesc">
	<div class = "contentMainHeader">
	Email Sent
	</div>
	<div class="textContent">
	Email has been sent to you with your login details
	</div>
	<div class="textContent">
	<?php
	if($_GET["p"] == "DOCTOR")
	{
	?>
	<a href="./login.php?p=DOCTOR">Login Page</a>
	<?php
	}
	elseif($_GET["p"] == "CMEProvider")
	{
	?>
	<a href="./login.php?p=CMEProvider">Login Page</a>
	<?php
	}
	?>
	</div>
</div>