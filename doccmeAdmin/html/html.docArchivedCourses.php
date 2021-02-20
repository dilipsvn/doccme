<?php
/*
 * Created on Oct 29, 2007
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
		Doctor's Archived Courses
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
	<a href = "editDoctorDetails.php?id=<?php echo $this->id;?>">Edit Doctor Details</a>>>
</div>
<div id="resultBox">
	<div class="textContent">
	</div>
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
		$this->error = $this->bal->getDocArchivedCoursesWithLimits($result, $from, $pageCount, $count, $this->id);
		if($result != null)
		{
			?>
						<div class="textContent">
		No. of archived course(s) :<?php echo $count;?> .<br/>
		
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
			echo  " <a href='{$_SERVER['PHP_SELF']}?from=1&id=$this->id'> |<- First</a> ";
		    $prevpage = $from-1;
	   		echo "&nbsp;&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$prevpage&id=$this->id'><<- Prev </a> ";
		} // if
		
		echo "&nbsp;&nbsp; ( Page $from of $lastPage )&nbsp;&nbsp; ";
		if($from == $lastPage)
		{
			 echo "  Next&nbsp;&nbsp;  Last  ";
		}
		else
		{
	   		$nextpage = $from + 1;
	  		 echo " <a href='{$_SERVER['PHP_SELF']}?from=$nextpage&id=$this->id'>Next ->></a> ";
	  		 echo "&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$lastPage&id=$this->id'>Last ->|</a> ";
		} // if
	}
	?>
	</div>
	<br/>
			<table border="1" cellspacing="1" cellpadding="1" width="100%">
				
				<tr>	
					<th class ="tabledatahead">CourseId</th>
					<th class ="tabledatahead">CourseTitle</th>
					<th class ="tabledatahead">Speciality</th>
					<th class ="tabledatahead">CourseStartDate</th>
					<th class ="tabledatahead">CourseEndDate</th>
					<th class="tabledatahead">Fee</th>
					<th class="tabledatahead">CMECredits</th>
				</tr>
		<?php
			while($course = mysql_fetch_assoc($result))
			{
		?>
				<tr>
					<td ><a href="viewCourseDetails.php?id=<?php echo $course["CourseId"]; ?>"><?php echo $course["CourseId"]; ?></a></td>
					<td ><?php echo $course["CourseTitle"];?></td>
					<td ><?php echo $course["Speciality"];?></td>
					<td >
					<?php 
						$temp1 = explode("-", $course["CourseStartDate"]);
						$dt1 = mktime(0,0,0,$temp1[1], $temp1[2], $temp1[0]);
						echo date("m/d/Y", $dt1)
						?>
					</td>
					<td >
					<?php	
						$temp2 = explode("-", $course["CourseEndDate"]);
						$dt2 = mktime(0,0,0,$temp2[1], $temp2[2], $temp2[0]);
						echo date("m/d/Y", $dt2);
					?>
					</td>
					<td ><?php echo "$".$course["CourseFee"];?></td>
					<td class="tabledata"><?php echo $course["CMECredits"];?></td>
				</tr>
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
				<tr>	
					<th class ="tabledatahead">CourseId</th>
					<th class ="tabledatahead">CourseTitle</th>
					<th class ="tabledatahead">Speciality</th>
					<th class ="tabledatahead">CourseStartDate</th>
					<th class ="tabledatahead">CourseEndDate</th>
					<th class="tabledatahead">CourseFee</th>
					<th class="tabledatahead">CMECredits</th>
				</tr>
				
				
				<tr>
				<td  colspan="7">No Matching Records Found</td>
				</tr>
				</table>
	<?php
		}
	
	?>
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
			echo  "First &nbsp;&nbsp;  Prev  ";
		}
		else
		{
			echo  " <a href='{$_SERVER['PHP_SELF']}?from=1&id=$this->id'> |<- First</a> ";
		    $prevpage = $from-1;
	   		echo "&nbsp;&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$prevpage&id=$this->id'><<- Prev </a> ";
		} // if
		
		echo "&nbsp;&nbsp; ( Page $from of $lastPage )&nbsp;&nbsp; ";
		if($from == $lastPage)
		{
			 echo "  Next&nbsp;&nbsp;  Last  ";
		}
		else
		{
	   		$nextpage = $from + 1;
	  		 echo " <a href='{$_SERVER['PHP_SELF']}?from=$nextpage&id=$this->id'>Next ->></a> ";
	  		 echo "&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$lastPage&id=$this->id'>Last ->|</a> ";
		} // if
	}
	?>
	</div>
	<br/>
</div>
