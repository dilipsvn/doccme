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
	
		document.getElementById('error_loginName').innerHTML = "";
		if(!checkLoginName())
			condt=false;
		document.getElementById('error_firstName').innerHTML = "";
		if(!checkFirstName())
			condt=false;
		document.getElementById('error_email').innerHTML = "";
		if(!checkEmail())
			condt=false;
		document.getElementById('error_contactPhone').innerHTML = "";
		if(!checkContactPhone())
			condt=false;
		
				
		return condt;
}
function checkLoginName()
{
	var val;
	val = document.getElementById("docUserName").value;
	if(val == "")
	{
		document.getElementById("error_loginName").innerHTML = "Please enter login name";
		document.getElementById("docUserName").focus();
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
			document.getElementById("docUserName").focus();
			return false;
		}
	}
	
}
function checkFirstName()
{
	var val;
	val = document.getElementById("friendName").value;
	if(val == "")
	{
		document.getElementById("error_firstName").innerHTML = "Please enter friend's name";
		document.getElementById("friendName").focus();
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
			document.getElementById("friendName").focus();
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
		if (checkInternationalPhone(val)==false)
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
	val = document.getElementById("friendEmail").value;
	if(val == "")
	{
		
		return true;
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
				document.getElementById("friendEmail").focus();
				return false;
			}
		}
		else
		{
			document.getElementById("error_email").innerHTML = "Single Quotes not allowed in form";
			document.getElementById("friendEmail").focus();
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
<form name="frmEmail" id="frmEmail" method="post" action="./referFriend.php" onsubmit="return doValidate();">
	<input type="hidden" name="PageAction" id="PageAction" value="SAVE" />
	<table width="344" height="155" border="0" cellpadding="0" cellspacing="0" bordercolor="c4d9de">
		<tr>
			<td class = "labelOfInput"><?php $this->docUserName->showLabel(); ?></td>
			<td class = "inputbox"><?php $this->docUserName->showInput(); ?>
			<font color = "red"><span id= "error_loginName"><?php echo $this->docUserName_error; ?></font></span></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->friendName->showLabel(); ?></td>
			<td class = "inputbox"><?php $this->friendName->showInput(); ?>
			<font color = "red"><span id= "error_firstName"><?php echo $this->friendName_error; ?></font></span></td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->friendEmail->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->friendEmail->showInput();  ?>
			<font color = "red"><span id= "error_email"><?php echo $this->emailORPhone_error;echo $this->friendEmail_error; ?></font></span> </td>
		</tr>
		<tr>
			<td class = "labelOfInput"><?php $this->contactPhone->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->contactPhone->showInput();  ?>
			<font color = "red"><span id= "error_contactPhone"><?php echo $this->contactPhone_error;?></font></span> </td>
		</tr>
		
		
		<tr>
			<td class="inputbox"> &nbsp;</td>
			<td class = "inputbox"> <input type="submit" value="Submit" /> 
		</tr>
	</table>
</form>


