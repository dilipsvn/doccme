<?php
/*
 * Created on Oct 3, 2007
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
		Course Payment Successful
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();">
		</div>
		<div style="clear:both; border: none;"> </div>
	</div>
	<div class="textContent">
	<b>Thank You for Booking with DocCME</b>
	<br/><br/>
	<p>Dear Doctor,</p><br/>
	<p>Thank you for taking time to visit DocCME and book a course for
	 your training needs. We appreciate the trust and support. 
	 </p>

<p>Please feel free to call us on 866-465-6181 for any additional support.</p>
<?php
/* 
foreach($_POST as $key=>$val)
{
	echo $key." => ".$val ."<br/>";
} */
?>
 
<br/>
<p>Best regards,<br/>

<p>DocCME team</p>

<br/>
<p><input type="button" id="Proceed" name="Proceed" value="Proceed" onclick="javascript: document.location.href ='./doctorOptions.php' "/> </p>
</div>
</div>
