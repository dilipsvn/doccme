<?php
/*
 *	Created on Apr 6, 2007
 *	author Poornima Kamatgi
 *
 *	this class displays three forms
 *	one form displays course details(non-editable)
 *	second form displays search form for doctors for whom the
 *	course is to be booked
 *	third form displays the booking details
 *	form in which doctor id is input on click 
 *	event in second form's search results
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.AdminAgentSecurity.php");
require_once("./classes/class.Error.php");
require_once("./classes/class.BAL.php");
require_once("./classes/Model.AppliedCourse.php");
require_once("./classes/Model.Doctor.php");
class Page
{
	var $security;
	
	var $role;
	
	var $error;
	
	var $appliedCourse;
	var $bookingType;
	var $paymentMode;
	var $amount;
	
	var $doctor;
	var $firstName;
	var $lastName;
	var $bal;
	
	var $courseId;
	var $courseTitle;
	var $courseStartDate;
	var $courseEndDate;
	var $lastDateForApp;
	
	
	var $StateList;
	var $SpecialityList;
	var $PaymentModeList;
	
	function Page()
	{
		$this->security = new AdminAgentSecurity();
		$this->role = $this->security->CheckRole();
		$this->bal = new BAL();
		$this->error = new Error();
		$this->condt = true;
		$this->appliedCourse = new ModelAppliedCourse();
		$this->appliedCourse->autoSetFromPost();
		
		$this->doctor = new ModelDoctor();
		$this->doctor->autoSetFromPost();
		
		$result = "";
		if($this->role == "AGENT")
		{
			$this->error = $this->bal->checkAccessOfAgent("8", $result);
			$row = mysql_fetch_assoc($result);
			$this->access = $row["AccessType"];
			if($this->access == "DENIED")
			{
				session_write_close();
				header("location:./inValidPageAccess.php");
			}
		}
		elseif($this->role == "" || $this->role == "DOCTOR" || $this->role == "CMEProvider")
		{
			session_write_close();
			header("location:./index.php");
		}
		// get course details
		$id = $_GET["id"];
		$result1 = "";
		$this->error = $this->bal->getCMECourseDetails($result1, $id);
		//print_r($result1);
		//exit();
		if(mysql_num_rows($result1) == 0)
		{
			session_write_close();
			header("location:./invalidId.php?type=courseId");
		}
		if($result1 != null)
		{
			while($course = mysql_fetch_assoc($result1))
			{
				$this->courseId = new TextBox("CME Course ID", "courseId",$course["CourseId"], "50", "35", "true");
				$this->courseTitle = new TextBox("CME Course Title", "courseTitle",$course["CourseTitle"], "50", "35", "true");
				$this->courseaddress1 = new TextBox("Venue Address1", "address1",$course["Venue_Address1"], "50", "25", "true");
			 	$this->coursecity = new TextBox("Venue City", "city", $course["Venue_City"], "50", "25","true");
			 	$this->coursestate = new TextBox("Venue State", "State", $course["Venue_State"], "50", "25","true");
			 	$temp1 = explode("-", $course["CourseStartDate"]);
				$dt1 = mktime(0,0,0,$temp1[1], $temp1[2], $temp1[0]);
				$startDate = date("m/d/Y", $dt1);
				$this->courseStartDate = new TextBox("Course Start Date", "courseStartDate",$startDate, "50", "25", "true");
				$this->course->courseDate->courseStartDate = $this->courseStartDate->data;
				$temp2 = explode("-", $course["CourseEndDate"]);
				$dt2 = mktime(0,0,0,$temp2[1], $temp2[2], $temp2[0]);
				$endDate = date("m/d/Y", $dt2);
				$this->courseEndDate = new TextBox("Course End Date", "courseEndDate", $endDate, "50", "25", "true");
				$this->course->courseDate->courseEndDate = $this->courseEndDate->data;
				$temp3 = explode("-", $course["LastDate_App"]);
				$dt3 = mktime(0,0,0,$temp3[1], $temp3[2], $temp3[0]);
				$lastDate = date("m/d/Y", $dt3);
				$this->lastDateForApp = new TextBox("Last Date For Application", "lastDateForApp", $lastDate, "50", "25", "true");
				$this->course->courseDate->lastDateForApp = $this->lastDateForApp->data;
			 	$this->courseFee = new TextBox("Course Fee (USD $)", "courseFee",$course["CourseFee"], "50", "25", "true");
			}
		}
		//get doctor firstname and lastname for search
		$this->firstName = new TextBox("FirstName", "firstName", $this->doctor->name->firstName, "50", "35");
		$this->lastName = new TextBox("LastName", "lastName", $this->doctor->name->lastName, "50", "35");
		
		//assign fields of appliedCourse object
		$this->appliedCourse->courseId = $this->courseId->data;
		$this->doctorId = new TextBox("Doctor ID", "doctorId",$this->appliedCourse->doctorId, "50", "35");
		$this->amount = new TextBox("Amount", "amount",$this->courseFee->data, "50", "35", "true");
		$this->appliedCourse->amount = $this->courseFee->data;
		$this->paymentMode = new SelectList("Payment Mode", "paymentMode", $this->appliedCourse->paymentMode);
		
		//populating statte and paymentmode lists
		$this->error = $this->bal->getComboStateList($this->StateList);
		$this->error = $this->bal->getComboPaymentModeList($this->PaymentModeList);
		
		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction= "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];
		
	}
	
	function formLoad()
	{
		if($this->PageAction == "BookCourse")
		{
			$this->doctorId_error = $this->checkDoctorId();
			if($this->doctorId_error != "")
			{
				$this->condt = false;
			}
			
			if($this->condt)
			{
				$bid = "";
				$this->error = $this->bal->bookCourseForDoctor($this->appliedCourse, $bid);
				if(!$this->error->isError())
				{
					session_write_close();
					header("location:./makePaymentForCourse.php?bid=" . $bid . "&cid=". $this->appliedCourse->courseId . "&did=". $this->appliedCourse->doctorId);
				}
			}
		}
	}
	function showContent()
	{
		$this->formLoad();
		include("./html/html.bookCourseForDoctor.php");
	}
	function checkFirstName()
	{
		if($this->PageAction=="SEARCH")
		{
			if($this->firstName->data != "")
			{
				if(strrpos($this->firstName->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
			}
			else
				echo "";
		}
	}
	function checkLastName()
	{
		if($this->PageAction=="SEARCH")
		{
			if($this->lastName->data != "")
			{
				if(strrpos($this->lastName->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
			}
			else
				echo "";
		}
	}
	function checkDoctorId()
	{
		if($this->PageAction=="BookCourse")
		{
			if($this->doctorId->data == "")
				return "DoctorId cannot be blank";
			else
				return "";
		}
	}
	
}
$myPage = new Page();
$mPage = new Main("Book Course For Doctor", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>
