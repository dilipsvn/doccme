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
require_once("./classes/Model.Course.php");
require_once("./classes/class.phpDate.php");
class Page
{
	var $course;

  	var $courseId;
  	var $CMEId;
  	var $courseTitle;
   	var $courseDesc;
 	var $specialityField;
 	var $speciality;
 	var $address1;
	var $address2;
	var $city;
	var $state;
	var $zip;
	var $country;
	var $contactPerson;
	var $contactPhone;
 	var $fax;
	var $email;
	var $courseStartDate;
	var $courseEndDate;
	var $lastDateForApp;
 	var $nearestHotel;
 	var $nearestAirport;
 	var $courseFee;
 	var $cmeCredits;

 	var $condt;
	var $security;
	var $role;
	var $error;
	var $bal;

	function Page()
	{
		$this->course = new ModelCourse();
 		$this->security = new AdminAgentSecurity();
		$this->bal = new BAL();
		$this->error = new Error();
		$result = "";
		$this->condt = true;
		$this->role = $this->security->CheckRole();
		if($this->role == "" || $this->role == "DOCTOR" || $this->role == "CMEProvider")
		{
			session_write_close();
			header("location:./index.php");
		}
		if (!isset($_REQUEST["PostBack"]))
			$this->postBack= "false";
		else
			$this->postBack = $_REQUEST["PostBack"];

		$this->course->autoSetfromPost();

		$id =  $_GET["id"];
		$result1 = "";
		$this->error = $this->bal->getCMECourseDetails($result1, $id);
		if(mysql_num_rows($result1) == 0)
		{
			session_write_close();
			header("location:./invalidId.php");
		}
		else
		{
			if($result1 != null)
			{
				while($course = mysql_fetch_assoc($result1))
				{
					$this->courseId = new TextBox("CME Course ID", "courseId", $course["CourseId"], "50", "35", "true");
					$this->course->courseId = $this->courseId->data;
					$this->CMEId = new TextBox("CME ID", "CMEId", $course["CMEId"], "50", "35", "true");
					$this->course->CMEId = $this->CMEId->data;
					$this->courseTitle = new TextBox("CME Course Title", "courseTitle", $course["CourseTitle"], "50", "35");
					$this->course->courseTitle = $this->courseTitle->data;
				 	$this->courseDesc = new TextBox("CME Course Description", "courseDesc", $course["CourseDesc"], "50", "35");
				 	$this->course->courseDesc = $this->courseDesc->data;
				 	$this->speciality = new TextBox("Speciality", "Speciality", $course["Speciality"], "50", "35");
					$this->course->speciality = $this->speciality->data;
					$this->address1 = new TextBox("Venue Address1", "address1",$course["Venue_Address1"], "50", "25");
				 	$this->course->address->address1 = $this->address1->data;
				 	$this->address2 = new TextBox("Venue Address2", "address2",$course["Venue_Address2"], "50", "25");
				 	$this->course->address->address2 = $this->address2->data;
				 	$this->city = new TextBox("Venue City", "city", $course["Venue_City"], "50", "25");
				 	$this->course->address->city = $this->city->data;
				 	$this->state = new TextBox("Venue State", "State", $course["Venue_State"], "50", "35");
				 	$this->course->address->state = $this->state->data;
				 	$this->zip = new TextBox("Venue Zip", "zip", $course["Venue_Zip"], "50", "25");
				 	$this->course->address->zip = $this->zip->data;
				 	$this->country = new TextBox("Venue Country", "country", $course["Venue_Country"], "50", "25", "true");
				 	$this->course->address->country = $this->country->data;
				 	$this->contactPerson = new TextBox("Contact Person", "contactPerson", $course["ContactPerson"], "50", "25");
				 	$this->course->contactPerson = $this->contactPerson->data;
				 	$this->contactPhone = new TextBox("Contact Phone", "contactPhone", $course["ContactPhone"], "50", "25");
				 	$this->course->contactPhone = $this->contactPhone->data;
				 	$this->fax = new TextBox("Fax", "fax", $course["ContactFax"], "50", "25");
				 	$this->course->phone->fax = $this->fax->data;
				 	$this->email = new TextBox("Email Address", "email", $course["ContactEmail"], "50", "25", "true");
				 	$this->course->email = $this->email->data;
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
					$this->lastDateForApp = new TextBox("Last Date For Application", "lastDateForApp", $lastDate, "50", "25");
					$this->course->courseDate->lastDateForApp = $this->lastDateForApp->data;
				 	$this->nearestHotel = new TextBox("Nearest Hotel", "nearestHotel", $course["NearestHotel"], "50", "25");
				 	$this->course->nearestHotel = $this->nearestHotel->data;
				 	$this->nearestAirport = new TextBox("Nearest Airport", "nearestAirport", $course["NearestAirport"], "50", "25");
				 	$this->course->nearestAirport = $this->nearestAirport->data;
				 	$this->courseFee = new TextBox("Course Fee (USD $)", "courseFee",$course["CourseFee"], "50", "25");
				 	$this->course->courseFee = $this->courseFee->data;
				 	$this->cmeCredits = new TextBox("CME Credits", "cmeCredits", $course["CMECredits"], "50", "35");
				 	$this->course->cmeCredits = $this->cmeCredits->data;
				}
			}
		}
		
	
	}

	function showContent()
	{
		include("./html/html.viewCourseDetails.php");
	}
}
$myPage = new Page();
$mPage = new Main("View Course Details", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>

