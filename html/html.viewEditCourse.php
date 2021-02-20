<script language="JavaScript" type="text/javascript">
function dologout()
{
	document.location.href="./logout.php";
}
</script>
<div id="ContentmainDesc">
	<div class = "contentMainHeader">
		<div style="float: left; width: 48%; margin-left: 3px;">
		View / Edit Course
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();">
		</div>
		<div style="clear:both; border: none;"> </div>
	</div>
	<br/>
	<div class="textContent">
      	<a href="index.php">Home</a>>>
	<a href="cmeProviderOptions.php">CME Provider Options</a>>>
	</div>
 	<div class="ERROR">
	<?php
	if($this->error->isError())
	{
		echo $this->error->getUserMessage();
	}
	?>
	</div>
	<br/>
	<div class ="success">
	<?php
	if($_GET["msg"] == "success")
	{
		echo "<b>Course has been updated successfully</b>";
	}
	?>
	</div>
	<br/>
	
	 <div id="resultBox">	
	<?php
		$from = $_GET["from"];
		
		$pagecnt = 10;
		if($from < 0)
		{
			echo "invalid range";
			
		}
		if($from == "")
		{
			$from = 1;
		}
		
		
		$this->error = $this->bal->getCMECourseDetailsForCMEProviderWithLimits($result, $id, $from,$pagecnt, $count);
		
		if($result != null)
		{
		
	?>	
		<table border="1" cellspacing="0" cellpadding="1">
		<tr>	
			<th class ="tabledatahead">CourseID</th>
			<th class ="tabledatahead">CourseTitle</th>
			<th class ="tabledatahead">CourseDesc</th>
			<th class ="tabledatahead">City / State </th>
			<th class ="tabledatahead">StartDate</th>
			<th class ="tabledatahead">EndDate</th>
			<th class ="tabledatahead">LastDate</th>
			<th class ="tabledatahead">CourseFee</th>
			<th class ="tabledatahead">CMECredits</th>
		</tr>	
	<?php
			while($courses = mysql_fetch_assoc($result))
			{
				
	?>
	
				<tr>
				<td class="tabledata"><a href="./editCMECourse.php?id=<?php echo $courses["CourseId"];?>"><?php echo $courses["CourseId"]; ?></a></td>
				<td class="tabledata"><?php echo $courses["CourseTitle"];?></td>
				<td class="tabledata">
                                <?php 
                                      if($courses["CourseDesc"] != "")
                                      {
                                        echo $courses["CourseDesc"];
                                      }
                                      else
                                      {
                                          echo $courses["CourseTitle"];
                                       }
                                ?>
                               </td>
				<td class="tabledata"><?php echo $courses["Venue_City"] . "," . $courses["Venue_State"];?></td>
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
						$temp3 = explode("-", $courses["LastDate_App"]);
						$dt3 = mktime(0,0,0,$temp3[1], $temp3[2], $temp3[0]);
						echo date("m/d/Y", $dt3);
						
					?>
				</td>
				<td class="tabledata"><?php echo "$".$courses["CourseFee"]?></td>
				<td class="tabledata"><?php echo $courses["CMECredits"]?></td>
				</tr>
	<?php
			}
		}
		else
		{
	?> 
				<table border="1" cellspacing="0" cellpadding="1">
			<tr>	
					<th class ="tabledatahead">CourseID</th>
					<th class ="tabledatahead">CourseTitle</th>
					<th class ="tabledatahead">CourseDesc</th>
					<th class ="tabledatahead">City / State </th>
					<th class ="tabledatahead">StartDate</th>
					<th class ="tabledatahead">EndDate</th>
					<th class ="tabledatahead">LastDate</th>
					<th class ="tabledatahead">CourseFee</th>
					<th class ="tabledatahead">CMECredits</th>
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
	if($count == 1)
	{
		echo $Nav;
	}
	if($from > 1)
	{
		if(($from - $pagecnt) > 0)
		{
			$Nav .= "\n"."<a href=\"./viewEditCourse.php?from=" . ($from - $pagecnt)  . "\"><< Prev</a>"."\n";
		}
	}
	if($from < $count)
	{
		if(($from + $pagecnt) < $count)
		{
			$Nav .= "\n"."<a href=\"./viewEditCourse.php?from=" . ($from  + $pagecnt) ."\">Next >></a>"."\n";
		}
	}	
	echo $Nav;
	?>
	</div>
</div>
