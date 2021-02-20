<script language="JavaScript" type="text/javascript" >
function modelesswin(url,mwidth,mheight)
{
if (document.all && window.print) //if ie5
eval('window.showModelessDialog(url,"","help:0;resizable:1;dialogWidth:'+mwidth+'px;dialogHeight:'+mheight+'px")')
else
eval('window.open(url,"","width='+mwidth+'px,height='+mheight+'px,resizable=1,scrollbars=1")')
}
</script>
<script type="text/javascript" src="./include/datetimepicker.js">
//Date Time Picker
</script>
 <script language="JavaScript" type="text/javascript">
function dologout()
{
	document.location.href="./logout.php";
}
</script>
<script type="text/javascript">
function checkdate(input)
{
	//Basic check for format validity
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
	{ //Detailed check for valid date ranges
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

	document.getElementById('error_startDate').innerHTML = "";
	if(!checkStartDate())
		condt=false;
	document.getElementById('error_endDate').innerHTML = "";
	if(!checkEndDate())
		condt=false;
	document.getElementById('error_city').innerHTML = "";
		if(!checkCity())
			condt=false;
	document.getElementById('error_keyword').innerHTML = "";
		if(!checkKeyword())
			condt=false;
	return condt;
}
function checkStartDate()
{
	val = document.getElementById("courseStartDate").value;
	if(val == "")
	{
		return true;
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
		return true;
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
function checkCity()
{
	val = document.getElementById("city").value;
	if(val != "")
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
	else
	{
		return true;
	}
}
function checkKeyword()
{
	val = document.getElementById("keyword").value;
	if(val != "")
	{
		if(checkSingleQuotes(val))
		{
			return true;
		}
		else
		{
			document.getElementById("error_keyword").innerHTML = "Single Quotes not allowed in form";
			document.getElementById("keyword").focus();
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
</script>
<!-- <div id="ContentMainImage">
	<img src="./images/CMESearch.jpg" alt="CME Provider Lounge" />
</div> -->
<div id="ContentMainDesc">
	<div class = "contentMainHeader">
		<div style="float: left; width: 48%; margin-left: 3px;">
		CME Course Search
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		<?php if($_SESSION["UserName"] != "")
		{
		?>
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();">
		<?php
		}
		?>
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
			echo "Course has been booked successfully";

		}
		?>
	</div>
	<div class="textContent">
	<a href="index.php">Home</a>>><a href="doctorOptions.php">Doctor Options</a>>><br/>
	</div>
<div class="textContent">
	Thank you for visiting. Please use any one or more criteria to search CME database. Try us out today by giving us a call at <span class = "highlight">+1-866-465-6181</span> or dropping an
 <a  href="javascript:var mywin=window.open('./emailUs.php','Email','toolbar=no,status=no,menubar=no,resizeable=no,width=342,height=180,titlebar=no');">
		 <span class = "highlight">
		 	Email
		</span>
	</a>		
and our customer service agents will call you back.
	</div>
	<div></div><br/>
	<div class="searchBox">
		<div class="searchFirstCol">
		<form name="frmCMESearch" id="frmCMESearch" method="post" action="<?php echo $PHP_SELF;?>" onsubmit="return doValidate();">
		<input type="hidden" name="PageAction" id="PageAction" value="SEARCH" />
			<b>Meeting Date</b>{mm/dd/yyyy} Example: 07/21/2006<br/>Between
  			<?php $this->courseStartDate->showInput();?><a href="javascript:NewCal('courseStartDate','mmddyyyy');"><img src="./images/dtp.gif" width="16" height="16" border="0" alt="Pick a date"></a>
  			<br/><font color = "red"><span id="error_startDate"><?php echo $this->courseStartDate_error; ?></span></font>
  		</div>
  		<div class = "searchFirstLineCol">
  		<b>AND</b>
  		</div>
  		<div class="searchFirstSecondCol">
  			<?php $this->courseEndDate->showInput();?><a href="javascript:NewCal('courseEndDate','mmddyyyy');"><img src="./images/dtp.gif" width="16" height="16" border="0" alt="Pick a date"></a>
  			<br/><font color = "red"><span id="error_endDate"><?php echo $this->courseEndDate_error; ?></span></font>
		</div>

		<div class="searchFirstCol">
			  <b>Select Your Preferred Location</b><br/>
			  <b>City</b>&nbsp;&nbsp;&nbsp;<input type="text" name="city" id = "city" value="" size="20" maxlength="40"/>
			  <br/><font color = "red"><span id="error_city"><?php echo $this->city_error; ?></span></font>
		</div>
		<div class="searchSecondSecondCol">
			  <b>State</b>&nbsp;<?php $this->state->showSelectList($this->StateList);?>
		</div>
		<div class="searchFirstCol">
			  <b>Select the Specialty</b><br/>
			  <?php $this->speciality->showSelectList($this->SpecialityList); ?>
		</div>
		<div class="searchThirdSecondCol">
			  <b>Keyword</b>
			  <?php $this->keyword->showInput();?>
			 <br/><font color = "red"><span id="error_keyword"><?php echo $this->keyword_error; ?></span></font>
		</div>
		<br/><br/><br/>
		<div class="searchFirstCol">
			  <input type="image" name="submit" value="submit" src="images/search_but.gif" width="81" height="22">
		</div>
		<div class="clearFloatLeft"></div>
		</form>
	</div>

	<br/>
	
	
</div>

