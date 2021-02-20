<?php
/*
 *	Created on Apr 2, 2007
 *	author Poornima Kamatgu
 *
 *	thsi class displays the 
 *	booking details of applied course
 *	if doctor has paid the course fee
 * 	totally then the book status of 
 * 	applied course is changed to "BOOKED" 
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.AdminAgentSecurity.php");
require_once("./classes/class.Error.php");
require_once("./classes/class.BAL.php");
require_once("./classes/Model.AppliedCourse.php");
require_once("./classes/class.phpDate.php");
class Page
{
	var $appliedCourse;
 	var $bookingId;
 	var $doctorId;
 	var $courseId;
  	var $paymentMode;
  	var $amount;
  	var $agentId;
  	var $bookStatus;
  	var $security;
	var $role;
	var $error;
	var $bal;
	var $bookStatusList;
	
	function Page()
	{
		$this->appliedCourse = new ModelAppliedCourse();
 		$this->appliedCourse->autoSetFromPost();
		$this->security = new AdminAgentSecurity();
		$this->bal = new BAL();
		$this->error = new Error();
		$result = "";
		$this->role = $this->security->CheckRole();
		
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
		$result1 = "";
		$id =  $_GET["id"];
		
		$this->error = $this->bal->getAppliedCourseDetails($result1, $id);
		if($result1 != null)
		{
			while($appliedCourse = mysql_fetch_assoc($result1))
			{
				$this->bookingId = new TextBox("Booking Id", "bookingId",$appliedCourse["BookingId"], "50", "25", "true");
				$this->appliedCourse->bookingId = $this->bookingId->data;
				$this->doctorId = new TextBox("Doctor ID", "doctorId", $appliedCourse["DoctorId"], "50", "25", "true");
				$this->courseId = new TextBox("Course ID", "courseId", $appliedCourse["CourseId"], "50", "25", "true");
				$this->paymentMode = new TextBox("PaymentMode", "paymentMode",$appliedCourse["PaymentMode"], "50", "25", "true");
				$this->amount = new TextBox("Amount", "amount",$appliedCourse["Amount"], "50", "25", "true");
				$this->agentId = new TextBox("Agent ID", "agentId",$appliedCourse["AgentId"], "50", "25");
				$this->appliedCourse->agentId = $this->agentId->data;
				$this->bookStatus = new SelectList("Book Status", "bookStatus", $appliedCourse["BookStatus"]);
				$this->appliedCourse->bookStatus = $this->bookStatus->data;
				
 			}
		}
		$this->error = $this->bal->getComboBookingStatusList($this->bookStatusList);
		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction= "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];
	}
	
	function formLoad()
	{
		if($this->PageAction=="Book")
		{
			$this->error = $this->bal->bookCMECourse($this->appliedCourse);
			if(!$this->error->isError())
			{
				session_write_close();
				header("location:./bookCMECourse.php?msg=success");
			}
		}
	}
	
	function showContent()
	{
		$this->formLoad();
		include("./html/html.bookCourse.php");
	}
}
$myPage = new Page();
$mPage = new Main("Book  Applied Course Page", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>
