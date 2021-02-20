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
		<div style="float: left; width: 48%; margin-left: 3px;margin-top:0px;">
		Doctor Pay Course
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();">
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
	<a href="index.php">Home</a>>><a href="doctorOptions.php">Doctor Options</a>>><a href="cmeCourseSearch.php">CME Course Search</a>>><br/>
	</div>
<?php
	$result = "";
	$courseId = $_GET["cid"];
	$this->error = $this->bal->getCourseDetails($courseId, $result);
	if(mysql_num_rows($result) != 0)
	{

?>
		<div class="textContent">
		  <p>Dear Doctor <br /><br />Here are your booking details</p>
		</div>
<?php
		while($course = mysql_fetch_assoc($result))
		{
		$url			= "https://test.authorize.net/gateway/transact.dll";
		//$url			= "https://secure.authorize.net/gateway/transact.dll";
?>
<form name="frmRegAgent" id="frmRegAgent" method="post" action="<?php echo $url;?>">
<input type="hidden" name="PageAction" id="PageAction" value="Make Payment" />
	<table border="0" cellpadding="2" cellspacing="2" width="100%">
		<tr>
			<td class = "labelOfInput"><?php $this->bookingId->showLabel(); ?></td>
			<td class = "inputbox">
				<?php
					$result2 = "";
					$this->error = $this->bal->confirmBookingId($_GET["bid"], $result2);
					if(mysql_num_rows($result2) != 0)
					{
						echo $_GET["bid"];
					}
					/*else
					{
						session_write_close();
						header("location:./invalidId.php?type=bookingId");
					}*/
					//echo $_GET["bid"];
				 ?>
			</td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->doctorId->showLabel(); ?></td>
			<td class = "inputbox"><?php echo $_SESSION["UserId"]; ?></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->doctorName->showLabel(); ?> </td>
			<td class = "inputbox">
			<?php
			echo $this->docName;
			 ?>
			 </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->courseId->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $courseId;?></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->courseTitle->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $course["CourseTitle"];?> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->courseDesc->showLabel(); ?> </td>
			<td class = "inputbox">
                         <?php
                                          if($course["CourseDesc"] != "")
                                           {
                                                  echo $course["CourseDesc"];
                                            }
                                            else
                                             {
                                                  echo $course["CourseTitle"];
                                            }
                            ?>
                         </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->address1->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $course["Venue_Address1"]; ?></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->state->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $course["Venue_State"]; ?></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->country->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $course["Venue_Country"]; ?></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->courseStartDate->showLabel(); ?> </td>
			<td class = "inputbox">
			<?php
			$temp1 = explode("-", $course["CourseStartDate"]);
			$dt1 = mktime(0,0,0,$temp1[1], $temp1[2], $temp1[0]);
			echo date("m/d/Y", $dt1);
			?>
			</td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->courseEndDate->showLabel(); ?> </td>
			<td class = "inputbox">
			<?php
			$temp2 = explode("-", $course["CourseEndDate"]);
			$dt2 = mktime(0,0,0,$temp2[1], $temp2[2], $temp2[0]);
			echo date("m/d/Y", $dt2);
			?>
			</td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->country->showLabel(); ?> </td>
			<td class = "inputbox">
			<?php
			$temp3 = explode("-", $course["LastDate_App"]);
			$dt3 = mktime(0,0,0,$temp3[1], $temp3[2], $temp3[0]);
			echo date("m/d/Y", $dt3);
			?>
			</td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->courseFee->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo "$".$course["CourseFee"];?></td>
		</tr>
		
</table>
<?php
		srand(time());
		$sequence = rand(1, 1000);
		$this->amount = $course["CourseFee"];
		// Trim $ sign if it exists
		if (substr($this->amount, 0,1) == "$")
		{
			$this->amount = substr($this->amount,1);
		}
		$ret = $this->creditCardInfo->InsertFP($this->apiLoginId, $this->transactionKey, $this->amount, $sequence);
		
		?>
		<input type="hidden" name="x_login" value="<?php echo $this->apiLoginId;?>">
		<input type="hidden" name="x_amount" value="<?php echo $this->amount;?>">
		<input type="hidden" name="x_test_request" value="true">
		<INPUT type="hidden" name="x_show_form" value="PAYMENT_FORM">
		
<div class = "textContent">
To make payment through credit card click here &nbsp;&nbsp; <input type="submit" value="Make Payment" />
</div>
</form>

<?php
		}
	}
	else
	{
		echo "Invalid Course Id";
?>
<h5>No details retrieved </h5>
<?php
	}
?>
</div>
