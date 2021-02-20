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
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();">
		</div>
		<div style="clear:both; border: none;"> </div>
	</div>
	<div class = "ERROR">
		<?php
		if($this->error->isError())
		{
			echo $this->error->getUserMessage();
		}
		?>
	</div>
	
	<?php
	$id = $_GET["id"];
	$this->error = $this->bal->getCourseDetails($id, $result);
	if(mysql_num_rows($result) == 0)
	{
		$this->error->setError(0, "Invalid Course Id", $this->error->EL->getUIError());
		return $this->error;
	}
	else
	{
	?>
	<br/>
	<div class="textContent">
	<a href="index.php">Home</a>>><a href="doctorOptions.php">Doctor Options</a>>><a href="cmeCourseSearch.php">CME Course Search</a><br/>
	</div>
	<div id="resultBox">
	<form name="frmEditCourse" id="frmEditCourse" method="post" action="./bookCourse.php?id=<?php echo $id;?>">
	<input type="hidden" name="PageAction" id="PageAction" value="BookCourse" />
	<input type="hidden" name="BookingId" id="BookingId" value="" />
	<input type="hidden" name="CourseId" id="CourseId" value="" />
	<table border="0" cellpadding="2" cellspacing="2" width="95%">
	<tr>
			<td  class = "labelOfInput"><?php $this->courseId->showLabel();?></td>
			<td class = "inputbox"><?php echo $this->courseId->data;?> </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->courseTitle->showLabel();?></td>
			<td class = "inputbox"><?php echo $this->courseTitle->data;?> </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->speciality->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->speciality->data; ?>
			</td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->address1->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->address1->data;  ?></td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->city->showLabel();?> </td>
			<td class = "inputbox"><?php echo $this->city->data;?></td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->state->showLabel();?> </td>
			<td class = "inputbox"><?php echo $this->state->data;?></td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->zip->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->zip->data;  ?></td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->country->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->country->data;  ?></td>
		</tr>
		<tr>
			<td class="labelOfInput"><?php $this->courseStartDate->showLabel(); ?></td>
			<td class="inputbox"><?php echo $this->courseStartDate->data; ?></td>
		</tr>
		<tr>
			<td class="labelOfInput"><?php $this->courseEndDate->showLabel(); ?></td>
			<td class="inputbox"><?php echo $this->courseEndDate->data; ?></td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->lastDateForApp->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->lastDateForApp->data; ?> </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->courseFee->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo "$".$this->courseFee->data;  ?> </td>
		</tr>
		<tr>
			<td class = "inputbox"> &nbsp;</td>
			<td class = "inputbox"> <input type="submit" value="BOOK COURSE" />
			</td>
		</tr>
	
	</table>
	</form>
	</div>
	<?php
	}
	?>

	
</div>
