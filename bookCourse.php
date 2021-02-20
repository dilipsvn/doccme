<?php
/*
 *	Created on Mar 18, 2007
 *	author Poornima Kamatgi
 *
 *	this class enables a registered doctor
 * 	to book cme course by paying the course
 *	fee
 *
 *	revised on May 31, 2007
 *	added validation code for payment mode entry 
 *	
 */
ob_start();
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.Error.php");
require_once("./classes/class.Security.php");
require_once("./classes/Model.AppliedCourse.php");
require_once("./classes/class.phpDate.php");
class Page
{
	var $bal;
	var $security;
	var $error;
	
	var $appliedCourse;
	var $courseId;
	var $courseTitle;
	var $courseDesc;
	var $venueCity;
	var $venueState;
	var $venueCountry;
	var $venueZip;
	var $courseFee;
	var $paymentMode;
	
	var $StateList;
	var $SpecialityList;
	var $PaymentModeList;
	
	
	function Page()
	{
		$this->bal = new BAL();
		$this->security = new Security();
		$this->error = new Error();
		
		$this->appliedCourse = new ModelAppliedCourse();
		$this->appliedCourse->autoSetFromPost();
		
		$this->bal->getComboStateList($this->StateList);
		$this->bal->getComboSpecialityList($this->SpecialityList);
		$this->bal->getComboPaymentModeList($this->PaymentModeList);
		
		
		$id = $_GET["id"];
		$result = "";
		$this->error = $this->bal->getCourseDetails($id, $result);
		if(mysql_num_rows($result) == 0)
		{
			$this->error->setError(0, "Invalid Course Id", $this->error->EL->getUIError());
			return $this->error;
		}
		elseif($result != null)
		{
			while($course = mysql_fetch_assoc($result))
			{
				$this->courseId = new TextBox("CME Course ID", "courseId",$course["CourseId"], "50", "35", "true");
				$this->appliedCourse->courseId = $this->courseId->data;
				$this->courseTitle = new TextBox("CME Course Title", "courseTitle",$course["CourseTitle"], "150", "50", "true");
				$this->speciality = new TextBox("Speciality", "Speciality", $course["Speciality"], "150", "50", "true");
			 	$this->address1 = new TextBox("Venue Address1", "address1",$course["Venue_Address1"], "100", "50", "true");
			 	$this->city = new TextBox("Venue City", "city", $course["Venue_City"], "50", "25","true");
			 	$this->state = new TextBox("Venue State", "State", $course["Venue_State"], "50", "25","true");
			 	$this->zip = new TextBox("Venue Zip", "zip",$course["Venue_Zip"], "50", "25", "true");
			 	$this->country = new TextBox("Venue Country", "country",$course["Venue_Country"], "50", "25", "true");
			 	$dt1 = new phpDate();
				$dt1->setMySqlDate($course["CourseStartDate"]);
				$this->courseStartDate = new TextBox("Course Start Date", "courseStartDate",$dt1->getFormDate(), "50", "25", "true");
				$dt2 = new phpDate();
				$dt2->setMySqlDate($course["CourseEndDate"]);
				$this->courseEndDate = new TextBox("Course End Date", "courseEndDate", $dt2->getFormDate(), "50", "25", "true");
				$dt3 = new phpDate();
				$dt3->setMySqlDate($course["LastDate_App"]);
			 	$this->lastDateForApp = new TextBox("Last Date For Application", "lastDateForApp", $dt3->getFormDate(), "50", "25","true");
			 	$this->courseFee = new TextBox("Course Fee (USD $)", "courseFee",$course["CourseFee"], "50", "25", "true");
			 	$this->appliedCourse->amount = $this->courseFee->data;
			 	$this->paymentMode = new SelectList("Payment Mode", "paymentMode", $this->appliedCourse->paymentMode);
			 	$this->appliedCourse->paymentMode = $this->paymentMode->data;
			 }
		}
		
		
	
		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction = "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];
		
		$role = $this->security->CheckRole();
		if($role == "DOCTOR")
		{
			$loginStatus = $this->security->CheckLoginStatus();
			
			if($loginStatus == "NOTLOGGEDIN")
			{
				$this->security->setLandingPage("bookCourse.php");
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
			$this->security->setLandingPage("bookCourse.php");
			session_write_close();
			header("location:./login.php?p=DOCTOR");
		}
		$userAgent = $this->security->CheckUserAgent();
		//echo "user agent : " . $userAgent;
		if($userAgent != $_SERVER["HTTP_USER_AGENT"])
		{
			$this->security->setLandingPage("bookCourse.php");
			session_write_close();
			header("location:./login.php?p=DOCTOR");
		}
		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction = "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];
	}
	
	function formLoad()
	{
		ob_start();
		if($this->PageAction == "BookCourse")
		{
			$bid = "";
			$this->error = $this->bal->bookCMECourse($this->appliedCourse, $bid);
			if(!$this->error->isError())
			{
				session_write_close();
				header("location:./doctorPayCourse.php?bid=" . $bid . "&cid=". $this->appliedCourse->courseId . "&did=". $this->appliedCourse->doctorId);
			}
					
		}
	}
	function showContent()
	{
		$this->formLoad();
		include("./html/html.BookCourse.php");
	}
}

$mPage = new Main("Book Course",new Page());
$mPage->showPage();
session_write_close();
?>
