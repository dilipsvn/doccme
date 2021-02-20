<div id="ContentMainDesc">
<div class = "contentMainHeader">
Login
</div>
<div class = "success">
<?php
  if($_GET["msg"] == "success")
 {
 	echo "You have successfully registered. Login to avail the facilities";
 }
?>
</div>
<div class = "ERROR">
<?php
 	if($_GET["msg"] == "failure")
 	{
 		echo "Invalid Login Name/ Password";
 	}

 ?>
</div>
  <div id="loginBox">
 	<form name="frmLogin" id="frmLogin" method="post"  action="<?php echo $PHP_SELF;?>">
 		<input type="hidden" name="PageAction" id="PageAction" value="LOGIN" />

 			<div class = "labelOfLogin"> <?php $this->loginName->showLabel(); ?></div>
 			<div class = "inputLogin"><?php $this->loginName->showInput(); ?></div>

 			<div class = "labelOfLogin"> <?php $this->password->showLabel(); ?></div>
 			<div class="inputLogin"><?php $this->password->showInput(); ?></div>
 			<div class="clearFloatLeft"></div>
 			<div class="loginButton"> <input type="image" name = "Login" value="Login" src="images/login_but.gif" width="55" height="22">
 			</div>

 			<div class="clearFloatRight"></div>

 	</form>
 	<div class="loginButton">
 	<a href="./forgotPassword.php?role=<?php echo $_GET["p"];?>">Forgot your Password?</a>
 	</div>
</div>
</div>
