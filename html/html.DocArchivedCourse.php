<script language="JavaScript" type="text/javascript">
function dologout()
{
	document.location.href="./logout.php";
}
</script>
<div id="ContentmainDesc">
	<div class = "contentMainHeader">
		<div style="float: left; width: 48%; margin-left: 3px;">
		Doctor&acute;s Archived Courses
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();">
		</div>
		<div style="clear:both; border: none;"> </div>
	</div>
	<br/>
 <div class="ERROR">
	<?php
	if($this->error->isError())
	{
		echo $this->error->getUserMessage();
	}
	?>
	</div>	
	<div class="textContent">
	<a href="index.php">Home</a>>><a href="doctorOptions.php">Doctor Options</a>>><br/>
	</div>
 <div id="resultBox">	
	<?php
	$from = $_GET["from"];
	$pagecnt = 10;
	if($from < 0)
	{
		echo "invalid range";
	}
	if($from == "" || $from == 0)
	{
		$from = 1;
	}
	
	$this->error = $this->bal->getArchivedCoursesForDoctorWithLimits($result, $from, $pagecnt, $count);
	if($result != null)
	{
	?>	
		<br/>
		<table border="1" cellspacing="0" cellpadding="1" >
		<tr>	
			<th class = "tabledatahead">CourseID</th>
			<th class ="tabledatahead">CourseTitle</th>
			<th class ="tabledatahead">CourseDesc</th>
			<th class ="tabledatahead">City / State</th>
			<th class ="tabledatahead">StartDate</th>
			<th class ="tabledatahead">EndDate</th>
			<th class ="tabledatahead">BookedDate</th>
			<th class ="tabledatahead">Fee</th>
			<th class ="tabledatahead">CMECredits</th>
		</tr>	
	<?php
			while($courses = mysql_fetch_array($result))
			{
	?>
				<tr>
				<td class = "tabledata"><a href="viewCourseDetails.php?id=<?php echo $courses["CourseId"]; ?>"><?php echo $courses["CourseId"]; ?></a></td>
				<td class = "tabledata"><?php echo $courses["CourseTitle"];?></td>
				<td class = "tabledata">
				<?php 
				if($courses["CourseDesc"] == "")
				{
					 echo $courses["CourseTitle"];
				}
				else
				{
					echo $courses["CourseDesc"];
				}
				?>
				</td>
				<td class = "tabledata"><?php echo $courses["Venue_City"] ."/".$courses["Venue_State"];?></td>
				<td class="tabledata">
						<?php 
						$temp1 = explode("-", $courses["CourseStartDate"]);
						$dt1 = mktime(0,0,0,$temp1[1], $temp1[2], $temp1[0]);
						echo date("m/d/Y", $dt1);
						
					?>
				</td>
				<td class="tabledata">
					<?php 
						$temp2 = explode("-", $courses["CourseEndDate"]);
						$dt2 = mktime(0,0,0,$temp2[1], $temp2[2], $temp2[0]);
						echo date("m/d/Y", $dt2);
						
					?>
				</td>
				<td class="tabledata">
					<?php 
						$temp2 = explode("-", $courses["BookingDate"]);
						$dt2 = mktime(0,0,0,$temp2[1], $temp2[2], $temp2[0]);
						echo date("m/d/Y", $dt2);
						
					?>
				</td>
				<td class = "tabledata"><?php echo "$".$courses["CourseFee"];?></td>
				<td class = "tabledata"><?php echo $courses["CMECredits"];?></td>
				</tr>
	<?php
			}
		}
		else
		{
			//echo "result is null";
	?> 
			<br/>
				<table border="1" cellspacing="0" cellpadding="1">
			<tr>	
				
			<th class = "tabledatahead">Course ID</th>
			<th class ="tabledatahead">Course title</th>
			<th class ="tabledatahead">Course desc</th>
			<th class ="tabledatahead">City / State</th>
			<th class ="tabledatahead">Start date</th>
			<th class ="tabledatahead">End date</th>
			<th class ="tabledatahead">Last date</th>
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
	<div class="paginationbar">
	<?php
	$Nav = "";
	if($from > 1)
	{
		if(($from - $pagecnt) > 0)
		{
			$Nav .= "\n"."<a href=\"./docArchivedCourse.php?from=" . ($from - $pagecnt) . "\"><< Prev</a>"."\n";
		}
	}
	if($from < $count)
	{
		if(($from + $pagecnt) < $count)
		{
			$Nav .= "\n"."<a href=\"./docArchivedCourse.php?from=" . ($from  + $pagecnt) . "\">Next >></a>"."\n";
		}
	}
	echo  $Nav;
	?>
</div>

</div>
