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
<script language="JavaScript" type="text/javascript">
var digits = "0123456789";
// non-digit characters which are allowed in phone numbers
var phoneNumberDelimiters = "()- ";
// characters which are allowed in international phone numbers
// (a leading + is OK)
var validWorldPhoneChars = phoneNumberDelimiters + "+";
// Minimum no of digits in an international phone no.
var minDigitsInIPhoneNumber = 10;

function isInteger(s)
{   var i;
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}

function stripCharsInBag(s, bag)
{   var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character isnt whitespace.
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function checkInternationalPhone(strPhone){
s=stripCharsInBag(strPhone,validWorldPhoneChars);
return (isInteger(s) && s.length >= minDigitsInIPhoneNumber);
}

function doValidate()
{
	var condt=true;
	
		document.getElementById('error_instituteName').innerHTML = "";
		if(!checkInstituteName())
			condt=false;	
		document.getElementById('error_firstName').innerHTML = "";
		if(!checkFirstName())
			condt=false;
		document.getElementById('error_middleName').innerHTML = "";
		if(!checkMiddleName())
			condt=false;
		document.getElementById('error_lastName').innerHTML = "";
		if(!checkLastName())
			condt=false;
		document.getElementById('error_address1').innerHTML = "";
		if(!checkAddress1())
			condt=false;
		document.getElementById('error_address2').innerHTML = "";
		if(!checkAddress2())
			condt=false;
		document.getElementById('error_city').innerHTML = "";
		if(!checkCity())
			condt=false;
		document.getElementById('error_state').innerHTML = "";
		if(!checkState())
			condt=false;
		document.getElementById('error_zip').innerHTML = "";
		if(!checkZip())
			condt=false;
		document.getElementById('error_workPhone').innerHTML = "";
		if(!checkWorkPhone())
			condt=false;
		document.getElementById('error_homePhone').innerHTML = "";
		if(!checkHomePhone())
			condt=false;
		document.getElementById('error_fax').innerHTML = "";
		if(!checkFax())
			condt=false;
		document.getElementById('error_mobilePhone').innerHTML = "";
		if(!checkMobilePhone())
			condt=false;
		document.getElementById('error_email').innerHTML = "";
		if(!checkEmail())
			condt=false;
		document.getElementById('error_websiteUrl').innerHTML = "";
		if(!checkWebsiteUrl())
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
function checkInstituteName()
{
	var val;
	val = document.getElementById("instituteName").value;
	if(val == "")
	{
		document.getElementById("error_instituteName").innerHTML = "Please enter institute Name";
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
			document.getElementById("error_instituteName").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("instituteName").focus();
			return false;
		}
	}
	
}
function checkFirstName()
{
	var val;
	val = document.getElementById("firstName").value;
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
			document.getElementById("error_lastName").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("lastName").focus();
			return false;
		}
	}
}
function checkAddress1()
{
	var val;
	val = document.getElementById("address1").value;
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
			document.getElementById("error_address1").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("address1").focus();
			return false;
		}
	}

	
}
function checkAddress2()
{
	var val;
	val = document.getElementById("address2").value;
	if(val != "")
	{
		if(checkSingleQuotes(val))
		{
			return true;
		}
		else
		{
			document.getElementById("error_address2").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("address2").focus();
			return false;
		}
	}
	else
	{
		return true;
	}
	
}
function checkCity()
{
	val = document.getElementById("city").value;
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
			document.getElementById("error_city").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("city").focus();
			return false;
		}
	}
}

