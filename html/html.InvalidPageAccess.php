<script language="JavaScript" type="text/javascript">
function dologout()
{
	document.location.href="./logout.php";
}
</script>
<div id="ContentMainDesc">
	<div class = "contentMainHeader">
		<div style="float: left; width: 48%; margin-left: 3px;">
		Invalid Page Access
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		<?php if($_SESSION["UserName"] != "")
		{
		?>
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();">
		<?php
		}
		?>
		</div>
		<div style="clear:both; border: none;"> </div>
	</div>
	<h3>You are not authorized to view this page</h3>
</div>
	
