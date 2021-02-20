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
<div id="ContentMainDesc">
	<div class = "contentMainHeader">
		<div style="float: left; width: 48%; margin-left: 3px;">
		Admin&acute;s CME Provider Options
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();"> 
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
	echo "CMEProvider has been registered successfully";
}
?>
</div>
	<div class="textContent">
	<div class="optionsBoxCME">
			
			<div class="optionColumn">
				<b>To Add CME Provider</b>
			</div>
			<div class="buttonColumn">
				<a href="cmeProviderRegister.php"><img src="./images/click_here.gif" alt="Click here to Add CME Provider" width="78" height="22" border="0"></a>
			</div>
			<div class="optionColumn">
				<b>To Search CME Providers</b>
			</div>
			<div class="buttonColumn">
				<a href="searchCMEProvider.php"><img src="./images/click_here.gif" alt="Click here to search cme providers" width="78" height="22" border="0"></a>
			</div>
			<div class="optionColumn">
			 	 <b>To Add Course for CME Provider</b>
			</div>
			<div class="buttonColumn">
				<a href="addCourseForCMEProvider.php"><img src="./images/click_here.gif" alt="Click here To Add Course for CME Provider" width="78" height="22" border="0"></a>
			</div>
			<div class="clearFloatLeft"></div>
			<div></div>
			
		</div>
		<p class="cmeloungefootnote"> Please call us for <b>Technical Support</b> at <span class="highlight">  1-866-465-6181  </span> if you face any technical problem while using our site. Our Technical staff will assist you with the solution.</p>
	</div>
</div>
