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
<div id="ContentMainDesc">
	<div class = "contentMainHeader">
		<div style="float: left; width: 48%; margin-left: 3px;">
		Search Doctor 
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
	<a href = "home.php">Home</a>>>
	<a href = "doctors.php">Doctor Options</a>>>
	</div>
<br/>
	<form name="frmRegDoctor" id="frmRegDoctor" method="post" action="<?php echo $PHP_SELF;?>">
	<input type="hidden" name="PageAction" id="PageAction" value="SEARCH" />
	<table border="0" cellpadding="2" cellspacing="2" width="100%">
		
		<tr>
			<td  class = "labelOfInput"><?php $this->firstName->showLabel(); ?></td>
			<td class = "inputbox" ><?php $this->firstName->showInput(); ?>
			<font color = "red"><span id= "error_firstName"><?php echo $this->checkFirstName(); ?></font></span> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->lastName->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->lastName->showInput();  ?> 
			<font color = "red"><span id= "error_lastName"><?php echo $this->checkLastName(); ?></font></span> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->sex->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->sex->showSelectList($this->SexList); ?>
			<font color = "red"><span id= "error_sex"><?php echo $this->checkSex(); ?></font></span></td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->address1->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->address1->showInput();  ?>
			<font color = "red"><span id= "error_address1"><?php echo $this->checkAddress1(); ?></font></span>  </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->city->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->city->showInput();  ?>
			<font color = "red"><span id= "error_city"><?php echo $this->checkCity(); ?></font></span> </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->state->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->state->showSelectList($this->StateList);  ?>
			<font color = "red"><span id= "error_state"><?php echo $this->checkState(); ?></font></span>  </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->email->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->email->showInput();  ?>
			<font color = "red"><span id= "error_email"><?php echo $this->checkEmail(); ?></font></span> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->speciality->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->speciality->showSelectList($this->SpecialityList);  ?>
			<font color = "red"><span id= "error_speciality"><?php echo $this->checkSpeciality(); ?></font></span> </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->loginName->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->loginName->showInput();  ?>
			<font color = "red"><span id= "error_loginName"><?php echo $this->checkLoginName(); ?></font></span>  </td>
		</tr>
		<tr>
			<td  class = "inputbox"> &nbsp;</td>
			<td  class = "inputbox"> <input type="image" name="submit" value="SEARCH" src="./images/search_but.gif" width="81" height="22">
			
		</tr>
</table>
</form>
<br>
	<div class="success">
	<?php
	
	if($_GET["msg"] == "successdocdet")
	{
		echo "Doctor Details have been updated successfully";
	}
	elseif($_GET["msg"] == "successdocpass")
	{
		echo "Doctor password reset has been successful";
	}
	?>
	</div>

</div>