function checkState()
{
	val = document.getElementById("State").value;
	if(val == "")
	{
		return true;
	}
	else
	{
		return true;
	}
}
function checkZip()
{
	val = document.getElementById("zip").value;
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
			document.getElementById("error_zip").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("zip").focus();
			return false;
		}
	}
}
function checkWorkPhone()
{
	var val;
	val = document.getElementById("workPhone").value;
        if(val == "")
        {
            document.getElementById("error_workPhone").innerHTML = "Please enter primary phone no.";
		document.getElementById("workPhone").focus();
		return false;

         }
        else
	{
		if(checkSingleQuotes(val))
		{
			if (checkInternationalPhone(val)==false)
		      {
			   document.getElementById("error_workPhone").innerHTML = "Please enter a Valid Phone Number";
			  document.getElementById("workPhone").focus();
			  return false;
		      }
		      else
		      {
			    return true;
		       }
		}
		else
		{
			document.getElementById("error_workPhone").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("workPhone").focus();
			return false;
		}
		
	}
	
}
function checkHomePhone()
{
	var val;
	val = document.getElementById("homePhone").value;
	if(val != "")
	{
		if(checkSingleQuotes(val))
		{
			return true;
		}
		else
		{
			document.getElementById("error_homePhone").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("homePhone").focus();
			return false;
		}
		if (checkInternationalPhone(val)==false)
		{
			document.getElementById("error_homePhone").innerHTML = "Please enter a Valid Phone Number";
			document.getElementById("homePhone").focus();
			return false;
		}
		else
		{
			return true;
		}
	}
	else
	{
		return true;
	}
}
function checkFax()
{
	val = document.getElementById("fax").value;
	if(val != "")
	{
		if(checkSingleQuotes(val))
		{
			if (checkInternationalPhone(val)==false)
		       {
			     document.getElementById("error_fax").innerHTML = "Please enter a Valid fax Number";
			     document.getElementById("fax").focus();
			     return false;
		       }
		       else
		      {
			     return true;
		      }
		}
		else
		{
			document.getElementById("error_fax").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("fax").focus();
			return false;
		}
		
	}
	else
	{
		document.getElementById("error_fax").innerHTML = "Please enter fax number";
		document.getElementById("fax").focus();
		return false;
	}
}
function checkMobilePhone()
{
	var val;
	val = document.getElementById("mobilePhone").value;
	if(val != "")
	{
		if(checkSingleQuotes(val))
		{
			if (checkInternationalPhone(val)==false)
		{
			document.getElementById("error_mobilePhone").innerHTML = "Please enter a Valid Phone Number";
			document.getElementById("mobilehone").focus();
			return false;
		}
		else
		{
			return true;
		}
		}
		else
		{
			document.getElementById("error_mobilePhone").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("mobilePhone").focus();
			return false;
		}
		
	}
	else
	{
		return true;
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
function checkWebsiteUrl()
{
	val = document.getElementById("websiteUrl").value;
	if(val != "")
	{
		if(checkSingleQuotes(val))
		{
			return true;
		}
		else
		{
			document.getElementById("error_websiteUrl").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("websiteUrl").focus();
			return false;
		}
	}
	else
	{
		return true;
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
		Admin&acute;s CME Provider Register
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();"/> 
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
	<div class = "success">
	<?php
	if($_GET["msg"] == "success")
   	{
		echo "CME Provider has been registered  successfully";
	}
	?>
	</div>	
	<div class="textContent">
	<a href = "home.php">Home</a>>>
	<a href = "cmeproviders.php">CME Providers</a>>>
	</div>
<form name="frmRegCMEProvider" id="frmRegCMEProvider" method="post" action="./cmeProviderRegister.php" onsubmit="return doValidate();">
	<input type="hidden" name="PageAction" id="PageAction" value="SAVE" />
	<table border="0" cellpadding="2" cellspacing="2" width="100%">
		<tr>
			<td colspan="2" class="inputbox">
				<div id="mandatoryFields">
					Fields which are marked with '*' are mandatory
				</div>
			</td>
		<tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->instituteName->showLabel(); ?></td>
			<td class = "inputbox"><?php $this->instituteName->showInput(); ?> 
			<font color ="red">* <span id = "error_instituteName"><?php echo $this->instituteName_error; ?></span></font> </td>
		</tr>
	<tr>
			<td class = "labelOfInput"><?php $this->firstName->showLabel(); ?></td>
			<td class = "inputbox"><?php $this->firstName->showInput(); ?>
			<font color ="red"><span id = "error_firstName"><?php echo $this->firstName_error; ?></span></font></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->middleName->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->middleName->showInput(); ?>
			<font color ="red"><span id = "error_middleName"><?php echo $this->middleName_error; ?></span></font> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->lastName->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->lastName->showInput();  ?>
			<font color ="red"><span id = "error_lastName"><?php echo $this->lastName_error; ?></span></font> </td>
		</tr>
	<tr>
			<td class = "labelOfInput"><?php $this->address1->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->address1->showInput();  ?>
			<font color ="red"><span id = "error_address1"><?php echo $this->address1_error; ?></span></font></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->address2->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->address2->showInput();  ?>
			<font color ="red"><span id = "error_address2"><?php echo $this->address2_error; ?></span></font> </td>
		</tr>
		
		<tr>
			<td class = "labelOfInput"><?php $this->city->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->city->showInput();  ?>
			<font color ="red"><span id = "error_city"><?php echo $this->city_error; ?></span></font> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->state->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->state->showSelectList($this->StateList);  ?>
			<font color ="red"><span id = "error_state"><?php echo $this->state_error; ?></span></font> </td>
		</tr> 
		<tr>
			<td class = "labelOfInput"><?php $this->zip->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->zip->showInput();  ?>
			<font color ="red"><span id = "error_zip"><?php echo $this->zip_error; ?></span></font> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->country->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->country->showInput();  ?> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->workPhone->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->workPhone->showInput();  ?>
			<font color ="red">* <span id = "error_workPhone"><?php echo $this->workPhone_error; ?></span></font> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->homePhone->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->homePhone->showInput();  ?>
			<font color ="red"><span id = "error_homePhone"><?php echo $this->homePhone_error; ?></span></font>  </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->fax->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->fax->showInput();  ?>
			<font color ="red">* <span id = "error_fax"><?php echo $this->fax_error; ?></span></font>  </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->mobilePhone->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->mobilePhone->showInput();  ?> 
			<font color ="red"><span id = "error_mobilePhone"><?php echo $this->mobilePhone_error; ?></span></font> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->email->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->email->showInput();  ?> 
			<font color ="red">* <span id = "error_email"><?php echo $this->email_error; ?></span></font> </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->websiteUrl->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->websiteUrl->showInput();  ?>
			<font color ="red"><span id = "error_websiteUrl"><?php echo $this->websiteUrl_error; ?></span></font></td>
		</tr>
	<tr>
			<td class = "labelOfInput"><?php $this->loginName->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->loginName->showInput();  ?> 
			<font color ="red">* <span id = "error_loginName"><?php echo $this->loginName_error; ?></span></font> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->password->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->password->showInput();  ?> 
			<font color ="red">* <span id = "error_password"><?php echo $this->password_error; ?></span></font> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->confirmPassword->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->confirmPassword->showInput();  ?>
			<font color ="red">* <span id = "error_confirmPassword"><?php echo $this->confirmPassword_error; echo "\n\n" . $this->equalPassword_error; ?></span></font> </td>
		</tr>
		<tr>
			<td  class = "inputbox"> &nbsp;</td>
			<td  class = "inputbox"> <input type="submit" value="SUBMIT" />
			<input type="reset" value="RESET" /> </td>
		</tr>
	</table>
</form>
</div>
