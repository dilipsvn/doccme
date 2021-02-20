<?php
/*
 * Created on Mar 26, 2007
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
		View Booked Course Summary
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
	<br/>
	<div class="textContent">
	<a href="index.php">Home</a>>>
	<a href="cmeProviderOptions.php">CME Provider Options</a>>>
	</div>
	<div id="resultBox">	
	<?php
	$from = $_GET["from"];
	$pageCount = 10;
	if($from < 0)
	{
		$this->error->setError(0, "Invalid Range", $this->error->EL->getUIError());
		return $this->error;
	}
	if($from == "")
	{
		$from = 1;
	}
	$cmeId = $_SESSION["UserId"];
	$this->error = $this->bal->getRegisteredCourseSummaryForCMEProviderWithLimits($cmeId, $result, $from, $pageCount, $count);
	if($result != null)
	{
	?>	
	<div class="textContent">
		<b><p>There are  <?php echo $count;?> courses registered by doctors.</p></b>
		
	</div>
	<div class="paginationbar">
	<?php
	$lastPage = ceil($count/$pageCount);
	if($count == 1 || $count == 0 || $count < $pageCount)
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
			echo  " <a href='{$_SERVER['PHP_SELF']}?from=1&PageAction=SEARCH$queryString'> |<- First</a> ";
		    $prevpage = $from-1;
	   		echo "&nbsp;&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$prevpage&PageAction=SEARCH$queryString'><<- Prev </a> ";
		} // if
		
		echo "&nbsp;&nbsp; ( Page $from of $lastPage )&nbsp;&nbsp; ";
		if($from == $lastPage)
		{
			 echo "  Next&nbsp;&nbsp;  Last  ";
		}
		else
		{
	   		$nextpage = $from + 1;
	  		 echo " <a href='{$_SERVER['PHP_SELF']}?from=$nextpage&PageAction=SEARCH$queryString'>Next ->></a> ";
	  		 echo "&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$lastPage&PageAction=SEARCH$queryString'>Last ->|</a> ";
		} // if
	}
	?>
	</div>
	<br/>
		<table border="1" cellspacing="0" cellpadding="1">
		<tr>	
			<th class ="tabledatahead">CourseID</th>
			<th class ="tabledatahead">CourseTitle</th>
			<th class ="tabledatahead">City / State </th>
			<th class ="tabledatahead">Doctor's Name</th>
			<th class ="tabledatahead">StartDate</th>
			<th class ="tabledatahead">EndDate</th>
			<th class ="tabledatahead">BookedDate</th>
			<th class ="tabledatahead">Fee</th>
			<th class ="tabledatahead">CMECredits</th>
			
		</tr>	
	<?php
			while($courses = mysql_fetch_assoc($result))
			{
	?>
				<tr>
				<td class="tabledata"><a href="viewCourseDetails.php?id=<?php echo $courses["CourseId"]; ?>"><?php echo $courses["CourseId"]; ?></a></td>
				<td class="tabledata"><?php echo $courses["CourseTitle"];?></td>
				<td class="tabledata"><?php echo $courses["Venue_City"] . "," . $courses["Venue_State"];?></td>
				<td class="tabledata"><?php echo $courses["FirstName"];?></td>
				<td class="tabledata">
						<?php 
						$temp1 = split("-", $courses["CourseStartDate"]);
						$dt1 = mktime(0,0,0,$temp1[1], $temp1[2], $temp1[0]);
						echo date("m/d/Y", $dt1);
						
					?>
				</td>
				<td class="tabledata">
					<?php 
						$temp2 = split("-", $courses["CourseEndDate"]);
						$dt2 = mktime(0,0,0,$temp2[1], $temp2[2], $temp2[0]);
						echo date("m/d/Y", $dt2);
						
					?>
				</td>
				<td class="tabledata">
					<?php 
						$temp3 = split("-", $courses["BookingDate"]);
						$dt3 = mktime(0,0,0,$temp3[1], $temp3[2], $temp3[0]);
						echo date("m/d/Y", $dt3);
						
					?>
				</td>
				<td class="tabledata"><?php echo "$".$courses["CourseFee"];?></td>
				<td class="tabledata"><?php echo $courses["CMECredits"];?></td>
				</tr>
	<?php
			}
		}
		else
		{
	?> 
			<br/>
			<table border="1" cellspacing="0" cellpadding="1">
			<tr>	
				
			<th class ="tabledatahead">Course ID</th>
			<th class ="tabledatahead">Course title</th>
			<th class ="tabledatahead">City / State</th>
			<th class ="tabledatahead">Doctor's name</th>
			<th class ="tabledatahead">Start date</th>
			<th class ="tabledatahead">End date</th>
			<th class ="tabledatahead">Booked date</th>
			<th class ="tabledatahead">Fee</th>
			<th class ="tabledatahead">CME credits</th>
			</tr>
				<tr>
				<td  colspan="9">No Matching Records Found</td>
				</tr>
	<?php
		}
	?>
	</table>
	</div>
	<br/>
	<div class="paginationbar">
	<?php
	$lastPage = ceil($count/$pageCount);
	if($count == 1 || $count == 0 || $count < $pageCount)
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
			echo  " <a href='{$_SERVER['PHP_SELF']}?from=1&PageAction=SEARCH$queryString'> |<- First</a> ";
		    $prevpage = $from-1;
	   		echo "&nbsp;&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$prevpage&PageAction=SEARCH$queryString'><<- Prev </a> ";
		} // if
		
		echo "&nbsp;&nbsp; ( Page $from of $lastPage )&nbsp;&nbsp; ";
		if($from == $lastPage)
		{
			 echo "  Next&nbsp;&nbsp;  Last  ";
		}
		else
		{
	   		$nextpage = $from + 1;
	  		 echo " <a href='{$_SERVER['PHP_SELF']}?from=$nextpage&PageAction=SEARCH$queryString'>Next ->></a> ";
	  		 echo "&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$lastPage&PageAction=SEARCH$queryString'>Last ->|</a> ";
		} // if
	}
	?>
	</div>

</div>
