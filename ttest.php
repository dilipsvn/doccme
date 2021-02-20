<html>
<head><title>Test Edit CME Course</title></head>
<body>
<form name="frmAddCourse" id="frmAddCourse" method="post" action= "ttest.php" >
	
	<input type="text" name ="courseId" value = "1411" />
	<input type="text" name ="courseTitle" value = "Test" />
	<input type="text" name ="courseDesc" value = "Test Neurology" />
	<input type="text" name ="specialityField" value = "Neurology" />
	<input type="text" name ="Speciality" value = "Neurology" />
	<input type="text" name ="address1" value = "gfdsgfg" />
	<input type="text" name ="address2" value = "1411" />
	<input type="text" name ="city" value = "hfdghg" />
	<input type="text" name ="State" value = "AL" />
	<input type="text" name ="zip" value = "" />
	<input type="text" name ="country" value = "USA" />
	<input type="text" name ="contactPerson" value = "" />
	<input type="text" name ="contactPhone" value = "" />
	<input type="text" name ="fax" value = "" />
	<input type="text" name ="email" value = "poornima_sk@yahoo.com" />
	<input type="text" id="courseStartDate" name="courseStartDate" size="25" maxlength="50" value="01/31/2008" readonly="true" />
	<input type="text" id="courseEndDate" name="courseEndDate" size="25" maxlength="50" value="02/12/2008" readonly="true" />
	<input type="text" id="lastDateForApp" name="lastDateForApp" size="25" maxlength="50" value="01/30/2008"/>
	<input type="text" id="nearestHotel" name="nearestHotel" size="25" maxlength="50" value=""/>			
	<input type="text" id="nearestAirport" name="nearestAirport" size="25" maxlength="50" value=""/>			
	<input type="text" id="courseFee" name="courseFee" size="25" maxlength="50" value="1.00"/>*
	<input type="text" id="cmeCredits" name="cmeCredits" size="25" maxlength="50" value="7"/>*
	<input type="hidden" name="PageAction" id="PageAction" value="UPDATE" />
	<input type="submit" value="UPDATE" />
</form>
</body>
</html>
