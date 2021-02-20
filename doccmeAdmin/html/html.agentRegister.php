<?php
/*
 * 	Created on Mar 28, 2007
 *	author Poornima Kamatgi
 * 	
 * 	this is html page representation of agent's registration
 * 	form
 * 	it validates form fields using Javascript validation
 */
?>
<script language="JavaScript" type="text/javascript">
function dologout()
{
	document.location.href="./logout.php";
}
</script>
<script language="JavaScript" type="text/javascript">
function doValidate()
{
	var condt=true;
	
		document.getElementById('error_firstName').innerHTML = "";
		if(!checkFirstName())
			condt=false;
		document.getElementById('error_middleName').innerHTML = "";
		if(!checkMiddleName())
			condt=false;
		document.getElementById('error_lastName').innerHTML = "";
		if(!checkLastName())
			condt=false;
		document.getElementById('error_contactPhone').innerHTML = "";
		if(!checkContactPhone())
			condt=false;
		document.getElementById('error_email').innerHTML = "";
		if(!checkEmail())
			condt=false;
		document.getElementById('error_loginName').innerHTML = "";
		if(!checkLoginName())
			condt=false;
		document.getElementById('error_password').innerHTML = "";
		if(!checkPassword())
			condt=false;
		document.getElementById('error_confirmPassword').innerHTML = "";
		if(!checkConfirmPassword())
			condt=false;
		if(!checkEqualPasswords(document.getElementById("password"), document.getElementById("confirmPassword")))
			condt = false;					
		return condt;
}
function checkFirstName()
{
	var val;
	val = document.getElementById("firstName").value;
	if(val == "")
	{
		document.getElementById("error_firstName").innerHTML = "Please enter first name";
		document.getElementById("firstName").focus();
		return false;
	}
	else
	{
		if(checkSingleQuotes(val))
		{
			return true;
		}
		else
		{
			document.getElementById("error_firstName").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("firstName").focus();
			return false;
		}
	}
	
}
function checkMiddleName()
{
	var val;
	val = document.getElementById("middleName").value;
	if(val == "")
	{
		return true;
	}
	else
	{
		if(checkSingleQuotes(val))
		{
			return true;
		}
		else
		{
			document.getElementById("error_middleName").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("middleName").focus();
			return false;
		}
	}
	
}
function checkLastName()
{
	var val;
	val = document.getElementById("lastName").value;
	if(val == "")
	{
		document.getElementById("error_lastName").innerHTML = "Please enter last name";
		document.getElementById("lastName").focus();
		return false;
	}
	else
	{
		if(checkSingleQuotes(val))
		{
			return true;
		}
		else
		{
			document.getElementById("error_lastName").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("lastName").focus();
			return false;
		}
	}
}
function checkContactPhone()
{
	var val;
	val = document.getElementById("contactPhone").value;
	if(val == "")
	{
		return true;
	}
	else
	{
		if(checkSingleQuotes(val))
		{
			return true;
		}
		else
		{
			document.getElementById("error_contactPhone").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("contactPhone").focus();
			return false;
		}
	}
}
function checkEmail()
{
	val = document.getElementById("email").value;
	if(val == "")
	{
		document.getElementById("error_email").innerHTML = "Please enter email address";
		document.getElementById("email").focus();
		return false;
	}
	else
	{
		if(checkSingleQuotes(val))
		{
			if(validate_email(val))
			{
				return true;
			}
			else
			{
				document.getElementById("error_email").innerHTML = "Please enter valid email id";
				document.getElementById("email").focus();
				return false;
			}
		}
		else
		{
			document.getElementById("error_email").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("email").focus();
			return false;
		}
	}
}
function checkLoginName()
{
	var val;
	val = document.getElementById("loginName").value;
	if(val == "")
	{
		document.getElementById("error_loginName").innerHTML = "Please enter user name";
		document.getElementById("loginName").focus();
		return false;
	}
	else
	{
		if(checkSingleQuotes(val))
		{
			return true;
		}
		else
		{
			document.getElementById("error_loginName").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("loginName").focus();
			return false;
		}
	}
	
}
function checkPassword()
{
	var val;
	val = document.getElementById("password").value;
	if(val == "")
	{
		document.getElementById("error_password").innerHTML = "Please enter password";
		document.getElementById("password").focus();
		return false;
	}
	else
	{
		if(checkSingleQuotes(val))
		{
			return true;
		}
		else
		{
			document.getElementById("error_password").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("password").focus();
			return false;
		}
	}
	
}
function checkConfirmPassword()
{
	var val;
	val = document.getElementById("confirmPassword").value;
	if(val == "")
	{
		document.getElementById("error_confirmPassword").innerHTML = "Please enter confirm password";
		document.getElementById("confirmPassword").focus();
		return false;
	}
	else
	{
		if(checkSingleQuotes(val))
		{
			return true;
		}
		else
		{
			document.getElementById("error_confirmPassword").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("confirmPassword").focus();
			return false;
		}
	}
	
}
function checkSingleQuotes(val)
{
	if(val.lastIndexOf("'") < 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}
function checkEqualPasswords(pass1, pass2)
{
	var val1 = pass1.value;
	var val2 = pass2.value;
	if(val1 == val2)
	{
		return true;
	} 
	else
	{
		document.getElementById("error_confirmPassword").innerHTML = "Password and Confirm Password must be same";
		document.getElementById("confirmPassword").focus();
		return false;
	}
}
function validate_email(email)
{
	apos = email.indexOf("@");
	dotpos = email.lastIndexOf(".");
	if( apos < 1 ||(dotpos-apos) < 2) 
	{
		return false;
	}
	else
	{
		return true;
	}
}
</script>
<div id="ContentMainDesc">
<div class = "contentMainHeader">
		<div style="float: left; width: 48%; margin-left: 3px;">
		Agent Register
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type="button" id="lblLogout" name="Logout" value="Logout" onclick="dologout();"/>
		</div>
		<div style="clear:both; border: none;"> </div>
	</div>
<div class="textContent"><p>Dear Admin, please fill the following details of agent</p></div>
<div class = "ERROR">
<?php
if($this->error->isError())
{
	echo $this->error->getUserMessage();
}
?>
</div>
<div class = "success">
<?php
if($_GET["msg"] == "success")
{
	echo "Agent has been registered successfully";
}
?>
</div>
<div class="textContent">
	<a href = "home.php">Home</a>>>
	<a href = "agents.php">Agent Options</a>>>
	</div>
<form name="frmRegAgent" id="frmRegAgent" method="post" action="./agentRegister.php" onsubmit="return doValidate();" >
	<input type="hidden" name="PageAction" id="PageAction" value="SAVE" />
	<table border="0" cellpadding="2" cellspacing="2" width="100%">
		<tr>
			<td colspan="2" class="inputbox">
				<div id="mandatoryFields">
					Fields which are marked with '*' are mandatory
				</div>
			</td>
		<tr>
			<td class = "labelOfInput"><?php $this->firstName->showLabel(); ?></td>
			<td class = "inputbox"><?php $this->firstName->showInput(); ?>
			<font color="red">*<span id= "error_firstName"><?php echo $this->firstName_error; ?></font></span></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->middleName->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->middleName->showInput(); ?>
			<font color="red"><span id= "error_middleName"><?php echo $this->middleName_error; ?></font></span> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->lastName->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->lastName->showInput();  ?> 
			<font color="red">*<span id= "error_lastName"><?php echo $this->lastName_error; ?></font></span> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->contactPhone->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->contactPhone->showInput();  ?>
			<font color="red"><span id= "error_contactPhone"><?php echo $this->contactPhone_error; ?></font></span> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->email->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->email->showInput();  ?> 
			<font color="red">*<span id= "error_email"><?php echo $this->email_error; ?></font></span> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->loginName->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->loginName->showInput();  ?> 
			<font color="red">*<span id= "error_loginName"><?php echo $this->loginName_error; ?></font></span> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->password->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->password->showInput();  ?>
			<font color="red">*<span id= "error_password"><?php echo $this->password_error; ?></font></span> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->confirmPassword->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->confirmPassword->showInput();  ?> 
			<font color="red">*<span id= "error_confirmPassword"><?php echo $this->confirmPassword_error; echo "\n\n".$this->equalPassword_error;?></font></span> </td>
		</tr>
		
		<tr>
			<td class="inputbox"> &nbsp;</td>
			<td class = "inputbox"> <input type="submit" value="SUBMIT" /> &nbsp;
			<input type="reset" value="RESET" /> </td>
		</tr>
	</table>
</form>
</div>
