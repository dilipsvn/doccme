<?php
/*
 * Created on Mar 27, 2007
 *	author Poornima Kamatgi
 *
 *	this is data access layer class
 *	this class interacts with database
 *	using mysql queries and returns required
 *	resultset to the business access layer class
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
 	 * defines error object
 	 * parameters passed : none
 	 * returns none
 	 */
 	function DAL()
 	{
 		$this->mySQL = new MYSQLHelper();
 	}
 	/*
 	 * checks access rights of agent
 	 */
 	function checkDBAgentAccess(&$con, $agentId, $moduleId, &$result)
 	{
 		$error = new Error();
 		//$error->module = "(DAL) checkDBAgentAccess";
 		$query = new QueryBuilder("AccessList");
 		$fieldList = " AccessType ";
 		$query->setFieldList($fieldList);
 		$condition = " UserId = '" . $agentId . "' AND ModuleId = '" . $moduleId . "'";
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
 	 * this method checks the existence
 	 * of similar email id in
 	 * doctor table befor inserting new doctor details
 	 * parameters passed : email id of doctor, connection object,  empty value
 	 * returns error object
 	 */
 	function checkDBDocDupEntriesForUserName(&$loginName, &$val, &$con)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("Doctor");
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
 		$query = new QueryBuilder("Doctor");
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
 	 * cme provider table before inserting new
 	 * cme provider details
 	 * parameters passed : email id of cme provider, connection object, empty value
 	 * returns error object
 	 */
 	function checkDBCMEPDupEntriesForUserName(&$loginName, &$val, &$con)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("CMEProvider");
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
 	 * cme provider table before inserting new cme provider details
 	 * parameters passed : email id of cme provider, empty value, connection object
 	 * returns error object
 	 */
 	function checkDBCMEPDupEntriesForEmailId(&$email, &$val, &$con)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("CMEProvider");
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
 	 * users table before inserting new
 	 * agent details
 	 * parameters passed : email id of agent, connection object, empty value
 	 * returns error object
 	 */
 	function checkDBAgentDupEntriesForUserName(&$loginName, &$val, &$con)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("Users");
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
 	 * users table befor inserting new agent details
 	 * parameters passed : email id of agent, empty value, connection object
 	 * returns error object
 	 */
 	function checkDBAgentDupEntriesForEmailId(&$email, &$val, &$con)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("Users");
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
 	 * inserts the doctor details from form fields
 	 * into the doctor table
 	 * parameters passed : connection object, Model object of Doctor
 	 * returns error object
  	 */
 	function insertDoctor(&$con, &$Docter)
 	{
 		$error = new Error();
 		//$error->module="(DAC) InsertDoctor";
 		//create insert query
 		$sqlInsert = "INSERT INTO `Doctor`(".
 			"`RegDate`, `FirstName`,`MiddleName`,`LastName`,`Sex`,`Address1`,`Address2`,".
 			"`City`,`State`,`Zip`,`Country`,`WorkPhone`,".
			"`HomePhone`,`Fax`,`MobilePhone`,`EmailId`,".
  			"`Speciality`,`ContactTime`,`UserName`,`Password`,".
  			"`Status`,`Remarks`".
  			") VALUES(NOW(), ".
  			"'".$Docter->name->firstName.
			"', '".$Docter->name->middleName.
			"', '".$Docter->name->lastName.
			"', '".$Docter->sex.
			"', '".$Docter->address->address1.
			"', '".$Docter->address->address2.
			"', '".$Docter->address->city.
			"', '".$Docter->address->state.
			"', '".$Docter->address->zip.
			"', '"."USA".
			"', '".$Docter->phone->workPhone.
			"', '".$Docter->phone->homePhone.
			"', '".$Docter->phone->fax.
			"', '".$Docter->phone->mobilePhone.
			"', '".$Docter->email.
			"', '".$Docter->speciality.
			"', '".$Docter->contactTime.
			"', '".$Docter->login->loginName.
			"', '".$Docter->login->password.
			"', '"."NEW".
			"', '".$Docter->remarks.
			"')";

	 		//execute insert query
	 	$value = "";
	 	$error = $this->mySQL->executeScalar($con, $sqlInsert, $value);
	 	if($error->isError())
		{
			return $error;
		}
		return $error;
	}

 	/*
 	 * inserts the cme provider details from form fields
 	 * into the cmeprovider table
 	 * parameters passed : connection object, Model object of Cme Provider
 	 * returns error object
  	 */
 	function insertCMEProvider(&$con, &$CMEProvider)
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
 		"'".$CMEProvider->instituteName.
 		"', '".$CMEProvider->name->firstName.
 		"', '".$CMEProvider->name->middleName.
 		"', '".$CMEProvider->name->lastName.
 		"', '".$CMEProvider->address->address1.
 		"', '".$CMEProvider->address->address2.
 		"', '".$CMEProvider->address->city.
 		"', '".$CMEProvider->address->state.
 		"', '".$CMEProvider->address->zip.
 		"', '"."USA".
 		"', '".$CMEProvider->phone->workPhone.
		"', '".$CMEProvider->phone->homePhone.
		"', '".$CMEProvider->phone->fax.
		"', '".$CMEProvider->phone->mobilePhone.
 		"', '".$CMEProvider->email.
 		"', '".$CMEProvider->websiteUrl.
 		"', '".$CMEProvider->login->loginName.
 		"', '".$CMEProvider->login->password.
 		"', '"."NEW".
		"', '".$CMEProvider->remarks.
 		"')";

		//execute insert query
	 	$value = "";
	 	$error = $this->mySQL->executeScalar($con, $sqlInsert, $value);
	 	if($error->isError())
		{
			return $error;
		}
		return $error;
 	}

 	/*
 	 * inserts the agent details from form fields
 	 * into the agent table
 	 * parameters passed : connection object, Model object of agent
 	 * returns error object
  	 */
 	function insertAgent(&$con, &$Agent)
 	{
 		$error = new Error();

 		$error->module="(DAC) InsertAgent";
 		//create insert query
 		$sqlInsert = "INSERT INTO `Users`(".
 			"`RegDate`, `FirstName`,`MiddleName`,`LastName`,".
 			"`ContactPhone`,`EmailId`,".
  			" `UserName`,`Password`,".
  			"`Status`,`Remarks`".
  			") VALUES(NOW(), ".
  			"'".$Agent->name->firstName.
			"', '".$Agent->name->middleName.
			"', '".$Agent->name->lastName.
			"', '".$Agent->contactPhone.
			"', '".$Agent->email.
			"', '".$Agent->login->loginName.
			"', '".$Agent->login->password.
			"', '"."NEW".
			"', '"."".
			"')";

	 	//execute insert query
	 	$value = "";
	 	$error = $this->mySQL->executeScalar($con, $sqlInsert, $value);
	 	if($error->isError())
		{
			return $error;
		}
		return $error;
 	}

 	/*
 	 * adds new cme course for cme provider by admin
 	 * parameters passed : connection object, model object of cme course
 	 * returns error object
 	 */
 	function addDBCMECourseForCMEProvider(&$con, &$course)
 	{
	 		$error = new Error();
	 		//$error->module="(DAL)addDBCMECourseForCMEProvider";
	 		//create insert query
	 		$temp1 = explode("/", $course->courseDate->courseStartDate);
		 	$startDate = mktime(0,0,0, $temp1[0],$temp1[1],$temp1[2]);
		 	$temp2 = explode("/", $course->courseDate->courseEndDate);
		 	$endDate = mktime(0,0,0, $temp2[0],$temp2[1],$temp2[2]);
		 	$temp3 = explode("/", $course->courseDate->lastDateForApp);
		 	$lastDate = mktime(0,0,0, $temp3[0],$temp3[1],$temp3[2]);

	 		$sqlInsert = "INSERT INTO `CMECourses`(".
	 		"`CMEId`, `CourseAddDate`, `CourseTitle`, `CourseDesc`,".
			" `Speciality`, `Venue_Address1`,`Venue_Address2`,".
			"`Venue_City`,`Venue_State`,`Venue_Zip`,`Venue_Country`,".
			"`ContactPerson`, `ContactPhone`,".
	 		"`ContactFax`, `ContactEmail`, `CourseStartDate`, `CourseEndDate`,".
	 		"`LastDate_App`,`NearestHotel`, `NearestAirport`, `CourseFee`,".
	 		"`Status`, `Remarks`,`CMECredits`".
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

	 		//execute insert query
		 	$value = "";
		 	$error = $this->mySQL->executeScalar($con, $sqlInsert, $value);
		 	if($error->isError())
			{
				return $error;
			}
			return $error;
 	}

 	/*
	 * checks login details of admin/agent
	 */
	 function checkDBLoginDetails(&$con, &$userName, &$password, &$result)
	 {
	  	$error = new Error();
	  	//$error->module = "(DAL) checkDBLoginDetails";
	 	$query = new QueryBuilder("Users");
	 	$fieldList = " UserId ";
	 	$query->setFieldList($fieldList);
	 	$condition = " UserName = '" . $userName . "' AND Password = '" . $password . "'";
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
 	 * gets cme provider list
 	 */
 	 function getCMEProviderList(&$con, &$cmeproviders)
 	 {
 		$error = new Error();
 		//$error->module="(DAC)getCMEProviderList";
 		$query = new QueryBuilder("CMEProvider");
 		$query->setFieldList(" CMEId, UserName ");
 		$sqlSelect = $query->generateQuery();
 		$result = "";
 		$error = $this->mySQL->executeQuery($result, $con, $sqlSelect);
 		if($error->isError())
		{
			return $error;
		}
 		else
 		{
 			while($cmeproviderList = mysql_fetch_row($result))
 			{
				$cmeproviders[] = $cmeproviderList;
 			}
 		}
 		return $error;
 	}
 	/*
 	 * get the records of states from database
 	 * parameters passed : connection object, array of records
 	 * returns error object
 	 */
 	function getStateList(&$con, &$states)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("States");
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
 	 * get the records of userstatus from database
 	 * parameters passed : connection object, array of records
 	 * returns error object
 	 */
 	function getUserStatusList(&$con, &$status)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("UserStatus");
 		$query->setFieldList(" UserStatus_Code, UserStatus_Name ");
 		$sqlSelect = $query->generateQuery();
 		$result = "";
 		$error = $this->mySQL->executeQuery($result, $con, $sqlSelect);
 		if($error->isError())
 		{
 			return $error;
 		}
 		else
 		{
 			while($statusList = mysql_fetch_row($result))
 			{
				$status[] = $statusList;
 			}
 		}
 		return $error;
 	}
	/*
 	 * get the records of course Types from database
 	 * parameters passed : connection object, array of records
 	 * returns error object
 	 */
 	function getCourseTypeList(&$con, &$types)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("CourseType");
 		$query->setFieldList(" CourseType, CourseName ");
 		$sqlSelect = $query->generateQuery();
 		$result = "";
 		$error = $this->mySQL->executeQuery($result, $con, $sqlSelect);
 		if($error->isError())
 		{
 			return $error;
 		}
 		else
 		{
 			while($typeList = mysql_fetch_row($result))
 			{
				$types[] = $typeList;
 			}
 		}
 		return $error;
 	}
 	/*
 	 * get the records of status from database
 	 * parameters passed : connection object, array of records
 	 * returns error object
 	 */
 	function getCourseStatusList(&$con, &$status)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("CourseStatus");
 		$query->setFieldList(" CourseStatus_Code, CourseStatus_Name ");
 		$sqlSelect = $query->generateQuery();
 		$result = "";
 		$error = $this->mySQL->executeQuery($result, $con, $sqlSelect);
 		if($error->isError())
 		{
 			return $error;
 		}
 		else
 		{
 			while($statusList = mysql_fetch_row($result))
 			{
				$status[] = $statusList;
 			}
 		}
 		return $error;
 	}
 	/*
 	 * get the records of booking status from database
 	 * parameters passed : connection object, array of records
 	 * returns error object
 	 */
 	function getBookingStatusList(&$con, &$status)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("BookingStatus");
 		$query->setFieldList(" BookingStatus_Code, BookingStatus_Name ");
 		$sqlSelect = $query->generateQuery();
 		$result = "";
 		$error = $this->mySQL->executeQuery($result, $con, $sqlSelect);
 		if($error->isError())
 		{
 			return $error;
 		}
 		else
 		{
 			while($statusList = mysql_fetch_row($result))
 			{
				$status[] = $statusList;
 			}
 		}
 		return $error;
 	}

 	/*
 	 * get the records of speciality from database
 	 * parameters passed : connection object, array of records
 	 * returns error object
 	 */
 	function getSpecialityList(&$con, &$specialities)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("Speciality");
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
 	 * get the records of paymentmodes from database
 	 * parameters passed : connection object, array of records
 	 * returns error object
 	 */
 	function getPaymentModeList(&$con, &$paymentmodes)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("PaymentModes");
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
 	 * gets the agent id and name to populate list in form
 	 * parameters passed  : connection object, array of users
 	 * returns error object
 	 */
 	 function getUserList(&$con, &$users)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("Users");
 		$query->setFieldList( " UserId, UserName ");
 		$sqlSelect = $query->generateQuery();
 		$result = "";
 		$error = $this->mySQL->executeQuery($result, $con, $sqlSelect);
 		if($error->isError())
 		{
 			return $error;
 		}
 		else
 		{
 			while($userList = mysql_fetch_row($result))
 			{
				$users[] = $userList;
 			}
 		}
 		return $error;
 	}


 	/*
 	 * gets cme providers list frm database
 	 */
 	function getDBCMEProviderSearchResults(&$con, &$CMEProvider, &$result)
 	{
 		$error = new Error();
 		$error->module="(DAC)getDBCMEProviderSearchResults";
 		$query = new QueryBuilder("CMEProvider");
 		$whereClause = "";
 		if($CMEProvider->instituteName!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " InstituteName LIKE '%". $CMEProvider->instituteName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "  AND InstituteName LIKE '%". $CMEProvider->instituteName ."%'";
	 		}
	 	}
	 	if($CMEProvider->name->firstName !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " FirstName LIKE '%". $CMEProvider->name->firstName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND FirstName LIKE '%". $CMEProvider->name->firstName ."%'";
	 		}
	 	}
	 	if($CMEProvider->address->address1!="")
	 	{
	 		if($whereClause == "")
	 		{
	 		$whereClause = $whereClause . " Address1 LIKE '%". $CMEProvider->address->address1 ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND Address1 LIKE '%". $CMEProvider->address->address1 ."%'";
	 		}
	 	}
 		if($CMEProvider->address->city!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " City LIKE '%". $CMEProvider->address->city ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND City LIKE '%". $CMEProvider->address->city ."%'";
	 		}
	 	}
	 	if($CMEProvider->address->state!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " State LIKE '%". $CMEProvider->address->state ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND State LIKE '%". $CMEProvider->address->state ."%'";
	 		}
	 	}
	 	if($CMEProvider->email!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " EmailId LIKE '%". $CMEProvider->email."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND EmailId LIKE '%". $CMEProvider->email."%'";
	 		}
	 	}
	 	if($CMEProvider->login->loginName!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " UserName LIKE '%". $CMEProvider->login->loginName."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND UserName LIKE '%". $CMEProvider->login->loginName."%'";
	 		}
	 	}
	 	if($whereClause != "")
	 	{
	 		$condition = $whereClause;
			$query->setCondition($condition);
	 	}
		$sqlSelect = $query->generateQuery();
		$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
		if($error->isError())
 		{
 			return $error;
 		}
 		return $error;

 	}

 		/*
 	 * gets cme providers count frm database
 	 */
 	function getDBCMEProviderSearchResultsCount(&$con, &$CMEProvider, &$count)
 	{
 		$error = new Error();
 		$error->module="(DAC)getDBCMEProviderSearchResultsCount";
 		$query = new QueryBuilder("CMEProvider");
 		$whereClause="";
 		if($CMEProvider->instituteName!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " InstituteName LIKE '%". $CMEProvider->instituteName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "  AND InstituteName LIKE '%". $CMEProvider->instituteName ."%'";
	 		}
	 	}
	 	if($CMEProvider->name->firstName !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " FirstName LIKE '%". $CMEProvider->name->firstName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND FirstName LIKE '%". $CMEProvider->name->firstName ."%'";
	 		}
	 	}
	 	if($CMEProvider->address->address1!="")
	 	{
	 		if($whereClause == "")
	 		{
	 		$whereClause = $whereClause . " Address1 LIKE '%". $CMEProvider->address->address1 ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND Address1 LIKE '%". $CMEProvider->address->address1 ."%'";
	 		}
	 	}
 		if($CMEProvider->address->city!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " City LIKE '%". $CMEProvider->address->city ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND City LIKE '%". $CMEProvider->address->city ."%'";
	 		}
	 	}
	 	if($CMEProvider->address->state != "")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " State LIKE '%". $CMEProvider->address->state ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND State LIKE '%". $CMEProvider->address->state ."%'";
	 		}
	 	}
	 	if($CMEProvider->email!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " EmailId LIKE '%". $CMEProvider->email."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND EmailId LIKE '%". $CMEProvider->email."%'";
	 		}
	 	}
	 	if($CMEProvider->login->loginName!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " UserName LIKE '%". $CMEProvider->login->loginName."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND UserName LIKE '%". $CMEProvider->login->loginName."%'";
	 		}
	 	}
	 	if($whereClause != "")
	 	{
	 		$condition = $whereClause;
			$query->setCondition($condition);
	 	}
		$sqlSelect = $query->generateQueryCount();
		$error = $this->mySQL->executeScalar($con, $sqlSelect, $count);
		if($error->isError())
 		{
 			return $error;
 		}
 		return $error;

 	}

 	/*
 	 * gets cme providers list frm database
 	 */
 	function getDBCMEProviderSearchResultsWithLimits(&$con, &$CMEProvider, &$result, $from, $pagecount)
 	{
 		$error = new Error();
 		//$error->module="(DAC)getDBCMEProviderSearchResultsWithLimits";
 		$query = new QueryBuilder("CMEProvider");
 		$whereClause = "";
 		if($CMEProvider->instituteName!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " InstituteName LIKE '%". $CMEProvider->instituteName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "  AND InstituteName LIKE '%". $CMEProvider->instituteName ."%'";
	 		}
	 	}
	 	if($CMEProvider->name->firstName !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " FirstName LIKE '%". $CMEProvider->name->firstName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND FirstName LIKE '%". $CMEProvider->name->firstName ."%'";
	 		}
	 	}
	 	if($CMEProvider->address->address1!="")
	 	{
	 		if($whereClause == "")
	 		{
	 		$whereClause = $whereClause . " Address1 LIKE '%". $CMEProvider->address->address1 ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND Address1 LIKE '%". $CMEProvider->address->address1 ."%'";
	 		}
	 	}
 		if($CMEProvider->address->city!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " City LIKE '%". $CMEProvider->address->city ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND City LIKE '%". $CMEProvider->address->city ."%'";
	 		}
	 	}
	 	if($CMEProvider->address->state != "")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " State LIKE '%". $CMEProvider->address->state ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND State LIKE '%". $CMEProvider->address->state ."%'";
	 		}
	 	}
	 	if($CMEProvider->email!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " EmailId LIKE '%". $CMEProvider->email."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND EmailId LIKE '%". $CMEProvider->email."%'";
	 		}
	 	}
	 	if($CMEProvider->login->loginName!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " UserName LIKE '%". $CMEProvider->login->loginName."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND UserName LIKE '%". $CMEProvider->login->loginName."%'";
	 		}
	 	}
              
	 	if($whereClause != "")
	 	{
	 		$condition = $whereClause;
			$query->setCondition($condition);
	 	}
		$sqlSelect = $query->generateQueryWithLimit($from, $pagecount);
               
		$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
		if($error->isError())
 		{
 			return $error;
 		}
 		return $error;

 	}
 	/*
	 * gets cme provider details of given cme id
	 * parameters passed : cme id, resultset
	 * returns error object
	 */
	 function getDBCMEProviderDetails(&$con, &$id, &$result)
	 {
	 	$error = new Error();
 		//$error->module = "(DAL)getDBCMEProviderDetails ";
	 	$query = new QueryBuilder("CMEProvider");
	 	$condition = " CMEId = '" . $id . "'";
	 	$query->setCondition($condition);
	 	$fieldList = " CMEId, InstituteName, FirstName, MiddleName, LastName, Address1, ".
	 	"Address2, City, State, Zip, WorkPhone, HomePhone, Fax, MobilePhone, EmailId, ".
	 	"WebsiteUrl, UserName, Status, Remarks ";
	 	$query->setFieldList($fieldList);
	 	$sqlSelect = $query->generateQuery();
	 	$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	 }

	 /*
	  * updates cme provider details
	  * parameters passed : connection object, Model object of cme provider
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
	 		", Status = '" . $CMEProvider->status . "'".
	 		", Remarks = '" . $CMEProvider->remarks . "'".
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
	   * resets cme provider password
	   * parameters passed :  model object of Cme provider, new password
	   * returns error object
	   */
 		function resetDBCMEProviderPassword(&$con, &$CMEProvider, &$newPassword)
 		{
 			$error = new Error();
 			//$error->module = "(DAL)resetDBCMEProviderPassword";
 			$sqlUpdate = "UPDATE CMEProvider SET ".
 			"Password = '". $newPassword . "' ".
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
 	 * gets Doctors list frm database
 	 */
 	function getDBDoctorSearchResults(&$con, &$Doctor, &$result)
 	{
 		$error = new Error();
 		//$error->module="(DAC)getDBDoctorSearchResults";
 		$query = new QueryBuilder("Doctor");
 		$whereClause = "";
 		if($Doctor->name->firstName !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " FirstName LIKE '%". $Doctor->name->firstName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND FirstName LIKE '%". $Doctor->name->firstName ."%'";
	 		}
	 	}
	 	if($Doctor->name->lastName !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " LastName LIKE '%". $Doctor->name->lastName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND LastName LIKE '%". $Doctor->name->lastName ."%'";
	 		}
	 	}
	 	if($Doctor->sex !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " Sex LIKE '%". $Doctor->sex ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND Sex LIKE '%". $Doctor->sex ."%'";
	 		}
	 	}
	 	if($Doctor->address->address1!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " Address1 LIKE '%". $Doctor->address->address1 ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND Address1 LIKE '%". $Doctor->address->address1 ."%'";
	 		}
	 	}
 		if($Doctor->address->city!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " City LIKE '%". $Doctor->address->city ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND City LIKE '%". $Doctor->address->city ."%'";
	 		}
	 	}
	 	if($Doctor->address->state!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " State LIKE '%". $Doctor->address->state ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND State LIKE '%". $Doctor->address->state ."%'";
	 		}

	 	}
	 	if($Doctor->email!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " EmailId LIKE '%". $Doctor->email."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND EmailId LIKE '%". $Doctor->email."%'";
	 		}
	 	}
	 	if($Doctor->speciality!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " Speciality LIKE '%". $Doctor->speciality."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND Speciality LIKE '%". $Doctor->speciality."%'";
	 		}
	 	}
	  	if($Doctor->login->loginName!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " UserName LIKE '%". $Doctor->login->loginName."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND UserName LIKE '%". $Doctor->login->loginName."%'";
	 		}
	 	}
	 	if($whereClause != "")
	 	{
	 		$condition = $whereClause;
			$query->setCondition($condition);
	 	}
		$sqlSelect = $query->generateQuery();
		$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
		if($error->isError())
 		{
 			return $error;
 		}
 		return $error;

 	}

 		/*
 	 * gets Doctor count frm database
 	 */
 	function getDBDoctorSearchResultsCount(&$con, &$Doctor, &$count)
 	{
 		$error = new Error();

 		$error->module="(DAC)getDBDoctorSearchResultsCount";
 		$query = new QueryBuilder("Doctor");
 		$whereClause = "";
 		if($Doctor->name->firstName !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " FirstName LIKE '%". $Doctor->name->firstName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND FirstName LIKE '%". $Doctor->name->firstName ."%'";
	 		}
	 	}
	 	if($Doctor->name->lastName !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " LastName LIKE '%". $Doctor->name->lastName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND LastName LIKE '%". $Doctor->name->lastName ."%'";
	 		}
	 	}
	 	if($Doctor->sex !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " Sex LIKE '%". $Doctor->sex ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND Sex LIKE '%". $Doctor->sex ."%'";
	 		}
	 	}
	 	if($Doctor->address->address1!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " Address1 LIKE '%". $Doctor->address->address1 ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND Address1 LIKE '%". $Doctor->address->address1 ."%'";
	 		}
	 	}
 		if($Doctor->address->city != "")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " City LIKE '%". $Doctor->address->city ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND City LIKE '%". $Doctor->address->city ."%'";
	 		}
	 	}
	 	if($Doctor->address->state!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " State LIKE '%". $Doctor->address->state ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND State LIKE '%". $Doctor->address->state ."%'";
	 		}

	 	}
	 	if($Doctor->email!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " EmailId LIKE '%". $Doctor->email."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND EmailId LIKE '%". $Doctor->email."%'";
	 		}
	 	}
	 	if($Doctor->speciality!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " Speciality LIKE '%". $Doctor->speciality."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND Speciality LIKE '%". $Doctor->speciality."%'";
	 		}
	 	}
	  	if($Doctor->login->loginName!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " UserName LIKE '%". $Doctor->login->loginName."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND UserName LIKE '%". $Doctor->login->loginName."%'";
	 		}
	 	}
	 	if($whereClause != "")
	 	{
	 		$condition = $whereClause;
			$query->setCondition($condition);
	 	}
	 	$sqlSelect = $query->generateQueryCount();
		$error = $this->mySQL->executeScalar($con, $sqlSelect, $count);
		if($error->isError())
 		{
 			return $error;
 		}
 		return $error;

 	}

 	/*
 	 * gets Doctor list frm database
 	 */
 	function getDBDoctorSearchResultsWithLimits(&$con, &$Doctor, &$result, $from, $pagecount)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("Doctor");
 		$whereClause = "";
 		if($Doctor->name->firstName !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " FirstName LIKE '%". $Doctor->name->firstName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND FirstName LIKE '%". $Doctor->name->firstName ."%'";
	 		}
	 	}
	 	if($Doctor->name->lastName !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " LastName LIKE '%". $Doctor->name->lastName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND LastName LIKE '%". $Doctor->name->lastName ."%'";
	 		}
	 	}
	 	if($Doctor->sex !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " Sex LIKE '%". $Doctor->sex ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND Sex LIKE '%". $Doctor->sex ."%'";
	 		}
	 	}
	 	if($Doctor->address->address1!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " Address1 LIKE '%". $Doctor->address->address1 ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND Address1 LIKE '%". $Doctor->address->address1 ."%'";
	 		}
	 	}
 		if($Doctor->address->city!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " City LIKE '%". $Doctor->address->city ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND City LIKE '%". $Doctor->address->city ."%'";
	 		}
	 	}
	 	if($Doctor->address->state!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " State LIKE '%". $Doctor->address->state ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND State LIKE '%". $Doctor->address->state ."%'";
	 		}

	 	}
	 	if($Doctor->email!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " EmailId LIKE '%". $Doctor->email."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND EmailId LIKE '%". $Doctor->email."%'";
	 		}
	 	}
	 	if($Doctor->speciality!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " Speciality LIKE '%". $Doctor->speciality."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND Speciality LIKE '%". $Doctor->speciality."%'";
	 		}
	 	}
	  	if($Doctor->login->loginName!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " UserName LIKE '%". $Doctor->login->loginName."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND UserName LIKE '%". $Doctor->login->loginName."%'";
	 		}
	 	}
	 	if($whereClause != "")
	 	{
	 		$condition = $whereClause;
			$query->setCondition($condition);
	 	}
		$sqlSelect = $query->generateQueryWithLimit($from, $pagecount);
		$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
		if($error->isError())
 		{
 			return $error;
 		}
 		return $error;

 	}
 	function getDBDoctorSearchResults_2(&$con, &$Doctor, &$result)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("Doctor");
 		$whereClause = "";
 		if($Doctor->name->firstName !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " FirstName LIKE '%". $Doctor->name->firstName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND FirstName LIKE '%". $Doctor->name->firstName ."%'";
	 		}
	 	}
	 	if($Doctor->name->lastName !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " LastName LIKE '%". $Doctor->name->lastName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND LastName LIKE '%". $Doctor->name->lastName ."%'";
	 		}
	 	}
	 	if($whereClause != "")
	 	{
	 		$condition = $whereClause ;
			$query->setCondition($condition);
	 	}
	 	$sqlSelect = $query->generateQuery();
		$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
		if($error->isError())
 		{
 			return $error;
 		}
 		return $error;

 	}

 	function getDBDoctorSearchResultsCount_2(&$con, &$Doctor, &$count)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("Doctor");
 		$whereClause = "";
 		if($Doctor->name->firstName !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " FirstName LIKE '%". $Doctor->name->firstName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND FirstName LIKE '%". $Doctor->name->firstName ."%'";
	 		}
	 	}
	 	if($Doctor->name->lastName !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " LastName LIKE '%". $Doctor->name->lastName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND LastName LIKE '%". $Doctor->name->lastName ."%'";
	 		}
	 	}

	 	if($whereClause != "")
	 	{
	 		$condition = $whereClause ;
			$query->setCondition($condition);
	 	}
	 	$sqlSelect = $query->generateQueryCount();
		$error = $this->mySQL->executeScalar($con, $sqlSelect, $count);
		if($error->isError())
 		{
 			return $error;
 		}
 		return $error;

 	}
 	function getDBDoctorSearchResultsWithLimits_2(&$con, &$Doctor, &$result, $from, $pagecount)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("Doctor");
 		$whereClause = "";
 		if($Doctor->name->firstName !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " FirstName LIKE '%". $Doctor->name->firstName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND FirstName LIKE '%". $Doctor->name->firstName ."%'";
	 		}
	 	}
	 	if($Doctor->name->lastName !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " LastName LIKE '%". $Doctor->name->lastName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND LastName LIKE '%". $Doctor->name->lastName ."%'";
	 		}
	 	}
	 	if($whereClause != "")
	 	{
	 		$condition = $whereClause;
			$query->setCondition($condition);
	 	}

		$sqlSelect = $query->generateQueryWithLimit($from, $pagecount);
		$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
		if($error->isError())
 		{
 			return $error;
 		}
 		return $error;
 	}
  	/*
	 * gets Doctor details of given Doctor id
	 * parameters passed : Doctor id, resultset
	 * returns error object
	 */
	 function getDBDoctorDetails(&$con, &$id, &$result)
	 {
	 	$error = new Error();
 		$error->module = "(DAL)getDBDoctorDetails ";
	 	$query = new QueryBuilder("Doctor");
	 	$condition = " DoctorId = '" . $id . "'";
	 	$query->setCondition($condition);
	 	$fieldList = "DoctorId, FirstName, MiddleName, LastName, Sex, Address1, ".
	 	"Address2, City, State, Zip, WorkPhone, HomePhone, Fax, MobilePhone, EmailId, ".
	 	"Speciality, ContactTime, UserName, Status, Remarks ";
	 	$query->setFieldList($fieldList);
	 	$sqlSelect = $query->generateQuery();
	 	$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	 }

	 /*
	  * updates Doctor details
	  * parameters passed : connection object, Model object of Doctor
	  * returns error object
	  */
	 function editDBDoctorDetails(&$con, &$Doctor)
	 {
	  	$error = new Error();

	  	$error->module = "(DAL) editDBDoctorDetails";
	  	$sqlUpdate = "UPDATE Doctor SET ".
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
	 		", Status = '" . $Doctor->status . "'".
	 		", Remarks = '" . $Doctor->remarks . "'".
	 		" WHERE DoctorId = '" . $Doctor->doctorId . "'";

			//execute update query
		 	$rows_affected = 0;
		 	echo $sqlUpdate;
		 	$error = $this->mySQL->executeUpdate($con, $sqlUpdate, $rows_affected);
		 	if($error->isError())
		 	{

		 		return $error;
		 	}
		 	return $error;
	  }

	  /*
	   * resets Doctor password
	   * parameters passed :  model object of Doctor, new password
	   * returns error object
	   */
 		function resetDBDoctorPassword(&$con, &$Doctor, &$newPassword)
 		{
 			$error = new Error();
 			//$error->module = "(DAL)resetDBDoctorPassword";
 			$sqlUpdate = "UPDATE Doctor SET ".
 			"Password = '". $newPassword . "' ".
 			" WHERE DoctorId = '" . $Doctor->doctorId . "'";

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
 	 * gets Agent list frm database
 	 */
 	function getDBAgentSearchResults(&$con, &$Agent, &$result)
 	{
 		$error = new Error();

 		$error->module="(DAC)getDBAgentSearchResults";
 		$query = new QueryBuilder("Users");
 		$whereClause = "";
 		if($Agent->name->firstName !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " FirstName LIKE '%". $Agent->name->firstName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND FirstName LIKE '%". $Agent->name->firstName ."%'";
	 		}

	 	}
	 	if($Agent->name->lastName !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " LastName LIKE '%". $Agent->name->lastName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND LastName LIKE '%". $Agent->name->lastName ."%'";
	 		}
	 	}
	  	if($Agent->email!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " EmailId LIKE '%". $Agent->email."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND EmailId LIKE '%". $Agent->email."%'";
	 		}
	 	}
	 	if($Agent->login->loginName!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " UserName LIKE '%". $Agent->login->loginName."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND UserName LIKE '%". $Agent->login->loginName."%'";
	 		}
	 	}
	 	if($whereClause != "")
	 	{
	 		$condition = $whereClause;
			$query->setCondition($condition);
	 	}
		$sqlSelect = $query->generateQuery();
		$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
		if($error->isError())
 		{
 			return $error;
 		}
 		return $error;
	}

 		/*
 	 * gets Agent count frm database
 	 */
 	function getDBAgentSearchResultsCount(&$con, &$Agent, &$count)
 	{
 		$error = new Error();

 		$error->module="(DAC)getDBAgentSearchResultsCount";
 		$query = new QueryBuilder("Users");
 		$whereClause = "";
 		if($Agent->name->firstName !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " FirstName LIKE '%". $Agent->name->firstName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND FirstName LIKE '%". $Agent->name->firstName ."%'";
	 		}

	 	}
	 	if($Agent->name->lastName !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " LastName LIKE '%". $Agent->name->lastName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND LastName LIKE '%". $Agent->name->lastName ."%'";
	 		}
	 	}
	  	if($Agent->email!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " EmailId LIKE '%". $Agent->email."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND EmailId LIKE '%". $Agent->email."%'";
	 		}
	 	}
	 	if($Agent->login->loginName!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " UserName LIKE '%". $Agent->login->loginName."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND UserName LIKE '%". $Agent->login->loginName."%'";
	 		}
	 	}
	 	if($whereClause != "")
	 	{
	 		$condition = $whereClause;
			$query->setCondition($condition);
	 	}
		$sqlSelect = $query->generateQueryCount();
		$error = $this->mySQL->executeScalar($con, $sqlSelect, $count);
		if($error->isError())
 		{
 			return $error;
 		}
 		return $error;

 	}

 	/*
 	 * gets Agent list frm database with limits
 	 */
 	function getDBAgentSearchResultsWithLimits(&$con, &$Agent, &$result, $from, $pagecount)
 	{
 		$error = new Error();

 		$error->module="(DAC)getDBAgentSearchResultsWithLimits";
 		$query = new QueryBuilder("Users");
 		$whereClause = "";
 		if($Agent->name->firstName !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " FirstName LIKE '%". $Agent->name->firstName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND FirstName LIKE '%". $Agent->name->firstName ."%'";
	 		}

	 	}
	 	if($Agent->name->lastName !="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " LastName LIKE '%". $Agent->name->lastName ."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . " AND LastName LIKE '%". $Agent->name->lastName ."%'";
	 		}
	 	}
	  	if($Agent->email!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " EmailId LIKE '%". $Agent->email."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND EmailId LIKE '%". $Agent->email."%'";
	 		}
	 	}
	 	if($Agent->login->loginName!="")
	 	{
	 		if($whereClause == "")
	 		{
	 			$whereClause = $whereClause . " UserName LIKE '%". $Agent->login->loginName."%'";
	 		}
	 		else
	 		{
	 			$whereClause = $whereClause . "AND UserName LIKE '%". $Agent->login->loginName."%'";
	 		}
	 	}
	 	if($whereClause != "")
	 	{
	 		$condition = $whereClause;
			$query->setCondition($condition);
	 	}
		$sqlSelect = $query->generateQueryWithLimit($from, $pagecount);
		$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
		if($error->isError())
 		{
 			return $error;
 		}
 		return $error;

 	}
 	/*
	 * gets Agent details of given Agent id
	 * parameters passed : Agent id, resultset
	 * returns error object
	 */
	 function getDBAgentDetails(&$con, &$id, &$result)
	 {
	 	$error = new Error();

 		$error->module = "(DAL)getDBAgentDetails ";
	 	$query = new QueryBuilder("Users");
	 	$condition = " UserId = '" . $id . "'";
	 	$query->setCondition($condition);
	 	$fieldList = " UserId, FirstName, MiddleName, LastName, ".
	 	"ContactPhone, EmailId, ".
	 	"UserName, Status, Remarks ";
	 	$query->setFieldList($fieldList);
	 	$sqlSelect = $query->generateQuery();
	 	$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	 }

	 /*
	  * updates Agent details
	  * parameters passed : connection object, Model object of Agent
	  * returns error object
	  */
	 function editDBAgentDetails(&$con, &$Agent)
	 {
	  	$error = new Error();

	  	$error->module = "(DAL) editDBAgentDetails";
	  	$sqlUpdate = "UPDATE Users SET ".
	 		" UserId = '" . $Agent->userId . "'" .
	 		", FirstName = '" . $Agent->name->firstName . "'".
	 		", MiddleName = '" . $Agent->name->middleName . "'".
	 		", LastName = '" . $Agent->name->lastName . "'".
	 		", ContactPhone = '" . $Agent->contactPhone . "'".
	 		", EmailId = '" . $Agent->email . "'".
	 		", UserName = '" . $Agent->login->loginName . "'".
	 		", Status = '" . $Agent->status . "'".
	 		", Remarks = '" . $Agent->remarks . "'".
	 		" WHERE UserId = '" . $Agent->userId . "'";
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
	   * resets Agent password
	   * parameters passed :  model object of Agent, new password
	   * returns error object
	   */
 		function resetDBAgentPassword(&$con, &$Agent, &$newPassword)
 		{
 			$error = new Error();

 			$error->module = "(DAL)resetDBAgentPassword";
 			$sqlUpdate = "UPDATE Users SET ".
 			"Password = '". $newPassword . "' ".
 			" WHERE UserId = '" . $Agent->userId . "'";

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
	    * gets the details of admin/ agent for display
	    * parameters passed : connection object, userid, result set
	    * returns error object
	    */
	    function getDBMyProfile(&$con, &$userId, &$result)
	    {
	    	$error = new Error();

 			$error->module = "(DAL)getDBMyProfile";
 			$query = new QueryBuilder("Users");
		 	$fieldList = " UserId, FirstName, MiddleName, LastName, ".
		 	"ContactPhone, EmailId, ".
		 	"UserName, Status, Remarks ";
		 	$query->setFieldList($fieldList);
		 	$condition = " UserId = '" . $userId . "'";
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
 	 * gets new cme courses' list frm database
 	 */
 	function getDBNewCMECourses(&$con, &$result)
 	{
 		$error = new Error();

 		$error->module ="(DAC)getDBNewCMECourses";
 		$query = new QueryBuilder("CMECourses");
 		$fieldList = " CourseId, CMEId, CourseTitle, Speciality, Venue_Address1, ".
		 	"Venue_Address2, Venue_City, Venue_State, CourseStartDate, CourseEndDate, ".
		 	"LastDate_App, UserName, Status, CourseFee, CMECredits ";
 		$query->setFieldList($fieldList);
 		$condition = " Status = 'NEW' ";
 		$query->setCondition($condition);
		$sqlSelect = $query->executeQuery();
		$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
		if($error->isError())
	 	{
	 		return $error;
	 	}
		return $error;
 	}
 	 /*
 	 * gets new cme courses' count frm database
 	 */
 	function getDBNewCMECoursesCount(&$con, &$count)
 	{
 		$error = new Error();

 		$error->module ="(DAC)getDBNewCMECourses";
 		$query = new QueryBuilder("CMECourses");
 		$fieldList = " CourseId, CMEId, CourseTitle, Speciality, Venue_Address1, ".
		 	"Venue_Address2, Venue_City, Venue_State, CourseStartDate, CourseEndDate, ".
		 	"LastDate_App, UserName, Status, CourseFee, CMECredits ";
 		$query->setFieldList($fieldList);
 		$condition = " Status = 'NEW'";
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
 	 * gets new cme courses'with limits frm database
 	 */
 	function getDBNewCMECoursesWithLimits(&$con, &$result, $from, $pagecount)
 	{
 		$error = new Error();

 		$error->module ="(DAC)getDBNewCMECoursesWithLimits";
 		$query = new QueryBuilder("CMECourses");
 		$fieldList = " CourseId, CMEId, CourseTitle, Speciality, Venue_Address1, ".
		 	"Venue_Address2, Venue_City, Venue_State, ContactEmail, CourseStartDate, CourseEndDate, ".
		 	"LastDate_App, Status, CourseFee, CMECredits  ";
 		$query->setFieldList($fieldList);
 		$condition = " Status = 'NEW' ";
 		$query->setCondition($condition);
 		$sqlSelect = $query->generateQueryWithLimit($from, $pagecount);
		$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
 	}

 	 /* gets cme course details
	 */
	 function getDBCMECourseDetails(&$con, &$result, &$id)
	 {
	 	$error = new Error();

		$error->module = "(DAL)getDBCMECourseDetails";
		$query = new QueryBuilder("CMECourses");
		$condition = " CourseId = '" . $id . "'";
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
 	 * approves CME Courses
 	 * parameters passed : connection object, course model object
 	 * returns error object
 	 */
 	 function approveDBCourse(&$con, &$course)
 	 {
 	 	$error = new Error();

 	 	$temp1 = explode("/", $course->courseDate->courseStartDate);
	 	$startDate = mktime(0,0,0, $temp1[0],$temp1[1],$temp1[2]);
	 	$temp2 = explode("/", $course->courseDate->courseEndDate);
	 	$endDate = mktime(0,0,0, $temp2[0],$temp2[1],$temp2[2]);
	 	$temp3 = explode("/", $course->courseDate->lastDateForApp);
	 	$lastDate = mktime(0,0,0, $temp3[0],$temp3[1],$temp3[2]);

 		$sqlUpdate = "UPDATE CMECourses SET ".
	 		"CourseId = '" . $course->courseId . "'" .
	 		", CMEId = '" . $course->CMEId . "'".
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
	 		", CourseStartDate = '" . date("Y-m-d", $startDate) . "'".
	 		", CourseEndDate = '" .date("Y-m-d", $endDate) . "'".
	 		", LastDate_App = '" . date("Y-m-d", $lastDate) . "'".
	 		", NearestHotel = '" . $course->nearestHotel . "'".
	 		", NearestAirport = '" . $course->nearestAirport . "'".
	 		", CourseFee = " . $course->courseFee . "".
	 		", Status = '" . $course->status . "'".
	 		", Remarks = '" . $course->remarks . "'".
	 		", CMECredits = '" . $course->cmeCredits . "'".
	 		" WHERE CourseId = '" . $course->courseId . "'";

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
 	 * gets applied  cme courses' list frm database
 	 */
 	function getDBAppliedCourses(&$con, &$result)
 	{
 		$error = new Error();

 		$error->module ="(DAC)getDBAppliedCourses";
 		$query = new QueryBuilder("AppliedCourses");
 		$fieldList = " BookingId, DoctorId, CourseId, BookingDate, ".
					" PaymentMode, Amount, AgentId, BookStatus ";
 		$query->setFieldList($fieldList);
 		$condition = " BookStatus = 'PENDING' ";
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
 	 * gets applied courses' count frm database
 	 */
 	function getDBAppliedCoursesCount(&$con, &$count)
 	{
 		$error = new Error();

 		$error->module ="(DAC)getDBAppliedCourses";
 		$query = new QueryBuilder("AppliedCourses");
 		$fieldList = " BookingId, DoctorId, CourseId, BookingDate, ".
					" PaymentMode, Amount, AgentId, BookStatus ";
 		$query->setFieldList($fieldList);
 		$condition = " BookStatus = 'PENDING' ";
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
 	 * gets applied courses'with limits frm database
 	 */
 	function getDBAppliedCoursesWithLimits(&$con, &$result, $from, $pagecount)
 	{
 		$error = new Error();

 		$error->module ="(DAC)getDBAppliedCoursesWithLimits";
 		$query = new QueryBuilder("AppliedCourses");
 		$fieldList = " BookingId, DoctorId, CourseId, BookingDate, ".
					" PaymentMode, Amount, AgentId, BookStatus ";
 		$query->setFieldList($fieldList);
 		$condition = " BookStatus = 'PENDING' ";
 		$query->setCondition($condition);
 		$sqlSelect = $query->generateQueryWithLimit($from, $pagecount);
 		$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
 	}

 	 /* gets applied cme course details
	 */
	 function getDBAppliedCourseDetails(&$con, &$result, &$id)
	 {
	 	$error = new Error();

		$error->module = "(DAL)getDBAppliedCourseDetails";
		$query = new QueryBuilder("AppliedCourses");
		$fieldList = " BookingId, DoctorId, CourseId, BookingDate, ".
					"PaymentMode, Amount, AgentId, BookStatus ";

		$query->setFieldList($fieldList);
		$condition = " BookingId = '" . $id . "'";
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
 	 * books CME Courses
 	 * parameters passed : connection object, course model object
 	 * returns error object
 	 */
 	 function bookDBCMECourse(&$con, &$appliedCourse)
 	 {
 	 	$error = new Error();

 	 	$error->module = "DAL - bookDBCourse";
 	 	$sqlUpdate = "UPDATE AppliedCourses SET BookStatus = '" . $appliedCourse->bookStatus . "'" .
 	 					"  WHERE BookingId = '" . $appliedCourse->bookingId . "'";
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
 	 * gets Booked  cme courses' list frm database
 	 */
 	function getDBBookedCourses(&$con, &$result)
 	{
 		$error = new Error();

 		$error->module ="(DAC)getDBBookedCourses";
 		$query = new QueryBuilder("AppliedCourses");
 		$fieldList = " BookingId, DoctorId, CourseId, BookingDate, ".
					" PaymentMode, Amount, AgentId, BookStatus ";
 		$query->setFieldList($fieldList);
 		$condition = " BookStatus = 'BOOKED' ";
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
 	 * gets applied courses' count frm database
 	 */
 	function getDBBookedCoursesCount(&$con, &$count)
 	{
 		$error = new Error();

 		$error->module ="(DAC)getDBBookedCoursesCount";
 		$query = new QueryBuilder("AppliedCourses");
 		$fieldList = " BookingId, DoctorId, CourseId, BookingDate, ".
					" PaymentMode, Amount, AgentId, BookStatus ";
 		$query->setFieldList($fieldList);
 		$condition = " BookStatus = 'BOOKED' ";
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
 	 * gets applied courses'with limits frm database
 	 */
 	function getDBBookedCoursesWithLimits(&$con, &$result, $from, $pagecount)
 	{
 		$error = new Error();

 		$error->module ="(DAC)getDBBookedCoursesWithLimits";
 		$query = new QueryBuilder("AppliedCourses");
 		$fieldList = " BookingId, DoctorId, CourseId, BookingDate,  ".
					" PaymentMode, Amount, AgentId, BookStatus ";
 		$query->setFieldList($fieldList);
 		$condition = " BookStatus = 'BOOKED' ";
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
 	 * adds module
 	 * parameters passed : connection object, model object
 	 * returns error object
 	 */
 	 function addDBModule(&$con, &$module)
 	 {
 	 	$error = new Error();

 	 	$error->module = "(DAL)addDBModule ";
 	 	$sqlInsert = "INSERT INTO ModuleList(ModuleName, ModulePath)".
 	 				"VALUES(" .
 	 				"'". $module->moduleName . "', ".
 	 				"'". $module->modulePath . "'".
					")";
		//execute insert query
	 	$value = "";
	 	$error = $this->mySQL->executeScalar($con, $sqlInsert, $value);
	 	if($error->isError())
		{
			return $error;
		}
		return $error;
 	 }

 	 /*
 	  * resets access for user
 	  * parameters passed : conn object, agent's user id
 	  * returns error object
 	  */
 	  function resetDBAccessList(&$con, &$agent, &$result)
 	  {
 	  		$error = new Error();
 	  		//$error->module = "(DAL) resetDBAccessList";
 	  		$sqlDelete = "DELETE FROM AccessList WHERE UserId = '" . $agent->userId . "'";
 	  		$error = $this->mySQL->executeQuery($result, $sqlDelete, $con);
 	  		if($error->isError())
			{
				return $error;
			}
			$sqlInsert = "INSERT INTO AccessList SELECT '" . $agent->userId . "'" .
						", ModuleId , ModuleName, 'DENIED' FROM ModuleList";
			//execute insert query
		 	$value = "";
		 	$error = $this->mySQL->executeScalar($con, $sqlInsert, $value);
		 	if($error->isError())
			{
				return $error;
			}
			$query = new QueryBuilder("AccessList");
 	  		$fieldList = " ModuleId, ModuleName, AccessType ";
 	  		$query->setFieldList($fieldList);
 	  		$condition = " UserId = '" . $agent->userId . "' ";
 	  		$query->setCondition($condition);
 	  		$ordByCond = " ModuleId ";
 	  		$query->setOrderByCond($ordByCond);
 	  		$sqlSelect = $query->generateQuery();
			$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
			if($error->isError())
	 		{
	 			return $error;
	 		}
			return $error;
 	  }

 	  /*
 	  * view access for user
 	  * parameters passed : conn object, agent's user id
 	  * returns error object
 	  */
 	  function viewDBAccessList(&$con, &$agent, &$result)
 	  {
 	  		$error = new Error();

 	  		$error->module = "(DAL) viewDBAccessList";
 	  		$query = new QueryBuilder("AccessList");
 	  		$fieldList = " ModuleId, ModuleName, AccessType ";
 	  		$query->setFieldList($fieldList);
 	  		$condition = " UserId = '" . $agent->userId . "' ";
 	  		$query->setCondition($condition);
 	  		$ordByCond = " ModuleId ";
 	  		$query->setOrderByCond($ordByCond);
 	  		$sqlSelect = $query->generateQuery();
 	  		$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
			if($error->isError())
	 		{
	 			return $error;
	 		}
			return $error;
 	  }

 	  /*
 	   * changes the access of agent
 	   * parameters passed :  agent object, con object, module id, access type resulset
 	   * returns error object
 	   */
 	   function assignDBAccessList(&$con, &$agent, &$moduleId, &$access, &$result)
 	   {
 	   		$error = new Error();

 	  		$error->module = "(DAL) assignDBAccessList";
 	  		$sqlUpdate = "UPDATE AccessList SET AccessType = '" . $access . "'" .
 	  					" WHERE UserId = '" . $agent->userId . "' AND ModuleId = '" . $moduleId . "'";
 	  		//execute update query
			$rows_affected = 0;
			$error = $this->mySQL->executeUpdate($con, $sqlUpdate, $rows_affected);
			if($error->isError())
			{
				$error->setError("Unable to update the record");
			    return $error;
			}
			$query = new QueryBuilder("AccessList");
 	  		$fieldList = " ModuleId, ModuleName, AccessType ";
 	  		$query->setFieldList($fieldList);
 	  		$condition = " UserId = '" . $agent->userId . "' ";
 	  		$query->setCondition($condition);
 	  		$ordByCond = " ModuleId ";
 	  		$query->setOrderByCond($ordByCond);
 	  		$sqlSelect = $query->generateQuery();
 	  		$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
			if($error->isError())
	 		{
	 			return $error;
	 		}
			return $error;
 	   }

 	   function getDBCMECourseSearchResults(&$con, &$course, &$result)
 		{
 			$error = new Error();
 			$error->module="(DAC)getDBCMECourseSearchResults";
 			$query = new QueryBuilder("CMECourses");
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
				$whereClause = $whereClause . " AND CourseStartDate >='". date("Y-m-d",$startDate) . "'";
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
	 			if($whereClause == "")
	 			{
	 				$whereClause = $whereClause . " AND Venue_City LIKE '%". $course->address->city ."%'";
	 			}
	 			else
	 			{
	 				$whereClause = $whereClause . " AND Venue_City LIKE '%". $course->address->city ."%'";
	 			}
	 		}
	 		if($course->address->state!="")
	 		{
	 			if($whereClause == "")
	 			{
	 				$whereClause = $whereClause . " AND Venue_State LIKE '%". $course->address->state ."%'";
	 			}
	 			else
	 			{
	 				$whereClause = $whereClause . " AND Venue_State LIKE '%". $course->address->state ."%'";
	 			}

	 		}
	 		if($course->speciality!="")
	 		{
	 			if($whereClause == "")
	 			{
	 				$whereClause = $whereClause . " AND Speciality LIKE '%". $course->speciality ."%'";
	 			}
	 			else
	 			{
	 				$whereClause = $whereClause . " AND Speciality LIKE '%". $course->speciality ."%'";
	 			}
	 		}
	 		if($course->keyword!="")
	 		{
	 			if($whereClause == "")
	 			{
	 				$whereClause = $whereClause . " AND (Speciality LIKE '% ". $course->keyword . "%'" .
								"OR CourseTitle LIKE '%". $course->keyword . "%'".
								"OR CourseDesc LIKE '%". $course->keyword ."%')";
	 			}
	 			else
	 			{
	 				$whereClause = $whereClause . "AND (Speciality LIKE '% ". $course->keyword . "%'" .
								"OR CourseTitle LIKE '%". $course->keyword . "%'".
								"OR CourseDesc LIKE '%". $course->keyword ."%')";
	 			}
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

 	function getDBCMECourseSearchCount(&$con, &$course, &$count)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("CMECourses");
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
			$whereClause = $whereClause . " AND CourseStartDate >='". date("Y-m-d", $startDate) . "'";
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
	 		$whereClause = $whereClause . "AND (Speciality LIKE '% ". $course->keyword . "%'" .
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

	function getDBCMECourseSearchResultsWithLimits(&$con, &$course, &$result, $from, $pagecount)
 	{
		$error = new Error();
 		$error = new Error();
 		//$error->module="(DAC)getDBCMECourseSearchCountForDoctor";
 		$query = new QueryBuilder("CMECourses");
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
			$whereClause = $whereClause . " AND CourseStartDate >='". date("Y-m-d",$startDate) . "'";
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
	 * inserts record in applied course table
	 * for storing applied course details
	 * parameters passed : connection object, appliedcourse object
	 * returns error object
	 */
	function bookDBCourseForDoctor(&$con, &$appliedCourse, &$bid)
 		{
 			$error = new Error();
 			//$error->module ="(DAC)bookCourse";
 			$sqlSelect1 = "SELECT Status FROM Doctor WHERE DoctorId = '" . $appliedCourse->doctorId . "'";
 			$result1 = "";
 			$error  = $this->mySQL->executeQuery($result1 , $con, $sqlSelect1);
 			if($error->isError())
	 		{
	 			$error->setError(0, "invalid doctor id", $error->EL->getDALError());
	 			return $error;
	 		}
	 		/*else
	 		{
	 			$row = mysql_fetch_array($result1);
	 			$access = $row["Status"];
	 			if($access == "NEW")
	 			{
	 				$error->setError(0, "Doctor does not have full access to book the course", $error->EL->getDALError());
	 				return $error;
	 			}
	 		}*/
 			$result = "";
 			$sqlSelect = "SELECT * FROM AppliedCourses WHERE ".
 			             " BookStatus = 'BOOKED' AND  DoctorId = '". $appliedCourse->doctorId ."' AND CourseId = '" . $appliedCourse->courseId ."'";
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
		 			$sqlInsert = "INSERT INTO `AppliedCourses`(".
					"`DoctorId`, `CourseId`, `BookingDate`, ".
					"`PaymentMode`, `Amount`, `AgentId`, `BookStatus`) VALUES(".
					"'".$appliedCourse->doctorId .
					"', '".$appliedCourse->courseId .
					"', NOW(), ".
					"'".$appliedCourse->paymentMode .
					"', '".$appliedCourse->amount .
					"', '".$appliedCourse->agentId .
					"', '".$appliedCourse->bookStatus .
					"')";

					
				 	$error = $this->mySQL->executeInsertId($con, $sqlInsert, $bid);
				 	if($error->isError())
					{
						$error->setError(0, "Unable to insert the record", $error->EL->getDALError());
						return $error;
					}
		 		}
	 		}
			return $error;
 		}

 		function addTransactionDetails(&$con, &$transaction)
 		{
 			$error = new Error();
 			$sqlInsert = "INSERT INTO `TransactionTable`(".
			"`TransactionId`,`BookingId`,`DoctorId`, `CourseId`, `TransactionDate`,".
			"`PaymentMode`, `Amount`, `TransactionStatus`) VALUES(".
			"".$transaction->transactionId .
			",".$transaction->bookingId .
			",".$transaction->doctorId .
			", ".$transaction->courseId .
			", NOW()".
			",'".$transaction->paymentMode .
			"', ".$transaction->amount .
			",'".$transaction->status .
			"')";

			//execute insert query
			
		 	$value = "";
		 	$error = $this->mySQL->executeScalar($con, $sqlInsert, $value);
		 	if($error->isError())
			{
				return $error;
			}
			return $error;
 		}
 		/*
 		 * retrieves the records from modules table
 		 * to check against the url
		 * parameter(s) passed : result set, connection object
		 * returns error object
 		 */
 		 function getDBModulesInAdmin(&$result, &$con)
 		 {
 		 	$error = new Error();
 		 	$query = new QueryBuilder("Modules");
 		 	$sqlSelect = $query->generateQuery();
 		 	$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
			if($error->isError())
	 		{
	 			return $error;
	 		}
			return $error;
 		 }
 		 /*
	 * admin assigns full access to doctors
	 * parameter(s) passed : result set
	 * returns error object
	 */
	 function assignDBFullAccessToAllDoctors(&$result, &$con)
	 {
	 	$error = new Error();
		$sqlUpdate = "UPDATE Doctor SET Status = 'FULL ACCESS'";
		//execute update query
		$rows_affected = 0;
		$error = $this->mySQL->executeUpdate($con, $sqlUpdate, $rows_affected);
		if($error->isError())
		{
			$error->setError(0, "Unable to update the record", $error->EL->getDALError());
		    return $error;
		}
 	 	return $error;

	 }
	/*
	 * admin assigns partial access to doctors
	 * parameter(s) passed : result set
	 * returns error object
	 */
	 function assignDBPartialAccessToAllDoctors(&$result, &$con)
	 {
	 	$error = new Error();
		$sqlUpdate = "UPDATE Doctor SET Status = 'NEW'";
		//execute update query
		$rows_affected = 0;
		$error = $this->mySQL->executeUpdate($con, $sqlUpdate, $rows_affected);
		if($error->isError())
		{
			$error->setError(0, "Unable to update the record", $error->EL->getDALError());
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
		    $query = new QueryBuilder(" Doctor ");
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
	 * retrieves the records from courses table
	 * whose end date is greater than current date
	 * parameter(s) passed : result set, connection object
	 * returns error object
	 */
	 function viewDBActiveCoursesList(&$result, &$con)
	 {
	 	$error = new Error();
	 	$query = new QueryBuilder("CMECourses");
	 	$condition = " LastDate_App >= curdate() ";
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
 	 * gets list of active courses count
	 *
 	 */
 	function viewActiveCoursesListCount(&$con, &$count)
 	{
 		$error = new Error();
		$query = new QueryBuilder("CMECourses");
 		$error->module ="(DAC)getDBDocActiveCoursesCount";
 		$condition = " LastDate_App >= curdate() ";
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
 	 * gets active courses list
	 * with limits from database
 	 */
 	function viewDBActiveCoursesListWithLimits(&$con, &$result, $from, $pagecount)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("CMECourses");
 		$condition = " LastDate_App >= curdate() ";
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
	 * retrieves the records from courses table
	 * whose end date is less than current date
	 * parameter(s) passed : result set, connection object
	 * returns error object
	 */
	 function viewDBArchivedCoursesList(&$result, &$con)
	 {
	 	$error = new Error();
	 	$query = new QueryBuilder("CMECourses");
	 	$condition = " LastDate_App < curdate() ";
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
 	 * gets list of active courses count
	  *
 	 */
 	function viewArchivedCoursesListCount(&$con, &$count)
 	{
 		$error = new Error();
		$query = new QueryBuilder("CMECourses");
 		$condition = " LastDate_App < curdate() ";
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
 	 * gets active courses list
	 * with limits from database
 	 */
 	function viewDBArchivedCoursesListWithLimits(&$con, &$result, $from, $pagecount)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("CMECourses");
 		$condition = " LastDate_App < curdate() ";
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
 	 * gets list of active courses count
	  * to be attended or being attended by the doc  frm database
 	 */
 	function getDBDocActiveCoursesCount(&$con, &$count, &$id)
 	{
 		$error = new Error();

 		$error->module ="(DAC)getDBDocActiveCoursesCount";
 		$sqlSelect = "SELECT COUNT(*) FROM CMECourses C, AppliedCourses A WHERE ".
 					  "A.DoctorId = '".$id ."'AND ".
					   "A.CourseId = C.CourseId AND C.CourseStartDate >= curdate() ".
					     " AND A.BookStatus = 'BOOKED'";

		$error = $this->mySQL->executeScalar($con, $sqlSelect, $count);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
 	}

 	 /*
 	 * gets list of active courses
	  * to be attended or being attended by the doc with limits frm database
 	 */
 	function getDBDocActiveCoursesWithLimits(&$con, &$result, $from, $pagecount, &$id)
 	{
 		$error = new Error();

 		$error->module ="(DAC)getDBDocActiveCoursesWithLimits";
		$fromLm= ($from - 1) * $pagecount;
 		$sqlSelect = "SELECT C.CourseId, C.CourseTitle, C.Speciality, C.CourseStartDate, ".
 					  " C.CourseEndDate , C.CourseFee, C.CMECredits FROM CMECourses C, AppliedCourses A WHERE ".
 					  " A.DoctorId = '".$id ."' AND ".
					   " A.CourseId = C.CourseId AND C.CourseStartDate >= curdate() ".
					   " AND A.BookStatus = 'BOOKED'".
					   " LIMIT " . $fromLm .", " . $pagecount;
 		$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
 	}
 	 /*
 	 * gets list of active courses count
	  * to be attended or being attended by the doc  frm database
 	 */
 	function getDBDocArchivedCoursesCount(&$con, &$count, &$id)
 	{
 		$error = new Error();

 		$error->module ="(DAC)getDBDocArchivedCoursesCount";
 		$sqlSelect = "SELECT COUNT(*) FROM CMECourses C, AppliedCourses A WHERE ".
 					  "A.DoctorId = ".$id ." AND ".
					   " A.CourseId = C.CourseId AND ".
					   " C.CourseEndDate <= curdate() AND A.BookStatus = 'BOOKED'";
		$error = $this->mySQL->executeScalar($con, $sqlSelect, $count);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
 	}

 	 /*
 	 * gets list of active courses
	  * to be attended or being attended by the doc with limits frm database
 	 */
 	function getDBDocArchivedCoursesWithLimits(&$con, &$result, $from, $pagecount, &$id)
 	{
 		$error = new Error();

 		$error->module ="(DAC)getDBDocArchivedCoursesWithLimits";
		$fromLm = ($from - 1) * $pagecount;
 		$sqlSelect = "SELECT C.CourseId, C.CourseTitle, C.Speciality, C.CourseStartDate, ".
 					  " C.CourseEndDate , C.CourseFee, C.CMECredits FROM CMECourses C,           AppliedCourses A WHERE A.DoctorId = ".$id ." AND A.CourseId = C.CourseId AND C.CourseEndDate <= curdate() AND A.BookStatus = 'BOOKED' LIMIT " . $fromLm .", " . $pagecount;
 		$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
 	}
	 /*
 	 * gets doctors' contacts count
	 * from database
 	 */
 	function getDBContactsCount(&$con, &$count)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("DoctorContacts");
 		$condition = " Status = 'ACTIVE' ";
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
 	 * gets doctors' contacts
	 * with limits from database
 	 */
 	function getDBContactsWithLimits(&$con, &$result, $from, $pagecount)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("DoctorContacts");
 		$condition = " Status = 'ACTIVE' ";
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
	   * sets the status of doctor contact
	   * as 'closed'(contacted)
	   */
	   function closeDBContact(&$con, &$id)
	   {
	   		$error = new Error();
	  		$sqlUpdate = "UPDATE DoctorContacts SET Status = 'CLOSED' WHERE ".
	  					  " DoctorContactId = '". $id . "'";
			//execute update query
			$rows_affected = 0;
			$error = $this->mySQL->executeUpdate($con, $sqlUpdate, $rows_affected);
			if($error->isError())
			{
				$error->setError(0, "Unable to update the record", $error->EL->getDALError());
			    return $error;
			}
	  		if($error->isError())
	 		{
	 			return $error;
	 		}
			return $error;
	   }
	 /*
 	 * gets referrals count
	 * from database
 	 */
 	function getDBReferralsCount(&$con, &$count)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("Referrals");
 		$condition = " Status = 'ACTIVE' ";
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
 	 * gets referrals
	 * with limits from database
 	 */
 	function getDBReferralsWithLimits(&$con, &$result, $from, $pagecount)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("Referrals");
 		$condition = " Status = 'ACTIVE' ";
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
	   * sets the status of referral
	   * as 'closed'(contacted)
	   */
	   function closeDBReferral(&$con, &$id)
	   {
	   		$error = new Error();
	  		$sqlUpdate = "UPDATE Referrals SET Status = 'CLOSED' WHERE ".
	  					  " ReferralId = '". $id . "'";
			//execute update query
			$rows_affected = 0;
			$error = $this->mySQL->executeUpdate($con, $sqlUpdate, $rows_affected);
			if($error->isError())
			{
				$error->setError(0, "Unable to update the record", $error->EL->getDALError());
			    return $error;
			}
	  		if($error->isError())
	 		{
	 			return $error;
	 		}
			return $error;
	   }
	 /*
	    * gets user name password of user
	    */
	   function getDBUserNamePassword(&$con, $email, &$result)
	   {
	   		$error = new Error();
	  		$query = new QueryBuilder("Users");
	  		$fieldList = " UserName, Password ";
	  		$query->setFieldList($fieldList);
	  		$condition = " EmailId = '" . $email . "' ";
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
	    * adds the remarks for referral
	    */
	   function updateDBReferralRemarks(&$con, &$referral)
	   {
	   		$error = new Error();
	   		$sqlUpdate = "UPDATE Referrals SET Remarks = '". $referral->remarks . "' WHERE ".
	  					  " ReferralId = '". $referral->referralId . "'";
			//execute update query
			$rows_affected = 0;
			$error = $this->mySQL->executeUpdate($con, $sqlUpdate, $rows_affected);
			if($error->isError())
			{
				$error->setError(0, "Unable to update the record", $error->EL->getDALError());
			    return $error;
			}
	  		return $error;
	   }
	    /*
	    * adds the remarks for contact
	    */
	   function updateDBContactRemarks(&$con, &$contact)
	   {
	   		$error = new Error();
	   		echo "in dal id : " . $contact->contactId;
	   		$sqlUpdate = "UPDATE DoctorContacts SET Remarks = '". $contact->remarks . "' WHERE ".
	  					  "DoctorContactId = '". $contact->contactId . "'";
			//execute update query
			$rows_affected = 0;
			$error = $this->mySQL->executeUpdate($con, $sqlUpdate, $rows_affected);
			if($error->isError())
			{
				//$error->setError(0, "Unable to update the record", $error->EL->getDALError());
			    return $error;
			}
			return $error;
	   }
	    /*
 	 * gets transactions count
	 * from database
 	 */
 	function getTransactionsCount(&$con, &$count)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("TransactionTable");
 		$sqlSelect = $query->generateQueryCount();
 		$error = $this->mySQL->executeScalar($con, $sqlSelect, $count);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
 	}
	 /*
 	 * gets transactions
	 * with limits from database
 	 */
 	function getDBTransactionsWithLimits(&$con, &$result, $from, $pagecount)
 	{
 		$error = new Error();
 		$query = new QueryBuilder("TransactionTable");
 		$sqlSelect = $query->generateQueryWithLimit($from, $pagecount);
		$error = $this->mySQL->executeQuery($result , $con, $sqlSelect);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
 	}
 	/*
	 * gets transaction details of transaction id
	 * parameters passed : transaction id, resultset
	 * returns error object
	 */
	 function getDBTransactionDetails(&$con, &$id, &$result)
	 {
	 	$error = new Error();
 		$query = new QueryBuilder("TransactionTable");
	 	$condition = " TransactionId = '" . $id . "'";
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
 		 * updates the book status of applied course
 		 * parameters passed : con object, booking id, status
 		 * returns error object
 		 */
 		 function updateDBBookingDetails(&$con, &$bid, &$status)
 		 {
 		 	$error = new Error();
 		 	$sqlUpdate = "UPDATE AppliedCourses SET BookStatus = '" . $status . "'".
 		 				  " WHERE BookingId = " . $bid;
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
	* gets the name of the doctor
	*/
	function getDBDocName(&$con, &$id, &$result)
	{
		$error = new Error();
 		$query = new QueryBuilder("Doctor");
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
 		$query = new QueryBuilder("AppliedCourses");
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
	 		$query = new QueryBuilder("Doctor");
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
       function getDBBookedCourseId(&$con,&$id, &$result)
      {
      		$error = new Error();
	 		$query = new QueryBuilder("AppliedCourses");
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
       * deletes the record in Applied Courses
       * following failed transaction
       */
       function deleteDBBookingDetails(&$bid, &$con)
       {
	       $error = new Error();
 			$sqlDelete = "DELETE FROM AppliedCourses WHERE BookingId = " . $bid;
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
