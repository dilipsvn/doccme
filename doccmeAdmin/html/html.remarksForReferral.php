<?php
/*
 * Created on Nov 20, 2007
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
		Remarks for Referral
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();">
		</div>
		<div style="clear:both; border: none;"> </div>
	</div>
	<div class="ERROR">
	<?php
	if($this->error->isError())
	{
		echo $this->error->getUserMessage();
	}
	?>
	</div>
	<div class="textContent">
	<a href = "home.php">Home</a>>><a href = "referralList.php">Referrals</a>
	</div>
<br/>
	<form name="frmRegReferral" id="frmRegReferral" method="post" action="<?php echo $PHP_SELF;?>">
	<input type="hidden" name="PageAction" id="PageAction" value="Add Remarks" />
	<table border="0" cellpadding="2" cellspacing="2" width="100%">
	<tr>
			<td  class = "labelOfInput"><?php $this->remarks->showLabel(); ?></td>
			<td class = "inputbox" ><?php $this->remarks->showTextArea(); ?>*
			</td>
	</tr>
	<tr>
			<td  class = "inputbox"> &nbsp;</td>
			<td  class = "inputbox"> <input type="submit" name="submit" value="Add Remarks"/>
		</tr>
</table>
</form>
</div>
