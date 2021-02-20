<?php
/*
 * Created on Oct 3, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.Error.php");
require_once("./classes/class.Security.php");
require_once("./classes/Model.AppliedCourse.php");
require_once("./classes/Model.Course.php");
require_once("./classes/class.phpDate.php");
require_once("./classes/class.creditCardInfo.php");  
//include ("simlib.php");
class Page
{
	var $bal;
	var $security;
	var $error;

	var $course;
	var $courseId;
	var $courseTitle;
	var $courseDesc;
	var $courseFee;
	var $bookingId;
	var $doctorId;
	var $StateList;

	var $creditCardInfo;
	var $apiLoginId;
	var $transactionKey;
	function Page()
	{
		$this->bal = new BAL();
		$this->security = new Security();
		$this->error = new Error();
		$this->creditCardInfo = new creditCardInfo();

		$this->course = new ModelCourse();
		$this->course->autoSetfromPost();
		$role = $this->security->CheckRole();
		if($role == "DOCTOR")
		{
			$loginStatus = $this->security->CheckLoginStatus();

			if($loginStatus == "NOTLOGGEDIN")
			{
				$this->security->setLandingPage("doctorPayCourse.php");
				session_write_close();
				header("Location:./login.php?p=DOCTOR");
			}
		}
		elseif($role == "CMEProvider")
		{
			session_write_close();
			header("location:./inValidPageAccess.php");
		}
		elseif($role == "")
		{
			$this->security->setLandingPage("doctorPayCourse.php");
			session_write_close();
			header("location:./login.php?p=DOCTOR");
		}
		$userAgent = $this->security->CheckUserAgent();
		//echo "user agent : " . $userAgent;
		if($userAgent != $_SERVER["HTTP_USER_AGENT"])
		{
			$this->security->setLandingPage("doctorPayCourse.php");
			session_write_close();
			header("location:./login.php?p=DOCTOR");
		}
		$this->apiLoginId = $this->creditCardInfo->getAPILoginId();
		$this->transactionKey = $this->creditCardInfo->getTransactionKey();

		$result1 = "";
		$this->bookingId = new TextBox("Booking ID","bookingId","","50","25");
		$this->doctorId = new TextBox("Doctor ID","doctorId","","50","25");
		$this->courseId = new TextBox("Course ID","courseId","","50","25");
		$this->doctorName = new TextBox("Doctor's name","doctorName", "", "50","25");
		$this->courseTitle = new TextBox("Course title","courseTitle","","50","25");
		$this->courseDesc = new TextBox("Course description","courseDesc","","50","20");
		$this->address1 = new TextBox("Venue Address","address1","","50","20");
		$this->state = new TextBox("Venue State","state","","50","20");
		$this->country = new TextBox("Country","country","","50","20");
		$this->courseStartDate = new TextBox("Course start date","courseStartDate","","50","20");
		$this->courseEndDate = new TextBox("Course end date","courseEndDate","","50","20");
		$this->lastDateForApp = new TextBox("Last date for application","lastDateForApp","","50","20");
		$this->courseFee= new TextBox("Course fee","courseFee","","50","20");
		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction = "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];
		$this->stateForBilling = new SelectList("State","stateForBilling","");
		$this->bal->getComboStateList($this->StateList);
		if(!isset($_SESSION["bid"]))
 		{
 			//session_register("bid");
 			$this->bid = $_REQUEST["bid"];
 			$_SESSION["bid"] = $this->bid;
 		}
 		else
 		{
 			//$this->bid = $_SESSION["bid"];
			$this->bid = $_REQUEST["bid"];
 			$_SESSION["bid"] = $this->bid;
 		}
 		
		$result1 = "";
		$this->error = $this->bal->getDocName($_SESSION["UserId"], $result1);
		$row = mysql_fetch_array($result1);
		$this->docName = $row["FirstName"] ." " . $row["LastName"];
	}
	
	function showContent()
	{
		include("./html/html.doctorPayCourse.php");
	}
}
$mPage = new Main("Doctor Pay Course",new Page());
$mPage->showPage();
session_write_close();
?>
