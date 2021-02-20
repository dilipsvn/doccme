<?php
/*
 * Created on Dec 13, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<script type="text/javascript" src="./include/datetimepicker.js">
//Date Time Picker
</script>
<script language="JavaScript" type="text/javascript">
function dologout()
{
	document.location.href="./logout.php";
}
</script>
<script type="text/javascript">
function checkdate(input)
{
	//Basic check for format validity
	var validformat=/^\d{2}\/\d{2}\/\d{4}$/;
	var validformat1=/^\d{1}\/\d{2}\/\d{4}$/;
	var validformat2=/^\d{1}\/\d{1}\/\d{4}$/;
	var validformat3=/^\d{2}\/\d{1}\/\d{4}$/;
	var returnval=false;
	var dtformat=false;
	if (validformat.test(input.value))
	{
		dtformat=true;
	}
	if (validformat1.test(input.value))
	{
		dtformat=true;
	}
	if (validformat2.test(input.value))
	{
		dtformat=true;
	}
	if (validformat3.test(input.value))
	{
		dtformat=true;
	}

	if(!dtformat)
	{
		returnval =  false;
	}
	else
	{ //Detailed check for valid date ranges
		var monthfield=input.value.split("/")[0];
		var dayfield=input.value.split("/")[1];
		var yearfield=input.value.split("/")[2];
		var dayobj = new Date(yearfield, monthfield-1, dayfield);
		if ((dayobj.getMonth()+1!=monthfield)||(dayobj.getDate()!=dayfield)||(dayobj.getFullYear()!=yearfield))
		{
			returnval = false;
		}
		else
		{
			returnval=true;
		}
	}
	if (returnval==false)
	{
		input.select();
		input.focus();
	}
	return returnval;
}
function doValidate()
{
	var condt=true;

	document.getElementById('error_startDate').innerHTML = "";
	if(!checkStartDate())
		condt=false;
	document.getElementById('error_endDate').innerHTML = "";
	if(!checkEndDate())
		condt=false;
	document.getElementById('error_city').innerHTML = "";
		if(!checkCity())
			condt=false;
	document.getElementById('error_keyword').innerHTML = "";
		if(!checkKeyword())
			condt=false;
	return condt;
}
function checkStartDate()
{
	val = document.getElementById("courseStartDate").value;
	if(val == "")
	{
		return true;
	}
	else
	{
		if(checkSingleQuotes(val))
		{
			if(!checkdate(document.getElementById('courseStartDate')))
			{
				document.getElementById("error_startDate").innerHTML = "Please enter valid date /date format";
				document.getElementById("courseStartDate").focus();
				return false;
			}
			else
			{
				return true;
			}
		}
		else
		{
			document.getElementById("error_startDate").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("courseStartDate").focus();
			return false;
		}

	}
}
function checkEndDate()
{
	val = document.getElementById("courseEndDate").value;
	if(val == "")
	{
		return true;
	}
	else
	{
		if(checkSingleQuotes(val))
		{
			if(!checkdate(document.getElementById('courseEndDate')))
			{
				document.getElementById("error_endDate").innerHTML = "Please enter valid date /date format";
				document.getElementById("courseEndDate").focus();
				return false;
			}
			else
			{
				return true;
			}
		}
		else
		{
			document.getElementById("error_endDate").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("courseEndDate").focus();
			return false;
		}

	}
}
function checkCity()
{
	val = document.getElementById("city").value;
	if(val != "")
	{
		if(checkSingleQuotes(val))
		{
			return true;
		}
		else
		{
			document.getElementById("error_city").innerHTML = "Single Quotes not allowed in form";
			document.getElementById("city").focus();
			return false;
		}
	}
	else
	{
		return true;
	}
}
function checkKeyword()
{
	val = document.getElementById("keyword").value;
	if(val != "")
	{
		if(checkSingleQuotes(val))
		{
			return true;
		}
		else
		{
			document.getElementById("error_keyword").innerHTML = "Single Quotes not allowed in form";
			document.getElementById("keyword").focus();
			return false;
		}
	}
	else
	{
		return true;
	}
}
function checkSingleQuotes(val)
{
	if(val.lastIndexOf("'") < 0)
	{
		return true;
	}
	else
	{
		return false;
	}

}
</script>
<div id="ContentMainDesc">
	<div class = "contentMainHeader">
		<div style="float: left; width: 48%; margin-left: 3px;">
		CME Course Search
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		<?php if($_SESSION["UserName"] != "")
		{
		?>
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();">
		<?php
		}
		?>
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
	</div>
	<div class="textContent">
	<a href="index.php">Home</a>>><a href="doctorOptions.php">Doctor Options</a>>>
	<a href="cmeCourseSearch.php">CME Course Search</a>
	<br/>
	</div>
	<div id="resultBox">
	<?php
	$pageAction = $_REQUEST["PageAction"];
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
		//session_write_close();
		//header("location:./invalidId.php?type=range");
	}
	if($from == "")
	{
		$from = 1;
	}
	
	
	if($pageAction=="SEARCH")
	{
		//if($this->flag == true)
		//{
			//$this->error = $this->bal->getAccessOfDoctor($access);
			//if($access == "FULL ACCESS")
			//{
			$this->error = $this->bal->getCMECourseSearchResultsForDoctorWithLimits($this->courseSearch, $this->result, $from, $pageCount, $count);
			
			
			if($this->result !=null)
			{
	?>
	<div class="textContent">
		<b><p>Available course(s) : <?php echo $count;?> </p></b>
		<p>Click on the Course ID to book the course</p>
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
			echo  "First&nbsp;&nbsp;Prev  ";
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
			 echo "  Next&nbsp;&nbsp;Last  ";
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
				<table width="200" border="1" cellspacing="0" cellpadding="1">
				<tr>
					<th class ="tabledatahead">ID</th>
					<th class ="tabledatahead">Title</th>
					<th class ="tabledatahead">Desc</th>
					<th class ="tabledatahead">City / State</th>
					<th class ="tabledatahead">EmailId</th>
					<th class ="tabledatahead">StartDate</th>
					<th class ="tabledatahead">EndDate</th>
					<th class ="tabledatahead">LastDate</th>
					<th class ="tabledatahead">CourseFee</th>
					<th class ="tabledatahead">CMECredits</th>
				</tr>
				
		<?php
				while($courses = mysql_fetch_assoc($this->result))
				{

	?>
					<tr>
					<td class="tabledata"><a href="./bookCourse.php?id=<?php echo $courses["CourseId"];?>"><?php echo $courses["CourseId"]; ?></a></td>
					<td class="tabledata"><a href="./bookCourse.php?id=<?php echo $courses["CourseId"];?>"><?php echo $courses["CourseTitle"];?></a></td>
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
					<th class ="tabledatahead">City / State</th>
					<th class ="tabledatahead">Email ID</th>
					<th class ="tabledatahead">Start date</th>
					<th class ="tabledatahead">End date</th>
					<th class ="tabledatahead">Last date</th>
					<th class ="tabledatahead">Course fee</th>
					<th class ="tabledatahead">CME credits</th>
			 </tr>
			<tr>
			<td colspan="10">No Matching Records Found</td>
			</tr>
	<?php
		 }
		}
		 else
		 {
	 		echo "Courses cannot be searched, invalid command for search";
	 	 }
		/*else
	  	{
		  	$resCount = 0;
		  	$this->error = $this->bal->getCMECourseSearchCount($this->courseSearch, $resCount);
		  	if($this->error->isError())
		  	{
		  		return $this->error;
		  	}
		  	else
		  	{
		  		echo "Sorry doctor, you do not have full access ".
		  		" to view course details.<br/>Count of available CME Courses is " . $resCount;
		  	}
	 	}*/
	 	
	 // }
	//}
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
			echo  "First&nbsp;&nbsp;Prev  ";
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
			 echo "  Next&nbsp;&nbsp;Last  ";
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
