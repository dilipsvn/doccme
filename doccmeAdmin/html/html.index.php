<?php
/*
 * Created on Mar 29, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<div id="adminContentMainDesc">
	<div class = "contentMainHeader">
		Admin Login Screen
	</div>


<div class = "ERROR">
<?php
if($this->error->isError())
{
	echo $this->error->getUserMessage();
}

if($_GET["msg"] == "failure")
{
	echo "Invalid Login Name / Password";
}
?>
</div>
 <div id="loginBox">
<form name="frmLogin" id="frmLogin" method="post"  action="<?php echo $PHP_SELF; ?>">
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
			<a href="./forgotPassword.php">Forgot your Password?</a>
			</div>
	</div>
 </div>
