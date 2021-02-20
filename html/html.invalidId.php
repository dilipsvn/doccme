<?php
/*
 * Created on Dec 6, 2007
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
		Invalid Id
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();">
		</div>
		<div style="clear:both; border: none;"> </div>
	</div>
	<h3><?php
		$type = $_GET["type"];
		if($type == "courseId")
		{
			echo "It is invalid course Id, please check again";
		}
		if($type == "doctorId")
		{
			echo "It is invalid doctor Id, please check again";
		}
		if($type == "cmeproviderId")
		{
			echo "It is invalid cme Id, please check again";
		}
		if($type == "bookingId")
		{
			echo "It is invalid booking Id, please check again";
		}
		if($type == "range")
		{
			echo "Invalid range, please check again";
		}
		if($type == "")
		{
			echo "No type specified";
		}
	?>
	</h3>
</div>
