<?php
/*
 * Created on Apr 6, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<script language="JavaScript" type="text/javascript">
function doBookCourse()
{
	document.getElementById('PageAction').value="BookCourse";
	document.getElementById('frmBookCourse').submit();
}
function doSearchDoctor()
{
	document.getElementById('PageAction').value="SEARCH";
	document.getElementById('frmBookCourse').submit();
}
</script>
<script language="JavaScript" type="text/javascript">
function dologout()
{
	document.location.href="./logout.php";
}
</script>
<div id="ContentMainDesc">
	<div class = "contentMainHeader">
		<div style="float: left; width: 48%; margin-left: 3px;">
		Book Course For Doctor
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();"/> 
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
	<div class = "success">
	<?php
	if($_GET["msg"] == "success")
	{
		echo "Course has been booked successfully";
	}
	?>
	<?php
	$id = $_GET["id"];
	?>
	</div>
	<div class="textContent">
	<a href = "home.php">Home</a>>>
	<a href = "searchCMECourse.php">Search CME Course</a>>>
	</div>
	
	<br/>
	<div id="resultBox">
	<form name="frmBookCourse" id="frmBookCourse" method="post" action="./bookCourseForDoctor.php?id=<?php echo $id;?>">
	<input type="hidden" name="PageAction" id="PageAction" value="" />
	<table name="CourseDetails"  border="0" cellpadding="2" cellspacing="2" width="95%">
		<tr>
			<td  class = "labelOfInput"><?php $this->courseId->showLabel();?></td>
			<td class = "inputbox"><?php $this->courseId->showInput();?> </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->courseTitle->showLabel();?></td>
			<td class = "inputbox"><?php $this->courseTitle->showInput();?> </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->courseaddress1->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->courseaddress1->showInput();  ?></td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->coursecity->showLabel();?> </td>
			<td class = "inputbox"><?php $this->coursecity->showInput();?></td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->coursestate->showLabel();?> </td>
			<td class = "inputbox"><?php $this->coursestate->showInput();?></td>
		</tr>
		
		<tr>
			<td class="labelOfInput"><?php $this->courseStartDate->showLabel(); ?></td>
			<td class="inputbox"><?php $this->courseStartDate->showInput(); ?></td>
		</tr>
		<tr>
			<td class="labelOfInput"><?php $this->courseEndDate->showLabel(); ?></td>
			<td class="inputbox"><?php $this->courseEndDate->showInput(); ?></td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->lastDateForApp->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->lastDateForApp->showInput(); ?> </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->courseFee->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->courseFee->showInput();  ?> </td>
		</tr>
</table>

  <hr  size="2">
  
  
<table name="BookingDetails" border="0" cellpadding="2" cellspacing="2" width="95%">
		<tr>
			<td class = "labelOfInput"><?php $this->firstName->showLabel(); ?></td>
			<td class = "inputbox"><?php $this->firstName->showInput(); ?>*
			<font color = "red"><span id= "error_firstName"><?php echo $this->checkFirstName(); ?></font></span></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->lastName->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->lastName->showInput();  ?>* 
			<font color = "red"><span id= "error_lastName"><?php echo $this->checkLastName(); ?></font></span> </td>
		</tr>
		<tr>
			<td class = "inputbox"> &nbsp;</td>
			<td class = "inputbox"> <input type="button" value="SearchDoctor" onclick="doSearchDoctor();"/>
			</td>
		</tr>
	
</table>
<br/>
<div id = "resultBox">
<?php
	
	
	$firstName = $_REQUEST["firstName"];
	$lastName = $_REQUEST["lastName"];
	if($firstName !=null)
	{
		$queryString = $queryString . "&firstName=" . $firstName;
	}
	if($lastName !=null)
	{
		$queryString = $queryString . "&lastName=" . $lastName;
	}
	$from = $_GET["from"];
	$pageCount = 5;
	if($from < 0)
	{
		echo "invalid range";
	}
	if($from == "")
	{
		$from = 1;
	}
	if($this->PageAction=="SEARCH")
	{
		$this->error = $this->bal->getDoctorSearchResultsWithLimits_2($this->doctor, $result, $from, $pageCount, $count);
		
		if($result !=null)
		{
		
	?>
			
	
			<table border="1" cellspacing="1" cellpadding="1" width="80%">
			<tr>	
				<th class ="tabledatahead">DoctorID</th>
				<th class ="tabledatahead">FirstName</th>
				<th class ="tabledatahead">LastName</th>
				<th class ="tabledatahead">Sex</th>
				<th class ="tabledatahead">City/State</th>
				<th class ="tabledatahead">EmailId</th>
				<th class ="tabledatahead">Speciality</th>
				<th class ="tabledatahead">UserName</th>
			</tr>
		
	<?php
			
			while($Doctor = mysql_fetch_assoc($result))
			{
				
	?>
				<tr>
				<td class="tabledata"><a href="Javascript: document.getElementById('doctorId').value='<?php echo $Doctor["DoctorId"]; ?>';document.getElementById('frmBookCourse').submit();"><?php echo $Doctor["DoctorId"]; ?></a></td>
				<td class="tabledata"><?php echo $Doctor["FirstName"];?></td>
				<td class="tabledata"><?php echo $Doctor["LastName"];?></td>
				<td class="tabledata"><?php echo $Doctor["Sex"];?></td>
				<td class="tabledata"><?php echo $Doctor["City"] . "," . $Doctor["State"];?></td>
				<td class="tabledata"><?php echo $Doctor["EmailId"];?></td>
				<td class="tabledata"><?php echo $Doctor["Speciality"];?></td>
				<td class="tabledata"><?php echo $Doctor["UserName"];?></td>
	<?php
			}
		}
		else
		{ 
	?>
				<table border="1" cellspacing="1" cellpadding="1" width="75%">
			<tr>	
				<th class ="tabledatahead">DoctorID</th>
				<th class ="tabledatahead">FirstName</th>
				<th class ="tabledatahead">LastName</th>
				<th class ="tabledatahead">Sex</th>
				<th class ="tabledatahead">City/State</th>
				<th class ="tabledatahead">EmailId</th>
				<th class ="tabledatahead">Speciality</th>
				<th class ="tabledatahead">UserName</th>
			</tr>
				<tr>
				<td class="tabledata" colspan="7">No Matching Records Found</td>
				</tr>
	<?php
		}
	}
	?>
	</table>
	</div>
	
	<br/>
	<div class="paginationbar">
	<?php
	$lastPage = ceil($count/$pageCount);
	if($count == 1 || $count == 0 || $count <= $pageCount)
	{
		echo "";
	}
	else
	{
		if($from < 1)
		{
			$from = 1;
		}
		elseif ($from > $lastPage)
		{
	   		$from = $lastPage;
		} // if
		if($from == 1)
		{
			echo  "First &nbsp;&nbsp;Prev";
		}
		else
		{
			echo  " <a href='{$_SERVER['PHP_SELF']}?from=1&id=$id&PageAction=SEARCH&$queryString'> |<- First</a> ";
		    $prevpage = $from-1;
	   		echo "&nbsp;&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$prevpage&id=$id&PageAction=SEARCH&$queryString'><<- Prev </a> ";
		} // if
		
		echo "&nbsp;&nbsp; ( Page $from of $lastPage )&nbsp;&nbsp; ";
		if($from == $lastPage)
		{
			 echo "  Next&nbsp;&nbsp;  Last  ";
		}
		else
		{
	   		$nextpage = $from + 1;
	  		 echo " <a href='{$_SERVER['PHP_SELF']}?from=$nextpage&id=$id&PageAction=SEARCH&$queryString'>Next ->></a> ";
	  		 echo "&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$lastPage&id=$id&PageAction=SEARCH&$queryString'>Last ->|</a> ";
		} // if
	}
	?>
	</div>
	<hr  size="2">
	<table name="BookingDetails" border="0" cellpadding="2" cellspacing="2" width="95%">
		<tr>
			<td  class = "labelOfInput"><?php $this->courseId->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->courseId->showInput();  ?> </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->doctorId->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->doctorId->showInput();  ?>
			<font color = "red"><span id = "error_doctorId"><?php echo $this->doctorId_error;?></font></span> </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->amount->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->amount->showInput();  ?> </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->paymentMode->showLabel();?> </td>
			<td class = "inputbox"><?php $this->paymentMode->showSelectList($this->PaymentModeList);?></td>
		</tr>
		<tr>
			<td class = "inputbox"> &nbsp;</td>
			<td class = "inputbox"> <input type="button" value="BookCourse" onclick="doBookCourse();"/>
			</td>
		</tr>
	
</table>
	</form>
</div>	
</div>
