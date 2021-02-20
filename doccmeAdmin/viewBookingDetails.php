<?php
/*
 * Created on Dec 6, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
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
		if($this->role == "" || $this->role == "DOCTOR" || $this->role == "CMEProvider")
		{
			session_write_close();
			header("location:./index.php");
		}
		$result1 = "";
		$id =  $_GET["id"];
		
		$this->error = $this->bal->getAppliedCourseDetails($result1, $id);
		if(mysql_num_rows($result1) == 0)
		{
			session_write_close();
			header("location:./invalidId.php");
		}
		else
		{
			if($result1 != null)
			{
				while($appliedCourse = mysql_fetch_assoc($result1))
				{
					$this->bookingId = new TextBox("Booking Id", "bookingId",$appliedCourse["BookingId"], "50", "25", "true");
					$this->appliedCourse->bookingId = $this->bookingId->data;
					$this->doctorId = new TextBox("Doctor ID", "doctorId", $appliedCourse["DoctorId"], "50", "25", "true");
					$this->courseId = new TextBox("Course ID", "courseId", $appliedCourse["CourseId"], "50", "25", "true");
					$temp1 = explode("-", $appliedCourse["BookingDate"]);
					$dt1 = mktime(0,0,0,$temp1[1], $temp1[2], $temp1[0]);
					$bookingDate = date("m/d/Y", $dt1);
					$this->bookingDate = new TextBox("Booking Date", "bookingDate",$bookingDate, "50", "25", "true");
					//$this->course->courseDate->courseStartDate = $this->courseStartDate->data;
					$this->paymentMode = new TextBox("PaymentMode", "paymentMode",$appliedCourse["PaymentMode"], "50", "25", "true");
					$this->amount = new TextBox("Amount", "amount",$appliedCourse["Amount"], "50", "25", "true");
					$this->agentId = new TextBox("Agent ID", "agentId",$appliedCourse["AgentId"], "50", "25");
					$this->appliedCourse->agentId = $this->agentId->data;
					$this->bookStatus = new TextBox("Book Status", "bookStatus", $appliedCourse["BookStatus"], "50", "25");
					$this->appliedCourse->bookStatus = $this->bookStatus->data;
					
	 			}
			}
		}
	}
	
	function showContent()
	{
		include("./html/html.viewBookingDetails.php");
	}
}
$myPage = new Page();
$mPage = new Main("View Booking Details", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>

