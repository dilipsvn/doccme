<?php
/*
 * Created on Oct 3, 2007
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
		Course Payment Failure
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logoout" value="Logout" onclick="dologout();"/>
		</div>
		<div style="clear:both; border:none;"> </div>
	</div>
	<div class ="ERROR">
	<?php
		if($this->error->isError())
		{
		echo $this->error->getUserMessage();
		}
	?>
	</div>	
	<div class="textContent">
		</p>Course could not be booked due to failure in payment</p>
		<p><input type="button" id="Proceed" name="Proceed" value="Proceed" onclick="javascript:document.location.href ='./searchCMECourse.php' "/> </p>
	</div>
</div>

