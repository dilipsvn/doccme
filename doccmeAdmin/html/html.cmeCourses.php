<?php
/*
 * Created on Oct 19, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<script language="JavaScript" type="text/javascript">
function doViewList()
{
	if(document.getElementById('type').value=="")
	{
		alert("Please Select Course Type");
		document.getElementById('type').focus();
		return ;
	}
	document.getElementById('PageAction').value="VIEW";
	document.getElementById('frmCourses').submit();
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
		CMECourses
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type="button" name="Logout" value="Logout" onclick="dologout();">
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
<div class="textContent">
	<a href = "home.php">Home</a>>>
	</div>
<div class="textContent"><p>CME Courses Details</p></div>

  <form name="frmCourses" id="frmCourses" action="./cmeCourses.php" method="post">
  <input type="hidden" name="PageAction" id="PageAction" value=""/>
  <table border="0" cellpadding="2" cellspacing="2" width="100%">
		<tr>
			<td class = "labelOfInput"><?php $this->type->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->type->showSelectList($this->courseTypeList); ?>
		
			<td class = "inputbox"> <input type="button" value="View Course Details" onclick="doViewList();"/> &nbsp;
			</td>
		</tr>
		
  </table>
  <div id="resultBox">
  <?php
  		$type = $_REQUEST["type"];
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
		
  		if($this->PageAction == "VIEW")
 		{
			
			if($this->type->data == "Active")
			{
				$this->error = $this->bal->viewActiveCoursesListWithLimits($result, $from, $pageCount, $count);
				if($this->error->isError())
 				{
 					return $this->error;
 				}
			}
			elseif($this->type->data == "Archived")
			{
				$this->error = $this->bal->viewArchivedCoursesListWithLimits($result, $from, $pageCount, $count);
				if($this->error->isError())
 				{
 					return $this->error;
 				}
			}
			
		
		if($result != null)
		{
			
	?>
<div class="textContent">
There are <?php echo $count ." " . $type ;?> courses registered in DocCME
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
			echo  "First &nbsp;&nbsp;Prev";
		}
		else
		{
			echo  " <a href='{$_SERVER['PHP_SELF']}?from=1&type=$type&PageAction=VIEW'> |<- First</a> ";
		    $prevpage = $from-1;
	   		echo "&nbsp;&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$prevpage&type=$type&PageAction=VIEW'><<-Prev </a> ";
		} // if
		
		echo "&nbsp;&nbsp; ( Page $from of $lastPage )&nbsp;&nbsp; ";
		if($from == $lastPage)
		{
			 echo "  Next&nbsp;&nbsp;  Last  ";
		}
		else
		{
	   		$nextpage = $from + 1;
	  		 echo " <a href='{$_SERVER['PHP_SELF']}?from=$nextpage&type=$type&PageAction=VIEW'>Next ->></a> ";
	  		 echo "&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$lastPage&type=$type&PageAction=VIEW'>Last ->|</a> ";
		} // if
	}
	?>
	</div>
	<br/>
			<table border="1" cellpadding="2" cellspacing="2" width="100%">
			<tr>	
					
					<th class ="tabledatahead">Id</th>
					<th class ="tabledatahead">CMEID</th>
					<th class ="tabledatahead">Title</th>
					<th class ="tabledatahead">City/State</th>
					<th class ="tabledatahead">EmailId</th>
					<th class ="tabledatahead">StartDate/EndDate</th>
					<th class ="tabledatahead">LastDate</th>
					<th class ="tabledatahead">Fee</th>
					<th class ="tabledataHeadSmall">CMECredits</th>
				
				</tr>
	<?php
			while($course = mysql_fetch_assoc($result))
			{
	?>
				<tr>
					<td class="tabledata"><a href="viewCourseDetails.php?id=<?php echo $course["CourseId"]; ?>"><?php echo $course["CourseId"]; ?></a></td>
					<td class="tabledata"><a href="viewCMEProviderDetails.php?id=<?php echo $course["CMEId"]; ?>"><?php echo $course["CMEId"]; ?></a></td>
					<td class="tabledata"><?php echo $course["CourseTitle"];?></td>
					<td class="tabledata"><?php echo $course["Venue_City"] . "," . $course["Venue_State"];?></td>
					<td class="tabledata"><?php echo $course["ContactEmail"];?></td>
					<td class="tabledata">
					<?php 
						$temp1 = explode("-", $course["CourseStartDate"]);
						$dt1 = mktime(0,0,0,$temp1[1], $temp1[2], $temp1[0]);
						$temp2 = explode("-", $course["CourseEndDate"]);
						$dt2 = mktime(0,0,0,$temp2[1], $temp2[2], $temp2[0]);
						echo date("m/d/Y", $dt1). "/".date("m/d/Y", $dt2);
					?>
					</td>
					<td class="tabledata">
					<?php 
						$temp3 = explode("-", $course["LastDate_App"]);
						$dt3 = mktime(0,0,0,$temp3[1], $temp3[2], $temp3[0]);
						echo date("m/d/Y", $dt3);
					?>
					</td>
					<td class="tabledata"><?php echo "$".$course["CourseFee"];?></td>
					<td class="tabledataSmall"><?php echo $course["CMECredits"];?></td>
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
	
				<table border="1" cellspacing="1" cellpadding="1" width="75%">
			<tr>	
					
					<th class ="tabledatahead">CourseId</th>
					<th class ="tabledatahead">CMEID</th>
					<th class ="tabledatahead">Title</th>
					<th class ="tabledatahead">City/State</th>
					<th class ="tabledatahead">EmailId</th>
					<th class ="tabledatahead">StartDate/EndDate</th>
					<th class ="tabledatahead">LastDate</th>
					<th class ="tabledatahead">Fee</th>
					<th class ="tabledatahead">CMECredits</th>
			</tr>
				<tr>
				<td  colspan="10">No Matching Records Found</td>
				</tr>
				</table>
	<?php
		}
 		}
	?>
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
			echo  "First &nbsp;&nbsp;Prev";
		}
		else
		{
			echo  " <a href='{$_SERVER['PHP_SELF']}?from=1&type=$type&PageAction=VIEW'> |<- First</a> ";
		    $prevpage = $from-1;
	   		echo "&nbsp;&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$prevpage&type=$type&PageAction=VIEW'><<-Prev </a> ";
		} // if
		
		echo "&nbsp;&nbsp; ( Page $from of $lastPage )&nbsp;&nbsp; ";
		if($from == $lastPage)
		{
			 echo "  Next&nbsp;&nbsp;  Last  ";
		}
		else
		{
	   		$nextpage = $from + 1;
	  		 echo " <a href='{$_SERVER['PHP_SELF']}?from=$nextpage&type=$type&PageAction=VIEW'>Next ->></a> ";
	  		 echo "&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$lastPage&type=$type&PageAction=VIEW'>Last ->|</a> ";
		} // if
	}
	?>
	</div>
	<br/>
</div>
	
