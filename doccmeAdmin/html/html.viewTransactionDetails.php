<?php
/*
 * Created on Jan 4, 2008
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
<div id="ContentmainDesc">
	<div class = "contentMainHeader">
		<div style="float: left; width: 48%; margin-left: 3px;">
		View Transaction Details 
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
	<div class="textContent">
	<a href = "home.php">Home</a>>>
	</div>
	<br/>
	<div id="displayBox">
	
	<table border="0" cellpadding="2" cellspacing="2" width="100%">
		<tr>
			<td class = "labelOfInput"><?php $this->transactionId->showLabel(); ?></td>
			<td class = "inputbox"><?php echo $this->transactionId->data; ?></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->bookingId->showLabel(); ?></td>
			<td class = "inputbox"><?php echo $this->bookingId->data; ?></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->doctorId->showLabel(); ?></td>
			<td class = "inputbox"><?php echo $this->doctorId->data; ?></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->courseId->showLabel(); ?></td>
			<td class = "inputbox"><?php echo $this->courseId->data; ?></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->paymentMode->showLabel(); ?></td>
			<td class = "inputbox"><?php echo $this->paymentMode->data; ?>
			</td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->amount->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo "$".$this->amount->data; ?> </td>
		</tr>
		
		<tr>
			<td class = "labelOfInput"><?php $this->status->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->status->data;  ?>
			</td>
		</tr>
		
		
	</table>
	
	</div>
	
  </div>
