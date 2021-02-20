<?php
/*
 * 	Created on Dec 11, 2006
 *	author Poornima Kamatgi
 * 	this is business access layer class
 * 	this acts as interface between
 * 	user interface and data access layer class
 * 	returns result set to page class
 *
 * 	revised on Jan 18, 2007(added error handling code)
 * 	revised on Apr 5, 2007(added explaination of each function)
 * 	revised on Sep 12, 2007(added revised error handling)
 * 	revised on Sep 27, 2007(changed the code in registerDoctor and registerCMEProvider functions)
 */
 require_once("class.DAL.php");
 require_once("class.phpDate.php");

 class BAL
 {
 	var $con;
 	var $dal;
 	var $error;


 	/*BAL Constructor
 	 * declares DBConnection object and calls connect method
 	 * to get the linkId of datbase connection
 	 * declares DAL object
 	 * declares Error object
 	 * no parameters passed
 	 * returns no values
 	 */
 	function BAL()
 	{
 		$this->EL = new ErrorLevel();
		$this->con = new MYSQLConnection();
		$err = $this->con->connect();

  	}
 	/*
 	 * checks the dup entries for username
 	 * in doc reg form
 	 * Parameter(s) passed : user name of doctor
 	 * returns error object
 	 *
 	 */
 	 function checkDocDupEntriesForUserName(&$userName, &$dupVal)
 	 {
 	 	$error = new Error();
	 	$dal = new DAL();
	 	$error = $dal->checkDBDocDupEntriesForUserName($userName, $dupVal, $this->con->conlink);
	 	if($error->isError())
		{
			return $error;
		}
		return $error;
 	 }
 	 /*
 	 * checks the dup entries for email id
 	 * in doc reg form
 	 * Parameter(s) passed : email id of doctor
 	 * returns error object
 	 *
 	 */
 	 function checkDocDupEntriesForEmailId(&$email, &$dupVal)
 	 {
 	 	$error = new Error();
	 	$dal = new DAL();
	 	$error = $dal->checkDBDocDupEntriesForEmailId($email, $dupVal, $this->con->conlink);
	 	if($error->isError())
		{
			return $error;
		}
		return $error;
 	 }
 	/*
 	 * registers the doctor by inserting the form information
 	 * in doctor table
 	 * Parameter(s) passed : Model object of doctor
 	 * returns error object
 	 *
 	 */
 	function registerDoctor(&$doctor)
 	{
	 	$error = new Error();
	 	$dal = new DAL();
	 	$error = $dal->insertDoctor($this->con->conlink, $doctor);
		if($error->isError())
		{
			return $error;
		}
	 	return $error;
 	}
	 /*
 	 * checks the dup entries for email id
 	 * in email us form
 	 * Parameter(s) passed : email id of doctor
 	 * returns error object
 	 *
 	 */
 	 function checkDocContactDupEntriesForEmailId(&$email, &$dupVal)
 	 {
 	 	$error = new Error();
	 	$dal = new DAL();
	 	$error = $dal->checkDBDocContactDupEntriesForEmailId($email, $dupVal, $this->con->conlink);
	 	if($error->isError())
		{
			return $error;
		}
		return $error;
 	 }
 	/*
 	 * registers the doctor by inserting the form information
 	 * in doctor contacts table
 	 * Parameter(s) passed : Model object of doctor contact
 	 * returns error object
 	 *
 	 */
 	function registerDocContact(&$docContact)
 	{
	 	$error = new Error();
	 	$dal = new DAL();
	 	$error = $dal->insertDocContact($this->con->conlink, $docContact);
		if($error->isError())
		{
			return $error;
		}
	 	return $error;
 	}
	/*
 	 * checks the dup entries for email id
 	 * in Referrals table
 	 * Parameter(s) passed : email id of doctor
 	 * returns error object
 	 *
 	 */
 	 function checkReferralDupEntriesForEmailId(&$email, &$dupVal)
 	 {
 	 	$error = new Error();
	 	$dal = new DAL();
	 	$error = $dal->checkDBReferralDupEntriesForEmailId($email, $dupVal, $this->con->conlink);
	 	if($error->isError())
		{
			return $error;
		}
		return $error;
 	 }
 	/*
 	 * registers the referral by inserting the form information
 	 * in Referrals table
 	 * Parameter(s) passed : Model object of referral
 	 * returns error object
 	 *
 	 */
 	function registerReferral(&$referral)
 	{
	 	$error = new Error();
	 	$dal = new DAL();
	 	$error = $dal->insertReferral($this->con->conlink, $referral);
		if($error->isError())
		{
			return $error;
		}
	 	return $error;
 	}
 	/*
 	 * checks the dup entries for username
 	 * in cme provider reg form
 	 * Parameter(s) passed : user name of cme provider
 	 * returns error object
 	 *
 	 */
 	 function checkCMEPDupEntriesForUserName(&$userName, &$dupVal)
 	 {
 	 	$error = new Error();
	 	$dal = new DAL();
	 	$error = $dal->checkDBCMEPDupEntriesForUserName($userName, $dupVal, $this->con->conlink);
	 	if($error->isError())
		{
			return $error;
		}
		return $error;
 	 }
 	 /*
 	 * checks the dup entries for email id
 	 * in cme provider reg form
 	 * Parameter(s) passed : email id of cme provider
 	 * returns error object
 	 *
 	 */
 	 function checkCMEPDupEntriesForEmailId(&$email, &$dupVal)
 	 {
 	 	$error = new Error();
	 	$dal = new DAL();
	 	$error = $dal->checkDBCMEPDupEntriesForEmailId($email, $dupVal, $this->con->conlink);
	 	if($error->isError())
		{
			return $error;
		}
		return $error;
 	 }
 	/*
 	 * registers the cme provider by inserting the form information
 	 * in cmeprovider table
 	 * Parameter(s) passed : Model object of cme provider
 	 * returns error object
 	 */
 	function registerCMEProvider(&$CMEProvider)
 	{
 		$error = new Error();
	 	$dal = new DAL();
	 	$error = $dal->insertCMEProvider($this->con->conlink, $CMEProvider);
		if($error->isError())
		{
			return $error;
		}
	 	return $error;
 	}
 	/*
 	 *  inserts cme course details in cmecourses table
 	 * by a registered cmeprovider
 	 * after checking the course start date is less than end date
 	 * and last date for application is less than start date
 	 * Parameter(s) passed : Model object of course
 	 * returns error object
 	 */
 	function addCMECourse(&$course)
 	{
 		$error = new Error();
	 	$dal = new DAL();
	 	$temp1 = explode("/", $course->courseDate->courseStartDate);
	 	$startDate = mktime(0,0,0, $temp1[0],$temp1[1],$temp1[2]);
	 	$temp2 = explode("/", $course->courseDate->courseEndDate);
	 	$endDate = mktime(0,0,0, $temp2[0],$temp2[1],$temp2[2]);
	 	$temp3 = explode("/", $course->courseDate->lastDateForApp);
	 	$lastDate = mktime(0,0,0, $temp3[0],$temp3[1],$temp3[2]);
 		if($startDate < $endDate)
 		{
 			if($lastDate < $startDate)
 			{
 				$course->CMEId = $_SESSION["UserId"];
 				$course->status = "NEW";
 				$error = $dal->addNewCMECourse($this->con->conlink, $course);
 			}
 			else
 			{
 				$error->setError(0, "last date must be less than start date", $error->EL->getBALError());
 				return $error;
 			}
 		}
 		else
 		{
 			$error->setError(0,"start date must be less than end date", $error->EL->getBALError());
 			return $error;
 		}
 		return $error;
	}
	/*
	 * Checks login name name and password
	 * of doctor against the doctor table fields
	 * for the same
	 * Parameter(s) passed : empty rowset, username and password of Login Model object of doctor
	 * returns error object
	 */
  	function loginCheckDoctor(&$result, &$userName, &$password)
 	{
 		$error = new Error();
	 	$dal = new DAL();
 		//$error->module = "(BAL)LoginCheckDoctor";
 		$error = $dal->checkDoctor($this->con->conlink, $result, $userName, $password);
 		return $error;
 	}

 	/*
 	 * Checks login name name and password
	 * of cme provider against the cme provider table fields
	 * for the same
	 * Parameter(s) passed : empty rowset, username and password of Login Model object of cme provider
	 * returns error object
	 */
 	function loginCheckCMEProvider(&$result, &$userName, &$password)
 	{
 		$error = new Error();
	 	$dal = new DAL();
 		//$error->module = "(BAL)LoginCheckCMEProvider";
 		$error = $dal->checkCMEProvider($this->con->conlink, $result, $userName, $password);
 		return $error;
 	}
  	/*
  	 * gets list of values from sex table
  	 * from database for select list of sexes in forms
  	 * Parameter(s) passed : array object
	 * returns error object
  	 */
 	function getComboSexList(&$arr)
 	{
 		$error = new Error();
	 	$sexArray = array(
						array("F", "FEMALE"),
						array("M", "MALE")
						);
 		foreach($sexArray as $sex)
 		{
 			$arr[] = $sex;
 		}
 		return $error;
 	}

 	/*
  	 * gets list of values from states table
  	 * from database for select list of states in forms
  	 * Parameter(s) passed : array object
	 * returns error object
  	 */
 	function getComboStateList(&$arr)
 	{
		$error = new Error();
	 	$dal = new DAL();
		$error = $dal->getStateList($this->con->conlink, $arr);
		return $error;
 	}

 	/*
  	 * gets list of values from speciality table
  	 * from database for select list of specialities in forms
  	 * Parameter(s) passed : array object
	 * returns error object
  	 */
 	function getComboSpecialityList(&$arr)
 	{
		$error = new Error();
	 	$dal = new DAL();
		$error = $dal->getSpecialityList($this->con->conlink, $arr);
		return $error;
	}

	/*
  	 * gets list of values from paymentmodes table
  	 * from database for select list of paymentmodes in bookcourse form
  	 * Parameter(s) passed : array object
	 * returns error object
  	 */
	function getComboPaymentModeList(&$arr)
 	{
		$error = new Error();
	 	$dal = new DAL();
		$error = $dal->getPaymentModeList($this->con->conlink, $arr);
		return $error;
	}

	/*
  	 * gets cme course search results for doctor
  	 * if the course start date and end date fall in range
  	 * and the speciality, city , state and keywords
  	 * specified in the search form
  	 * Parameter(s) passed : Model object of course and resultset
  	 * returns error object
  	 */
	function getCMECourseSearchResultsForDoctor(&$course, &$result)
	{
		//$error->module = "(BAL)getCMECourseSearchResultsForDoctor";
		$error = new Error();
	 	$dal = new DAL();
	 	if($course->courseDate->courseStartDate != "" && $course->courseDate->courseEndDate != "")
	 	{
			$temp1 = explode("/", $course->courseDate->courseStartDate);
			$startDate = mktime(0,0,0, $temp1[0],$temp1[1],$temp1[2]);
			$temp2 = explode("/", $course->courseDate->courseEndDate);
			$endDate = mktime(0,0,0, $temp2[0],$temp2[1],$temp2[2]);

			if($startDate < $endDate)
			{
				$error = $dal->getDBCMECourseSearchResultsForDoctor($this->con->conlink, $course, $result);
			}
			else
			{
				$error->setError(0, "Start date must be less than end date", $error->EL->getBALError());
				return $error;
			}
		}
		else
		{
			$error = $dal->getDBCMECourseSearchResultsForDoctor($this->con->conlink, $course, $result);
		}
		return $error;
	}
	/*
  	 * gets cme course search results for doctor
  	 * if the course start date and end date fall in range
  	 * and the speciality, city , state and keywords
  	 * specified in the search form with the limits specified
  	 * that is specified no. of search results are displayed per page
  	 * calls method to get the total no. of rows with the search criteria
  	 * for validation of limits
  	 * Parameter(s) passed : Model object of course,result set, from value(course index),
  	 *  pagecount(no of records to be displayed per page), count(get the total no. og records)
  	 * returns error object
  	 */
	function getCMECourseSearchResultsForDoctorWithLimits(&$course, &$result, &$from, $pagecount, &$count)
	{
		//$error->module = "(BAL)getCMECourseSearchResultsForDoctorWithLimits";
		$error = new Error();
	 	$dal = new DAL();
	 	if($course->courseDate->courseStartDate != "" && $course->courseDate->courseEndDate != "")
	 	{
			$temp1 = explode("/", $course->courseDate->courseStartDate);
			$startDate = mktime(0,0,0, $temp1[0],$temp1[1],$temp1[2]);
			$temp2 = explode("/", $course->courseDate->courseEndDate);
			$endDate = mktime(0,0,0, $temp2[0],$temp2[1],$temp2[2]);
			if($startDate < $endDate)
			{
				//Get the total count of the records
				$resCount=0;
				$error = $dal->getCMECourseSearchCountForDoctor($this->con->conlink, $course, $resCount);
				if ($error->isError())
				{
					$error->setError(0, "Unable to get the count of the records", $error->EL->getBALError());
					return $error;
				}

				$count=$resCount;

				//Validate the From value
				if($resCount != 0)
				{
					if($from > $resCount)
					{
						$error->setError(0, "Invalid Range", $error->EL->getBALError());
						return $error;
					}
					if($from < 0)
					{
						$error->setError(0, "Invalid Range", $error->EL->getBALError());
						return $error;
					}

					//Get the Records in the range.
					$error = $dal->getDBCMECourseSearchResultsForDoctorWithLimits($this->con->conlink, $course, $result, $from, $pagecount);
				}
			}
			else
			{
				$error->setError(0, "Start date must be less than end date", $error->EL->getBALError());
				return $error;
			}
		}
		else
		{
			$resCount=0;
			$error = $dal->getCMECourseSearchCountForDoctor($this->con->conlink, $course, $resCount);
			if ($error->isError())
			{
				$error->setError(0, "Unable to get the count of the records", $error->EL->getBALError());
				return $error;
			}
			$count=$resCount;
			//Validate the From value
			if($resCount != 0)
			{
				if($from > $resCount)
				{
					$error->setError(0, "Invalid Range", $error->EL->getBALError());
					return $error;
				}
				if($from < 0)
				{
					$error->setError(0, "Invalid Range", $error->EL->getBALError());
					return $error;
				}
				//Get the Records in the range.
				$error = $dal->getDBCMECourseSearchResultsForDoctorWithLimits($this->con->conlink, $course, $result, $from, $pagecount);
			}
		}
		return $error;
	}
	/*
  	 * gets archived cme courses for doctor
  	 * that is the courses whose coure end date
  	 * is less than current date
  	 * Parameter(s) passed : result set
  	 * returns error object
  	 */
	function getArchivedCoursesForDoctor(&$result)
	{
		//$error->module = "(BAL)getArchivedCoursesForDoctor";
		$error = new Error();
	 	$dal = new DAL();
	 	$doctorId = $_SESSION["UserId"];
	 	
		$error = $dal->getDBArchivedCoursesForDoctor($this->con->conlink, $result, $doctorId);
		return $error;
	}

	/*
  	 * gets archived cme courses for doctor
  	 * that is the courses whose coure end date
  	 * is less than current date with limits specified
  	 * calls method to get the total no. of records from table
  	 * for validation of limits
  	 * Parameter(s) passed : result set, from value(course index),
  	 * pagecount(no of records to be displayed per page), count(get the total no. og records)
  	 * returns error object
  	 */
	function getArchivedCoursesForDoctorWithLimits(&$result, &$from, $pagecount, &$count)
	{
		//$error->module = "(BAL)getArchivedCoursesForDoctorWithLimits";
		$error = new Error();
	 	$dal = new DAL();
	 	$doctorId = $_SESSION["UserId"];
		$resCount=0;
		$error = $dal->getDBArchivedCoursesCountForDoctor($this->con->conlink, $resCount, $doctorId);
		if ($error->isError())
		{
			return $error;
		}
		$count=$resCount;

		//Validate the From value
		if($resCount != 0)
		{
			if($from > $count)
			{
				$error->setError(0, "Invalid Range", $error->EL->getBALError());
				return $error;
			}
			if($from < 0)
			{
				$error->setError(0, "Invalid Range", $error->EL->getBALError());
				return $error;
			}
			//Get the Records in the range.
			
			$error = $dal->getDBArchivedCoursesForDoctorWithLimits($this->con->conlink, $result, $from, $pagecount, $doctorId);
		}
		return $error;
	}

	/*
	 * gets cme courses  registered by a cmeprovider
	 * in tabular form for viewing/editing
	 * Parameter(s) passed : result set, cme id from session
	 * returns error object
	 */
	function getCMECourseDetailsForCMEProvider(&$result,$CMEID)
	{
		//$error->module = "(BAL) getCMECourseDetails";
		$error = new Error();
	 	$dal = new DAL();
		$error = $dal->getDBCMECoursesForCMEProvider($this->con->conlink, $CMEID, $result);
		return $error;
	}
	/*
	 * gets a single cme course record with specified id
	 * 
	 * Parameter(s) passed : course id, resultset
	 * returns error objects
	 */
	function getCourseDetailsToView(&$result, &$id)
	{
		//$error->module = "(BAL)getEditCourseDetails";
		$error = new Error();
	 	$dal = new DAL();
		$error = $dal->getDBCourseDetailsToView($this->con->conlink, $id, $result);
		if($error->isError())
		{
			return $error;
		}
		return $error;
	}
	/*
	 * gets cme courses  registered by a cmeprovider
	 * in tabular form with limts for viewing/editing
	 * calls method to get the total no. of records
	 * for validation of limits
	 * Parameter(s) passed : result set, cme id from session, , from value(course index),
  	 * pagecount(no of records to be displayed per page), count(get the total no. og records)
	 * returns error object
	 */
	function getCMECourseDetailsForCMEProviderWithLimits(&$result, $CMEID, $from, $PageCount, &$count)
	{
		//$error->module = "(BAL) getCMECourseDetails";
		$error = new Error();
	 	$dal = new DAL();
		$CMEID = $_SESSION["UserId"];
		//Get the total count of the records
		$resCount=0;
		$error = $dal->getDBCMECoursesCountForCMEProvider($this->con->conlink,$CMEID,$resCount);
		if ($error->isError())
		{
			return $error;
		}

		$count=$resCount;

		//Validate the From value
		if($resCount != 0)
		{
			if($from > $count)
			{
				$error->setError(0, "Invalid Range", $error->EL->getBALError());
				return $error;
			}
			if($from < 0)
			{
				$error->setError(0, "Invalid Range", $error->EL->getBALError());
				return $error;
			}

		//Get the Records in the range.
		$error = $dal->getDBCMECoursesForCMEProviderWithLimits($this->con->conlink,$CMEID,$result, $from, $PageCount);
		}
		return $error;
	}
	/* checks the CME ID who is logged in
	 * has added the course to edit it
	 *
	 * parameter passed : CME Id, courseid, result object
	 * returns error object
	 */
	 function checkCMEId(&$CMEID, &$CourseId, &$result)
	 {
	 	//$error->module = "BAL - checkCMEId";
	 	$error = new Error();
	 	$dal = new DAL();
	 	$error = $dal->checkDBCMEId($this->con->conlink, $CMEID, $CourseId, $result);
	 	return $error;
	 }
	/*
	 * gets a single cme course record with specified id
	 * for editing
	 * Parameter(s) passed : course id, resultset
	 * returns error objects
	 */
	function getEditCourseDetails(&$id, &$result)
	{
		//$error->module = "(BAL)getEditCourseDetails";
		$error = new Error();
	 	$dal = new DAL();
		$error = $dal->getDBEditCourseDetails($this->con->conlink, $id, $result);
		if($error->isError())
		{
			return $error;
		}
		return $error;
	}
	/*
	 * gets a single cme course record with specified id
	 * for booking
	 * Parameter(s) passed : course id, resultset
	 * returns error objects
	 */
	function getCourseDetails(&$id, &$result)
	{
		//$error->module = "(BAL)getEditCourseDetails";
		$error = new Error();
	 	$dal = new DAL();
		$error = $dal->getDBCourseDetails($this->con->conlink, $id, $result);
		if($error->isError())
		{
			return $error;
		}
		return $error;
	}

	/*
	 * updates the cmecourses table with values
	 * given in the edit form except courseid, course start date,
	 * course end date and email id
	 * Parameter(s) passed : Model object of course
	 * returns error object
	 */
	function updateCourseDetails(&$course)
	{
		//$error->module = "(BAL)updateCourseDetails";
		$error = new Error();
	 	$dal = new DAL();
	 	$temp1 = explode("/", $course->courseDate->lastDateForApp);
	 	$lastDate = mktime(0,0,0, $temp1[0],$temp1[1],$temp1[2]);
	 	$temp2 = explode("/", $course->courseDate->courseStartDate);
	 	$startDate = mktime(0,0,0, $temp2[0],$temp2[1],$temp2[2]);
		if($lastDate < $startDate)
		{
			$error = $dal->updateCMECourseDetails($this->con->conlink, $course);
		}
		else
 		{
 			$error->setError(0, "Last date must be less than start and end dates", $error->EL->getBALError());
 			return $error;
 		}
 		return $error;
	}

	/*
	 * books the cme course for doctor
	 * and inserts booking details with values
	 * in booking course form in applied courses table
	 * calls addTransaction method in case of successful
	 * payment of course
	 * Parameter(s) passed : Model object of applied course
	 * returns error object
	 */
	function bookCMECourse(&$appliedCourse, &$Id)
	{
		//$error->module = "(BAL)bookCMECourse";
		$error = new Error();
	 	$dal = new DAL();
		$appliedCourse->doctorId = $_SESSION["UserId"];
		$appliedCourse->agentId = "";
		$appliedCourse->bookStatus = "PENDING";
		$error = $dal->bookCourse($this->con->conlink, $appliedCourse, $Id);
		if($error->isError())
		{
			return $error;
		}
		
		return $error;
	}

	/*
	 * adds transactions details in view of
	 * successful booking of course
	 * Parameter(s) passed : Model object of applied course
	 * returns error object
	 */
	function addTransaction(&$transaction)
	{
		//$error->module = "(BAL)addTransaction";
		$error = new Error();
	 	$dal = new DAL();
		$error = $dal->addTransactionDetails($this->con->conlink, $transaction);
		return $error;
	}

	/*
	 * gets the cme course details applied by the doctor
	 * parameters passed : doctor id, result set
	 * returns error object
	 */
	 function getAppliedCourseSummaryForDoctor($doctorId, &$result)
	 {
	 	$error = "(BAL)getAppliedCourseSummaryForDoctor";
	 	$error = $dal->getDBAppliedCourseSummaryForDoctor($this->con->conlink, $doctorId, $result);
	 	return $error;
	 }

	 /*
	 * gets the cme course details applied by the doctor with limits
	 * calls method to get total no. of cme courses
	 * parameters passed : doctor id, result set, from, pagecount, count
	 * returns error object
	 */
	 function getAppliedCourseSummaryForDoctorWithLimits($doctorId, &$result, $from, $pagecount, &$count)
	 {
	 	//$error = "(BAL)getAppliedCourseSummaryForDoctorWithLimts";
	 	$error = new Error();
	 	$dal = new DAL();
	 	$resCount=0;
	 	$error = $dal->getDBAppliedCourseCountForDoctor($this->con->conlink, $doctorId, $resCount);
	 	if ($error->isError())
		{
			return $error;
		}
		$count=$resCount;
		//Validate the From value
		if($resCount != 0)
		{
			if($from > $count)
			{
				$error->setError(0, "Invalid Range", $error->EL->getBALError());
				return $error;
			}
			if($from < 0)
			{
				$error->setError(0, "Invalid Range", $error->EL->getBALError());
				return $error;
			}
			//Get the Records in the range.
		 	$error = $dal->getDBAppliedCourseSummaryForDoctorWithLimits($this->con->conlink, $doctorId, $result, $from, $pagecount);
		}
	 	return $error;
	 }

	 /*
	  gets the cme course details booked by the doctors for cme provider
	 * calls method to get total count of cme courses booked by doctors
	 * parameters passed : doctor id, result set, from, pagecount, count
	 * returns error object
	  */
	  function getRegisteredCourseSummaryForCMEProvider($cmeId, &$result)
	  {
	  	//$error->module = "(BAL)getRegisteredCourseSummaryForCMEProvider";
	  	$error = new Error();
	 	$dal = new DAL();
	  	$error = $dal->getDBRegisteredCourseSummaryForCMEProvider($this->con->conlink, $cmeId, $result);
	  	return $error;
	  }

	 /*
	 * gets the cme course details booked by the doctors for cme provider with limits
	 * calls method to get total count of cme courses booked by doctors
	 * parameters passed : doctor id, result set, from, pagecount, count
	 * returns error object
	 */
	  function getRegisteredCourseSummaryForCMEProviderWithLimits($cmeId, &$result, $from, $pagecount, &$count)
	  {
	  	//$error = "(BAL)getAppliedCourseSummaryForCMEProviderWithLimts";
	  	$error = new Error();
	 	$dal = new DAL();
	 	$resCount=0;
	 	$error = $dal->getDBRegisteredCourseCountForCMEProvider($this->con->conlink, $cmeId, $resCount);
	 	if ($error->isError())
		{
			return $error;
		}

		$count=$resCount;
		//Validate the From value
		if($resCount != 0)
		{
			if($from > $count)
			{
				$error->setError(0, "Invalid Range", $error->EL->getBALError());
				return $error;
			}
			if($from < 0)
			{
				$error->setError(0, "Invalid Range", $error->EL->getBALError());
				return $error;
			}
			//Get the Records in the range.
		 	$error = $dal->getDBRegisteredCourseSummaryForCMEProviderWithLimits($this->con->conlink, $cmeId, $result, $from, $pagecount);
		}
	 	return $error;
	  }
	  /*
	   * updates the book status in applied
	   * courses table(BOOKED/FAILED)
	   * parameters passed : booking id,status
	   * returns error object
	   */
	   function updateBookingDetails($bid, $status)
	   {
	   		$error = new Error();
	   		$dal = new DAL();
	   		$error = $dal->updateDBBookingDetails($this->con->conlink, $bid, $status);
	   		if($error->isError())
	   		{
	   			return $error;
	   		}
	   		return $error;
	   }
	   /*
	   * retrieves the status of the doctor
	   * parameters passed : access var
	   * returns error object
	  */
	  function getAccessOfDoctor(&$access)
	  {
	  		$error = new Error();
		   	$dal = new DAL();
		   	$doctorId = $_SESSION["UserId"];
		   	$error = $dal->getDBAccessOfDoctor($this->con->conlink, $doctorId, $access);
		   	if($error->isError())
	 		{
	 			return $error;
	 		}
			return $error;
	  }
	  function getCMECourseSearchCount(&$course, &$resCount)
	  {
		$error = new Error();
		$dal = new DAL();
		if($course->courseDate->courseStartDate != "" &&  $course->courseDate->courseEndDate != "")
		{
			$temp1 = explode("/", $course->courseDate->courseStartDate);
	 		$startDate = mktime(0,0,0, $temp1[0],$temp1[1],$temp1[2]);
	 		$temp2 = explode("/", $course->courseDate->courseEndDate);
	 		$endDate = mktime(0,0,0, $temp2[0],$temp2[1],$temp2[2]);
	 		if($startDate < $endDate)
			{

				//Get the total count of the records
				$error = $dal->getCMECourseSearchCountForDoctor($this->con->conlink, $course, $resCount);
				if($error->isError())
				{
					return $error;
				}

			}
			else
			{

				$error->setError(0, "Start date must be less than end date", $error->EL->getBALError());
				return $error;
			}
		}
		else
		{
			$error = $dal->getCMECourseSearchCountForDoctor($this->con->conlink, $course, $resCount);
			if($error->isError())
			{
				return $error;
			}
		}
		return $error;
	 }
	/*
     * gets user name and password of doctor
     */
     function getUserNamePasswordDoc($emailId, &$result)
     {
     	$error = new Error();
	 	$dal = new DAL();
	 	$error = $dal->getDBUserNamePasswordDoc($this->con->conlink, $emailId, $result);
		if($error->isError())
		{
			return $error;
		}
	 	return $error;
     }
     /*
     * gets user name and password of cmeprovider
     */
     function getUserNamePasswordCMEP($emailId, &$result)
     {
     	$error = new Error();
	 	$dal = new DAL();
	 	$error = $dal->getDBUserNamePasswordCMEP($this->con->conlink, $emailId, $result);
		if($error->isError())
		{
			return $error;
		}
	 	return $error;
     }
    /*
     * gets  name  of doctor
     */
     function getDocName(&$id,&$result)
     {
     		$error = new Error();
	 	$dal = new DAL();
	 	$error = $dal->getDBDocName($this->con->conlink, $id, $result);
		if($error->isError())
		{
			return $error;
		}
	 	return $error;
     }
     /*
     * gets booking id confirmation
     */
     function confirmBookingId(&$bid, &$result)
     {
     	$error = new Error();
	 	$dal = new DAL();
	 	$error = $dal->confirmDBBookingId($this->con->conlink, $bid, $result);
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
      function getDocEmailId($id, &$result)
      {
      		$error = new Error();
		 	$dal = new DAL();
		 	$error = $dal->getDBDocEmailId($this->con->conlink, $id, $result);
			if($error->isError())
			{
				return $error;
			}
		 	return $error;
      }
      /*
       * get course id from applied courses table
       */
       function getBookedCourseId($id, &$result)
      {
      		$error = new Error();
		 	$dal = new DAL();
		 	$error = $dal->getDBBookedCourseId($this->con->conlink, $id, $result);
			if($error->isError())
			{
				return $error;
			}
		 	return $error;
      }
      
       /*
       * get doctor details
       */
       function getDoctorDetails($id, &$result)
      {
      		$error = new Error();
		 	$dal = new DAL();
		 	$error = $dal->getDBDoctorDetails($this->con->conlink, $id, $result);
			if($error->isError())
			{
				return $error;
			}
		 	return $error;
      }
       /*
	  * updates the Doctor details
	  * parameter passed : Model object of Doctor
	  * returns error object
	  */
	  function editDoctorDetails(&$Doctor)
	  {
	  	$error = new Error();
	  	$dal = new DAL();
	  	$error->module = "(BAL) editDBDoctorDetails";
	  	$error = $dal->editDBDoctorDetails($this->con->conlink, $Doctor);
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
 	 * parameters passed : doctor id of doctor,old password, empty value
 	 * returns error object
 	 */
 	 function checkDocPasswordExists($doctorId, &$password, &$dupVal)
 	 {
 	 	$error = new Error();
	 	$dal = new DAL();
	 	$error = $dal->checkDBDocPasswordExists($doctorId, $password, $dupVal, $this->con->conlink);
	 	if($error->isError())
		{
			return $error;
		}
		return $error;
 	 }
      /*
       * change doctor password
       */
       function resetDoctorPassword(&$doctor, $oldPass, $newPass)
      {
      		$error = new Error();
		 	$dal = new DAL();
		 	$error = $dal->resetDBDoctorPassword($this->con->conlink, $doctor, $oldPass, $newPass);
			if($error->isError())
			{
				return $error;
			}
		 	return $error;
      }
      /*
       * get CMEProvider details
       */
       function getCMEProviderDetails($id, &$result)
      {
      		$error = new Error();
		 	$dal = new DAL();
		 	$error = $dal->getDBCMEProviderDetails($this->con->conlink, $id, $result);
			if($error->isError())
			{
				return $error;
			}
		 	return $error;
      }
       /*
	  * updates the CMEProvider details
	  * parameter passed : Model object of CMEProvider
	  * returns error object
	  */
	  function editCMEProviderDetails(&$CMEProvider)
	  {
	  	$error = new Error();
	  	$dal = new DAL();
	  	$error = $dal->editDBCMEProviderDetails($this->con->conlink, $CMEProvider);
	  	if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	  }
	/*
 	 * this method checks the existence
 	 * of similar password in
 	 * cme provider table before updating  cmeprovider password
 	 * parameters passed : id of cme provider,old password, empty value
 	 * returns error object
 	 */
 	 function checkCMEPasswordExists($cmeId, &$password, &$dupVal)
 	 {
 	 	$error = new Error();
	 	$dal = new DAL();
	 	$error = $dal->checkDBCMEPasswordExists($cmeId, $password, $dupVal, $this->con->conlink);
	 	if($error->isError())
		{
			return $error;
		}
		return $error;
 	 }
      /*
       * change cmeprovider password
       */
       function resetCMEProviderPassword(&$cmeprovider, $oldPass, $newPass)
      {
      		$error = new Error();
		 	$dal = new DAL();
		 	$error = $dal->resetDBCMEProviderPassword($this->con->conlink, $cmeprovider, $oldPass, $newPass);
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
       function deleteBookingDetails($bid)
       {
	       	$error = new Error();
		 	$dal = new DAL();
		 	$error = $dal->deleteDBBookingDetails($bid, $this->con->conlink);
		 	if($error->isError())
			{
				return $error;
			}
			return $error;
 	 
       }
 }
?>
