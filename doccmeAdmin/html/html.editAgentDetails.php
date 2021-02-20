<?php
/*
 * Created on Mar 28, 2007
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
<div id="ContentmainDesc">
	<div class = "contentMainHeader">
		<div style="float: left; width: 48%; margin-left: 3px;">
		Edit Agent Details
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();"/>
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
	<a href = "home.php">Home</a>>>
	<a href = "agents.php">Agent Options</a>>>
	<a href = "searchAgent.php">Search Agent</a>>>
	</div>
	<br/>
	<div id="resultBox">
	<?php
	$id = $_GET["id"];
	if($_GET["msg"] == "successagentdet")
	{
		echo "Agent details updated successfully";
	}
	if($_GET["msg"] == "successagentpass")
	{
		echo "Agent password reset successful";
	}
	?>
	<form name="frmEditAgent" id="frmEditAgent" method="post" action="./editAgentDetails.php?id=<?php echo $id;?>">
	<input type="hidden" name="PageAction" id="PageAction" value="UPDATE" />
	<input type="hidden" name="PostBack" id="PostBack" value="true" />
	<table border="0" cellpadding="2" cellspacing="2" width="95%">
		<tr>
			<td  class = "labelOfInput"><?php $this->userId->showLabel(); ?></td>
			<td class = "inputbox"><?php $this->userId->showInput(); ?></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->firstName->showLabel(); ?></td>
			<td class = "inputbox"><?php $this->firstName->showInput(); ?>
			<font color ="red"><span id = "error_firstName"><?php echo $this->firstName_error; ?></span></font></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->middleName->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->middleName->showInput(); ?>
			<font color ="red"><span id = "error_middleName"><?php echo $this->middleName_error; ?></span></font> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->lastName->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->lastName->showInput();  ?>
			<font color ="red"><span id = "error_lastName"><?php echo $this->lastName_error; ?></span></font> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->contactPhone->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->contactPhone->showInput();  ?>
			<font color ="red"><span id = "error_contactPhone"><?php echo $this->contactPhone_error; ?></span></font> </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->email->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->email->showInput();  ?>
			<font color ="red"><span id = "error_email"></span></font> </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->loginName->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->loginName->showInput();  ?>
			<font color ="red"><span id = "error_loginName"></span></font>  </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->status->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->status->showSelectList($this->StatusList);  ?>
			<font color ="red"><span id = "error_status"><?php echo $this->status_error;  ?></span></font></td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->remarks->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->remarks->showInput();  ?>
			<font color ="red"><span id = "error_remarks"><?php echo $this->remarks_error;  ?></span></font> </td>
		</tr>
		<tr>
			<td class = "inputbox"> &nbsp;</td>
			<td class = "inputbox"> <input type="submit" value="UPDATE" />
			 &nbsp; <input type="reset" value="RESET" /> </td>
		</tr>
	</table>
	</form>
	</div>
	
  <hr size="2">
  <div id="resultBox">
  <form name="frmEditAgent" id="frmEditAgent"  method="post" action = "./editAgentDetails.php?id=<?php echo $id;?>">
  <table border="0" cellpadding="2" cellspacing="2" width="95%">
  <input type="hidden" name="PageAction" id="PageAction" value="RESET" />
  	<tr>
		<td  class = "labelOfInput"><?php $this->newPassword->showLabel(); ?> </td>
		<td class = "inputbox"><?php $this->newPassword->showInput();  ?>
		<font color ="red"><?php echo $this->newPassword_error; ?> </td></font>
	</tr>
	<tr>
		<td  class = "labelOfInput"><?php $this->confirmNewPassword->showLabel(); ?> </td>
		<td class = "inputbox"><?php $this->confirmNewPassword->showInput();  ?>
		<font color ="red"><?php echo $this->confirmNewPassword_error;echo "\n\n".$this->equalPass_error; ?> </td></font>
	</tr>
	<tr>
		<td class = "inputbox"> &nbsp;</td>
		<td class = "inputbox"> <input type="submit" value="RESET" />
		 &nbsp; <input type="reset" value="CANCEL" /> </td>
	</tr>
  </table>
  </form>
  </div>
</div>
