<?php
/*
 * Created on Mar 31, 2007
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
		My Profile
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();">
		</div>
		<div style="clear:both; border: none;"> </div>
	</div>
<div class="textContent"><p>Dear Admin/Agent,here are your details</p></div>
<div class="ERROR">
<?php
if($this->error->isError())
{
	echo $this->error->getUserErrMsg();
}
?>
</div>
<div class="textContent">
	<a href = "home.php">Home</a>>>
</div>
<?php
	$result = "";
	$this->error = $this->bal->getMyProfile($result);
	if($result != null)
	{
		while($profile = mysql_fetch_assoc($result))
		{
?>
<form name="frmRegAgent" id="frmRegAgent" method="post" action="./myProfile.php">
	<table border="0" cellpadding="2" cellspacing="2" width="100%">
		<tr>
			<td class = "labelOfInput"><?php $this->userId->showLabel(); ?></td>
			<td class = "inputbox"><?php echo $profile["UserId"]; ?></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->firstName->showLabel(); ?></td>
			<td class = "inputbox"><?php echo $profile["FirstName"]; ?></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->middleName->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $profile["MiddleName"]; ?> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->lastName->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $profile["LastName"];?></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->contactPhone->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $profile["ContactPhone"];?> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->email->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $profile["EmailId"]; ?></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->loginName->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $profile["UserName"];?></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->status->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $profile["Status"];?></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->remarks->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $profile["Remarks"];?></td>
		</tr>
		
	</table>
</form>
<?php
		}
	
	}
	else
	{	
	
?>
<h5>No details retrieved </h5>
<?php
	}
?>
</div>
