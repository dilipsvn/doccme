<?php
/*
 * Created on April 2, 2007
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
		View Booked CME Courses
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
	</div>
	<div id="resultBox">
	<br/>
	<?php
		$from = $_GET["from"];
		$pageCount = 10;
		if($from < 0)
		{
			echo "invalid range";
		}
		if($from == "")
		{
			$from = 1;
		}
		$this->error = $this->bal->getBookedCoursesWithLimits($result, $from, $pageCount, $count);
		if($result != null)
		{
			?>
			<div class="textContent">
		There are <?php echo $count;?> courses booked by the doctors.<br/>
		
		</div>
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
			echo  "First &nbsp;&nbsp;  Prev  ";
		}
		else
		{
			echo  " <a href='{$_SERVER['PHP_SELF']}?from=1'> |<- First</a> ";
		    $prevpage = $from-1;
	   		echo "&nbsp;&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$prevpage'><<- Prev </a> ";
		} // if
		
		echo "&nbsp;&nbsp; ( Page $from of $lastPage )&nbsp;&nbsp; ";
		if($from == $lastPage)
		{
			 echo "  Next&nbsp;&nbsp;  Last  ";
		}
		else
		{
	   		$nextpage = $from + 1;
	  		 echo " <a href='{$_SERVER['PHP_SELF']}?from=$nextpage'>Next ->></a> ";
	  		 echo "&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$lastPage'>Last ->|</a> ";
		} // if
	}
	?>
	</div>
	<br/>
			<table border="1" cellspacing="1" cellpadding="1" width="100%">
				
				<tr>	
					<th class ="tabledatahead">BookingId</th>
					<th class ="tabledatahead">DoctorID</th>
					<th class ="tabledatahead">CourseId</th>
					<th class ="tabledatahead">PaymentMode</th>
					<th class ="tabledatahead">Amount</th>
					<th class ="tabledatahead">AgentId</th>
					<th class ="tabledatahead">BookingStatus</th>
				
				</tr>
		<?php
			while($course = mysql_fetch_assoc($result))
			{
		?>
				<tr>
					<td ><a href="viewBookingDetails.php?id=<?php echo $course["BookingId"]; ?>"><?php echo $course["BookingId"]; ?></a></td>
					<td ><a href="viewDoctorDetails.php?id=<?php echo $course["DoctorId"]; ?>"><?php echo $course["DoctorId"]; ?></a></td>
					<td ><a href="viewCourseDetails.php?id=<?php echo $course["CourseId"]; ?>"><?php echo $course["CourseId"]; ?></a></td>
					<td ><?php echo $course["PaymentMode"];?></td>
					<td ><?php echo "$".$course["Amount"];?></td>
					<td ><a href="viewAgentDetails.php?id=<?php echo $course["AgentId"]; ?>"><?php echo $course["AgentId"]; ?></a></td>
					<td ><?php echo $course["BookStatus"];?></td>
	<?php
			}
		?>
		</table>
	<?php
		}
		else
		{ 
	?>
	<br/>
				<table border="1" cellspacing="1" cellpadding="1" width="75%">
			<tr>	
					<th class ="tabledatahead">BookingId</th>
					<th class ="tabledatahead">DoctorID</th>
					<th class ="tabledatahead">CourseId</th>
					<th class ="tabledatahead">PaymentMode</th>
					<th class ="tabledatahead">Amount</th>
					<th class ="tabledatahead">AgentId</th>
					<th class ="tabledatahead">BookingStatus</th>
				
				</tr>
				<tr>
				<td  colspan="8">No Matching Records Found</td>
				</tr>
				</table>
	<?php
		}
	
	?>
	</div>
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
			echo  "First &nbsp;&nbsp;  Prev  ";
		}
		else
		{
			echo  " <a href='{$_SERVER['PHP_SELF']}?from=1'> |<- First</a> ";
		    $prevpage = $from-1;
	   		echo "&nbsp;&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$prevpage'><<- Prev </a> ";
		} // if
		
		echo "&nbsp;&nbsp; ( Page $from of $lastPage )&nbsp;&nbsp; ";
		if($from == $lastPage)
		{
			 echo "  Next&nbsp;&nbsp;  Last  ";
		}
		else
		{
	   		$nextpage = $from + 1;
	  		 echo " <a href='{$_SERVER['PHP_SELF']}?from=$nextpage'>Next ->></a> ";
	  		 echo "&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$lastPage'>Last ->|</a> ";
		} // if
	}
	?>
	</div>
</div>
