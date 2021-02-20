<?php
/*
 *	Created on Apr 2, 2007
 *	author Poornima Kamatgi
 *
 *	this class displays the course
 *	details form fetched from database
 *	for editing/changing the status
 *	from "NEW" to "APPROVED"
 *
 *	revised on June 15, 2007
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
   	var $courseTitle_error;
 	var $courseDesc;
 	var $courseDesc_error;
 	var $specialityField;
 	var $specialityField_error;
 	var $speciality;
 	var $speciality_error;
 	var $address1;
	var $address1_error;
	var $address2;
	var $address2_error;
	var $city;
	var $city_error;
	var $state;
	var $state_error;
	var $zip;
	var $zip_error;
	var $country;
	var $contactPerson;
	var $contactPerson_error;
 	var $contactPhone;
 	var $contactPhone_error;
	var $fax;
	var $fax_error;
	var $email;
	var $lastDateForApp;
 	var $lastDateForApp_error;
 	var $nearestHotel;
 	var $nearestHotel_error;
 	var $nearestAirport;
 	var $nearestAirport_error;
 	var $courseFee;
 	var $courseFee_error;
 	var $status;
 	var $status_error;
	var $condt;

	var $security;

	var $role;

	var $error;

	var $bal;

	var $StateList;
	var $SpecialityList;
	var $courseStatusList;

	function Page()
	{
		$this->course = new ModelCourse();
 		$this->course->autoSetFromPost();
		$this->security = new AdminAgentSecurity();
		$this->bal = new BAL();
		$this->error = new Error();
		$result = "";
		$this->condt = true;
		$this->role = $this->security->CheckRole();

		if($this->role == "AGENT")
		{
			$this->error = $this->bal->checkAccessOfAgent("6", $result);
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
		$id =  $_GET["id"];
		$result1 = "";
		$this->error = $this->bal->getCMECourseDetails($result1, $id);
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
			 	$this->courseDesc = new TextArea("CME Course Description", "courseDesc", $course["CourseDesc"], "5", "35");
			 	$this->course->courseDesc = $this->courseDesc->data;
			 	$this->specialityField = new TextBox("", "specialityField", $course["Speciality"],"50", "35");
				$this->course->specialityField = $this->specialityField->data;
			 	$this->speciality = new SelectList("Speciality", "Speciality", $course["Speciality"]);
			 	$this->course->speciality = $this->speciality->data;
			 	$this->address1 = new TextBox("Venue Address1", "address1",$course["Venue_Address1"], "50", "25");
			 	$this->course->address->address1 = $this->address1->data;
			 	$this->address2 = new TextBox("Venue Address2", "address2",$course["Venue_Address2"], "50", "25");
			 	$this->course->address->address2 = $this->address2->data;
			 	$this->city = new TextBox("Venue City", "city", $course["Venue_City"], "50", "25");
			 	$this->course->address->city = $this->city->data;
			 	$this->state = new SelectList("Venue State", "State", $course["Venue_State"]);
			 	$this->course->address->state = $this->state->data;
			 	$this->zip = new TextBox("Venue Zip", "zip", $course["Venue_Zip"], "50", "25");
			 	$this->course->address->zip = $this->city->zip;
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
			 	$temp1 = split("-", $course["CourseStartDate"]);
				$dt1 = mktime(0,0,0,$temp1[1], $temp1[2], $temp1[0]);
				$startDate = date("m/d/Y", $dt1);
				$this->courseStartDate = new TextBox("Course Start Date", "courseStartDate",$startDate, "50", "25", "true");
				$this->course->courseDate->courseStartDate = $this->courseStartDate->data;
				$temp2 = split("-", $course["CourseEndDate"]);
				$dt2 = mktime(0,0,0,$temp2[1], $temp2[2], $temp2[0]);
				$endDate = date("m/d/Y", $dt2);
				$this->courseEndDate = new TextBox("Course End Date", "courseEndDate", $endDate, "50", "25", "true");
				$this->course->courseDate->courseEndDate = $this->courseEndDate->data;
				$temp3 = split("-", $course["LastDate_App"]);
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
			 	$this->status = new SelectList("Status", "status", $course["Status"]);
			 	$this->course->status = $this->status->data;
			}
		}
		$this->bal->getComboCourseStatusList($this->courseStatusList);
		$this->bal->getComboStateList($this->StateList);
		$this->bal->getComboSpecialityList($this->SpecialityList);
		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction= "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];
	}

	function formLoad()
	{
		if($this->PageAction=="APPROVE")
		{
			$this->course->autoSetfromPost();
			/*$this->courseTitle_error = $this->checkCourseTitle();
			if($this->courseTitle_error != "")
				$this->condt = false;
			$this->courseDesc_error = $this->checkCourseDesc();
			if($this->courseDesc_error != "")
				$this->condt = false;
			$this->speciality_error = $this->checkSpeciality();
			if($this->speciality_error != "")
				$this->condt = false;
			$this->address1_error = $this->checkAddress1();
			if($this->address1_error != "")
				$this->condt = false;
			$this->address2_error = $this->checkAddress2();
			if($this->address2_error != "")
				$this->condt = false;
			$this->city_error = $this->checkCity();
			if($this->city_error != "")
				$this->condt = false;
			$this->state_error = $this->checkState();
			if($this->state_error != "")
				$this->condt = false;
			$this->zip_error = $this->checkZip();
			if($this->zip_error != "")
				$this->condt = false;
			$this->contactPerson_error = $this->checkContactPerson();
			if($this->contactPerson_error != "")
				$this->condt = false;
			$this->contactPhone_error = $this->checkContactPhone();
			if($this->contactPhone_error != "")
				$this->condt = false;
			$this->fax_error = $this->checkFax();
			if($this->fax_error != "")
				$this->condt = false;
			$this->lastDateForApp_error = $this->checkLastDateForApp();
			if($this->lastDateForApp_error != "")
				$this->condt = false;
			$this->nearestHotel_error = $this->checkNearestHotel();
			if($this->nearestHotel_error != "")
				$this->condt = false;
			$this->nearestAirport_error = $this->checkNearestAirport();
			if($this->nearestAirport_error != "")
				$this->condt = false;
			$this->courseFee_error = $this->checkCourseFee();
			if($this->courseFee_error != "")
				$this->condt = false;
			$this->status_error = $this->checkStatus();
			if($this->status_error != "")
				$this->condt = false;*/

			if($this->condt)
			{
				$this->error = $this->bal->approveCourse($this->course);
				if(!$this->error->isError())
				{
					session_write_close();
					header("location:./approveCMECourse.php?msg=success");

				}
			}

		}
	}

	function checkCourseTitle()
	{
			if($this->courseTitle->data == "")
			{
				return "CourseTitle cannot be blank";
			}
			else
			{
				if(strrpos($this->courseTitle->data, "'") >= 1)
				{
					return "Single quotes not allowed";

				}
				else
				{
					return "";
				}
			}

	}
	function checkCourseDesc()
	{
			if($this->courseDesc->data == "")
				return "";
			else
			{
				if(strrpos($this->courseDesc->data, "'") >= 1)
				{
					return "Single quotes not allowed";

				}
				else
				{
					return "";
				}
			}
	}
	function checkSpeciality()
	{
		if($this->speciality->data == "")
			return "Select speciality";
		else
		{
			return "";
		}

	}
	function checkAddress1()
	{

			if($this->address1->data == "")
				return "Address1 cannot be blank";
			else
			{
				if(strrpos($this->address1->data, "'") >= 1)
				{
					return "Single quotes not allowed";
				}
				else
				{

					return "";
				}
			}

	}
	function checkAddress2()
	{

			if($this->address2->data == "")
				return "";
			else
			{
				if(strrpos($this->address2->data, "'") >= 1)
				{
					return "Single quotes not allowed";

				}
				else
				{
					return "";
				}
			}

	}
	function checkCity()
	{

			if($this->city->data == "")
				return  "City cannot be blank";
			else
			{
				if(strrpos($this->city->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				else
				{
						return "";
				}
			}

	}
	function checkState()
	{

		if($this->state->data == "")
			return  "Select State";
		else
			return  "";

	}
	function checkZip()
	{

			if($this->zip->data == "")
				return  "Zip cannot be blank";
			else
			{
			 	if(strrpos($this->zip->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				else
				{
						return "";
				}
			}

	}
	function checkContactPerson()
	{

			if($this->contactPerson->data == "")
			{
				if(strrpos($this->contactPerson->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				else
				{
						return "";
				}
			}

	}
	function checkContactPhone()
	{

			if($this->courseTitle->data == "")
			{
				if(strrpos($this->contactPhone->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				else
				{
						return "";
				}
			}

	}
	function checkFax()
	{

			if($this->fax->data == "")
				return  "Fax cannot be blank";
			else
			{
				if(strrpos($this->fax->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				else
				{
						return "";
				}
			}

	}
	function checkLastDateForApp()
	{

			if($this->lastDateForApp->data == "")
				return "last date for application cannot be blank";
			else
			{
				if(strrpos($this->lastDateForApp->data, "'") >= 1)
				{
					return "Single quotes not allowed";
				}
				else
				{
						return "";
				}
			}

	}
	function checkNearestHotel()
	{

			if($this->nearestHotel->data != "")
			{
				if(strrpos($this->nearestHotel->data, "'") >= 1)
				{
					return "Single quotes not allowed";
				}
				else
				{
						return "";
				}
			}

	}
	function checkNearestAirport()
	{

			if($this->nearestAirport->data == "")
			{
				if(strrpos($this->nearestAirport->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				else
				{
						return "";
				}
			}

	}
	function checkCourseFee()
	{

			if($this->courseFee->data == "")
				return "course fee cannot be blank";
			else
			{
				if(strrpos($this->courseFee->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				else
				{
						return "";
				}
			}

	}
	function checkStatus()
	{

			if($this->status->data == "")
				return  "Select Status";
			else
			{
				return  "";
			}

	}
	function showContent()
	{
		$this->formLoad();
		include("./html/html.approveCourse.php");
	}
}
$myPage = new Page();
$mPage = new Main("Approve CME Course Page", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>