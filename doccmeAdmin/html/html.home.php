<?php
/*
 * Created on Mar 26, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<script language="JavaScript" type="text/javascript">
function dologout()
{
	document.location.href="./logout.php";
}
</script>
<div id="ContentMainDesc">
	<div class = "contentMainHeader">
		<div style="float: left; width: 48%; margin-left: 3px;">
		Doccme Admin Home Page
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();"/>
		</div>
		<div style="clear:both; border: none;"> </div>
	</div>
	
<h3>
<?php
  if(isset($_SESSION["Role"]))
 {
 	if($_SESSION["Role"] == "ADMIN")
 	{
 		//echo "Welcome Admin, you have successfully logged in";
 	}
 	elseif($_SESSION["Role"] == "AGENT")
 	{
 		echo "Welcome Agent, you have successfully logged in";
 	}
 }
 ?>
</h3>

</div>
