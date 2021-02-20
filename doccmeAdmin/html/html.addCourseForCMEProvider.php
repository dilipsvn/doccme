<?php
/*
 * Created on Mar 28, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<script type="text/javascript" src="./include/datetimepicker.js">
/*Date Time Picker*/
</script>
<script language="JavaScript" type="text/javascript">
function dologout()
{
	document.location.href="./logout.php";
}
</script>
<script type="text/javascript">
var digits = "0123456789";

var phoneNumberDelimiters = "()- ";

var validWorldPhoneChars = phoneNumberDelimiters + "+";

var minDigitsInIPhoneNumber = 10;

function isInteger(s)
{   var i;
    for (i = 0; i < s.length; i++)
    {   
         var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
   
    return true;
}

function stripCharsInBag(s, bag)
{   var i;
    var returnString = "";
   /* Search through string's characters one by one.
     If character is not in bag, append to returnString.*/
    for (i = 0; i < s.length; i++)
    {   
        /* Check that current character isnt whitespace.*/
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function checkInternationalPhone(strPhone)
{
	s=stripCharsInBag(strPhone,validWorldPhoneChars);
	return (isInteger(s) && s.length >= minDigitsInIPhoneNumber);
}

function checkdate(input)
{
	
	var validformat=/^\d{2}\/\d{2}\/\d{4}$/; 
	var validformat1=/^\d{1}\/\d{2}\/\d{4}$/;
	var validformat2=/^\d{1}\/\d{1}\/\d{4}$/;
	var validformat3=/^\d{2}\/\d{1}\/\d{4}$/;
	var returnval=false;
	var dtformat=false;
	if (validformat.test(input.value))
	{
		dtformat=true;
	}
	if (validformat1.test(input.value))
	{
		dtformat=true;
	}
	if (validformat2.test(input.value))
	{
		dtformat=true;
	}
	if (validformat3.test(input.value))
	{
		dtformat=true;
	}
	
	if(!dtformat)
	{
		returnval =  false;
	}
	else
	{ 
		var monthfield=input.value.split("/")[0];
		var dayfield=input.value.split("/")[1];
		var yearfield=input.value.split("/")[2];
		var dayobj = new Date(yearfield, monthfield-1, dayfield);
		if ((dayobj.getMonth()+1!=monthfield)||(dayobj.getDate()!=dayfield)||(dayobj.getFullYear()!=yearfield))
		{
			returnval = false;
		}
		else
		{
			returnval=true;
		}
	}
	if (returnval==false) 
	{
		input.select();
		input.focus();
	}
	return returnval;
}
function doValidate()
{
	var condt=true;
	
		document.getElementById('error_CMEId').innerHTML = "";
		if(!checkCMEId())
			condt=false;
		document.getElementById('error_courseTitle').innerHTML = "";
		if(!checkCourseTitle())
			condt=false;
		document.getElementById('error_courseDesc').innerHTML = "";
		if(!checkCourseDesc())
			condt=false;
                document.getElementById('error_specialityField').innerHTML = "";
		if(!checkSpecialityField())
			condt=false;
		document.getElementById('error_speciality').innerHTML = "";
		if(!checkSpeciality())
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
		document.getElementById('error_contactPerson').innerHTML = "";
		if(!checkContactPerson())
			condt=false;
		document.getElementById('error_contactPhone').innerHTML = "";
		if(!checkContactPhone())
			condt=false;
		document.getElementById('error_fax').innerHTML = "";
		if(!checkFax())
			condt=false;
		document.getElementById('error_email').innerHTML = "";
		if(!checkEmail())
			condt=false;
		document.getElementById('error_startDate').innerHTML = "";
		if(!checkStartDate())
			condt=false;
		document.getElementById('error_endDate').innerHTML = "";
		if(!checkEndDate())
			condt=false;
		document.getElementById('error_lastDate').innerHTML = "";
		if(!checkLastDate())
			condt=false;
		document.getElementById('error_nearestHotel').innerHTML = "";
		if(!checkNearestHotel())
			condt=false;
		document.getElementById('error_nearestAirport').innerHTML = "";
		if(!checkNearestAirport())
			condt=false;					
		document.getElementById('error_courseFee').innerHTML = "";
		if(!checkCourseFee())
			condt=false;	
		document.getElementById('error_cmeCredits').innerHTML = "";
		if(!checkCMECredits())
			condt=false;
		
	return condt;
}
function doRemove()
{
	var mysp = document.getElementById('Speciality').value;
	var mystr = document.getElementById('specialityField').value ;
	var myArr = new Array();
	var arr_len;
	var flg=false;
	var cstr = "";
	var i;
	if (mysp=="")
	{
		/*document.getElementById("error_specialityField").innerHTML = "Please select the Specialty to be Removed..";*/
		alert("Please select the Specialty to be Removed..");
		return false;
	}
	if (mystr=="")
	{
		/*document.getElementById("error_specialityField").innerHTML = "List of selected Specialties is empty. There is Nothing to Remove";*/
		alert("List of selected Specialtys are empty. There is Nothing to Remove");
		return false; 
	}
	if (mystr.indexOf(";") < 0)
	{
		if (mystr == mysp)
		{
			document.getElementById('specialityField').value = "";
		}
		else
		{
			/*document.getElementById("error_specialityField").innerHTML = "No match Found to be removed...";*/
			alert("No match Found to be removed...");
			return false;
		}
	}
	else
	{
		myArr = mystr.split(";");
		arr_len = myArr.length;
		for(i=0;i<arr_len; i++)
		{
			if (myArr[i] == mysp)
			{
				flg = true;
			}
			else
			{
				if(cstr=="")
				{
					cstr = myArr[i];
				}
				else
				{
					cstr = cstr + ";" + myArr[i];
				}
			}
		}
		if(flg)
		{
			/*document.getElementById("error_specialityField").innerHTML = "Removed Selection";*/
			alert("Removed Selection");
			document.getElementById('specialityField').value = cstr;
		}
		else
		{
			/*document.getElementById("error_specialityField").innerHTML = "Match Not found for removal...";*/
			alert("Match Not found for removal...");
		}		
	}
}
function doAdd()
{
	var mysp = document.getElementById('Speciality').value;
	var mystr = document.getElementById('specialityField').value;
	if (mysp=="")
	{
		/*document.getElementById("error_specialityField").innerHTML = "Please select the Specialty..";
		document.getElementById("specialityField").focus();
		return;*/
		alert("Please select the Specialty..");
	}
	if (mystr=="")
	{
		document.getElementById('specialityField').value = mysp;
	}
	else
	{
		var arrSpl = mystr.split(";");
                var i = 0;
	        for(i=0;i < arrSpl.length;i++)
	        {
			if(arrSpl[i] == mysp)
		       {
			  alert("This speciality already exists in the list");
		        }
                        else
                       {
                           document.getElementById('specialityField').value = mystr + ";" +  mysp;
                        }
		}
                  
	}
}
function checkCMEId()
{
	val = document.getElementById("CMEId").value;
	if(val == "")
	{
		document.getElementById("error_CMEId").innerHTML = "Please select CME User Name";
		document.getElementById("CMEId").focus();
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
			document.getElementById("error_CMEId").innerHTML = "Single Quotes not allowed in form";
			document.getElementById("CMEId").focus();
			return false;
		}
	}
}
function checkCourseTitle()
{
	val = document.getElementById("courseTitle").value;
	if(val == "")
	{
		document.getElementById("error_courseTitle").innerHTML = "Please enter course title";
		document.getElementById("courseTitle").focus();
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
			document.getElementById("error_courseTitle").innerHTML = "Single Quotes not allowed in form";
			document.getElementById("courseTitle").focus();
			return false;
		}
	}
}
function checkCourseDesc()
{
	val = document.getElementById("courseDesc").value;
	if(val != "")
	{
		if(checkSingleQuotes(val))
		{
			return true;
		}
		else
		{
			document.getElementById("error_courseDesc").innerHTML = "Single Quotes not allowed in form";
			document.getElementById("courseDesc").focus();
			return false;
		}
	}
	else
	{
		return true;
	}
}
function checkSpecialityField()
{
	val = document.getElementById("specialityField").value;
	if(val != "")
	{
		if(checkSingleQuotes(val))
		{
			return true;
		}
		else
		{
			document.getElementById("error_specialityField").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("specialityField").focus();
			return false;
		}
	}
	else
	{
		document.getElementById("error_specialityField").innerHTML = "Please add speciality in this field";
		document.getElementById("specialityField").focus();
		return false;
	}
}
function checkSpeciality()
{
	val = document.getElementById("Speciality");
	if(val.selectedIndex < 0)
	{
		return true;
	}
	else
	{
		return true;
	}
}
function checkAddress1()
{
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
	val = document.getElementById("address2").value;
	if(val != "")
	{
		if(checkSingleQuotes(val))
		{
			return true;
		}
		else
		{
			document.getElementById("error_address2").innerHTML = "Single Quotes not allowed in form";
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
		document.getElementById("State").focus();
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
			document.getElementById("State").focus();
			return false;
		}
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
			document.getElementById("error_zip").innerHTML = "Single Quotes not allowed in form";
			document.getElementById("zip").focus();
			return false;
		}
	}
}
function checkContactPerson()
{
	val = document.getElementById("contactPerson").value;
	if(val != "")
	{
		if(checkSingleQuotes(val))
		{
			return true;
		}
		else
		{
			document.getElementById("error_contactPerson").innerHTML = "Single Quotes not allowed in form";
			document.getElementById("contactPerson").focus();
			return false;
		}
	}
	else
	{
		return true;
	}
}
function checkContactPhone()
{
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
function checkStartDate()
{
	val = document.getElementById("courseStartDate").value;
	if(val == "")
	{
		document.getElementById("error_startDate").innerHTML = "Please enter course start date";
		document.getElementById("courseStartDate").focus();
		return false;
	}
	else
	{
		if(checkSingleQuotes(val))
		{
			if(!checkdate(document.getElementById('courseStartDate')))
			{
				document.getElementById("error_startDate").innerHTML = "Please enter valid date /date format";
				document.getElementById("courseStartDate").focus();
				return false;
			}
			else
			{
				return true;
			}	
		}
		else
		{
			document.getElementById("error_startDate").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("courseStartDate").focus();
			return false;
		}
		
	}
}
function checkEndDate()
{
	val = document.getElementById("courseEndDate").value;
	if(val == "")
	{
		document.getElementById("error_endDate").innerHTML = "Please enter course end date";
		document.getElementById("courseEndDate").focus();
		return false;
	}
	else
	{
		if(checkSingleQuotes(val))
		{
			if(!checkdate(document.getElementById('courseEndDate')))
			{
				document.getElementById("error_endDate").innerHTML = "Please enter valid date /date format";
				document.getElementById("courseEndDate").focus();
				return false;
			}
			else
			{
				return true;
			}
		}
		else
		{
			document.getElementById("error_endDate").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("courseEndDate").focus();
			return false;
		}
		
	}
}
function checkLastDate()
{
	val = document.getElementById("lastDateForApp").value;
	if(val == "")
	{
		document.getElementById("error_lastDate").innerHTML = "Please enter last date for application";
		document.getElementById("lastDateForApp").focus();
		return false;
	}
	else
	{
		if(checkSingleQuotes(val))
		{
			if(!checkdate(document.getElementById('lastDateForApp')))
			{
				document.getElementById("error_lastDate").innerHTML = "Please enter valid date /date format";
				document.getElementById("lastDateForApp").focus();
				return false;
			}
			else
			{
				return true;
			}
		}
		else
		{
			document.getElementById("error_lastDate").innerHTML = "Single quotes are not allowed in form";
			document.getElementById("lastDateForApp").focus();
			return false;
		}
		
	}
}
function checkNearestHotel()
{
	val = document.getElementById("nearestHotel").value;
	if(val != "")
	{
		if(checkSingleQuotes(val))
		{
			return true;
		}
		else
		{
			document.getElementById("error_nearestHotel").innerHTML = "Single Quotes not allowed in form";
			document.getElementById("nearestHotel").focus();
			return false;
		}
	}
	else
	{
		return true;
	}
}
function checkNearestAirport()
{
	val = document.getElementById("nearestAirport").value;
	if(val != "")
	{
		if(checkSingleQuotes(val))
		{
			return true;
		}
		else
		{
			document.getElementById("error_nearestAirport").innerHTML = "Single Quotes not allowed in form";
			document.getElementById("nearestAirport").focus();
			return false;
		}
	}
	else
	{
		return true;
	}
}
function checkCourseFee()
{
	val = document.getElementById("courseFee").value;
	if(val == "")
	{
		document.getElementById("error_courseFee").innerHTML = "Please enter Course Fee";
		document.getElementById("courseFee").focus();
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
			document.getElementById("error_courseFee").innerHTML = "Single Quotes not allowed in form";
			document.getElementById("courseFee").focus();
			return false;
		}
	}
}
function checkCMECredits()
{
	val = document.getElementById("cmeCredits").value;
	if(val == "")
	{
		document.getElementById("error_cmeCredits").innerHTML = "Please enter CME Credits value";
		document.getElementById("cmeCredits").focus();
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
			document.getElementById("error_cmeCredits").innerHTML = "Single Quotes not allowed in form";
			document.getElementById("cmeCredits").focus();
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
 <div id="ContentMainDesc">
	<div class = "contentMainHeader">
		<div style="float: left; width: 48%; margin-left: 3px;">
		Add Course for CME Provider
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();"/>
		</div>
		<div style="clear:both; border: none;"> </div>
	</div>
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
			echo "Course has been registered successfully";
		}
		?>
	</div>
	
	<div class="textContent">
	<a href = "home.php">Home</a>>>
	<a href = "cmeproviders.php">CME Providers</a>>>
	</div>
<div class = "textContent">
<p>Dear Admin, please fill the following details to add a course in our database for selected CMEProvider through drop down list.</p>
</div>
<form name="frmAddCourse" id="frmAddCourse" method="post" action= "./addCourseForCMEProvider.php" onsubmit="return doValidate();">
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
			<td  class = "labelOfInput"><?php $this->CMEId->showLabel();?></td>
			<td class = "inputbox"><?php $this->CMEId->showSelectList($this->cmeProviderList);?>
			<font color ="red">*<span id ="error_CMEId"><?php echo $this->CMEId_error; ?></span></font></td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->courseTitle->showLabel();?></td>
			<td class = "inputbox"><?php $this->courseTitle->showInput();?>
			<font color ="red">*<span id ="error_courseTitle"><?php echo $this->courseTitle_error; ?></span></font> </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->courseDesc->showLabel();?></td>
			<td class = "inputbox"><?php $this->courseDesc->showTextarea();?> 
			<font color ="red"><span id ="error_courseDesc"><?php echo $this->courseDesc_error; ?></span></font> </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->speciality->showLabel(); ?>
			<br/>
			<a  href="javascript:var mywin=window.open('./help.php','Help','toolbar=no,status=no,menubar=no,resizeable=yes,scrollbars=yes,width=338,height=250,titlebar=no');">
			<b><u>Help?</u></b></a></td>
			<td class = "inputbox"><?php $this->specialityField->showInput();?>
			<font color ="red">*<span id ="error_specialityField"><?php echo $this->specialityField_error; ?></span></font> <br/>
			<?php $this->speciality->showSelectList($this->SpecialityList); ?>
			<input type="button" name="btnAdd" value="ADD" onclick="doAdd();" />
			<font color ="red"><span id ="error_speciality"><?php echo $this->speciality_error; ?></span></font><br/> 
			<input type="button" name="btnRemove" value="REMOVE" onclick="doRemove();" />	
			</td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->address1->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->address1->showInput();  ?>
			<font color ="red">*<span id ="error_address1"><?php echo $this->address1_error; ?></span></font> </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->address2->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->address2->showInput();  ?>
			<font color ="red"><span id ="error_address2"><?php echo $this->address2_error; ?></span></font> </td>
		</tr>
						
		<tr>
			<td  class = "labelOfInput"><?php $this->city->showLabel();?> </td>
			<td class = "inputbox"><?php $this->city->showInput();?>
			<font color ="red">*<span id ="error_city"><?php echo $this->city_error; ?></span></font> </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->state->showLabel();?> </td>
			<td class = "inputbox"><?php $this->state->showSelectList($this->StateList);?>
			<font color ="red">*<span id ="error_state"><?php echo $this->state_error; ?></span></font></td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->zip->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->zip->showInput();  ?>
			<font color ="red"><span id ="error_zip"><?php echo $this->zip_error; ?></span></font> </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->country->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->country->showInput();  ?></td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->contactPerson->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->contactPerson->showInput();  ?>
			<font color ="red"><span id ="error_contactPerson"><?php echo $this->contactPerson_error; ?></span></font></td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->contactPhone->showLabel(); ?> </td>
			<td class ="inputbox"><?php $this->contactPhone->showInput();  ?> 
			<font color ="red"><span id ="error_contactPhone"><?php echo $this->contactPhone_error; ?></span></font></td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->fax->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->fax->showInput();  ?>
			<font color ="red"><span id ="error_fax"><?php echo $this->fax_error; ?></span></font></td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->email->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->email->showInput();  ?>
			<font color ="red">*<span id ="error_email"><?php echo $this->email_error; ?></span></font></td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->courseStartDate->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->courseStartDate->showInput();  ?><a href="javascript:NewCal('courseStartDate','mmddyyyy');"><img src="./images/dtp.gif" width="16" height="16" border="0" alt="Pick a date"></a>
			 <font color ="red">*<span id ="error_startDate"><?php echo $this->courseStartDate_error; ?></span></font></td>
		</tr>
		
		<tr>
			<td  class = "labelOfInput"><?php $this->courseEndDate->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->courseEndDate->showInput();  ?><a href="javascript:NewCal('courseEndDate','mmddyyyy');"><img src="./images/dtp.gif" width="16" height="16" border="0" alt="Pick a date"></a> 
			<font color ="red">*<span id ="error_endDate"><?php echo $this->courseEndDate_error; ?></span></font></td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->lastDateForApp->showLabel(); ?> </td>
			<td class = "inputbox"> <?php $this->lastDateForApp->showInput();  ?><a href="javascript:NewCal('lastDateForApp','mmddyyyy');"><img src="./images/dtp.gif" width="16" height="16" border="0" alt="Pick a date"></a> 
			<font color ="red">*<span id ="error_lastDate"><?php echo $this->lastDateForApp_error; ?></span></font></td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->nearestHotel->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->nearestHotel->showInput();  ?>
			<font color ="red"><span id ="error_nearestHotel"><?php echo $this->nearestHotel_error; ?></span></font> </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->nearestAirport->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->nearestAirport->showInput();  ?> 
			<font color ="red"><span id ="error_nearestAirport"><?php echo $this->nearestAirPort_error; ?></span></font></td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->courseFee->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->courseFee->showInput();  ?> 
			<font color ="red">*<span id ="error_courseFee"><?php echo $this->courseFee_error; ?></span></font></td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->cmeCredits->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->cmeCredits->showInput();  ?>
			<font color ="red">*<span id ="error_cmeCredits"><?php echo $this->cmeCredits_error; ?></span></font></td>
		</tr>
		<tr>
			<td class = "inputbox">&nbsp; </td>
			<td class = "inputbox"> <input type="submit" value="SUBMIT" />
			 &nbsp; <input type="reset" value="RESET" /> </td>
		</tr>
	</table>
</form>
</div>
