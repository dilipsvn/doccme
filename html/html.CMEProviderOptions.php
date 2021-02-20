<script language="JavaScript" type="text/javascript">
function dologout()
{
	document.location.href="./logout.php";
}
</script>
<div id="ContentMainDesc">
	<div class = "contentMainHeader">
		<div style="float: left; width: 48%; margin-left: 3px;">
		CME Provider Options
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();">
		</div>
		<div style="clear:both; border: none;"> </div>
	</div>
	<div class=textContent>
		<a href="index.php">Home</a>>>
		</div>
	<div class="textContent">
		<p>Thanks for being DocCME patron. Please proceed with the following options.</p>
		
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
				<b>To Add Course/s</b>
			</div>
			<div class="buttonColumn">
				<a href="addCourse.php"><img src="./images/click_here.gif" alt="Click here to Add Course/s" width="78" height="22" border="0"></a>
			</div>
			<div class="optionColumn">
				<b>To View / Edit Course</b>
			</div>
			<div class="buttonColumn">
				<a href="viewEditCourse.php"><img src="./images/click_here.gif" alt="Click here to View / Edit Course" width="78" height="22" border="0"></a>
			</div>
			<div class="optionColumn">
				<b>Edit Personal Details</b>
			</div>
			<div class="buttonColumn">
				<a href="editCMEProviderDetails.php"><img src="./images/click_here.gif" alt="Click here to View  Archived Course" width="78" height="22" border="0"></a>
			</div>
			<div class="optionColumn">
			 	 <b>To View Booked Course Summary</b>
			</div>
			<div class="buttonColumn">
				<a href="viewRegisteredCourseSummary.php"><img src="./images/click_here.gif" alt="Click here to View Registered Course Summary" width="78" height="22" border="0"></a>
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
		<p class="cmeloungefootnote"> Please call us for <b>Technical Support</b> at <span class="highlight"> 1-866-465-6181</span> if you face any technical problem while using our site. Our Technical staff will assist you with the solution.</p>
	</div>
</div>
