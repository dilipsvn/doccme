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
	
		document.getElementById('error_firstName').innerHTML = "";
		if(!checkFirstName())
			condt=false;
			document.getElementById('error_middleName').innerHTML = "";
		if(!checkMiddleName())
			condt=false;
		document.getElementById('error_lastName').innerHTML = "";
		if(!checkLastName())
			condt=false;
		document.getElementById('error_sex').innerHTML = "";
		if(!checkSex())
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
		document.getElementById('error_speciality').innerHTML = "";
		if(!checkSpeciality())
			condt=false;
		document.getElementById('error_contactTime').innerHTML = "";
		if(!checkContactTime())
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
			document.getElementById("error_firstName").innerHTML = "Single Quotes not allowed in form";
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
			document.getElementById("error_lastName").innerHTML = "Single Quotes not allowed in form";
			document.getElementById("lastName").focus();
			return false;
		}
	}
	
}
function checkSex()
{
	var val;
	val = document.getElementById("sex").value;
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
			document.getElementById("error_sex").innerHTML = "Single Quotes not allowed in form";
			document.getElementById("sex").focus();
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
		document.getElementById("error_address1").innerHTML = "Please enter address1";
		document.getElementById("address1").focus();
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
			document.getElementById("error_address1").innerHTML = "Single Quotes not allowed in form";
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
		document.getElementById("error_city").innerHTML = "Please enter city";
		document.getElementById("city").focus();
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
			document.getElementById("error_city").innerHTML = "Single Quotes not allowed in form";
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
		document.getElementById("error_state").innerHTML = "Please enter state";
		
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
			document.getElementById("error_state").innerHTML = "Single Quotes not allowed in form";
			
			return false;
		}
	}
}
function checkZip()
{
	val = document.getElementById("zip").value;
	if(val == "")
	{
		document.getElementById("error_zip").innerHTML = "Please enter zip";
		document.getElementById("zip").focus();
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
			document.getElementById("error_zip").innerHTML = "Single Quotes not allowed in form";
			document.getElementById("zip").focus();
			return false;
		}
	}
}
function checkWorkPhone()
{
	var val;
	val = document.getElementById("workPhone").value;
	if(val != "")
	{
		if(checkSingleQuotes(val))
		{
			return true;
		}
		else
		{
			document.getElementById("error_workPhone").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("workPhone").focus();
			return false;
		}
		if (checkInternationalPhone(workPhone.value)==false)
		{
			document.getElementById("error_workPhone").innerHTML = "Please Enter a Valid Phone Number";
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
		return true;
		
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
		if (checkInternationalPhone(homePhone.value)==false)
		{
			document.getElementById("error_homePhone").innerHTML = "Please Enter a Valid Phone Number";
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
			return true;
		}
		else
		{
			document.getElementById("error_fax").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("fax").focus();
			return false;
		}
		if (checkInternationalPhone(fax.value)==false)
		{
			document.getElementById("error_fax").innerHTML = "Please Enter a Valid fax Number";
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
		return true;
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
			return true;
		}
		else
		{
			document.getElementById("error_mobilePhone").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("mobilePhone").focus();
			return false;
		}
		if (checkInternationalPhone(mobilePhone.value)==false)
		{
			document.getElementById("error_mobilePhone").innerHTML = "Please Enter a Valid Phone Number";
			document.getElementById("mobilePhone").focus();
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
			document.getElementById("error_email").innerHTML = "Single Quotes not allowed in form";
			document.getElementById("email").focus();
			return false;
		}
	}
}
function checkSpeciality()
{
	var val;
	val = document.getElementById("Speciality").value;
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
			document.getElementById("error_speciality").innerHTML = "Single Quotes not allowed in form";
			
			return false;
		}
	}
	
}
function checkContactTime()
{
	var val;
	val = document.getElementById("contactTime").value;
	if(val != "")
	{
		if(checkSingleQuotes(val))
		{
			return true;
		}
		else
		{
			document.getElementById("error_contactTime").innerHTML = "Single Quotes not allowed in form";
			document.getElementById("contactTime").focus();
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
			document.getElementById("error_loginName").innerHTML = "Single Quotes not allowed in form";
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
			document.getElementById("error_password").innerHTML = "Single Quotes not allowed in form";
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
		document.getElementById("error_confirmPassword").innerHTML = "Please confirm password";
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
			document.getElementById("error_confirmPassword").innerHTML = "Single Quotes not allowed in form";
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
Doctor&acute;s Registration Form
</div>
<div class="textContent"><p>Dear Doctor, please fill the following details to help serve you better</p></div>
<div class = "ERROR">
<?php
if($this->error->isError())
{
	echo $this->error->getErrorMessage();
}
?>
</div>
<form name="frmRegDoctor" id="frmRegDoctor" method="post" action="./docRegister.php" onsubmit="return doValidate();">
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
			<font color ="red">*<span id = "error_firstName"><?php echo $this->firstName_error; ?></span></font></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->middleName->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->middleName->showInput(); ?>
			<font color ="red"><span id = "error_middleName"><?php echo $this->middleName_error; ?></span></font> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->lastName->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->lastName->showInput();  ?> 
			<font color ="red">*<span id = "error_lastName"><?php echo $this->lastName_error; ?></span></font> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->sex->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->sex->showSelectList($this->SexList); ?>
			<font color ="red"><span id = "error_sex"><?php echo $this->sex_error; ?></span></font></td>
		</tr>
	
		<tr>
			<td class = "labelOfInput"><?php $this->address1->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->address1->showInput();  ?>
			<font color ="red">*<span id = "error_address1"><?php echo $this->address1_error; ?></span></font> </td>
		</tr>
		
		<tr>
			<td class = "labelOfInput"><?php $this->address2->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->address2->showInput();  ?>
			<font color ="red"><span id = "error_address2"><?php echo $this->address2_error; ?></span></font> </td>
		</tr>
		
		<tr>
			<td class = "labelOfInput"><?php $this->city->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->city->showInput();  ?> 
			<font color ="red">*<span id = "error_city"><?php echo $this->city_error; ?></span></font></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->state->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->state->showSelectList($this->StateList);  ?>
			<font color ="red">*<span id = "error_state"><?php echo $this->state_error; ?></span></font></td>
		</tr> 
		<tr>
			<td class = "labelOfInput"><?php $this->zip->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->zip->showInput();  ?> 
			<font color ="red">*<span id = "error_zip"><?php echo $this->zip_error; ?></span></font></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->country->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->country->showInput();  ?> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->workPhone->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->workPhone->showInput();  ?>
			<font color ="red"><span id = "error_workPhone"><?php echo $this->workPhone_error; ?></span></font> (Example: 763-545-2297)</td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->homePhone->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->homePhone->showInput();  ?>
			<font color ="red"><span id = "error_homePhone"><?php echo $this->homePhone_error; ?></span></font> (Example: 763-545-2297)</td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->fax->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->fax->showInput();  ?>
			<font color ="red"><span id = "error_fax"><?php echo $this->fax_error; ?></span></font> (Example: 763-545-2297)</td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->mobilePhone->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->mobilePhone->showInput();  ?>
			<font color ="red"><span id = "error_mobilePhone"><?php echo $this->mobilePhone_error;?></span></font> (Example: 763-545-2297)</td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->email->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->email->showInput();  ?>
			<font color ="red">*<span id = "error_email"><?php echo $this->email_error; ?></span></font> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->speciality->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->speciality->showSelectList($this->SpecialityList);  ?> 
			<font color ="red"><span id = "error_speciality"><?php echo $this->speciality_error; ?></span></font></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->contactTime->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->contactTime->showInput();  ?>
			<font color ="red"><span id = "error_contactTime"><?php echo $this->contactTime_error; ?></span></font> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->loginName->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->loginName->showInput();  ?>
			<font color ="red">*<span id = "error_loginName"><?php echo $this->loginName_error; ?></span></font> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->password->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->password->showInput();  ?>
			<font color ="red">*<span id = "error_password"><?php echo $this->password_error; ?></span></font></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->confirmPassword->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->confirmPassword->showInput();  ?>
			<font color ="red">*<span id = "error_confirmPassword"><?php echo $this->confirmPassword_error; echo  "\n\n".$this->equalPassword_error; ?></span></font> </td>
		</tr>
		
		<tr>
			<td class="inputbox">&nbsp; </td>
			<td class = "inputbox"> <input type="submit" value="SUBMIT" /> &nbsp;
			<input type="reset" value="RESET" /> </td>
		</tr>
	</table>
</form>
</div>
