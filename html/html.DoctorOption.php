<script language="JavaScript" type="text/javascript">
function dologout()
{
	document.location.href="./logout.php";
}
</script>
<div id="ContentMainDesc">
	<div class = "contentMainHeader">
		<div style="float: left; width: 48%; margin-left: 3px;">
		Doctor&acute;s Options
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();">
		</div>
		<div style="clear:both; border: none;"> </div>
	</div>

	<div class="textContent">
	<a href="index.php">Home</a>
	</div>
		<div class="textContent">
		  <p>Thanks for becoming DocCME patron. Please proceed with the following options available below.</p>
		</div>
	<div class = "success">
	<?php
		if($_GET["msg"] == "detailssuccess")
		{
			echo "Personal Details have been updated successfully";

		}
		elseif($_GET["msg"] == "resetsuccess")
		{
			echo "Password reset has been successful";

		}
		?>
	</div>
		<div id="optionsBox">
			<div class="optionColumn">
				<b>To Search for CME courses</b>
			</div>
			<div class="buttonColumn">
				<a href="cmeCourseSearch.php"><img src="./images/click_here.gif" alt="Click here to Search Course " width="78" height="22" border="0"></a>
			</div>
			<div class="optionColumn">
				<b>View booked courses</b>
			</div>
			<div class="buttonColumn">
				<a href="viewAppliedCourseSummary.php"><img src="./images/click_here.gif" alt="Click here to View Applied / Registered Course" width="78" height="22" border="0"></a>
			</div>
			<div class="optionColumn">
				<b>Edit personal details</b>
			</div>
			<div class="buttonColumn">
				<a href="editDoctorDetails.php"><img src="./images/click_here.gif" alt="Click here to View  Archived Course" width="78" height="22" border="0"></a>
			</div>
			<div class="optionColumn">
				<b>View archived course</b>
			</div>
			<div class="buttonColumn">
				<a href="docArchivedCourse.php"><img src="./images/click_here.gif" alt="Click here to View  Archived Course" width="78" height="22" border="0"></a>
			</div>
			<div class="clearFloatLeft"></div>
			<div></div>
			<div class="CallUsButtonDocOpt"><img src="./images/phone_num.gif" width="172px" height="21px"/></div>
			<div class="EmailUsButtonDocOpt">
			<a  href="javascript:var mywin=window.open('./emailUs.php','Email','toolbar=no,status=no,menubar=no,resizeable=no,width=342,height=162,titlebar=no');">
			<img src="./images/email_but.gif" width="172px" height="21px" border ='0'/>
			</a></div>
			<div class="ClearFloat"></div>
		</div>
	</div>
</div>
