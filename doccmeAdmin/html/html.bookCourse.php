<?php
/*
 * Created on Apr 2, 2007
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
		Book CME Course
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
	<a href = "bookCMECourse.php">Booked Courses' List</a>>>
	</div>
	<br/>
	<div id="resultBox">
	<form name="frmBookCourse" id="frmBookCourse" method="post" action="./bookCourse.php">
	<input type="hidden" name="PageAction" id="PageAction" value="Book" />
	<table border="0" cellpadding="2" cellspacing="2" width="95%">
	<tr>
		<td  class = "labelOfInput"><?php $this->bookingId->showLabel();?></td>
		<td class = "inputbox"><?php $this->bookingId->showInput();?> </td>
	</tr>
	<tr>
		<td  class = "labelOfInput"><?php $this->doctorId->showLabel();?></td>
		<td class = "inputbox"><?php $this->doctorId->showInput();?> </td>
	</tr>
	<tr>
		<td  class = "labelOfInput"><?php $this->courseId->showLabel();?></td>
		<td class = "inputbox"><?php $this->courseId->showInput();?> </td>
	</tr>
	<tr>
		<td  class = "labelOfInput"><?php $this->paymentMode->showLabel();?></td>
		<td class = "inputbox"><?php $this->paymentMode->showInput();?> </td>
	</tr>
	<tr>
		<td  class = "labelOfInput"><?php $this->amount->showLabel();?></td>
		<td class = "inputbox"><?php $this->amount->showInput();?> </td>
	</tr>
	<tr>
		<td  class = "labelOfInput"><?php $this->agentId->showLabel();?></td>
		<td class = "inputbox"><?php $this->agentId->showInput();?> </td>
	</tr>
	<tr>
		<td  class = "labelOfInput"><?php $this->bookStatus->showLabel();?></td>
		<td class = "inputbox"><?php $this->bookStatus->showSelectList($this->bookStatusList);?> </td>
	</tr>
	<tr>
		<td class = "inputbox">&nbsp; </td>
		<td class = "inputbox"><input type="submit" value="BOOK"/>
			
	</tr>
	</table>
	</form>
</div>	
</div>
