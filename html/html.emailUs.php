<?php
/*
 * Created on Oct 24, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
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

		document.getElementById('error_contactPhone').innerHTML = "";
		if(!checkContactPhone())
			condt=false;
		document.getElementById('error_email').innerHTML = "";
		if(!checkEmail())
			condt=false;
		document.getElementById('error_contactTime').innerHTML = "";
		if(!checkContactTime())
			condt=false;
		return condt;
}
function checkFirstName()
{
	var val;
	val = document.getElementById("firstName").value;
	if(val == "")
	{
		document.getElementById("error_firstName").innerHTML = "Please enter  name";
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
function checkContactPhone()
{
	var val;
	val = document.getElementById("contactPhone").value;
	if(val != "")
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
		if (checkInternationalPhone(contactPhone.value)==false)
		{
			document.getElementById("error_contactPhone").innerHTML = "Please Enter a Valid Phone Number";
			document.getElementById("contactPhone").focus();
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
	if(val != "")
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
	else
	{
		return true;
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
<span class="ERROR">
<?php
if($this->error->isError())
{
	echo $this->error->getErrorMessage();
}

?>
</font></span>
<form name="frmEmail" id="frmEmail" method="post" action="./emailUs.php" onsubmit="return doValidate();">
	<input type="hidden" name="PageAction" id="PageAction" value="SAVE" />
	<table width="344" height="143" border="0" cellpadding="0" cellspacing="0" bordercolor="c4d9de">
		<tr>
			<td class = "labelOfInput"><?php $this->firstName->showLabel(); ?></td>
			<td class = "inputbox"><?php $this->firstName->showInput(); ?>
			<font color = "red"><span id= "error_firstName"><?php echo $this->firstName_error; ?></font></span></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->contactPhone->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->contactPhone->showInput();  ?>
			<font color = "red"><span id= "error_contactPhone"><?php echo $this->contactPhone_error;?></font></span> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->email->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->email->showInput();  ?>
			<font color = "red"><span id= "error_email"><?php echo $this->emailORPhone_error; echo $this->email_error;?></font></span> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->contactTime->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->contactTime->showInput();  ?>
			<font color = "red"><span id= "error_contactTime"><?php echo $this->contactTime_error; ?></font></span> </td>
		</tr>
		<tr>
			<td class="inputbox"> &nbsp;</td>
			<td class = "inputbox"> <input type="submit" value="Submit" />
		</tr>
	</table>
</form>


