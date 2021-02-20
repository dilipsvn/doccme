<script type="text/javascript">
var month;
var day;
var year;
var isValidDay="";
function checkDate(date1)
{
	if(date1 !="")
	{
		date = date1.value;
		
		dateVal = date.split("/");
		month = dateVal[0];
		day = dateVal[1];
		year = dateVal[2];
		reyear = /19[0-9]{2}|2[0-9]{3}/;
		remonth = /0[1-9]|1[0-2]/;
		isValidYear =  reyear.test(year);
		isValidMonth = remonth.test(month);
		if(isValidYear)
		{
			if(isValidMonth)
			{
				if(month == 2)
				{
					
	
					isValidDay = CheckValidDaysLeap(year, day);
					
				}
				else
				{
					isValidDay = CheckValidDays(month, day);
					
					
				}
			}
			else
			{
				alert("Enter valid month");
			}
		}
		else
		{
			alert("Enter Valid year");
		}	
		if(isValidYear && isValidMonth && isValidDay)
		{
			alert("Perfect date");
		}
		else
		{
			alert("wrong date");
		}
	}
}

function CheckValidDaysLeap(year, day)
{
	reDayLeap = /2[0-9]/;
	reDayNotLeap = /2[0-8]/;
	
	if((year % 4) == 0 )
	{
			if((year % 100)== 0)
			{
				isValidDay = reDayNotLeap.test(day);
			}
			else
			{
				isValidDay = reDayLeap.test(day);
				
			}
		
	}
	else
	{
		isValidDay = reDayNotLeap.test(day);
		
	}
	return isValidDay;
	
}

function CheckValidDays(month, day)
{
	reOddDays = /0[1-9]|1[0-9]|2[0-9]|(31)/;
	reEvenDays = /0[1-9]|1[0-9]|2[0-9]|(30)/;
	var isValidDay;
	
	if((month == 8)||(month <= 12))
	{
		if((month % 2)== 0)
		{
			isValidDay = reOddDays.test(day);
		}
		else
		{
			isValidDay = reEvenDays.test(day);
		}	
	}
	if((month == 1) ||(month <= 7)) 
	{
		if((month % 2)== 0)
		{
			isValidDay = reEvenDays.test(day);
			
		}
		else
		{
			isValidDay = reOddDays.test(day);
			
		}	
	}
	return isValidDay;
}
function checkFormFields(form)
{
	if(form.password.value == "")
	{
		alert("Password cannot be blank");
	}
}
</script>