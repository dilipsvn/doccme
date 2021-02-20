<?php
/*
 * Created on Mar 27, 2007
 *	author Poornima Kamatgi
 *
 * 	this is business access layer class
 * 	this acts as interface between
 * 	user interface and data access layer class
 * 	returns result set to page class
 * 
 *	revised on 14th Sep, 2007
 *	changed code for error handling
 */
 require_once("class.DAL.php");
 require_once("class.phpDate.php");
 class BAL
 {
 	var $con;
 	var $dal;
 	var $error;
 	
 	
 	/*
 	 * BAL Constructor
 	 * defines database connection object, DAL object, Error object
 	 * parameters passed : none
 	 * returns none
 	 */ 	
 	function BAL()
 	{
 		$this->EL = new ErrorLevel();
		$this->con = new MYSQLConnection();
		$err = $this->con->connect();
 		
  	}
 	
 	/*
 	 * checks the access right of agent
 	 */
 	 function checkAccessOfAgent($moduleId, &$result)
 	 {
 	 	$error = new Error();
 	 	//$error->module = "(BAL)checkAccessOfAgent";
 	 	$dal = new DAL();
 	 	$agentId = $_SESSION["UserId"];
 	 	$error = $dal->checkDBAgentAccess($this->con->conlink, $agentId, $moduleId, $result);
 	 	if($error->isError())
 	 	{
 	 		return $error;
 	 	}
 	 	return $error;
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
 	 * checks the dup entries for username
 	 * in agent reg form
 	 * Parameter(s) passed : user name of agent
 	 * returns error object
 	 * 
 	 */
 	 function checkAgentDupEntriesForUserName(&$userName, &$dupVal)
 	 {
 	 	$error = new Error();
	 	$dal = new DAL();
	 	$error = $dal->checkDBAgentDupEntriesForUserName($userName, $dupVal, $this->con->conlink);
	 	if($error->isError())
		{
			return $error;
		}
		return $error;
 	 }
 	 /*
 	 * checks the dup entries for email id
 	 * in agent reg form
 	 * Parameter(s) passed : email id of agent
 	 * returns error object
 	 * 
 	 */
 	 function checkAgentDupEntriesForEmailId(&$email, &$dupVal)
 	 {
 	 	$error = new Error();
	 	$dal = new DAL();
	 	$error = $dal->checkDBAgentDupEntriesForEmailId($email, $dupVal, $this->con->conlink);
	 	if($error->isError())
		{
			return $error;
		}
		return $error;
 	 }
 	/* 
 	 * registers the agent by inserting the form information
 	 * in users table
 	 * Parameter(s) passed : Model object of agent
 	 * returns error object
 	 * 
 	 */
 	function registerAgent(&$agent)
 	{
	 	$error = new Error();
	 	$dal = new DAL();
	 	$error = $dal->insertAgent($this->con->conlink, $agent);
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
 	
 	/*  inserts cme course details in cmecourses table
 	 * by a admin for registered cmeprovider
 	 * after checking the course start date is less than end date
 	 * and last date for application is less than start date
 	 * Parameter(s) passed : Model object of course
 	 * returns error object
 	 */
 	function addCMECourseForCMEProvider(&$course)
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
 				$course->status = "NEW";
				$error = $dal->addDBCMECourseForCMEProvider($this->con->conlink, $course);
 				if($error->isError())
				{
					return $error;
				}
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
 	 * gets cmeproviders as list
 	 */
 	function getComboCMEProviderList(&$arr)
 	{
 		$error = new Error();
 		$dal = new DAL();
 		$error = $dal->getCMEProviderList($this->con->conlink, $arr);
 		if($error->isError())
 		{
 			return $error;
 		}
 		return $error;
 	}
 	 
 	/*
 	 * get the records of sexes from DAL method
 	 * parameters passed :array of records
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
 	 * get the records of states from DAL method
 	 * parameters passed :array of records
 	 * returns error object
 	 */ 	
 	function getComboStateList(&$arr)
 	{
		$error = new Error();
		$dal = new DAL();
		$error = $dal->getStateList($this->con->conlink, $arr);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
 	}
 	
 	/*
 	 * get the records of user status from DAL method
 	 * parameters passed :array of records
 	 * returns error object
 	 */ 	
 	function getComboUserStatusList(&$arr)
 	{
		$error = new Error();
		$dal = new DAL();
		$error = $dal->getUserStatusList($this->con->conlink, $arr);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
 	}
	/*
 	 * displays the types of courses from array
 	 * parameters passed :array of records
 	 * returns error object
 	 */
 	function getComboCourseTypeList(&$arr)
 	{
 		$error = new Error();
 		$dal = new DAL();
	 	$error = $dal->getCourseTypeList($this->con->conlink, $arr);
		if($error->isError())
 		{
 			return $error;
 		}
 		return $error;
 	}
 	/*
 	 * get the records of course status from DAL method
 	 * parameters passed :array of records
 	 * returns error object
 	 */ 	
 	function getComboCourseStatusList(&$arr)
 	{
		$error = new Error();
		$dal = new DAL();
		$error = $dal->getCourseStatusList($this->con->conlink, $arr);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
 	}
 	/*
 	 * get the records of booking status from DAL method
 	 * parameters passed :array of records
 	 * returns error object
 	 */ 	
 	function getComboBookingStatusList(&$arr)
 	{
		$error = new Error();
		$dal = new DAL();
		$error = $dal->getBookingStatusList($this->con->conlink, $arr);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
 	}
 	
 	/*
 	 * get the records of speciality from DAL method
 	 * parameters passed :array of records
 	 * returns error object
 	 */
 	function getComboSpecialityList(&$arr)
 	{
		$error = new Error();
		$dal = new DAL();
		$error = $dal->getSpecialityList($this->con->conlink, $arr);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	}	
	
	/*
 	 * get the records of paymentmodes from DAL method
 	 * parameters passed :array of records
 	 * returns error object
 	 */
	function getComboPaymentModeList(&$arr)
 	{
		$error = new Error();
		$dal = new DAL();
		$error = $dal->getPaymentModeList($this->con->conlink, $arr);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	}	
	
	/*
	 * gets agent id and name to populate user list
	 * parameters passed:array
	 * returns error object
	 */
	 function getComboUserList(&$arr)
 	{
		$error = new Error();
		$dal = new DAL();
		$error = $dal->getUserList($this->con->conlink, $arr);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	}
		
	/*
	 * checks login details of admin/agent
	 */
	 function checkLoginDetails(&$result, $userName, $password)
	 {
	 	$error = new Error();
	 	$dal = new DAL();
	 	$error->module = "(BAL) checkLoginDetails";
	  	$error = $dal->checkDBLoginDetails($this->con->conlink, $userName, $password, $result);
	 	if($error->isError())
 		{
 			return $error;
 		}
	 	return $error;
	 }
	 
	/*
	 * gets the list of cme providers from database
	 * based on search criteria sent
	 * parameters passed : Model object of CMEProvider, result set
	 * returns error object
	 */
	function getCMEProviderSearchResults(&$CMEProvider, &$result)
	{
		$error = new Error();
		$dal = new DAL();
		$error->module = "(BAL)getCMEProviderSearchResults";
		$error = $dal->getDBCMEProviderSearchResults($this->conlink, $CMEProvider, $result);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	}
	/*
	 * gets the list of cme providers from database with limits
	 * based on search criteria sent
	 * parameters passed : Model object of CMEProvider, result set, from value, page count, count
	 * returns error object
	 */
	function getCMEProviderSearchResultsWithLimits(&$CMEProvider, &$result, &$from, $pagecount, &$count)
	{
		$error1 = new Error();
		$dal = new DAL();
		$error->module = "(BAL)getCMEProviderSearchResultsWithLimits";
		$resCount=0;
		$error = $dal->getDBCMEProviderSearchResultsCount($this->con->conlink, $CMEProvider, $resCount);
		if ($error->isError())
		{
			return $error;			
		}
		
		$count=$resCount;
		//Validate the From value
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
		$error= $dal->getDBCMEProviderSearchResultsWithLimits($this->con->conlink, $CMEProvider, $result, $from, $pagecount);
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
	 function getCMEProviderDetails(&$id, &$result)
	 {
	 	$error = new Error();
	 	$dal = new DAL();
	 	$error->module = "(BAL)getCMEProviderDetails";
	 	$error = $dal->getDBCMEProviderDetails($this->con->conlink, $id, $result);
	 	if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	 }
	 
	 /*
	  * updates the cme provider details
	  * parameter passed : Model object of CMEProvider
	  * returns error object
	  */
	  function editCMEProviderDetails(&$CMEProvider)
	  {
		$error = new Error();
		$dal = new DAL();
	  	$error->module = "(BAL) editDBCMEProviderDetails";
	  	$error = $dal->editDBCMEProviderDetails($this->con->conlink, $CMEProvider);
	  	if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	  }
	  
	  /*
	   * resets password of cme provider
	   * parameter passed : Model object of CME provider, new password
	   * returns error object
	   */
	   function resetCMEProviderPassword(&$CMEProvider, &$newPassword)
	   {
		 $error = new Error();
		 $dal = new DAL();
		 $error->module = "(BAL) resetCMEProviderPassword";
	  	 $error = $dal->resetDBCMEProviderPassword($this->con->conlink, $CMEProvider, $newPassword);
	  	 if($error->isError())
 		 {
 			return $error;
 		 }
		 return $error;
	   }
	   
	/* gets the list of Doctor from database
	 * based on search criteria sent
	 * parameters passed : Model object of Doctor, result set
	 * returns error object
	 */
	function getDoctorSearchResults(&$Doctor, &$result)
	{
		$error = new Error();
		$dal = new DAL();
		$error->module = "(BAL)getDoctorSearchResults";
		$error = $dal->getDBDoctorSearchResults($this->con->conlink, $Doctor, $result);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	}
	/*
	 * gets the list of Doctors from database with limits
	 * based on search criteria sent
	 * parameters passed : Model object of Doctor, result set, from value, page count, count
	 * returns error object
	 */
	function getDoctorSearchResultsWithLimits(&$Doctor, &$result, &$from, $pagecount, &$count)
	{
		$error = new Error();
		$dal = new DAL();
		$resCount=0;
		$error = $dal->getDBDoctorSearchResultsCount($this->con->conlink, $Doctor, $resCount);
		if ($error->isError())
		{
			return $error;			
		}
		$count=$resCount;
		//Validate the From value
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
		$error = $dal->getDBDoctorSearchResultsWithLimits($this->con->conlink, $Doctor, $result, $from, $pagecount);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	}
	
	/* gets the list of Doctor from database
	 * based on search criteria sent
	 * parameters passed : Model object of Doctor, result set
	 * returns error object
	 */
	function getDoctorSearchResults_2(&$Doctor, &$result)
	{
		$error = new Error();
		$error->module = "(BAL)getDoctorSearchResults";
		$error = $dal->getDBDoctorSearchResults_2($this->con->conlink, $Doctor, $result);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	}
	/*
	 * gets the list of Doctors from database with limits
	 * based on search criteria sent
	 * parameters passed : Model object of Doctor, result set, from value, page count, count
	 * returns error object
	 */
	function getDoctorSearchResultsWithLimits_2(&$Doctor, &$result, &$from, $pagecount, &$count)
	{
		$error = new Error();
		$dal = new DAL();
		$resCount = 0;
		$error = $dal->getDBDoctorSearchResultsCount_2($this->con->conlink, $Doctor, $resCount);
		if ($error->isError())
		{
			return $error;			
		}
		$count = $resCount;
		//Validate the From value
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
		$error = $dal->getDBDoctorSearchResultsWithLimits_2($this->con->conlink, $Doctor, $result, $from, $pagecount);
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
	 function getDoctorDetails(&$id, &$result)
	 {
	 	$error = new Error();
	 	$dal = new DAL();
	 	$error = "(BAL)getDoctorDetails";
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
	   * resets password of doctor
	   * parameter passed : Model object of Doctor, new password
	   * returns error object
	   */
	   function resetDoctorPassword(&$Doctor, &$newPassword)
	   {
	   	 $error = new Error();
	   	 $dal = new DAL();
	   	 $error->module = "(BAL) resetDoctorPassword";
	  	 $error = $dal->resetDBDoctorPassword($this->con->conlink, $Doctor, $newPassword);
	  	 if($error->isError())
 		 {
 			return $error;
 		 }
		 return $error;
	   }
	   
	   /* gets the list of Agents from database
	 * based on search criteria sent
	 * parameters passed : Model object of agent, result set
	 * returns error object
	 */
	function getAgentSearchResults(&$Agent, &$result)
	{
		$error = new Error();
		$error->module = "(BAL)getAgentSearchResults";
		$dal = new DAL();
		$error = $dal->getDBAgentSearchResults($this->conlink, $Agent, $result);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	}
	/*
	 * gets the list of Agents from database with limits
	 * based on search criteria sent
	 * parameters passed : Model object of Agent, result set, from value, page count, count
	 * returns error object
	 */
	function getAgentSearchResultsWithLimits(&$Agent, &$result, &$from, $pagecount, &$count)
	{
		$error = new Error();
		$dal = new DAL();
		$resCount=0;
		$error = $dal->getDBAgentSearchResultsCount($this->con->conlink, $Agent, $resCount);
		if ($error->isError())
		{
			return $error;			
		}
		
		$count = $resCount;
		
		//Validate the From value
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
		$error = $dal->getDBAgentSearchResultsWithLimits($this->con->conlink, $Agent, $result, $from, $pagecount);
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
	 function getAgentDetails(&$id, &$result)
	 {
	 	$error = new Error();
	 	//$error->module = "(BAL)getAgentDetails";
	 	$dal = new DAL();
	 	$error = $dal->getDBAgentDetails($this->con->conlink, $id, $result);
	 	if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	 }
	 
	 /*
	  * updates the Doctor details
	  * parameter passed : Model object of agent
	  * returns error object
	  */
	  function editAgentDetails(&$Agent)
	  {
	  	$error = new Error();
	  	//$error->module = "(BAL) editDBAgentDetails";
	  	$dal = new DAL();
	  	$error = $dal->editDBAgentDetails($this->con->conlink, $Agent);
	  	if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	  }
	  
	  /*
	   * resets password of doctor
	   * parameter passed : Model object of agent, new password
	   * returns error object
	   */
	   function resetAgentPassword(&$Agent, &$newPassword)
	   {
	   		$error = new Error();
	   		//$error->module = "(BAL) resetAgentPassword";
	   		$dal = new DAL();
	  		$error = $dal->resetDBAgentPassword($this->con->conlink, $Agent, $newPassword);
	  		if($error->isError())
 			{
 				return $error;
 			}
			return $error;
	   }
	  
	   /* 
	    * gets the details of admin/ agent for display
	    * parameters passed : result set
	    * returns error object
	    */
	   function getMyProfile(&$result)
	   {
	   		$error = new Error();
	   		//$error->module = "(BAL) getMyProfile";
	   		$dal = new DAL();
	   		$userId = $_SESSION["UserId"];
	   		$error = $dal->getDBMyProfile($this->con->conlink, $userId, $result);
	   		if($error->isError())
 			{
 				return $error;
 			}
			return $error;
	   } 
	   
	   /*
	    * get cme courses with status new 
	    * parameters passed : resutl set
	    * returns  error object
	    */
	    function getNewCMECourses(&$result)
		{
			$error = new Error();
			//$error->module = "(BAL)getNewCMECourses";
			$dal = new DAL();
			$error = $dal->getDBNewCMECourses($this->conlink, $result);
			if($error->isError())
	 		{
	 			return $error;
	 		}
			return $error;
		}
	/*
	  * get cme courses with status new with limit
	    * parameters passed : resutl set
	    * returns  error object
	 */
	function getNewCMECoursesWithLimits(&$result, &$from, $pagecount, &$count)
	{
		$error = new Error();
		$dal = new DAL();
		$resCount=0;
		$error = $dal->getDBNewCMECoursesCount($this->con->conlink, $resCount);
		if ($error->isError())
		{
			return $error;			
		}
		$count=$resCount;
		//Validate the From value
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
		$error= $dal->getDBNewCMECoursesWithLimits($this->con->conlink, $result, $from, $pagecount);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	}
	
	/*
	 * gets cme course details
	 */
	 function getCMECourseDetails(&$result, &$id)
	 {
	 	$error = new Error();
	 	//$error->module = "(BAL)getCMECourseDetails";
	 	$dal = new DAL(); 
		$error = $dal->getDBCMECourseDetails($this->con->conlink, $result, $id);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	 }
	/*
	 * updates course staus to approve
	 * parameters passed : model course
	 * returns error object
	 */
	 function approveCourse(&$course)
	 {
	 	$error = new Error();
	 	$dal = new DAL();
		$temp1 = explode("/", $course->courseDate->courseStartDate);
	 	$startDate = mktime(0,0,0, $temp1[0],$temp1[1],$temp1[2]);
	 	$temp3 = explode("/", $course->courseDate->lastDateForApp);
	 	$lastDate = mktime(0,0,0, $temp3[0],$temp3[1],$temp3[2]);
		if($lastDate < $startDate)
 		{
			$error = $dal->approveDBCourse($this->con->conlink, $course);
			if($error->isError())
 			{
 				return $error;
 			}
		}
		else
		{
			$error->setError(0, "Last date must be less than start and end dates", $error->EL->getBALError());
 			return $error;
		}
		
		return $error;
	 }
	
	/*
	  * gets applied course details
	  * parameters passed : result
	  * returns error object
	  */
	  function getAppliedCourses(&$result)
	  {
	  		$error = new Error();
			//$error->module = "(BAL)getAppliedCourses";
			$dal = new DAL();
			$error = $dal->getDBAppliedCourses($this->conlink, $result);
			if($error->isError())
	 		{
	 			return $error;
	 		}
			return $error;
	  }	 
	 /*
	  * gets applied course details
	  * parameters passed : result
	  * returns error object
	  */
	  function getAppliedCoursesWithLimits(&$result, &$from, $pagecount, &$count)
	  {
	  	$error = new Error();
	  	//$error->module = "(BAL)getAppliedCoursesWithLimits";
	  	$dal = new DAL();
		$resCount = 0;
		$error = $dal->getDBAppliedCoursesCount($this->con->conlink, $resCount);
		if ($error->isError())
		{
			return $error;			
		}
		$count=$resCount;
		//Validate the From value
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
		$error= $dal->getDBAppliedCoursesWithLimits($this->con->conlink, $result, $from, $pagecount);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	  	
	  }
	  
	  /*
	 * gets applied course details
	 */
	 function getAppliedCourseDetails(&$result, &$id)
	 {
	 	$error = new Error();
	 	//$error->module = "(BAL)getAppliedCourseDetails";
	 	$dal = new DAL();
		$error = $dal->getDBAppliedCourseDetails($this->con->conlink, $result, $id);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	 }
	  /*
	   * book course
	   */
	   function bookCMECourse(&$appliedCourse)
	   {
	   		$error = new Error();
			//$error->module = "(BAL)bookCMECourse";
			$dal = new DAL();
			$error = $dal->bookDBCMECourse($this->con->conlink, $appliedCourse);
			if($error->isError())
 			{
 				return $error;
 			}
			return $error;
	   }
	   
	   /*
	  * gets booked course details
	  * parameters passed : result
	  * returns error object
	  */
	  function getBookedCourses(&$result)
	  {
	  		$error = new Error();
			//$error->module = "(BAL)getBookedCourses";
			$dal = new DAL();
			$error = $dal->getDBBookedCourses($this->conlink, $result);
			if($error->isError())
	 		{
	 			return $error;
	 		}
			return $error;
	  }	 
	 /*
	  * gets booked course details
	  * parameters passed : result set
	  * returns error object
	  */
	  function getBookedCoursesWithLimits(&$result, &$from, $pagecount, &$count)
	  {
	  	$error = new Error();
	  	//$error->module = "(BAL)getBookedCoursesWithLimits";
	  	$dal = new DAL();
		$resCount = 0;
		$error = $dal->getDBBookedCoursesCount($this->con->conlink, $resCount);
		if ($error->isError())
		{
			return $error;			
		}
		$count=$resCount;
		//Validate the From value
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
		$error= $dal->getDBBookedCoursesWithLimits($this->con->conlink, $result, $from, $pagecount);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	  	
	  }
	  
	  /*
	   * adds modules 
	   * parameters passed: module object
	   * returns error object
	   */
	   function addModule(&$module)
	   {
		   	$error = new Error();
		   //	$error->module = "(BAL) addModule";
		   $dal = new DAL();
		   	$error = $dal->addDBModule($this->con->conlink, $module);
		   	if($error->isError())
	 		{
	 			return $error;
	 		}
			return $error;
	  }
	  
	  /*
	   * resets access list from access list
	   * parameters passed : agent's user id
	   * returns error object
	   */
	   function resetAccessList(&$agent, &$result)
	   {
		   	$error = new Error();
		   	//$error->module = "(BAL) resetAccessList";
		   	$dal = new DAL();
		   	$error = $dal->resetDBAccessList($this->con->conlink, $agent, $result);
	   		if($error->isError())
	 		{
	 			return $error;
	 		}
			return $error;
	   }
	   
	   /*
	    * gets the access list of agent
	    * parameters passed : agent object
	    * returns error object
	    */
	    function viewAccessList(&$agent, &$result)
	    {
	    	$error = new Error();
		   	//$error->module = "(BAL) viewAccessList";
		   	$dal = new DAL();
		   	$error = $dal->viewDBAccessList($this->con->conlink, $agent, $result);
	   		if($error->isError())
	 		{
	 			return $error;
	 		}
			return $error;
	    }
	   
	   /*
	    * changes the accesstype of agent for given module
	    * parameters passed : agent's user id, module id, access type, resultset
	    * returns error object
	    */ 
	   function assignAccessList(&$agent, &$moduleId, &$access, &$result)
	   {
	   		$error = new Error();
		   	//$error->module = "(BAL)assignAccessList";
		   	$dal = new DAL();
		   	if($access == "Grant Access")
		   	{
		   		$access = "GRANTED";
		   	}
		   	elseif($access == "Deny Access")
		   	{
		   		$access = "DENIED";
		   	}
		   	$error = $dal->assignDBAccessList($this->con->conlink, $agent, $moduleId, $access, $result);
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
	 /*
  	 * gets cme course search results for doctor
  	 * if the course start date and end date fall in range 
  	 * and the speciality, city , state and keywords
  	 * specified in the search form
  	 * Parameter(s) passed : Model object of course and resultset
  	 * returns error object
  	 */
	function getCMECourseSearchResults(&$course, &$result)
	{
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
				$error = $dal->getDBCMECourseSearchResults($this->con->conlink, $course, $result);
			}
			else
			{
				$error->setError(0, "Start date must be less than end date", $error->EL->getBALError());
				return $error;
			}
		}
		else
		{
			$error = $dal->getDBCMECourseSearchResults($this->con->conlink, $course, $result);
		}
		return $error;
	}	
	function getCMECourseSearchCount(&$course, &$resCount)
	{
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
				$error = $dal->getDBCMECourseSearchCount($this->con->conlink, $course, $resCount);
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
			$error = $dal->getDBCMECourseSearchCount($this->con->conlink, $course, $resCount);
			if($error->isError())
			{
				return $error;			
			}
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
	function getCMECourseSearchResultsWithLimits(&$course, &$result, &$from, $pagecount, &$count)
	{
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
				$error = $dal->getDBCMECourseSearchCount($this->con->conlink, $course, $resCount);
				if($error->isError())
				{
					return $error;			
				}
				if($resCount != 0)
				{
					$count=$resCount;
					//Validate the From value
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
				$error = $dal->getDBCMECourseSearchResultsWithLimits($this->con->conlink, $course, $result, $from, $pagecount);
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
				$error = $dal->getDBCMECourseSearchCount($this->con->conlink, $course, $resCount);
				if($error->isError())
				{
					return $error;			
				}
				if($resCount != 0)
				{
					$count=$resCount;
					//Validate the From value
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
				$error = $dal->getDBCMECourseSearchResultsWithLimits($this->con->conlink, $course, $result, $from, $pagecount);
				}
		}
		return $error;
	}
	
	/*
	 * books the cme course for doctor
	 * and inserts booking details with values
	 * in booking course form in applied courses table
	 * 
	 * Parameter(s) passed : Model object of applied course
	 * returns error object
	 */
	function bookCourseForDoctor(&$appliedCourse, &$bid)
	{
		$error = new Error();
		//$error->module = "(BAL)bookCourseForDoctor";
		$dal = new DAL();
		$appliedCourse->agentId = $_SESSION["UserId"];
		$appliedCourse->bookStatus = "PENDING";
		$error = $dal->bookDBCourseForDoctor($this->con->conlink, $appliedCourse, $bid);
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
	 function assignFullAccessToAllDoctors(&$result)
	 {
	 	$error = new Error();
		$dal = new DAL();
		$error = $dal->assignDBFullAccessToAllDoctors($result, $this->con->conlink);
		if($error->isError())
		{
			return $error;
		}
		return $error;
	 }
	/*
	 * admin assigns partial access to doctors
	 * parameter(s) passed : result set
	 * returns error object
	 */	
	 function assignPartialAccessToAllDoctors(&$result)
	 {
	 	$error = new Error();
		$dal = new DAL();
		$error = $dal->assignDBPartialAccessToAllDoctors($result, $this->con->conlink);
		if($error->isError())
		{
			return $error;
		}
		return $error;
	 }
	 /*
	 * retrieves the records in modules table
	 * to check against the url 
	 * parameter(s) passed : result set
	 * returns error object
	 */	
	 function getModulesInAdmin(&$result)
	 {
	 	$error = new Error();
		$dal = new DAL();
		$error = $dal->getDBModulesInAdmin($result, $this->con->conlink);
		if($error->isError())
		{
			return $error;
		}
		return $error;
	 }
	/*
	 * retrieves the records from courses table
	 * whose end date is greater than current date
	 * parameter(s) passed : result set
	 * returns error object
	 */	
	 function viewActiveCoursesList(&$result)
	 {
	 	$error = new Error();
		$dal = new DAL();
		$error = $dal->viewDBActiveCoursesList($result, $this->con->conlink);
		if($error->isError())
		{
			return $error;
		}
		return $error;
	 }
	  /*
	   * gets the list of
	   * active cme courses
	   * parameters passed : result object, from value, page count and total no. of pages
	   * returns error object
	   */
	  function viewActiveCoursesListWithLimits(&$result, &$from, $pagecount, &$count)
	  {
	  	$error = new Error();
	  	$dal = new DAL();
		$resCount = 0;
		$error = $dal->viewActiveCoursesListCount($this->con->conlink, $resCount);
		if ($error->isError())
		{
			return $error;			
		}
		$count=$resCount;
		//Validate the From value
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
		$error= $dal->viewDBActiveCoursesListWithLimits($this->con->conlink, $result, $from, $pagecount);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	  }
	 /*
	 * retrieves the records from courses table
	 * whose last date is less than current date
	 * parameter(s) passed : result set
	 * returns error object
	 */	
	 function viewArchivedCoursesList(&$result)
	 {
	 	$error = new Error();
		$dal = new DAL();
		$error = $dal->viewDBArchivedCoursesList($result, $this->con->conlink);
		if($error->isError())
		{
			return $error;
		}
		return $error;
	 }
	 /*
	   * gets the list of
	   * archived courses
	   * parameters passed : result object, from value, page count and total no. of pages
	   * returns error object
	   */
	  function viewArchivedCoursesListWithLimits(&$result, &$from, $pagecount, &$count)
	  {
	  	$error = new Error();
	  	$dal = new DAL();
		$resCount = 0;
		$error = $dal->viewArchivedCoursesListCount($this->con->conlink, $resCount);
		if ($error->isError())
		{
			return $error;			
		}
		$count=$resCount;
		//Validate the From value
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
		$error= $dal->viewDBArchivedCoursesListWithLimits($this->con->conlink, $result, $from, $pagecount);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	  }
	 /*
	  * gets the list of active courses
	  * to be attended or being attended by the doc
	  * parameters passed : result object, from value, page count and total no. of pages
	  * returns error object
	  */
	  function getDocActiveCoursesWithLimits(&$result, &$from, $pagecount, &$count, &$id)
	  {
	  	$error = new Error();
	  	$dal = new DAL();
		$resCount = 0;
		$error = $dal->getDBDocActiveCoursesCount($this->con->conlink, $resCount, $id);
		if ($error->isError())
		{
			return $error;			
		}
		$count=$resCount;
		//Validate the From value
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
		$error= $dal->getDBDocActiveCoursesWithLimits($this->con->conlink, $result, $from, $pagecount, $id);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	  	
	  }
	   /*
	  * gets the list of archived courses
	  * already  attended  by the doc
	  * parameters passed : result object, from value, page count and total no. of pages
	  * returns error object
	  */
	   function getDocArchivedCoursesWithLimits(&$result, &$from, $pagecount, &$count, &$id)
	  {
	  	$error = new Error();
	  	$dal = new DAL();
		$resCount = 0;
		$error = $dal->getDBDocArchivedCoursesCount($this->con->conlink, $resCount, $id);
		if ($error->isError())
		{
			return $error;			
		}
		$count=$resCount;
		//Validate the From value
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
		$error= $dal->getDBDocArchivedCoursesWithLimits($this->con->conlink, $result, $from, $pagecount, $id);
		if($error->isError())
 		{
 			return $error;
 		}
		return $error;
	  	
	  }
	  /*
	   * gets the list of
	   * contacts of doctors who
	   * are to be called by DocCME
	   * parameters passed : result object, from value, page count and total no. of pages
	   * returns error object
	   */
	  function getContactsWithLimits(&$result, &$from, $pagecount, &$count)
	  {
	  	$error = new Error();
	  	$dal = new DAL();
		$resCount = 0;
		$error = $dal->getDBContactsCount($this->con->conlink, $resCount);
		if ($error->isError())
		{
			return $error;			
		}
		$count=$resCount;
		//Validate the From value
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
		$error= $dal->getDBContactsWithLimits($this->con->conlink, $result, $from, $pagecount);
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
	   function closeContact(&$id)
	   {
	   		$error = new Error();
	  		$dal = new DAL();
	  		$error = $dal->closeDBContact($this->con->conlink, $id);
	  		if($error->isError())
	 		{
	 			return $error;
	 		}
			return $error;
	   }
	   /*
	   * gets the list of
	   * refrrals of doctors who
	   * are to be called by DocCME
	   * parameters passed : result object, from value, page count and total no. of pages
	   * returns error object
	   */
	  function getReferralsWithLimits(&$result, &$from, $pagecount, &$count)
	  {
	  	$error = new Error();
	  	$dal = new DAL();
		$resCount = 0;
		$error = $dal->getDBReferralsCount($this->con->conlink, $resCount);
		if ($error->isError())
		{
			return $error;			
		}
		$count=$resCount;
		//Validate the From value
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
		$error= $dal->getDBReferralsWithLimits($this->con->conlink, $result, $from, $pagecount);
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
	   function closeReferral(&$id)
	   {
	   		$error = new Error();
	  		$dal = new DAL();
	  		$error = $dal->closeDBReferral($this->con->conlink, $id);
	  		if($error->isError())
	 		{
	 			return $error;
	 		}
			return $error;
	   }
	 /*
	    * gets user name password of user
	    */
	   function getUserNamePassword($email, &$result)
	   {
	   		$error = new Error();
	  		$dal = new DAL();
	  		$error = $dal->getDBUserNamePassword($this->con->conlink, $email, $result);
	  		if($error->isError())
	 		{
	 			return $error;
	 		}
			return $error;
	   }
	   /*
	    * adds remarks to the contact
	    */
	   function updateContactRemarks(&$contact)
	   {
	   		$error = new Error();
	  		$dal = new DAL();
	  		$error = $dal->updateDBContactRemarks($this->con->conlink, $contact);
	  		if($error->isError())
	 		{
	 			return $error;
	 		}
			return $error;
	   }
	    /*
	    * adds remarks to the referral
	    */
	   function updateReferralRemarks(&$referral)
	   {
	   		$error = new Error();
	  		$dal = new DAL();
	  		$error = $dal->updateDBReferralRemarks($this->con->conlink, $referral);
	  		if($error->isError())
	 		{
	 			return $error;
	 		}
			return $error;
	   }
	    /*
	   * gets the list of
	   * transaction in DocCME
	   * parameters passed : result object, from value, page count and total no. of pages
	   * returns error object
	   */
	  function getTransactionsWithLimits(&$result, &$from, $pagecount, &$count)
	  {
	  	$error = new Error();
	  	$dal = new DAL();
		$resCount = 0;
		$error = $dal->getTransactionsCount($this->con->conlink, $resCount);
		if ($error->isError())
		{
			return $error;			
		}
		$count=$resCount;
		//Validate the From value
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
		$error= $dal->getDBTransactionsWithLimits($this->con->conlink, $result, $from, $pagecount);
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
	 function getTransactionDetails(&$id, &$result)
	 {
	 	$error = new Error();
	 	$dal = new DAL();
	 	$error->module = "(BAL)getTransactionDetails";
	 	$error = $dal->getDBTransactionDetails($this->con->conlink, $id, $result);
	 	if($error->isError())
 		{
 			return $error;
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
      function getDocEmailId(&$id, &$result)
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
       function getBookedCourseId(&$id, &$result)
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
		if($error->isError())
		{
			return $error;
		}
		return $error;
	}
	
 }
?>
