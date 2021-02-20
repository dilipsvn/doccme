<?php
/*
 * 	Created on Dec 9, 2006
 *	author Poornima Kamatgi
 *
 *	this is data access layer class
 *	this class interacts with database
 *	using mysql queries and returns required
 *	resultset to the business access layer class
 *
 *	revised on Jan 20, 2007
 *	revised on Mar 17, 2007
 *	revised on Sep 12, 2007
 *
 */
 require_once("class.MYSQLHelper.php");
 require_once("class.phpDate.php");
 require_once("class.QueryBuilder.php");

 class DAL
 {
 	var $mySQL;

 	/*
 	 * DAL constructor
 	 * declares Error object
 	 * paremeters passed : none
 	 *
 	 */
 	function DAL()
	{
		$this->mySQL = new MYSQLHelper();
	}
 	/*
 	 * this method checks the existence
 	 * of similar email id in
 	 * doctor table befor inserting new doctor details
 	 * parameters passed : email id of doctor, connection object,  empty value
 	 * returns error object
 	 */
 	function checkDBDocDupEntriesForUserName(&$loginName, &$val, &$con)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("doctor");
 		$fieldList = " UserName ";
 		$query->setFieldList($fieldList);
 		$condition = " UserName = '".$loginName."'";
 		$query->setCondition($condition);
	 	$sqlSelect = $query->generateQuery();
	 	$error = $this->mySQL->executeScalar($con, $sqlSelect, $val);
	 	if($error->isError())
	 	{
	 		return $error;
	 	}
		return $error;
 	}
 	/*
 	 * this method checks the existence
 	 * of similar email id in
 	 * doctor table before inserting new doctor details
 	 * parameters passed : email id of doctor, connection object, empty value
 	 * returns error object
 	 */
 	function checkDBDocDupEntriesForEmailId(&$email, &$val, &$con)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("doctor");
 		$fieldList = " EmailId ";
 		$query->setFieldList($fieldList);
 		$condition = " EmailId = '".$email."'";
 		$query->setCondition($condition);
	 	$sqlSelect = $query->generateQuery();
	 	$error = $this->mySQL->executeScalar($con, $sqlSelect, $val);
	 	if($error->isError())
	 	{
	 		return $error;
	 	}
		return $error;
 	}
	/*
 	 * this method checks the existence
 	 * of similar email id in
 	 * doctor contacts table before inserting new doctor details
 	 * parameters passed : email id of doctor, connection object, empty value
 	 * returns error object
 	 */
 	function checkDBDocContactDupEntriesForEmailId(&$email, &$val, &$con)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("doctorcontacts");
 		$fieldList = " EmailId ";
 		$query->setFieldList($fieldList);
 		$condition = " EmailId = '".$email."' ";
 		$query->setCondition($condition);
	 	$sqlSelect = $query->generateQuery();
	 	$error = $this->mySQL->executeScalar($con, $sqlSelect, $val);
	 	if($error->isError())
	 	{
	 		return $error;
	 	}
		return $error;
 	}
	/*
 	 * this method checks the existence
 	 * of similar email id in
 	 * refrrals table before inserting new referral details
 	 * parameters passed : email id of doctor's friend, connection object, empty value
 	 * returns error object
 	 */
 	function checkDBReferralDupEntriesForEmailId(&$email, &$val, &$con)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("paymentmodesreferrals");
 		$fieldList = " FriendEmailId ";
 		$query->setFieldList($fieldList);
 		$condition = " FriendEmailId = '".$email."' ";
 		$query->setCondition($condition);
	 	$sqlSelect = $query->generateQuery();
	 	$error = $this->mySQL->executeScalar($con, $sqlSelect, $val);
	 	if($error->isError())
	 	{
	 		return $error;
	 	}
		return $error;
 	}
 	/*
 	 * this method checks the existence
 	 * of similar user name in
 	 * cme provider table before inserting new
 	 * cme provider details
 	 * parameters passed : email id of cme provider, connection object, empty value
 	 * returns error object
 	 */
 	function checkDBCMEPDupEntriesForUserName(&$loginName, &$val, &$con)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("paymentmodescmeprovider");
 		$fieldList = " UserName ";
 		$query->setFieldList($fieldList);
 		$condition = " UserName = '".$loginName."'";
 		$query->setCondition($condition);
	 	$sqlSelect = $query->generateQuery();
	 	$error = $this->mySQL->executeScalar($con, $sqlSelect, $val);
	 	if($error->isError())
	 	{
	 		return $error;
	 	}
		return $error;
 	}
 	/*
 	 * this method checks the existence
 	 * of similar email id in
 	 * doctor table befor inserting new doctor details
 	 * parameters passed : email id of doctor, connection object
 	 * returns error object
 	 */
 	function checkDBCMEPDupEntriesForEmailId(&$email, &$val, &$con)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("paymentmodescmeprovider");
 		$fieldList = " EmailId ";
 		$query->setFieldList($fieldList);
 		$condition = " EmailId = '".$email."'";
 		$query->setCondition($condition);
	 	$sqlSelect = $query->generateQuery();
	 	$error = $this->mySQL->executeScalar($con, $sqlSelect, $val);
	 	if($error->isError())
	 	{
	 		return $error;
	 	}
		return $error;
 	}
 	/*
 	 * inserts doctor details into doctor table
 	 * parameters passed : connection object, model object of doctor
 	 * returns error object
 	 */
 	function insertDoctor(&$con, &$docter)
 	{
 		$error = new Error();
 		//$error->module="(DAC) insertDoctor";
 		//create insert query
 		$sqlInsert = "INSERT INTO `doctor`(".
 			"`RegDate`, `FirstName`,`MiddleName`,`LastName`,`Sex`,`Address1`,`Address2`,".
 			"`City`,`State`,`Zip`,`Country`,`WorkPhone`,".
			"`HomePhone`,`Fax`,`MobilePhone`,`EmailId`,".
  			"`Speciality`,`ContactTime`,`UserName`,`Password`,".
  			"`Status`,`Remarks`".
  			") VALUES(NOW(), ".
  			"'".$docter->name->firstName.
			"', '".$docter->name->middleName.
			"', '".$docter->name->lastName.
			"', '".$docter->sex.
			"', '".$docter->address->address1.
			"', '".$docter->address->address2.
			"', '".$docter->address->city.
			"', '".$docter->address->state.
			"', '".$docter->address->zip.
			"', '"."USA".
			"', '".$docter->phone->workPhone.
			"', '".$docter->phone->homePhone.
			"', '".$docter->phone->fax.
			"', '".$docter->phone->mobilePhone.
			"', '".$docter->email.
			"', '".$docter->speciality.
			"', '".$docter->contactTime.
			"', '".$docter->login->loginName.
			"', '".$docter->login->password.
			"', '"."NEW".
			"', '".$docter->remarks.
			"')";

	 	//execute insert query
	 	$value = "";
	 	$error = $this->mySQL->executeInsert($con, $sqlInsert);
	 	if($error->isError())
		{
			return $error;
		}
		return $error;
 	}
	/*
 	 * inserts doctor contact details into doctor table
 	 * parameters passed : connection object, model object of doctor
 	 * returns error object
 	 */
 	function insertDocContact(&$con, &$docContact)
 	{
 		$error = new Error();
 		//create insert query
 		$sqlInsert = "INSERT INTO `DoctorContacts` (".
 			" `ContactedDate`, `Name`,".
 			" `ContactPhone`,`EmailId`,".
  			" `ContactTime`,".
  			" `Status`,`Remarks`".
  			")  VALUES(NOW(), ".
  			"'".$docContact->name->firstName.
			"', '".$docContact->contactPhone.
			"', '".$docContact->email.
			"', '".$docContact->contactTime.
			"', '"."ACTIVE".
			"', '".$docContact->remarks.
			"')";

	 	//execute insert query
	 	$value = "";
	 	$error = $this->mySQL->executeInsert($con, $sqlInsert);
	 	if($error->isError())
		{
			return $error;
		}
		return $error;
 	}
	/*
 	 * inserts referral details into referrals table
 	 * parameters passed : connection object, model object of referral
 	 * returns error object
 	 */
 	function insertReferral(&$con, &$referral)
 	{
 		$error = new Error();
 		//create insert query
 		$sqlInsert = "INSERT INTO `Referrals` (".
 			" `ReferredDate`, `DocUserName`,".
 			" `FriendName`,`FriendEmailId`,".
 			" `ContactPhone`,".
  			" `Status`,`Remarks`".
  			")  VALUES(NOW(), ".
  			"'".$referral->docUserName.
			"', '".$referral->friendName.
			"', '".$referral->friendEmail.
			"', '".$referral->contactPhone.
			"', '"."ACTIVE".
			"', '".$referral->remarks.
			"')";

	 	//execute insert query

	 	$error = $this->mySQL->executeInsert($con, $sqlInsert);
	 	if($error->isError())
		{
			return $error;
		}
		return $error;
 	}
 	/*
 	 * inserts cme provider details into cme provider table
 	 * parameters passed : connection object, model object of cme provider
 	 * returns error object
 	 */
 	function insertCMEProvider(&$con, &$cmeProvider)
 	{
 		$error = new Error();
 		//$error->module="(DAC) InsertCMEProvider";
 		//create insert query

 		$sqlInsert = "INSERT INTO `CMEProvider`(".
 		"`RegDate`, `InstituteName`, `FirstName`," .
		"`MiddleName`, `LastName`,`Address1`,`Address2`,".
 		"`City`,`State`,`Zip`,`Country`,`WorkPhone`,".
		"`HomePhone`,`Fax`,`MobilePhone`,`EmailId`,".
  		"`WebSiteUrl`, `UserName`,`Password`,".
  		"`Status`,`Remarks`".
 		") VALUES (NOW(), ".
 		"'".$cmeProvider->instituteName.
 		"', '".$cmeProvider->name->firstName.
 		"', '".$cmeProvider->name->middleName.
 		"', '".$cmeProvider->name->lastName.
 		"', '".$cmeProvider->address->address1.
 		"', '".$cmeProvider->address->address2.
 		"', '".$cmeProvider->address->city.
 		"', '".$cmeProvider->address->state.
 		"', '".$cmeProvider->address->zip.
 		"', '"."USA".
 		"', '".$cmeProvider->phone->workPhone.
		"', '".$cmeProvider->phone->homePhone.
		"', '".$cmeProvider->phone->fax.
		"', '".$cmeProvider->phone->mobilePhone.
 		"', '".$cmeProvider->email.
 		"', '".$cmeProvider->websiteUrl.
 		"', '".$cmeProvider->login->loginName.
 		"', '".$cmeProvider->login->password.
 		"', '"."NEW".
		"', '".$cmeProvider->remarks.
 		"')";

	 	$value = "";
	 	$error = $this->mySQL->executeInsert($con, $sqlInsert);
	 	if($error->isError())
		{
			return $error;
		}
		return $error;
  	}
 	/*
 	 * adds new cme course by cme provider
 	 * parameters passed : connection object, model object of cme course
 	 * returns error object
 	 */
 	function addNewCMECourse(&$con, &$course)
 	{
 		$error = new Error();
 		//$error->module="(DAC) AddCMECourse";
 		//create insert query
 		$temp1 = explode("/", $course->courseDate->courseStartDate);
	 	$startDate = mktime(0,0,0, $temp1[0],$temp1[1],$temp1[2]);
	 	$temp2 = explode("/", $course->courseDate->courseEndDate);
	 	$endDate = mktime(0,0,0, $temp2[0],$temp2[1],$temp2[2]);
	 	$temp3 = explode("/", $course->courseDate->lastDateForApp);
	 	$lastDate = mktime(0,0,0, $temp3[0],$temp3[1],$temp3[2]);
 		/*$startDate = $course->courseDate->courseStartDate->getMysqlDate();
 		$endDate = $course->courseDate->courseEndDate->getMysqlDate();
 		$lastDate = $course->courseDate->lastDateForApp->getMysqlDate();*/

 		$sqlInsert = "INSERT INTO `cmecourses`(".
	 		"`CMEId`, `CourseAddDate`, `CourseTitle`, `CourseDesc`,".
			" `Speciality`, `Venue_Address1`,`Venue_Address2`,".
			"`Venue_City`,`Venue_State`,`Venue_Zip`,`Venue_Country`,".
			"`ContactPerson`, `ContactPhone`,".
	 		"`ContactFax`, `ContactEmail`, `CourseStartDate`, `CourseEndDate`,".
	 		"`LastDate_App`,`NearestHotel`, `NearestAirport`, `CourseFee`,".
	 		"`Status`, `Remarks`, `CMECredits`".
	 		") VALUES ('". $course->CMEId ."', NOW()".
	 		", '".$course->courseTitle.
	 		"', '".$course->courseDesc.
	 		"', '".$course->specialityField.
	 		"', '".$course->address->address1.
	 		"', '".$course->address->address2.
	 		"', '".$course->address->city.
	 		"', '".$course->address->state.
	 		"', '".$course->address->zip.
	 		"', '".$course->address->country.
	 		"', '".$course->contactPerson.
	 		"', '".$course->contactPhone.
	 		"', '".$course->phone->fax.
	 		"', '".$course->email.
	 		"', '".date("Y-m-d", $startDate).
	 		"', '".date("Y-m-d", $endDate).
	 		"', '".date("Y-m-d", $lastDate).
	 		"', '".$course->nearestHotel.
	 		"', '".$course->nearestAirport.
	 		"', ".$course->courseFee.
	 		", '".$course->status.
			"', '".$course->remarks.
			"', '".$course->cmeCredits.
	 		"')";

	 	$value = "";
	 	$error = $this->mySQL->executeInsert($con, $sqlInsert);
	 	if($error->isError())
		{
			return $error;
		}
		return $error;
 	}

 	/*
 	 * checks the user name and password
 	 * of registered doctor in doctor table
 	 * parameters passed : connection object, result set, user name , password of doctor
 	 * returns error object
 	 */
 	function checkDoctor(&$con, &$result, &$userName, &$password)
 	{
 		$error = new Error();
 		//$error->module = "(DAC)checkDoctor";
 		$query = new QueryBuilder("doctor");
 		$query->setFieldList(" DoctorId ");
 		$condition = "UserName = '".$userName."' AND Password = '".$password."'";
 		$query->setCondition($condition);
 		$sqlSelect = $query->generateQuery();
 		$error = $this->mySQL->executeQuery($result, $con, $sqlSelect);
 		if($error->isError())
		{
			return $error;
		}
		return $error;
 	}

 	/*
 	 * checks the user name and password
 	 * of registered cme provider in cme provider table
 	 * parameters passed : connection object, result set, user name , password of cme provider
 	 * returns error object
 	 */
 	function checkCMEProvider(&$con, &$result, &$userName, &$password)
 	{
 		$error = new Error();
 		//$error->module = "(DAC)CheckCMEProvider";
 		$query = new QueryBuilder("paymentmodescmeprovider");
 		$query->setFieldList(" CMEId ");
 		$condition = "UserName = '".$userName."' AND Password = '".$password."'";
 		$query->setCondition($condition);
 		$sqlSelect = $query->generateQuery();
 		$error = $this->mySQL->executeQuery($result, $con, $sqlSelect);
 		if($error->isError())
		{
			return $error;
		}
		return $error;
 	}
 	/*
 	 * populates state list for combo box values in form from States table
 	 * parameter passed : connection object, array object to store the values from table
 	 * returns error object
 	 */
 	function getStateList(&$con, &$states)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("states");
 		$query->setFieldList(" State_Code, State_Name ");
 		$sqlSelect = $query->generateQuery();
 		$result = "";
 		$error = $this->mySQL->executeQuery($result, $con, $sqlSelect);
 		if($error->isError())
 		{
 			return $error;
 		}
 		else
 		{
 			while($stateList = mysql_fetch_row($result))
 			{
				$states[] = $stateList;
 			}
 		}
 		return $error;
 	}
 	/*
 	 * populates speciality list for combo
 	 * box values in form from Speciality table
 	 * parameter passed : connection object,
 	 * array object to store the values from table
 	 * returns error object
 	 */
 	function getSpecialityList(&$con, &$specialities)
 	{
 		//$error->module="(DAC)getStateList";
 		$error = new Error();
 		$query = new QueryBuilder("speciality");
 		$query->setFieldList( " Speciality_Code, Speciality_Name ");
 		$sqlSelect = $query->generateQuery();
 		$result = "";
 		$error = $this->mySQL->executeQuery($result, $con, $sqlSelect);
 		if($error->isError())
 		{
 			return $error;
 		}
 		else
 		{
 			while($specialityList = mysql_fetch_row($result))
 			{
 				$specialities[] = $specialityList;
 			}
 		}
 		return $error;
 	}
 	/*
 	 * populates payment mode list for combo box
 	 * values in form from PaymentModes table
 	 * parameter passed : connection object, array object
 	 * to store the values from table
 	 * returns error object
 	 */
 	function getPaymentModeList(&$con, &$paymentmodes)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("paymentmodes");
 		$query->setFieldList( " PaymentModeId, PaymentModeName ");
 		$sqlSelect = $query->generateQuery();
 		$result = "";
 		$error = $this->mySQL->executeQuery($result, $con, $sqlSelect);
 		if($error->isError())
 		{
 			return $error;
 		}
 		else
 		{
 			while($paymentmodesList = mysql_fetch_row($result))
 			{
				$paymentmodes[] = $paymentmodesList;
 			}
 		}
 		return $error;
 	}
 	/*
 	 * gets the list of cme courses
 	 * based on search criteria in search form
 	 * parameters passed : connection object, model object of course, result set
 	 * returns error object
 	 */
 	function getDBCMECourseSearchResultsForDoctor(&$con, &$course, &$result)
 	{
 		$error = new Error();
 		//$error->module="(DAC)getDBCMECourseSearchResultsForDoctor";
 		$query = new QueryBuilder("cmecourses");
 		$whereClause = "";
 		if($course->courseDate->courseStartDate != "" && $course->courseDate->courseEndDate != "")
 		{
 		$temp1 = explode("/", $course->courseDate->courseStartDate);
 		$startDate = mktime(0,0,0, $temp1[0],$temp1[1],$temp1[2]);
	 	$temp2 = explode("/", $course->courseDate->courseEndDate);
	 	$endDate = mktime(0,0,0, $temp2[0],$temp2[1],$temp2[2]);
 		}
	 	if($course->courseDate->courseStartDate!="")
		{
			$whereClause = $whereClause . " AND CourseStartDate >='". date("Y-m-d", $startDate). "'";
	 	}
	 	if($course->courseDate->courseStartDate!= "")
		{
			$whereClause = $whereClause . " AND  LastDate_App >= '". date("Y-m-d", $startDate) ."'";
	 	}
	 	if($course->courseDate->courseEndDate!="")
		{
			$whereClause = $whereClause . " AND CourseEndDate <='". date("Y-m-d", $endDate) ."'";
	 	}
 		if($course->address->city!="")
	 	{
	 		$whereClause = $whereClause . " AND Venue_City LIKE '%". $course->address->city ."%'";
	 	}
	 	if($course->address->state!="")
	 	{
	 		$whereClause = $whereClause . " AND Venue_State LIKE '%". $course->address->state ."%'";

	 	}
	 	if($course->speciality!="")
	 	{
	 		$whereClause = $whereClause . " AND Speciality LIKE '%". $course->speciality ."%'";
	 	}
	 	if($course->keyword!="")
	 	{
	 		$whereClause = $whereClause . " AND (Speciality LIKE '% ". $course->keyword . "%'" .
								"OR CourseTitle LIKE '%". $course->keyword . "%'".
								"OR CourseDesc LIKE '%". $course->keyword ."%')";
	 	}
	 	$condition =" CourseStartDate >= curdate() AND LastDate_App >= curdate() AND Status = 'APPROVED' " . $whereClause;
		$query->setCondition($condition);
		$sqlSelect = $query->generateQuery();
		$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
		if($error->isError())
 		{
 			return $error;
 		}
 		return $error;

 	}
 	/*
 	 * gets the count of cme courses
 	 * based on search criteria in search form
 	 * parameters passed : connection object, model object of course, result set
 	 * returns error object
 	 */
 	function getCMECourseSearchCountForDoctor(&$con, &$course, &$count)
 	{
 		$error = new Error();
 		//$error->module="(DAC)getDBCMECourseSearchCountForDoctor";
 		$query = new QueryBuilder("cmecourses");
 		$whereClause = "";
 		if($course->courseDate->courseStartDate != "" && $course->courseDate->courseEndDate != "")
 		{
 		$temp1 = explode("/", $course->courseDate->courseStartDate);
 		$startDate = mktime(0,0,0, $temp1[0],$temp1[1],$temp1[2]);
	 	$temp2 = explode("/", $course->courseDate->courseEndDate);
	 	$endDate = mktime(0,0,0, $temp2[0],$temp2[1],$temp2[2]);
 		}
		if($course->courseDate->courseStartDate!="")
		{
			$whereClause = $whereClause . " AND CourseStartDate >='". date("Y-m-d", $startDate). "'";
	 	}
	 	if($course->courseDate->courseStartDate!= "")
		{
			$whereClause = $whereClause . " AND  LastDate_App >= '". date("Y-m-d", $startDate) ."'";
	 	}
	 	if($course->courseDate->courseEndDate!="")
		{
			$whereClause = $whereClause . " AND CourseEndDate <='". date("Y-m-d", $endDate) ."'";
	 	}
 		if($course->address->city!="")
	 	{
	 		$whereClause = $whereClause . " AND Venue_City LIKE '%". $course->address->city ."%'";
	 	}
	 	if($course->address->state!="")
	 	{
	 		$whereClause = $whereClause . " AND Venue_State LIKE '%". $course->address->state ."%'";

	 	}
	 	if($course->speciality!="")
	 	{
	 		$whereClause = $whereClause . " AND Speciality LIKE '%". $course->speciality ."%'";
	 	}
	 	if($course->keyword!="")
	 	{
	 		$whereClause = $whereClause . " AND (Speciality LIKE '% ". $course->keyword . "%'" .
								"OR CourseTitle LIKE '%". $course->keyword . "%'".
								"OR CourseDesc LIKE '%". $course->keyword ."%')";
	 	}
	 	$condition =" CourseStartDate >= curdate() AND LastDate_App >= curdate() AND Status = 'APPROVED' " . $whereClause;
		$query->setCondition($condition);
		$sqlSelect = $query->generateQueryCount();
		$error = $this->mySQL->executeScalar($con, $sqlSelect, $count);
		if($error->isError())
 		{
 			return $error;
 		}
 		return $error;

 	}
 	/*
 	 * gets the list of cme courses with limits
 	 * based on search criteria in search form
 	 * parameters passed : connection object, model object of course,
 	 * result set, from value, pagecount for pagination
 	 * returns error object
 	 */
 	function getDBCMECourseSearchResultsForDoctorWithLimits(&$con, &$course, &$result, $from, $pagecount)
 	{
 		$error = new Error();
 		//$error->module="(DAC)getDBCMECourseSearchCountForDoctor";
 		$query = new QueryBuilder("cmecourses");
 		$whereClause = "";
 		if($course->courseDate->courseStartDate != "" && $course->courseDate->courseEndDate != "")
 		{
 		$temp1 = explode("/", $course->courseDate->courseStartDate);
 		$startDate = mktime(0,0,0, $temp1[0],$temp1[1],$temp1[2]);
	 	$temp2 = explode("/", $course->courseDate->courseEndDate);
	 	$endDate = mktime(0,0,0, $temp2[0],$temp2[1],$temp2[2]);
 		}
		if($course->courseDate->courseStartDate!="")
		{
			$whereClause = $whereClause . " AND CourseStartDate >='". date("Y-m-d", $startDate). "'";
	 	}
	 	if($course->courseDate->courseStartDate!= "")
		{
			$whereClause = $whereClause . " AND  LastDate_App >= '". date("Y-m-d", $startDate) ."'";
	 	}
	 	if($course->courseDate->courseEndDate!="")
		{
			$whereClause = $whereClause . " AND CourseEndDate <='". date("Y-m-d", $endDate) ."'";
	 	}
 		if($course->address->city!="")
	 	{
	 		$whereClause = $whereClause . " AND Venue_City LIKE '%". $course->address->city ."%'";
	 	}
	 	if($course->address->state!="")
	 	{
	 		$whereClause = $whereClause . " AND Venue_State LIKE '%". $course->address->state ."%'";

	 	}
	 	if($course->speciality!="")
	 	{
	 		$whereClause = $whereClause . " AND Speciality LIKE '%". $course->speciality ."%'";
	 	}
	 	if($course->keyword!="")
	 	{
	 		$whereClause = $whereClause . " AND (Speciality LIKE '% ". $course->keyword . "%'" .
								"OR CourseTitle LIKE '%". $course->keyword . "%'".
								"OR CourseDesc LIKE '%". $course->keyword ."%')";
	 	}
	 	$condition =" CourseStartDate >= curdate() AND LastDate_App >= curdate() AND Status = 'APPROVED' " . $whereClause;
		$query->setCondition($condition);
		$sqlSelect = $query->generateQueryWithLimit($from, $pagecount);
		$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
		if($error->isError())
 		{
 			return $error;
 		}
 		return $error;
	}
 	/*
 	 * gets the list of cme courses whose
 	 * course end date is less than current date for doctor
 	 * parameters passed : connection object, result set
 	 * returns error object
 	 */
 	function getArchivedCoursesForDoctor(&$con, &$result, &$doctorId)
 	{
 		$error = new Error();
 		//$error->module="(DAC)getArchivedCoursesForDoctor";
 		
 		$sqlSelect = "SELECT A.CourseId, B.CourseTitle, B.CourseDesc,B.Venue_City," .
 				"B.Venue_State, B.CourseStartDate, B.CourseEndDate, B.CourseFee, B.CMECredits ".
					 "FROM appliedcourses A, cmecourses B, doctor C WHERE ".
					 " A.CourseId = B.CourseId AND A.BookStatus = 'BOOKED' " .
					 " AND B.CourseEndDate < curDate() AND A.DoctorId = '" . $doctorId . "'";
		
		$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
		if($error->isError())
 		{
 			return $error;
 		}
 		return $error;
 	}
 	/*
 	 * gets the count of cme courses whose
 	 * course end date is less than current date for doctor
 	 * parameters passed : connection object, result set
 	 * returns error object
 	 */
 	function getDBArchivedCoursesCountForDoctor(&$con, &$count, &$doctorId)
 	{
 		$error = new Error();
 		//$error->module="(DAC)getDBArchivedCoursesCountForDoctor";
 		$sqlSelect = "SELECT COUNT(*) ".
					 "FROM appliedcourses A, cmecourses B WHERE ".
					 " A.CourseId = B.CourseId AND A.BookStatus = 'BOOKED' " .
					 " AND B.CourseEndDate < curDate() AND A.DoctorId = '" . $doctorId . "'";
		
 		
 		
 		$error = $this->mySQL->executeScalar($con, $sqlSelect, $count);
		if($error->isError())
 		{
 			return $error;
 		}
 		return $error;
 	}
  	/*
 	 * gets the list of cme courses with limits whose
 	 * course end date is less than current date for doctor
 	 * parameters passed : connection object, result set
 	 * from value, pagecount for pagination
 	 * returns error object
 	 */
 	function getDBArchivedCoursesForDoctorWithLimits(&$con, &$result, $from, $pagecount, &$doctorId)
 	{
 		$error = new Error();
 		$error = new Error();
		$query = new QueryBuilder("paymentmodespaymentmodesappliedcourses A, cmecourses C");
		$condition = "A.CourseId = C.CourseId AND A.BookStatus = 'BOOKED' AND C.CourseEndDate < curDate() AND A.DoctorId = " . $doctorId;
		$query->setCondition($condition);
		$sqlSelect1 = $query->generateQueryWithLimit($from, $pagecount);
		
 		/*$sqlSelect = "SELECT A.CourseId, B.CourseTitle, B.CourseDesc,B.Venue_City," .
 				"B.Venue_State, B.CourseStartDate, B.CourseEndDate, B.CourseFee, B.CMECredits ".
					 "FROM appliedcourses A, cmecourses B, Doctor C WHERE ".
					 " A.CourseId = B.CourseId AND A.BookStatus = 'BOOKED' AND C.DoctorId = " . $doctorId .
					 "  AND B.CourseEndDate < curDate() AND A.DoctorId = " . $doctorId ."".
					 " LIMIT " . $from . ", " . $pagecount;*/
					 
		
 		$error = $this->mySQL->executeQuery($result , $con, $sqlSelect1);
		if($error->isError())
 		{
 			return $error;
 		}
 		return $error;
 	}
 	/*
 	 * gets the list of courses added by the registered
 	 * cme provider
 	 * parameters passed : connection object, id of cme provider, result set
 	 * returns error object
 	 */
 	function getDBCMECoursesForCMEProvider(&$con, $CMEID, &$result)
 	{
 		$error = new Error();
 		//$error->module="(DAC)getDBCMECoursesForCMEProvider";
 		$query = new QueryBuilder("cmecourses");
 		$condition =  "CMEId = '". $CMEID ."' AND Status = 'NEW'";
 		$query->setCondition($condition);
 		$sqlSelect = $query->generateQuery();
 		$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
		if($error->isError())
 		{
 			return $error;
 		}
 		return $error;
 	}
 	/*
 	 * gets the count of courses added by the registered
 	 * cme provider
 	 * parameters passed : connection object, id of cme provider, result set
 	 * returns error object
 	 */
 	function getDBCMECoursesCountForCMEProvider(&$con, $CMEID, &$count)
 	{
 		$error = new Error();
 		//$error->module="(DAC)getDBCMECoursesCountForCMEProvider";
 		$query = new QueryBuilder("cmecourses");
 		$condition = "CMEId = '". $CMEID ."' AND Status = 'NEW'";
 		$query->setCondition($condition);
 		$sqlSelect = $query->generateQueryCount();
 		$error = $this->mySQL->executeScalar($con, $sqlSelect, $count);
		if($error->isError())
 		{
 			return $error;
 		}
 		return $error;
 	}
 	/*
 	 * gets the list of courses added by the registered
 	 * cme provider with limits
 	 * parameters passed : connection object, id of cme provider, result set,
 	 * from value, pagecount for pagination
 	 * returns error object
 	 */
 	function getDBCMECoursesForCMEProviderWithLimits(&$con,$CMEID,&$result,$from,$pagecount)
 	{
 		$error = new Error();
 		//$error->module="(DAC)getDBCMECoursesForCMEProviderWithLimits";
 		$query = new QueryBuilder("cmecourses");
 		$condition =  "CMEId = '". $CMEID ."' AND Status = 'NEW'";
 		$query->setCondition($condition);
 		$sqlSelect = $query->generateQueryWithLimit($from, $pagecount);
 		$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
		if($error->isError())
 		{
 			return $error;
 		}
 		return $error;
 	}
  	/*
  	 * gets the course details record in cmecourses table for editing
  	 * parameters passed : connection object, course id, result set
  	 * returns error object
  	 */
 	function getDBEditCourseDetails(&$con, &$id, &$result)
 	{
 		$error = new Error();
 		//$error->module="(DAC)getDBEditCourseDetails";
 		$query = new QueryBuilder("cmecourses");
 		$condition = " CourseId = '" . $id . "' AND Status = 'NEW'";
 		$query->setCondition($condition);
 		$sqlSelect = $query->generateQuery();
 		$error  = $this->mySQL->executeQuery($result , $con, $sqlSelect);
 		if($error->isError())
 		{
 			$error->setError(0, "invalid course id", $error->EL->getDALError());
 			return $error;
 		}
 		return $error;
 	}
	/*
  	 * gets the course details record in cmecourses table for viewing
  	 * parameters passed : connection object, course id, result set
  	 * returns error object
  	 */
 	function getDBCourseDetailsToView(&$con, &$id, &$result)
 	{
 		$error = new Error();
 		//$error->module="(DAC)getDBEditCourseDetails";
 		$query = new QueryBuilder("cmecourses");
 		$condition = " CourseId = '" . $id . "'";
 		$query->setCondition($condition);
 		$sqlSelect = $query->generateQuery();
 		$error  = $this->mySQL->executeQuery($result , $con, $sqlSelect);
 		if($error->isError())
 		{
 			//$error->setError(0, "invalid course id", $error->EL->getDALError());
 			return $error;
 		}
 		return $error;
 	}
	/*
  	 * gets the course details record in cmecourses table for booking
  	 * parameters passed : connection object, course id, result set
  	 * returns error object
  	 */
 	function getDBCourseDetails(&$con, &$id, &$result)
 	{
 		$error = new Error();
 		//$error->module="(DAC)getDBEditCourseDetails";
 		$query = new QueryBuilder("cmecourses");
 		$condition = " CourseId = '" . $id . "' AND Status = 'APPROVED'";
 		$query->setCondition($condition);
 		$sqlSelect = $query->generateQuery();
 		$error  = $this->mySQL->executeQuery($result , $con, $sqlSelect);
 		if($error->isError())
 		{
 			$error->setError(0, "invalid course id", $error->EL->getDALError());
 			return $error;
 		}
 		return $error;
 	}
 	/*
 	 * updates cme courses table with changes made in the form
 	 * parameters passed : connection object, model object of course
 	 * returns error object
 	 */
 	function updateCMECourseDetails(&$con, &$course)
 	{
 		$error = new Error();
 		//$error->module="(DAC)updateCMECourseDetails";
 		//change date format from mm/dd/yyyy to yyyy-mm-dd
 		//change date format from mm/dd/yyyy to yyyy-mm-dd

 		$temp1 = explode("/", $course->courseDate->courseStartDate);
	 	$startDate = mktime(0,0,0, $temp1[0],$temp1[1],$temp1[2]);
	 	$temp2 = explode("/", $course->courseDate->courseEndDate);
	 	$endDate = mktime(0,0,0, $temp2[0],$temp2[1],$temp2[2]);
	 	$temp3 = explode("/", $course->courseDate->lastDateForApp);
	 	$lastDate = mktime(0,0,0, $temp3[0],$temp3[1],$temp3[2]);


 		$sqlUpdate = "UPDATE cmecourses SET ".
	 		"CourseId = '" . $course->courseId . "'" .
	 		", CourseTitle = '" . $course->courseTitle . "'".
	 		", CourseDesc = '" . $course->courseDesc . "'".
	 		", Speciality = '" . $course->specialityField . "'".
	 		", Venue_Address1 = '" . $course->address->address1 . "'".
	 		", Venue_Address2 = '" . $course->address->address2 . "'".
	 		", Venue_City = '" . $course->address->city . "'".
	 		", Venue_State = '" . $course->address->state . "'".
	 		", Venue_Zip = '" . $course->address->zip . "'".
	 		", Venue_Country = '" . $course->address->country . "'".
	 		", ContactPerson = '" . $course->contactPerson . "'".
	 		", ContactPhone = '" . $course->contactPhone . "'".
	 		", ContactFax = '" . $course->phone->fax . "'".
	 		", ContactEmail = '" . $course->email . "'".
	 		", CourseStartDate = '" . date("Y-m-d", $startDate). "'".
	 		", CourseEndDate = '" . date("Y-m-d", $endDate). "'".
	 		", LastDate_App = '" . date("Y-m-d", $lastDate).  "'".
	 		", NearestHotel = '" . $course->nearestHotel . "'".
	 		", NearestAirport = '" . $course->nearestAirport . "'".
	 		", CourseFee = " . $course->courseFee . "".
	 		", CMECredits = '" . $course->cmeCredits . "'".
	 		" WHERE CourseId = " . $course->courseId . "";

	 	//execute update query
	 	$rows_affected = 0;
	 	$error = $this->mySQL->executeUpdate($con, $sqlUpdate, $rows_affected);
	 	if($error->isError())
	 	{
	 		$error->setDisplayMessage("Unable to update the record");
	 		return $error;
	 	}
	 	return $error;
 	}
 		/*
 		 * inserts details of booking a course by doctor
 		 * in appliedcourses table
 		 * parameters passed : connection object
 		 * returns error object
 		 */
 		function bookCourse(&$con, &$appliedCourse, &$Id)
 		{
 			$error = new Error();
 			//$error->module="(DAC)bookCourse";
 			$result1 = "";
 			$sqlSelect1 = "SELECT * FROM cmecourses WHERE CourseId = '" .$appliedCourse->courseId ."'";
 			$error = $this->mySQL->executeQuery($result1 , $con, $sqlSelect1);
 			if($result1 == null)
 			{
 				$error->setError(0,"invalid course id", $error->EL->getDALError());
	 			return $error;
 			}
 			$result = "";
 			$sqlSelect = "SELECT * FROM appliedcourses WHERE ".
 			             " DoctorId = '". $_SESSION["UserId"] ."' AND CourseId = '" . $appliedCourse->courseId ."' AND BookStatus = 'BOOKED'";
 			$error  = $this->mySQL->executeQuery($result , $con, $sqlSelect);
	 		if($error->isError())
	 		{
	 			$error->setError(0,"invalid course id", $error->EL->getDALError());
	 			return $error;
	 		}
	 		else
	 		{
		 		$rows = mysql_num_rows($result);
		 		if($rows > 0)
		 		{
		 			$error->setError(0, "Doctor has attended this course already.", $error->EL->getDALError());
		 			return $error;
		 		}
		 		else
		 		{
		 			$sqlInsert = "INSERT INTO `appliedcourses`(".
					"`DoctorId`, `CourseId`, `BookingDate`, ".
					"`PaymentMode`, `Amount`, `AgentId`, `BookStatus`) VALUES(".
					"'".$appliedCourse->doctorId .
					"', '".$appliedCourse->courseId .
					"', NOW(), ".
					"'"."Credit Card" .
					"', '".$appliedCourse->amount .
					"', '".$appliedCourse->agentId .
					"', '".$appliedCourse->bookStatus .
					"')";


				 	$error = $this->mySQL->executeInsertId($con, $sqlInsert, $Id);
				 	if($error->isError())
					{
						$error->setError(0, "Unable to insert the record", $error->EL->getDALError());
						return $error;
					}
		 		}
	 		}
			return $error;
 		}
 		/*
 		 * inserts transaction details in transaction table
 		 * when payment of course fee is paid completely
 		 * parameters passed : connection object, model object of appliedCourses
 		 * returns error object
 		 */
 		function addTransactionDetails(&$con, &$transaction)
 		{
 			$error = new Error();
 			//$error->module="(DAC)addTransactionDetails";
 			$sqlInsert = "INSERT INTO `TransactionTable`(".
			"`TransactionId`,`BookingId`,`DoctorId`, `CourseId`, `TransactionDate`, ".
			"`PaymentMode`, `Amount`,`TransactionStatus`) VALUES(".
			"".$transaction->transactionId .
           		", ".$transaction->bookingId .
			", ".$transaction->doctorId .
			", ".$transaction->courseId .
			", NOW()".
			",'".$transaction->paymentMode .
                        "', '".$transaction->amount .
			"','".$transaction->status.
			"'" .
			")";

			//execute insert query
	 	$value = "";
	 	$error = $this->mySQL->executeInsert($con, $sqlInsert);
	 	if($error->isError())
		{
			return $error;
		}
		return $error;
 		}

 		/*
 		* gets the cme courses list applied by the doctor
	 	* parameters passed : connection object, doctor id, result set
	 	* returns error object
 		*/
 		function getDBAppliedCourseSummaryForDoctor(&$con, $doctorId, &$result)
 		{
 			//$error->module = "(DAL)getDBAppliedCourseSummaryForDoctor";
 			$error = new Error();
 			$sqlSelect = "SELECT cmecourses.CourseId, cmecourses.CourseTitle, cmecourses.CourseDesc,".
 			"cmecourses.Venue_City, cmecourses.Venue_State, cmecourses.ContactEmail, cmecourses.CourseStartDate,".
 			"cmecourses.CourseEndDate, appliedcourses.BookingDate, cmecourses.CourseFee,cmecourses.CMECredits ".
 			" FROM cmecourses, appliedcourses WHERE" .
 			" cmecourses.CourseId = appliedcourses.CourseId AND " .
 			"appliedcourses.DoctorId = " . $doctorId . " AND appliedcourses.BookStatus = 'BOOKED'";

 			$error = $this->mySQL->executeQuery($result, $con, $sqlSelect);
 			if($error->isError())
 			{
 				$error->setDisplayMessage(" Unable to retrieve the records ");
 				return $error;
 			}
 			return $error;
 		}

 		/*
 		* gets the count of cme courses applied by the doctor
	 	* parameters passed : connection object , doctorid, result set
	  	* returns error object
 		*/
 		function getDBAppliedCourseCountForDoctor(&$con, $doctorId, &$count)
 		{
 			//$error->module = "(DAL)getDBAppliedCourseSummaryForDoctor";
 			$error = new Error();
 			$query = new QueryBuilder("cmecourses");
 			$sqlSelect = "SELECT count(*) FROM cmecourses, appliedcourses ".
 			" WHERE cmecourses.CourseId = appliedcourses.CourseId AND cmecourses.CourseStartDate >= curdate() " .
 			" AND appliedcourses.DoctorId = '" . $doctorId . "' AND appliedcourses.BookStatus = 'BOOKED'";

 			$error = $this->mySQL->executeScalar($con, $sqlSelect, $count);
			if($error->isError())
	 		{
	 			$error->setDisplayMessage(" Unable to retrieve the count ");
	 			return $error;
	 		}
 			return $error;
 		}

 		/*
 		* gets the cme courses applied by the doctor with limits
	 	* parameters passed :connection object, doctorid, result set,
	 	* from, pagecount
	 	* returns error object
 		*/
 		function getDBAppliedCourseSummaryForDoctorWithLimits(&$con, $doctorId, &$result, &$from, $pagecount)
 		{
 			//$error->module = "(DAL)getDBAppliedCourseSummaryForDoctor";
 			$error = new Error();
 			$query = new QueryBuilder("cmecourses, appliedcourses");
			$condition = " cmecourses.CourseId = appliedcourses.CourseId AND  appliedcourses.BookStatus = 'BOOKED' AND appliedcourses.DoctorId = " . $doctorId . " AND cmecourses.CourseStartDate >= curdate() ";
			$query->setCondition($condition);
 			$sqlSelect = $query->generateQueryWithLimit($from, $pagecount);

 			$error = $this->mySQL->executeQuery($result, $con, $sqlSelect);
 			if($error->isError())
 			{
 				$error->setDisplayMessage(" Unable to retrieve the records ");
 				return $error;
 			}
 			return $error;
 		}

 		/*
 		* gets the cme courses registered by the doctor
 		* that are added by the cme provider
	 	* parameters passed : connection object, cme id, result set
	 	* returns error object
 		*/
 		function getDBRegisteredCourseSummaryForCMEProvider(&$con, $cmeId, &$result)
 		{
 			$query = new QueryBuilder("cmecourses C, appliedcourses A, doctor D");
 			$condition = " C.CMEId = $cmeId AND A.CourseId = C.CourseId AND A.BookStatus = 'BOOKED' AND A.DoctorId = D.DoctorId ";
 			$query->setCondition($condition);
 			$sqlSelect = $query->generateQuery();

			$error = $this->mySQL->executeQuery($result, $con, $sqlSelect);
 			if($error->isError())
 			{
 				$error->setDisplayMessage(" Unable to retrieve the records ");
 				return $error;
 			}
 			return $error;
 		}

 		/*
 		* gets the count of cme courses registered by the doctor
 		* that are added by the cme provider
	 	* parameters passed : connection object , cmeid, result set
	 	* returns error object
 		*/
 		function getDBRegisteredCourseCountForCMEProvider(&$con, $cmeId, &$count)
 		{
 			
 			$query = new QueryBuilder("cmecourses C, appliedcourses A, doctor D");
 			$condition = " C.CMEId = $cmeId AND A.CourseId = C.CourseId AND A.BookStatus = 'BOOKED' AND A.DoctorId = D.DoctorId ";
 			$query->setCondition($condition);
 			$sqlSelect = $query->generateQueryCount();

			$error = $this->mySQL->executeScalar($con, $sqlSelect, $count);
			if($error->isError())
	 		{
	 			$error->setDisplayMessage(" Unable to retrieve the count ");
	 			return $error;
	 		}
 			return $error;
 		}

 		/*
 		* gets the cme courses applied by the doctor with limits
	 	* parameters passed : connection object, cmeid, result set, from,
	 	* pagecount
	 	* returns error object
 		*/
 		function getDBRegisteredCourseSummaryForCMEProviderWithLimits(&$con, $cmeId, &$result, &$from, $pagecount)
 		{
 			
 			$query = new QueryBuilder("cmecourses C, appliedcourses A, doctor D");
 			$condition = " C.CMEId = $cmeId AND A.CourseId = C.CourseId AND A.BookStatus = 'BOOKED' AND A.DoctorId = D.DoctorId ";
 			$query->setCondition($condition);
 			$sqlSelect = $query->generateQueryWithLimit($from, $pagecount);

 			$error = $this->mySQL->executeQuery($result, $con, $sqlSelect);
 			if($error->isError())
 			{
 				$error->setDisplayMessage(" Unable to retrieve the records ");
 				return $error;
 			}
 			return $error;
 		}
 		/*
 		 * updates the book status of applied course
 		 * parameters passed : con object, booking id, status
 		 * returns error object
 		 */
 		 function updateDBBookingDetails(&$con, &$bid, $status)
 		 {
 		 	$error = new Error();
 		 	$sqlUpdate = "UPDATE appliedcourses SET BookStatus = '" . $status . "'".
 		 				  " WHERE BookingId = '" . $bid . "'";
 		 	//execute update query
		 	$rows_affected = 0;
		 	$error = $this->mySQL->executeUpdate($con, $sqlUpdate, $rows_affected);
		 	if($error->isError())
		 	{
		 		$error->setDisplayMessage("Unable to update the record");
		 		return $error;
		 	}
		 	return $error;
 		 }
 		 /*
	   * retrieves the status of the doctor
	   * parameters passed : access var
	   * returns error object
	  */
	  function getDBAccessOfDoctor(&$con, &$doctorId, &$access)
	  {
	  		$error = new Error();
		   	$dal = new DAL();
		   	$result = "";
		    $query = new QueryBuilder("doctor");
		    $fieldList = " Status ";
		    $condition = " DoctorId = '" . $doctorId . "' ";
		    $query->setFieldList($fieldList);
		   	$query->setCondition($condition);
		   	$sqlSelect = $query->generateQuery();
		   	$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
		   	if($error->isError())
	 		{
	 			return $error;
	 		}
	 		else
	 		{
	 			$row = mysql_fetch_array($result);
	 			$access = $row["Status"];
	 		}
			return $error;
	  }
	/*
 	 * gets username and password of doctor
 	 * params : emailid of doctor
 	 * returns error object
 	 */
 	 function getDBUserNamePasswordDoc(&$con, $emailId, &$result)
 	 {
 	 	$error = new Error();
 		$query = new QueryBuilder("doctor");
 		$fieldList = " UserName, Password ";
 		$query->setFieldList($fieldList);
 		$condition = " EmailId = '".$emailId."'";
 		$query->setCondition($condition);
	 	$sqlSelect = $query->generateQuery();
	 	$error = $this->mySQL->executeQuery($result, $con, $sqlSelect);
	 	if($error->isError())
	 	{
	 		return $error;
	 	}
		return $error;
 	 }
 	 /*
 	 * gets username and password of cmeprovider
 	 * params : emailid of cmeprovider
 	 * returns error object
 	 */
 	 function getDBUserNamePasswordCMEP(&$con, $emailId, &$result)
 	 {
 	 	$error = new Error();
 		$query = new QueryBuilder("paymentmodescmeprovider");
 		$fieldList = " UserName, Password ";
 		$query->setFieldList($fieldList);
 		$condition = " EmailId = '".$emailId."'";
 		$query->setCondition($condition);
	 	$sqlSelect = $query->generateQuery();
	 	$error = $this->mySQL->executeQuery($result, $con, $sqlSelect);
	 	if($error->isError())
	 	{
	 		return $error;
	 	}
		return $error;
 	 }
	/*
	* gets the name of the doctor
	*/
	function getDBDocName(&$con, &$id, &$result)
	{
		$error = new Error();
 		$query = new QueryBuilder("doctor");
 		$fieldList = " FirstName, LastName ";
 		$query->setFieldList($fieldList);
 		$condition = " DoctorId = '".$id."'";
 		$query->setCondition($condition);
	 	$sqlSelect = $query->generateQuery();
	 	$error = $this->mySQL->executeQuery($result, $con, $sqlSelect);
	 	if($error->isError())
	 	{
	 		return $error;
	 	}
		return $error;
	}
     /*
     * gets booking id confirmation
     */
     function confirmDBBookingId(&$con, &$bid, &$result)
     {
     		$error = new Error();
 		$query = new QueryBuilder("paymentmodesappliedcourses");
 		$condition = " BookingId = '".$bid."' AND BookStatus = 'PENDING'";
 		$query->setCondition($condition);
	 	$sqlSelect = $query->generateQuery();
	 	$error = $this->mySQL->executeQuery($result, $con, $sqlSelect);
	 	if($error->isError())
	 	{
	 		return $error;
	 	}
		return $error;
     }
     /*
      * gets email id of doc
      * for sending booking details
      */
      function getDBDocEmailId(&$con,$id, &$result)
      {
      		$error = new Error();
	 		$query = new QueryBuilder("doctor");
	 		$fieldList = " EmailId ";
	 		$query->setFieldList($fieldList);
	 		$condition = " DoctorId = '".$id."'";
	 		$query->setCondition($condition);
		 	$sqlSelect = $query->generateQuery();
		 	$error = $this->mySQL->executeQuery($result, $con, $sqlSelect);
		 	if($error->isError())
		 	{
		 		return $error;
		 	}
			return $error;
      }
      /*
       * get course id from applied courses table
       */
       function getDBBookedCourseId(&$con,$id, &$result)
      {
      		$error = new Error();
	 		$query = new QueryBuilder("paymentmodesappliedcourses");
	 		$fieldList = " CourseId ";
	 		$query->setFieldList($fieldList);
	 		$condition = " BookingId = '".$id."'";
	 		$query->setCondition($condition);
		 	$sqlSelect = $query->generateQuery();
		 	$error = $this->mySQL->executeQuery($result, $con, $sqlSelect);
		 	if($error->isError())
		 	{
		 		return $error;
		 	}
			return $error;
      }
      /*
       * get doctor details
       */
       function getDBDoctorDetails(&$con,$id, &$result)
      {
      		$error = new Error();
	 		$query = new QueryBuilder("doctor");
	 		$condition = " DoctorId = '".$id."'";
	 		$query->setCondition($condition);
	 		$sqlSelect = $query->generateQuery();
		 	$error = $this->mySQL->executeQuery($result, $con, $sqlSelect);
		 	if($error->isError())
		 	{
		 		return $error;
		 	}
			return $error;
      }
       /*
	  * updates doctor details
	  * parameters passed : connection object, Model object of doctor
	  * returns error object
	  */
	 function editDBDoctorDetails(&$con, &$doctor)
	 {
	  	$error = new Error();

	  	$error->module = "(DAL) editDBDoctorDetails";
	  	$sqlUpdate = "UPDATE doctor SET ".
	 		" DoctorId = '" . $Doctor->doctorId . "'" .
	 		", FirstName = '" . $Doctor->name->firstName . "'".
	 		", MiddleName = '" . $Doctor->name->middleName . "'".
	 		", LastName = '" . $Doctor->name->lastName . "'".
	 		", Sex = '" . $Doctor->sex . "'".
	 		", Address1 = '" . $Doctor->address->address1 . "'".
	 		", Address2 = '" . $Doctor->address->address2 . "'".
	 		", City = '" . $Doctor->address->city . "'".
	 		", State = '" . $Doctor->address->state . "'".
	 		", Zip = '" . $Doctor->address->zip . "'".
	 		", WorkPhone = '" . $Doctor->phone->workPhone . "'".
	 		", HomePhone = '" . $Doctor->phone->homePhone . "'".
	 		", Fax = '" . $Doctor->phone->fax . "'".
	 		", MobilePhone = '" . $Doctor->phone->mobilePhone . "'".
	 		", EmailId = '" . $Doctor->email . "'".
	 		", Speciality = '" . $Doctor->speciality . "'".
	 		", ContactTime = '" . $Doctor->contactTime . "'".
	 		", UserName = '" . $Doctor->login->loginName . "'".
	 		" WHERE DoctorId = '" . $Doctor->doctorId . "'";

			//execute update query
		 	$rows_affected = 0;
		 	
		 	$error = $this->mySQL->executeUpdate($con, $sqlUpdate, $rows_affected);
		 	if($error->isError())
		 	{

		 		return $error;
		 	}
		 	return $error;
	  }
	  /*
 	 * this method checks the existence
 	 * of similar password in
 	 * doctor table before updating  doctor password
 	 * parameters passed : doctor id of doctor,old password,  connection object, empty value
 	 * returns error object
 	 */
 	function checkDBDocPasswordExists($doctorId, &$password, &$val, &$con)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("doctor");
 		
 		$condition = " Password = '".$password."' AND DoctorId = " . $doctorId;
 		$query->setCondition($condition);
	 	$sqlSelect = $query->generateQuery();
	 	$error = $this->mySQL->executeScalar($con, $sqlSelect, $val);
	 	if($error->isError())
	 	{
	 		return $error;
	 	}
		return $error;
 	}
       /*
	   * resets doctor password
	   * parameters passed :  model object of doctor, old password, new password
	   * returns error object
	   */
 		function resetDBDoctorPassword(&$con, &$doctor,&$oldPassword, &$newPassword)
 		{
 			$error = new Error();
 			//$error->module = "(DAL)resetDBCMEProviderPassword";
 			
	 			$sqlUpdate = "UPDATE doctor SET ".
	 			"Password = '". $newPassword . "' ".
	 			" WHERE DoctorId = '" . $doctor->doctorId . "'";
	
	 			//execute update query
			 	$rows_affected = 0;
			 	$error = $this->mySQL->executeUpdate($con, $sqlUpdate, $rows_affected);
			 	if($error->isError())
			 	{
			 		$error->setError(0,"Unable to update the record", $error->EL->getDALError());
			 		return $error;
			 	}
 			
	 		return $error;
 		}
 		 /*
       * get doctor details
       */
       function getDBCMEProviderDetails(&$con,$id, &$result)
      {
      		$error = new Error();
	 		$query = new QueryBuilder("paymentmodescmeprovider");
	 		$condition = " CMEId = ".$id;
	 		$query->setCondition($condition);
	 		$sqlSelect = $query->generateQuery();
		 	$error = $this->mySQL->executeQuery($result, $con, $sqlSelect);
		 	if($error->isError())
		 	{
		 		return $error;
		 	}
			return $error;
      }
       /*
	  * updates CMEProvider details
	  * parameters passed : connection object, Model object of CMEProvider
	  * returns error object
	  */
	 function editDBCMEProviderDetails(&$con, &$CMEProvider)
	 {
	  	$error = new Error();
 		//$error->module = "(DAL) editDBCMEProviderDetails";
	  	$sqlUpdate = "UPDATE CMEProvider SET ".
	 		" CMEId = '" . $CMEProvider->CMEId . "'" .
	 		", InstituteName = '" . $CMEProvider->instituteName . "'".
	 		", FirstName = '" . $CMEProvider->name->firstName . "'".
	 		", MiddleName = '" . $CMEProvider->name->middleName . "'".
	 		", LastName = '" . $CMEProvider->name->lastName . "'".
	 		", Address1 = '" . $CMEProvider->address->address1 . "'".
	 		", Address2 = '" . $CMEProvider->address->address2 . "'".
	 		", City = '" . $CMEProvider->address->city . "'".
	 		", State = '" . $CMEProvider->address->state . "'".
	 		", Zip = '" . $CMEProvider->address->zip . "'".
	 		", WorkPhone = '" . $CMEProvider->phone->workPhone . "'".
	 		", HomePhone = '" . $CMEProvider->phone->homePhone . "'".
	 		", Fax = '" . $CMEProvider->phone->fax . "'".
	 		", MobilePhone = '" . $CMEProvider->phone->mobilePhone . "'".
	 		", EmailId = '" . $CMEProvider->email . "'".
	 		", WebSiteUrl = '" . $CMEProvider->websiteUrl . "'".
	 		", UserName = '" . $CMEProvider->login->loginName . "'".
	 		" WHERE CMEId = '" . $CMEProvider->CMEId . "'";

			//execute update query
		 	$rows_affected = 0;
		 	$error = $this->mySQL->executeUpdate($con, $sqlUpdate, $rows_affected);
		 	if($error->isError())
		 	{
		 		$error->setError("Unable to update the record");
		 		return $error;
		 	}
			return $error;
	  }
	  /*
 	 * this method checks the existence
 	 * of similar password in
 	 * cmeprovider table before updating  doctor password
 	 * parameters passed : id of cmeprovider,old password,  connection object, empty value
 	 * returns error object
 	 */
 	function checkDBCMEPasswordExists($cmeId, &$password, &$val, &$con)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("paymentmodescmeprovider");
 		$condition = " Password = '".$password."' AND CMEId = " . $cmeId;
 		$query->setCondition($condition);
	 	$sqlSelect = $query->generateQuery();
	 	$error = $this->mySQL->executeScalar($con, $sqlSelect, $val);
	 	if($error->isError())
	 	{
	 		return $error;
	 	}
		return $error;
 	}
       /*
	   * resets cmeprovider password
	   * parameters passed :  model object of cmeproviderr, old password, new password
	   * returns error object
	   */
 		function resetDBCMEProviderPassword(&$con, &$cmeprovider,&$oldPassword, &$newPassword)
 		{
 			$error = new Error();
 			$sqlUpdate = "UPDATE CMEProvider SET ".
	 					  "Password = '". $newPassword . "' ".
	 					  " WHERE CMEId = '" . $cmeprovider->CMEId . "'";
			//execute update query
		 	$rows_affected = 0;
		 	$error = $this->mySQL->executeUpdate($con, $sqlUpdate, $rows_affected);
		 	if($error->isError())
		 	{
		 		$error->setError(0,"Unable to update the record", $error->EL->getDALError());
		 		return $error;
		 	}
 	 		return $error;
 		}
      /*
       * deletes the record in Applied Courses
       * following failed transaction
       */
       function deleteDBBookingDetails($bid, &$con)
       {
	       $error = new Error();
 			$sqlDelete = "DELETE FROM appliedcourses WHERE BookingId = " . $bid;
			//execute delete query
		 	$result = mysql_query($sqlDelete, $con);
		 	if(!$result)
		 	{
		 		$error->setError(0,"Unable to delete the record", $error->EL->getDALError());
		 		return $error;
		 	}
 	 		return $error;
 	 
       }
}
?>
