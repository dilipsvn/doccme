<?php
/*
 *	Created on Feb 5, 2007
 *	author Poornima Kamatgi
 *
 *	this class enables CME Provider to
 *	edit the CME course details added by her/him
 *	in the cmecourses table except courseId, 
 *	courseStartDate, courseEndDate
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.Security.php");
require_once("./classes/class.Error.php");
require_once("./classes/Model.Course.php");

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
	var $email_error;
	var $courseStartDate;
	var $courseStartDate_error;
 	var $courseEndDate;
 	var $courseEndDate_error;
 	var $lastDateForApp;
 	var $lastDateForApp_error;
 	var $nearestHotel;
 	var $nearestHotel_error;
 	var $nearestAirport;
 	var $nearestAirport_error;
 	var $courseFee;
 	var $courseFee_error;
 	var $cmeCredits;
 	var $cmeCredits_error;
 	var $bal;
 	var $security;
 	var $id;
	
	//array
	var $StateList;
	var $SpecialityList;
 	
 	//error class
 	var $error;
 	
 	var $condt;
 	
	function Page()
	{
		$this->security = new Security();
 		$this->bal = new BAL();
 		$this->error = new Error();
 		$this->course = new ModelCourse();
 		$this->course->autoSetFromPost();
 		$this->condt = true;
 		if (!isset($_REQUEST["PostBack"]))
			$this->postBack= "false";
		else
			$this->postBack = $_REQUEST["PostBack"];
 		$this->bal->getComboStateList($this->StateList);
		$this->bal->getComboSpecialityList($this->SpecialityList);
		$result = "";		
 		$this->id = $_GET["id"];
 		$this->CMEId = $_SESSION["UserId"];
 		
 		$userAgent = $this->security->CheckUserAgent();
			//echo "user agent : " . $userAgent;
			if($userAgent != $_SERVER["HTTP_USER_AGENT"])
			{
				$this->security->setLandingPage("./editCMECourse.php?id=".$this->id);
				session_write_close();
				header("Location:./login.php?p=CMEProvider");
			}
 		$result1 = ""; 			
 		$role = $this->security->CheckRole();
		if($role == "CMEProvider")
		{
			$loginStatus = $this->security->CheckLoginStatus();
			
			if($loginStatus == "NOTLOGGEDIN")
			{
				$this->security->setLandingPage("./editCMECourse.php?id=".$this->id);
				session_write_close();
				header("Location:./login.php?p=CMEProvider");
			}
		}
		elseif($role == "DOCTOR")
		{
			session_write_close();
			header("location:./inValidPageAccess.php");
		}
		elseif($role == "")
		{
			$this->security->setLandingPage("./editCMECourse.php?id=".$this->id);
			session_write_close();
			header("Location:./login.php?p=CMEProvider");
		}
		if($this->postBack == "false")
		{		
			$this->error = $this->bal->getEditCourseDetails($this->id, $result);
			if(mysql_num_rows($result) == 0)
			{
				session_write_close();
				header("location:./invalidId.php?type=courseId");
			}
			
		if($result != null)
		{
			while($course = mysql_fetch_assoc($result))
			{
				$this->courseId = new TextBox("CME Course ID", "courseId",$course["CourseId"], "150", "35", "true");
				$this->course->courseId = $this->courseId->data;
				$this->courseTitle = new TextBox("CME Course Title", "courseTitle", $course["CourseTitle"], "50", "35");
				$this->course->courseTitle = $this->courseTitle->data;
				$this->courseDesc = new TextArea("CME Course Description", "courseDesc", $course["CourseDesc"], "5", "35");
				$this->course->courseDesc = $this->courseDesc->data;
				$this->specialityField = new TextBox("", "specialityField", $course["Speciality"], "250", "35");
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
				$this->zip = new TextBox("Venue Zip", "zip",$course["Venue_Zip"], "50", "25");
				$this->course->address->zip = $this->city->zip;
				$this->country = new TextBox("Venue Country", "country",$course["Venue_Country"], "50", "25", "true");
				$this->course->address->country = $this->country->data;
				$this->contactPerson = new TextBox("Contact Person", "contactPerson",$course["ContactPerson"], "50", "25");
				$this->course->contactPerson = $this->contactPerson->data;
				$this->contactPhone = new TextBox("Contact Phone", "contactPhone",$course["ContactPhone"], "50", "25");
				$this->course->contactPhone = $this->contactPhone->data;
				$this->fax = new TextBox("Fax", "fax",$course["ContactFax"], "50", "25");
				$this->course->phone->fax = $this->fax->data;
				$this->email = new TextBox("Email Address", "email",$course["ContactEmail"], "50", "25", "true");
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
				$this->nearestHotel = new TextBox("Nearest Hotel", "nearestHotel",$course["NearestHotel"], "50", "25");
				$this->course->nearestHotel = $this->nearestHotel->data;
				$this->nearestAirport = new TextBox("Nearest Airport", "nearestAirport",$course["NearestAirport"], "50", "25");
				$this->course->nearestAirport = $this->nearestAirport->data;
				$this->courseFee = new TextBox("Course Fee (USD $)", "courseFee",$course["CourseFee"], "50", "25");
				$this->course->courseFee = $this->courseFee->data;
				$this->cmeCredits = new TextBox("CME Credits", "cmeCredits",$course["CMECredits"], "50", "25");
				$this->course->cmeCredits = $this->cmeCredits->data;
					 	
			}
		}
		}
		else
		{
					$this->courseId = new TextBox("CME Course ID", "courseId", $this->course->courseId, "50", "35", "true");
					$this->courseTitle = new TextBox("CME Course Title", "courseTitle", $this->course->courseTitle, "50", "35");
					$this->courseDesc = new TextArea("CME Course Description", "courseDesc", $this->course->courseDesc, "5", "35");
				 	$this->specialityField = new TextBox("", "specialityField", $this->course->specialityField,"50", "35");
					$this->speciality = new SelectList("Speciality", "Speciality", $this->course->speciality);
				 	$this->address1 = new TextBox("Venue Address1", "address1",$this->course->address->address1, "50", "25");
				 	$this->address2 = new TextBox("Venue Address2", "address2",$this->course->address->address2, "50", "25");
				 	$this->city = new TextBox("Venue City", "city", $this->course->address->city, "50", "25");
				 	$this->state = new SelectList("Venue State", "State", $this->course->address->state);
				 	$this->course->address->state = $this->state->data;
				 	$this->zip = new TextBox("Venue Zip", "zip", $this->course->address->zip, "50", "25");
				 	$this->country = new TextBox("Venue Country", "country", $this->course->address->country, "50", "25", "true");
				 	$this->contactPerson = new TextBox("Contact Person", "contactPerson", $this->course->contactPerson, "50", "25");
				 	$this->contactPhone = new TextBox("Contact Phone", "contactPhone", $this->course->contactPhone, "50", "25");
				 	$this->fax = new TextBox("Fax", "fax", $this->course->phone->fax, "50", "25");
				 	$this->email = new TextBox("Email Address", "email", $this->course->email, "50", "25", "true");
				 	$this->courseStartDate = new TextBox("Course Start Date", "courseStartDate",$this->course->courseDate->courseStartDate, "50", "25", "true");
					$this->courseEndDate = new TextBox("Course End Date", "courseEndDate", $this->course->courseDate->courseEndDate, "50", "25", "true");
					$this->lastDateForApp = new TextBox("Last Date For Application", "lastDateForApp", $this->course->courseDate->lastDateForApp, "50", "25");
					$this->nearestHotel = new TextBox("Nearest Hotel", "nearestHotel", $this->course->nearestHotel, "50", "25");
				 	$this->nearestAirport = new TextBox("Nearest Airport", "nearestAirport", $this->course->nearestAirport, "50", "25");
				 	$this->courseFee = new TextBox("Course Fee (USD $)", "courseFee",$this->course->courseFee, "50", "25");
				 	$this->cmeCredits = new TextBox("CME Credits", "cmeCredits",$this->course->cmeCredits, "50", "25");
				 	
				 }
		
		
		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction= "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];
		
	}
	function formLoad()
	{
		if($this->PageAction == "UPDATE")
		{
			if($this->postBack == "true")
			{
				$this->course->autoSetFromPost();
				$this->courseTitle_error = $this->checkCourseTitle();
				if($this->courseTitle_error != "")
					$this->condt = false;
				$this->courseDesc_error = $this->checkCourseDesc();
				if($this->courseDesc_error != "")
					$this->condt = false;
				$this->specialityField_error = $this->checkSpecialityField();
				if($this->specialityField_error != "")
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
				$this->cmeCredits_error = $this->checkCMECredits();
				if($this->cmeCredits_error != "")
					$this->condt = false;
				if($this->condt)
				{
					
					$this->error = $this->bal->updateCourseDetails($this->course);
					if(!$this->error->isError())
					{
						session_write_close();
						header("location:./viewEditCourse.php?msg=success");
					}
				}
			}
		}
	}
	
	function showContent()
	{
		$this->formLoad();
		include("./html/html.editCMECourse.php");
	}
	function checkCourseTitle()
	{
		if($this->PageAction == "UPDATE")
		{
			if($this->courseTitle->data == "")
				return "CourseTitle cannot be blank";
			else
			{
				if(strrpos($this->courseTitle->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->courseTitle->data) > 150 || strlen($this->courseTitle->data) < 3)
				{
						return "Course title must contain less than 50 chars not less than 3 chars";
				}
				else
				{
						return "";
				}
			}
		}	
		
	}
	function checkCourseDesc()
	{
		if($this->PageAction == "UPDATE")
		{
			if($this->courseDesc->data != "")
			{
				if(strrpos($this->courseDesc->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->courseDesc->data) > 250)
				{
						return "Course Desc must contain less than 250 characters";
				}
				else
				{
						return "";
				}
			}
		}	
		
	}
	function checkSpecialityField()
	{
		if($this->PageAction == "UPDATE")
		{
			if($this->specialityField->data != "")
			{
				if(strrpos($this->specialityField->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->specialityField->data) > 250 || strlen($this->specialityField->data) < 3)
				{
						return "Speciality field must contain less than 250 chars not less than 4 chars";
				}
				else
				{
						return "";
				}
			}
			else
			{
				return "Speciality field cannot be blank";
			}
		}	
		
	}
	function checkSpeciality()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->speciality->data == "")
				return "";
			else
				return "";
		}	 
	}
	function checkAddress1()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->address1->data == "")
				return  "Address1 cannot be blank";
			else
			{
				if(strrpos($this->address1->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->address1->data) > 100  || strlen($this->address1->data) < 4)
				{
						return "Address1 must contain less than 100 chars not less than 4 chars";
				}
				else
				{
						return "";
				}
			}
		} 
	}
	function checkAddress2()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->address2->data == "")
				return  "";
			else
			{
				if(strrpos($this->address2->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->address2->data) > 100)
				{
						return "Address2 must contain less than 100 characters";
				}
				else
				{
						return "";
				}
			}
		} 
	}
	function checkCity()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->city->data == "")
				return  "City cannot be blank";
			else
			{
				if(strrpos($this->city->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->city->data) > 50 || strlen($this->city->data) < 4)
				{
						return "City must contain less than 50 chars not less than 4 chars";
				}	
				else
				{
						return "";
				}
			}
		}	 
	}
	function checkState()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->state->data == "")
				return  "Select State";
			else
				return  "";
		}	 
	}
	function checkZip()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->zip->data == "")
				return  "";
			else
			{	
			 	if(strrpos($this->zip->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(!is_numeric($this->zip->data))
				{
					return "Enter numeric value for Zip code";
				}
				elseif(strlen($this->zip->data) > 5 || strlen($this->zip->data) < 5)
				{
					return "Zip code must contain 5 numbers";
				}
				else
				{
					return "";
				}
			}
		}	 
	}
	function checkContactPerson()
	{
		if($this->PageAction == "UPDATE")
		{
			if($this->contactPerson->data != "")
			{
				if(strrpos($this->contactPerson->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->contactPerson->data) > 50)
				{
						return "Contact Person must contain less than 50 characters";
				}
				else
				{
						return "";
				}
			}
		}	
		
	}
	function checkContactPhone()
	{
		if($this->PageAction == "UPDATE")
		{
			if($this->contactPhone->data != "")
			{
				if(strrpos($this->contactPhone->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(!preg_match("/^(\([0-9]{3}\)|[0-9]{3})[- \s]?[0-9]{3}[\s -]?[0-9]{4}/", $this->contactPhone->data))
				{
					return "Enter valid phone no";
				}
				else
				{
					return "";
				}
			}
		}	
		
	}
	function checkFax()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->fax->data != "")
			{
				if(strrpos($this->fax->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(!preg_match("/^(\([0-9]{3}\)|[0-9]{3})[- \s]?[0-9]{3}[\s -]?[0-9]{4}/", $this->fax->data))
				{
					return "Enter valid fax no.";
				}
				else
				{
					return "";
				}
			}
		}	 
	}
	
	function checkLastDateForApp()
	{
		$pattern = '/^(?=\d)(?:(?:(?:(?:(?:0?[13578]|1[02])(\/|-|\.)31)\1|(?:(?:0?[1,3-9]|1[0-2])(\/|-|\.)(?:29|30)\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})|(?:0?2(\/|-|\.)29\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))|(?:(?:0?[1-9])|(?:1[0-2]))(\/|-|\.)(?:0?[1-9]|1\d|2[0-8])\4(?:(?:1[6-9]|[2-9]\d)?\d{2}))($|\ (?=\d)))?(((0?[1-9]|1[012])(:[0-5]\d){0,2}(\ [AP]M))|([01]\d|2[0-3])(:[0-5]\d){1,2})?$/';
		$dt1 = $this->lastDateForApp->data;
		$dt2 = $this->courseStartDate->data;
		if($this->PageAction=="UPDATE")
		{
			if($this->lastDateForApp->data == "")
				return "Last date for application cannot be blank";
			else
			{
				if(strrpos($this->lastDateForApp->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(!preg_match($pattern, $dt1))
				{
					return "Invalid date format";
				}
				$tempLt = explode("/", $this->lastDateForApp->data);
	 			$lDate = mktime(0,0,0, $tempLt[0],$tempLt[1],$tempLt[2]);
				$tempSt = explode("/", $this->courseStartDate->data);
			 	$sDate = mktime(0,0,0, $tempSt[0], $tempSt[1], $tempSt[2]);
			 	if(($sDate - $lDate) < 0)
				{
					return "last date must be less than course start date";
				}
				else
				{
					return "";
				}
				$temp3 = explode("/", $this->lastDateForApp->data);
	 			$lastDate = mktime(0,0,0, $temp3[0],$temp3[1],$temp3[2]);
				$temp1 = explode("/", date("m/d/Y"));
			 	$curdate = mktime(0,0,0, $temp1[0], $temp1[1], $temp1[2]);
				if(($lastDate - $curdate) < 0)
				{
					return "last date must be greater than or equal to current date";
				}
				else
				{
					return "";
				}
			}
		}	 
	}
	function checkNearestHotel()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->nearestHotel->data != "")
			{
				if(strrpos($this->nearestHotel->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->nearestHotel->data) > 50)
				{
					return "Nearest Hotel must contain less than or equal to 50 chars";
				}
				else
				{
					return "";
				}
			}
		}	 
	}
	function checkNearestAirport()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->nearestAirport->data == "")
			{
				if(strrpos($this->nearestAirport->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->nearestAirport->data) > 50)
				{
					return "Nearest Airport must contain less than or equal to 50 chars";
				}
				else
				{
					return "";
				}
			}
		}	 
	}
	function checkCourseFee()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->courseFee->data == "")
				return "course fee cannot be blank";
			else
			{
				if(strrpos($this->courseFee->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(!is_numeric($this->courseFee->data))
				{
					return "Enter numeric value for course fee";
				}
				elseif(strlen($this->courseFee->data) > 10)
				{
					return "Course Fee must contain less than or equal to 10 numbers";
				}
				else
				{
					return "";
				}
			}
		}	 
	}
	function checkCMECredits()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->cmeCredits->data == "")
				return "CME Credits cannot be blank";
			else
			{
				if(strrpos($this->cmeCredits->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(!is_numeric($this->cmeCredits->data))
				{
					return "Enter numeric value for course feecme credits";
				}
				elseif($this->cmeCredits->data > 10 || $this->cmeCredits->data < 1)
				{
					return "CME Credits must be value between 1 - 10";
				}
				else
				{
					return "";
				}
			}
		}
	}
	
}
$myPage = new Page();
$mPage = new Main("Edit CME Course", $myPage);
$mPage->showPage();

$myPage->security->clearLandingPage();
session_write_close();

?>
