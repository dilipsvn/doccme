<?php
/*
 * Created on Oct 11, 2007
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
		Assign Partial Access to all Doctors
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();">
		</div>
		<div style="clear:both; border: none;"> </div>
	</div>
	<span class="ERROR">
	<?php
	if($this->error->isError())
	{
		echo $this->error->getUserMessage();
	}
	?>
	</span>
	<div class="textContent">
	<a href = "home.php">Home</a>>>
	<a href = "doctors.php">Doctor Options</a>>>
	</div>
	<div class="textContent">
	<?php
	if(!$this->error->isError())
	{
		echo "All the Doctors have been given partial access by admin".
		 "<br/>They can view only the number of courses available";
	}
	?>
	</div>
</div>
