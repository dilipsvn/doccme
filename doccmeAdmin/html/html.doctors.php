<?php
/*
 * Created on Mar 28, 2007
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
		Admin&acute;s Doctor Options
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();"/>
		</div>
		<div style="clear:both; border: none;"> </div>
	</div>
	<div class="textContent">
	<a href = "home.php">Home</a>>>
	</div>
       <div class = "success">
<?php
if($_GET["msg"] == "success")
{
	echo "Doctor has been registered successfully";
}
?>
</div>
	<div class="textContent">
	<div class="optionsBoxDoc">
			
			<div class="optionColumn">
				<b>To Add Doctor</b>
			</div>
			<div class="buttonColumn">
				<a href="doctorRegister.php"><img src="./images/click_here.gif" alt="Click here to Add Doctor" width="78" height="22" border="0"></a>
			</div>
			<div class="optionColumn">
				<b>To Search Doctors</b>
			</div>
			<div class="buttonColumn">
				<a href="searchDoctor.php"><img src="./images/click_here.gif" alt="Click here to search Doctors" width="78" height="22" border="0"></a>
			</div>
			<div class="optionColumn">
				<b>Full Access to  Doctors</b>
			</div>
			<div class="buttonColumn">
				<a href="fullAccessDoctors.php"><img src="./images/click_here.gif" alt="Click here to search Doctors" width="78" height="22" border="0"></a>
			</div>
			<div class="optionColumn">
				<b>Partial Access to  Doctors</b>
			</div>
			<div class="buttonColumn">
				<a href="partialAccessDoctors.php"><img src="./images/click_here.gif" alt="Click here to search Doctors" width="78" height="22" border="0"></a>
			</div>
			<div class="clearFloatLeft"></div>
			<div></div>
			<div></div><br/>
			
		</div>
		<p class="cmeloungefootnote"> Please call us for <b>Technical Support</b> at <span class="highlight"> 1-866-465-6181  </span> if you face any technical problem while using our site. Our Technical staff will assist you with the solution.</p>
	</div>
</div>
