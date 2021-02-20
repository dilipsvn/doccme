<?php
/*
 * Created on Apr 5, 2007
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
		CME Course Search Results
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
	<div class = "success">
	<?php
	if($_GET["msg"] == "success")
	{
		echo "Course has been booked successfully";
	}
	?>
	</div>
	<div class="textContent">
	<a href="home.php">Home</a>>>
	<a href="searchCMECourse.php">Search CME Courses</a>
	</div>
	<br/>
	<div id="resultBox">
	<?php
	$courseStartDate = $_REQUEST["courseStartDate"];
	$courseEndDate = $_REQUEST["courseEndDate"];
	$speciality = $_REQUEST["Speciality"];
	$state = $_REQUEST["State"];
	$city = $_REQUEST["city"];
	$keyword = $_REQUEST["keyword"];
	$queryString = "";
	if($courseStartDate !=null)
	{
			$queryString = $queryString . "&courseStartDate=" . $courseStartDate;
	}
	if($courseEndDate!=null)
	{
			$queryString = $queryString . "&courseEndDate=" . $courseEndDate;
	}
	if($speciality !=null)
	{
		$queryString = $queryString . "&Speciality=" . $speciality;
	}
	if($city !=null)
	{
		$queryString = $queryString . "&city=" . $city;
	}
	if($state !=null)
	{
		$queryString = $queryString . "&State=" . $state;
	}
	if($keyword !=null)
	{
		$queryString = $queryString . "&keyword=" . $keyword;
	}

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

	if($this->PageAction=="SEARCH")
	{
		if($this->flag == true)
		{
			$this->error = $this->bal->getCMECourseSearchResultsWithLimits($this->courseSearch, $result, $from, $pageCount, $count);
			if($result !=null)
				{

	?>
	<div class="textContent">
		<b><p>Available course(s) : <?php echo $count;?> </p></b>		
		<p>Click on the CourseId to book the course</p>
	</div>
	<div class="paginationbar">
	<?php
	$lastPage = ceil($count/$pageCount);
	if($count == 1 || $count == 0)
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
				
				<table border="1" cellspacing="1" cellpadding="0">
				<tr>
					<th class ="tabledatahead">ID</th>
					<th class ="tabledatahead">Title</th>
					<th class ="tabledatahead">Desc</th>
					<th class ="tabledatahead">City/State</th>
					<th class ="tabledatahead"> EmailId</th>
					<th class ="tabledatahead">StartDate</th>
					<th class ="tabledatahead">EndDate</th>
					<th class ="tabledatahead">LastDate</th>
					<th class ="tabledatahead">Fee</th>
					<th class ="tabledatahead">CMECredits</th>
				</tr>
	<?php

				while($courses = mysql_fetch_assoc($result))
				{

	?>
				<tr>
				<td class="tabledata"><a href="./bookCourseForDoctor.php?id=<?php echo $courses["CourseId"];?>"><?php echo $courses["CourseId"]; ?></a></td>
				<td class="tabledata"><a href="./bookCourseForDoctor.php?id=<?php echo $courses["CourseId"];?>"><?php echo $courses["CourseTitle"];?></a></td>
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
				<td class="tabledata"><?php echo $courses["ContactEmail"];?></td>
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
				<th class ="tabledatahead">ID</th>
				<th class ="tabledatahead">Title</th>
				<th class ="tabledatahead">Desc</th>
				<th class ="tabledatahead">City/State</th>
				<th class ="tabledatahead">EmailId</th>
				<th class ="tabledatahead">StartDate</th>
				<th class ="tabledatahead">EndDate </th>
				<th class ="tabledatahead">LastDate</th>
				<th class ="tabledatahead">Fee</th>
				<th class ="tabledatahead">CMECredits</th>
			</tr>
				<tr>
				<td  colspan="10">No Matching Records Found</td>
				</tr>
	<?php
		 }
		}
	  }
	  else
	  {
	  		echo "Invalid command for search";
	  }
	?>
	</table>
	</div>
	<br/>
	<div class="paginationbar">
	<?php
	$lastPage = ceil($count/$pageCount);
	if($count == 1 || $count == 0)
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
</div>
