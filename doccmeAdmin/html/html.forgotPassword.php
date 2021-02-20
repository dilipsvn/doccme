<?php
/*
 * Created on Oct 31, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<div id="adminContentMainDesc">
	<div class = "contentMainHeader">
		Forgot Password page
	</div>

<div id="loginBox">
<form name="frmEmail" id="frmEmail" method="post" action="./forgotPassword.php">
	<input type="hidden" name="PageAction" id="PageAction" value="SAVE" />
	
			<div class = "labelOfLogin"> <?php $this->email->showLabel(); ?> </div>
			<div class = "inputLogin"><?php $this->email->showInput();  ?>
			<font color="red"><span id= "error_email"><?php echo $this->email_error; ?></span> 
			</font></div>
			<div class="clearFloatLeft"></div>
			<div class = "emailInfo"> <input type="submit" value="Email Login Info" /></div>
			<div class="clearFloatRight"></div>
	
</form>
</div>
</div>

