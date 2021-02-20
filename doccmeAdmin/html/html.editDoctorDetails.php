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
		Edit Doctor Details 
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
	<a href = "doctors.php">Doctor Options</a>>>
	<a href = "searchDoctor.php">Search Doctor</a>>>
	</div>
	<div class="textContent">
	<b><a href = "docActiveCourses.php?id=<?php echo $this->id;?>">Active Courses </a>|</b>
	<b><a href = "docArchivedCourses.php?id=<?php echo $this->id;?>">Archived Courses</a></b>

	</div>
	<?php
	$id = $_GET["id"];
	?>
	<div id="resultBox">
	<?php
	$id = $_GET["id"];
	if($_GET["msg"] == "successdocdet")
	{
		echo "Doctor details updated successfully";
	}
	if($_GET["msg"] == "successdocpass")
	{
		echo "Doctor password reset successful";
	}
	?>
	<form name="frmEditDoctor" id="frmEditDoctor" method="post" action="./editDoctorDetails.php?id=<?php echo $id;?>">
	
	<table border="0" cellpadding="2" cellspacing="2" width="95%">
		<tr>
			<td  class = "labelOfInput"><?php $this->doctorId->showLabel(); ?></td>
			<td class = "inputbox"><?php $this->doctorId->showInput(); ?></td>
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
			<font color ="red"><span id = "error_lastName">*<?php echo $this->lastName_error; ?></span></font> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->sex->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->sex->showInput(); ?>
			<font color ="red"><span id = "error_sex"><?php echo $sex_error; ?></span></font></td>
		</tr>

		<tr>
			<td class = "labelOfInput"><?php $this->address1->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->address1->showInput();  ?><font color ="red">*
			<span id = "error_address1"><?php echo $this->address1_error; ?></span></font></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->address2->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->address2->showInput();  ?>
			<font color ="red"><span id = "error_address2"><?php echo $this->address2_error; ?></span></font> </td>
		</tr>

		<tr>
			<td class = "labelOfInput"><?php $this->city->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->city->showInput();  ?>
			<font color ="red">*<span id = "error_city"><?php echo $this->city_error; ?></span></font> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->state->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->state->showSelectList($this->StateList);  ?> 
			<font color ="red">*<span id = "error_state"><?php echo $this->state_error; ?></span></font> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->zip->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->zip->showInput();  ?>
			<font color ="red"><span id = "error_zip"><?php echo $this->zip_error; ?></span></font> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->country->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->country->showInput();  ?> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->workPhone->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->workPhone->showInput();  ?>
			<font color ="red"><span id = "error_workPhone"><?php echo $this->workPhone_error; ?></span></font> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->homePhone->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->homePhone->showInput();  ?>
			<font color ="red"><span id = "error_homePhone"><?php echo $this->homePhone_error; ?></span></font>  </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->fax->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->fax->showInput();  ?>
			<font color ="red"><span id = "error_fax"><?php echo $this->fax_error; ?></span></font>  </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->mobilePhone->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->mobilePhone->showInput();  ?>
			<font color ="red"><span id = "error_mobilePhone"><?php echo $this->mobilePhone_error; ?></span></font> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->email->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->email->showInput();  ?>
			<font color ="red"><span id = "error_email"><?php echo $this->email_error; ?></span></font> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->speciality->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->speciality->showSelectList($this->SpecialityList);  ?>
			<font color ="red"><span id = "error_speciality"><?php echo $this->speciality_error; ?></span></font> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->contactTime->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->contactTime->showInput();  ?>
			<font color ="red"><span id = "error_contactTime"><?php echo $this->contactTime_error; ?></span></font> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->loginName->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->loginName->showInput();  ?>
			<font color ="red"><span id = "error_loginName"></span></font> </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->status->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->status->showSelectList($this->StatusList);  ?>
			<font color ="red"><span id = "error_status"><?php echo $this->status_error; ?></span></font> </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->remarks->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->remarks->showInput();  ?>
			<font color ="red"><span id = "error_remarks"><?php echo $this->remarks_error; ?> </td>
		</tr>
		<tr>
			<td><input type="hidden" name="PageAction" id="PageAction" value="UPDATE" /></td>
			<td><input type="hidden" name="PostBack" id="PostBack" value="true" /></td>
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
  <form name="frmEditDoctor" id="frmEditDoctor"  method="post" action = "./editDoctorDetails.php?id=<?php echo $id;?>">
  <table border="0" cellpadding="2" cellspacing="2" width="95%">
  <input type="hidden" name="PageAction" id="PageAction" value="RESET" />
  	<tr>
		<td  class = "labelOfInput"><?php $this->newPassword->showLabel(); ?> </td>
		<td class = "inputbox"><?php $this->newPassword->showInput();  ?>
		<font color ="red"><?php echo $this->newPassword_error; ?></font>
		 </td>
	</tr>
	<tr>
		<td  class = "labelOfInput"><?php $this->confirmNewPassword->showLabel(); ?> </td>
		<td class = "inputbox"><?php $this->confirmNewPassword->showInput();  ?>
		<font color ="red"><?php echo $this->confirmNewPassword_error;echo "\n\n" .$this->equalPass_error; ?></font>
		 </td>
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
