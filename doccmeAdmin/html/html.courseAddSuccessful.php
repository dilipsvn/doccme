<?php
/*
 * Created on 29 Jan, 2008
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
		Course Registration Successful
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logoout" value="Logout" onclick="dologout();"/> 
		</div>
		<div style="clear:both; border: none;"> </div>
	</div>
	<div class="textContent">
	<b>Thank You for Registering Course with DocCME</b>
	<br/><br/>
	<p>Dear Admin,</p><br/>
	<p>You have successfully registered course for the selected CMEProvider.
	 </p>

<p>Please feel free to call us on 866-465-6181 for any additional support.</p>

 
<br/>
<p>Best regards,<br/>

<p>DocCME team</p>

<br/>
<p>Click here to add another course <input type="button" id="Proceed" name="Proceed" value="Proceed" onclick="javascript: document.location.href ='./addCourseForCMEProvider.php' "/> </p>
</div>
</div>
