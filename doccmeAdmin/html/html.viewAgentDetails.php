<?php
/*
 * Created on Dec 6, 2007
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
		View Agent Details 
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
			<td class = "labelOfInput"><?php $this->userId->showLabel(); ?></td>
			<td class = "inputbox"><?php echo $this->userId->data; ?></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->firstName->showLabel(); ?></td>
			<td class = "inputbox"><?php echo $this->firstName->data; ?>
			</td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->middleName->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->middleName->data; ?> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->lastName->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->lastName->data;  ?>
			 </td>
		</tr>
		
		<tr>
			<td class = "labelOfInput"><?php $this->contactPhone->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->contactPhone->data;  ?> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->email->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->email->data;  ?>
			</td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->loginName->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->loginName->data;  ?>
			</td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->status->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->status->data;  ?>
			</td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->remarks->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->remarks->data;  ?> </td>
		</tr>
		
	</table>
	</div>
  </div>

