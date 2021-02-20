<?php
/*
 *	Created on Mar 28, 2007
 *	author Poornima Kamatgi
 *
 * 	this class enables admin/agent
 * 	to add cme course on behalf of
 * 	registered cme provider
 *
 */
 session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/Model.Course.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.EmailList.php");
require_once("./classes/class.AdminAgentSecurity.php");
require_once("./classes/class.Error.php");

 class Page
 {
 	var $course;

  	var $CMEId;
  	var $CMEId_error;
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
	var $condt;


 	var $bal;
 	var $security;
	var $emailList;
	//array
	var $StateList;
	var $SpecialityList;
 	var $cmeProviderList;
 	//error class
 	var $error;

 	function Page()
 	{
 		$this->course = new ModelCourse();
 		$this->course->autoSetFromPost();
 		$this->security = new AdminAgentSecurity();
 		$this->bal = new BAL();
 		$this->emailList = new EmailList();
 		$result ="";
 		$this->condt = true;
 		$this->error = new Error();

		$this->CMEId = new SelectList("CME User Name", "CMEId",$this->course->CMEId);
 		$this->courseTitle = new TextBox("CME Course Title", "courseTitle",$this->course->courseTitle, "50", "35");
 		$this->courseDesc = new TextArea("CME Course Description", "courseDesc", $this->course->courseDesc, "5", "35", "");
 		$this->specialityField = new TextBox("", "specialityField",$this->course->specialityField, "150", "25");
 		$this->speciality = new SelectList("Speciality", "Speciality", $this->course->speciality);
 		$this->address1 = new TextBox("Venue Address1", "address1",$this->course->address->address1, "50", "25");
 		$this->address2 = new TextBox("Venue Address2", "address2",$this->course->address->address2, "50", "25");
 		$this->city = new TextBox("Venue City", "city",$this->course->address->city, "50", "25");
 		$this->state = new SelectList("State", "State", $this->course->address->state);
 		$this->zip = new TextBox("Venue Zip", "zip",$this->course->address->zip, "50", "25");
 		$this->country = new TextBox("Venue Country", "country","USA", "50", "25", "true");
 		$this->contactPerson = new TextBox("Contact Person", "contactPerson",$this->course->contactPerson, "50", "25");
 		$this->contactPhone = new TextBox("Contact Phone", "contactPhone",$this->course->contactPhone, "50", "25");
 		$this->fax = new TextBox("Fax", "fax",$this->course->phone->fax, "50", "25");
 		$this->email = new TextBox("Email Address", "email",$this->course->email, "50", "25");
 		$this->courseStartDate = new TextBox("Course Start Date", "courseStartDate",$this->course->courseDate->courseStartDate, "50", "25");
 		$this->courseEndDate = new TextBox("Course End Date", "courseEndDate",$this->course->courseDate->courseEndDate, "50", "25");
 		$this->lastDateForApp = new TextBox("Last Date For Application", "lastDateForApp",$this->course->courseDate->lastDateForApp, "50", "25");
 		$this->nearestHotel = new TextBox("Nearest Hotel", "nearestHotel",$this->course->nearestHotel, "50", "25");
 		$this->nearestAirport = new TextBox("Nearest Airport", "nearestAirport",$this->course->nearestAirport, "50", "25");
 		$this->courseFee = new TextBox("Course Fee (USD)", "courseFee",$this->course->courseFee, "50", "25");
 		$this->cmeCredits = new TextBox("CME Credits", "cmeCredits",$this->course->cmeCredits, "50", "25");

 		$this->error = $this->bal->getComboStateList($this->StateList);
 		$this->error = $this->bal->getComboCMEProviderList($this->cmeProviderList);
		$this->error = $this->bal->getComboSpecialityList($this->SpecialityList);


 		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction= "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];

		$this->role = $this->security->CheckRole();
		if($this->role == "AGENT")
		{
			$this->error = $this->bal->checkAccessOfAgent("3", $result);
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
	}

 	function formLoad()
	{

		if($this->PageAction=="SAVE")
		{
			$this->CMEId_error = $this->checkCMEId();
			if($this->CMEId_error != "")
				$this->condt = false;
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
			$this->email_error = $this->checkEmail();
			if($this->email_error != "")
				$this->condt = false;
			$this->courseStartDate_error = $this->checkCourseStartDate();
			if($this->courseStartDate_error != "")
				$this->condt = false;
			$this->courseEndDate_error = $this->checkCourseEndDate();
			if($this->courseEndDate_error != "")
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
				$this->error = $this->bal->addCMECourseForCMEProvider($this->course);
				if(!$this->error->isError())
				{
						//send email to registered cme provider
					$mailto = $this->email->data;
					$mailto = $this->email->data;
					$HTMLMail = "<HTML>";
					$HTMLMail .= "<HEAD> <TITLE>Course Registration Confirmation</TITLE> </HEAD>";
					$HTMLMail .= "<BODY>";
					$HTMLMail .= "<p>Dear CME Provider,</p>";
					$HTMLMail .= "<p>We are pleased to confirm your course registration with us. Thanks for registering the course with us. One of our Customer Service agent will be in contact with you to confirm the course details. We appreciate your business.
    As always please do not hesitate to call us at +1-866-465-6181 or email. .</p>";
					$HTMLMail .= "<P> Course Details : </P>";
					$HTMLMail .= "<CENTER> <TABLE>";
					$HTMLMail .= "<TR><TD> Course Title </TD><TD>&nbsp;</TD><TD> ".  $this->courseTitle->data. " </TD></TR>";
					$HTMLMail .= "<TR><TD> Course Start Date </TD><TD>&nbsp;</TD><TD> ".  $this->courseStartDate->data. " </TD></TR>";
					$HTMLMail .= "<TR><TD> Course End Date </TD><TD>&nbsp;</TD><TD>".  $this->courseEndDate->data. "</TD></TR>";
					$HTMLMail .= "<TR><TD> Last Date for Application </TD><TD>&nbsp;</TD><TD>".  $this->lastDateForApp->data."</TD></TR>";
					$HTMLMail .= "<TR><TD> Course Fee </TD><TD>&nbsp;</TD><TD>".  $this->courseFee->data."</TD></TR>";
					$HTMLMail .= "</TABLE></CENTER>";
					$HTMLMail .= "<p>Thank you for registering course.</p><p>Regards <br/>Doccme Admin</p>";
					$HTMLMail .= "</BODY>";
					$HTMLMail .= "</HTML>";
					$subject = "Course Registration Confirmation";
					$headers  = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type: text/html; charset=iso-8859-1" ."\r\n";
					$headers .= "From: <info@doccme.com >" ."\r\n";
	
					if(!mail($mailto, $subject , $HTMLMail, $headers))
					{
						echo "Error in sending email to cme provider : " . $this->contactPerson->data;
					}
					//send mail to admin
					$mailtoAdmin = $this->emailList->getEmailId("admin");
					$HTMLMail = "<HTML>";
					$HTMLMail .= "<HEAD> <TITLE>Course Registration Confirmation</TITLE> </HEAD>";
					$HTMLMail .= "<BODY>";
					$HTMLMail .= "<p>We  confirm  registration of the course with DocCME.</p>";
					$HTMLMail .= "<P> Applicant Details : </P>";
					$HTMLMail .= "<CENTER> <TABLE>";
					$HTMLMail .= "<TR><TD> Course Title </TD><TD>&nbsp;</TD><TD> ".  $this->courseTitle->data. " </TD></TR>";
					$HTMLMail .= "<TR><TD> Course Start Date </TD><TD>&nbsp;</TD><TD> ".  $this->courseStartDate->data. " </TD></TR>";
					$HTMLMail .= "<TR><TD> Course End Date </TD><TD>&nbsp;</TD><TD>".  $this->courseEndDate->data. "</TD></TR>";
					$HTMLMail .= "<TR><TD> Last Date for Application </TD><TD>&nbsp;</TD><TD>".  $this->lastDateForApp->data."</TD></TR>";
					$HTMLMail .= "<TR><TD> Course Fee </TD><TD>&nbsp;</TD><TD>".  $this->courseFee->data."</TD></TR>";
					$HTMLMail .= "<p>Regards <br/>Doccme Admin</p>";
					$HTMLMail .= "</TABLE></CENTER>";
					$HTMLMail .= "</BODY>";
					$HTMLMail .= "</HTML>";
					$subject = "Course Registration Confirmation";
					$headers  = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type: text/html; charset=iso-8859-1" ."\r\n";
					$headers .= "From: <info@doccme.com >" ."\r\n";
					if(!mail($mailtoAdmin, $subject , $HTMLMail, $headers))
					{
						echo "Error in sending email to admin";
					}
					session_write_close();
					header("location:./courseAddSuccessful.php");
				}
			}

		}


	}

 	function showContent()
	{
		$this->formLoad();
		include ("./html/html.addCourseForCMEProvider.php");
	}

	function checkCMEId()
	{
		if($this->PageAction == "SAVE")
		{
			if($this->CMEId->data == "")
				return "CME Id cannot be blank";
			else
			{
				if(strrpos($this->CMEId->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				else
				{
						return "";
				}
			}
		}

	}
	function checkCourseTitle()
	{
		if($this->PageAction == "SAVE")
		{
			if($this->courseTitle->data == "")
				return "CourseTitle cannot be blank";
			else
			{
				if(strrpos($this->courseTitle->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->courseTitle->data) > 50)
				{
						return "Course title must contain less than 50 characters";
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
		if($this->PageAction == "SAVE")
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

	function checkSpeciality()
	{
		if($this->PageAction=="SAVE")
		{
			if($this->speciality->data == "")
				return "";
			else
				return "";
		}
	}
	function checkSpecialityField()
	{
		if($this->PageAction == "SAVE")
		{
			if($this->specialityField->data != "")
			{
				if(strrpos($this->specialityField->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->specialityField->data) > 100)
				{
						return "Speciality field must contain less than 100 characters";
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
	function checkAddress1()
	{
		if($this->PageAction=="SAVE")
		{
			if($this->address1->data == "")
				return  "Address1 cannot be blank";
			else
			{
				if(strrpos($this->address1->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->address1->data) > 100)
				{
						return "Address1 must contain less than 100 characters";
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
		if($this->PageAction=="SAVE")
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
		if($this->PageAction=="SAVE")
		{
			if($this->city->data == "")
				return  "City cannot be blank";
			else
			{
				if(strrpos($this->city->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->city->data) > 50)
				{
						return "City must contain less than 50 characters";
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
		if($this->PageAction=="SAVE")
		{
			if($this->state->data == "")
				return  "Select State";
			else
				return  "";
		}
	}
	function checkZip()
	{
		if($this->PageAction=="SAVE")
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
		if($this->PageAction == "SAVE")
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
		if($this->PageAction == "SAVE")
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
		if($this->PageAction=="SAVE")
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
	function checkEmail()
	{
		if($this->PageAction=="SAVE")
		{
			if($this->email->data == "")
				return  "Email Address cannot be blank";
			else
			{
				if(strrpos($this->email->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->email->data) > 50)
				{
					return "Email must contain less than or equal to 50 characters";
				}
				elseif(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $this->email->data))
				{
					return "";
				}
				else
				{
					return "Enter valid email id";
				}

			}
		}
	}
	function checkCourseStartDate()
	{
		$pattern = '/^(?=\d)(?:(?:(?:(?:(?:0?[13578]|1[02])(\/|-|\.)31)\1|(?:(?:0?[1,3-9]|1[0-2])(\/|-|\.)(?:29|30)\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})|(?:0?2(\/|-|\.)29\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))|(?:(?:0?[1-9])|(?:1[0-2]))(\/|-|\.)(?:0?[1-9]|1\d|2[0-8])\4(?:(?:1[6-9]|[2-9]\d)?\d{2}))($|\ (?=\d)))?(((0?[1-9]|1[012])(:[0-5]\d){0,2}(\ [AP]M))|([01]\d|2[0-3])(:[0-5]\d){1,2})?$/';
		$dt = $this->courseStartDate->data;
		if($this->PageAction=="SAVE")
		{
			if($this->courseStartDate->data == "")
				return "Course Start date cannot be blank";
			else
			{
				if(strrpos($this->courseStartDate->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(!preg_match($pattern, $dt))
				{
					return "Invalid date format";
				}
				$temp1 = explode("/", $this->courseStartDate->data);
	 			$startDate = mktime(0,0,0, $temp1[0],$temp1[1],$temp1[2]);
				$temp2 = explode("/", date("m/d/Y"));
			 	$curdate = mktime(0,0,0, $temp2[0], $temp2[1], $temp2[2]);
				if(($startDate - $curdate) < 0)
				{
					return "course start date must be greater than or equal to current date";
				}
				else
				{
					return "";
				}
			}
		}	 
	}
	function checkCourseEndDate()
	{
		$pattern = '/^(?=\d)(?:(?:(?:(?:(?:0?[13578]|1[02])(\/|-|\.)31)\1|(?:(?:0?[1,3-9]|1[0-2])(\/|-|\.)(?:29|30)\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})|(?:0?2(\/|-|\.)29\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))|(?:(?:0?[1-9])|(?:1[0-2]))(\/|-|\.)(?:0?[1-9]|1\d|2[0-8])\4(?:(?:1[6-9]|[2-9]\d)?\d{2}))($|\ (?=\d)))?(((0?[1-9]|1[012])(:[0-5]\d){0,2}(\ [AP]M))|([01]\d|2[0-3])(:[0-5]\d){1,2})?$/';
		$dt = $this->courseEndDate->data;
		if($this->PageAction=="SAVE")
		{
			if($this->courseEndDate->data == "")
				return "Course End date cannot be blank";
			else
			{
				if(strrpos($this->courseEndDate->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(!preg_match($pattern, $dt))
				{
					return "Invalid date format";
				}
				$temp2 = explode("/", $this->courseEndDate->data);
			 	$endDate = mktime(0,0,0, $temp2[0],$temp2[1],$temp2[2]);
			 	$temp1 = explode("/", date("m/d/Y"));
			 	$curdate = mktime(0,0,0, $temp1[0], $temp1[1], $temp1[2]);
				if(($endDate - $curdate) < 0)
				{
					return "course end date must be greater than the current date";
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
		$dt = $this->lastDateForApp->data;
		if($this->PageAction=="SAVE")
		{
			if($this->lastDateForApp->data == "")
				return "Last date for application cannot be blank";
			else
			{
				if(strrpos($this->lastDateForApp->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(!preg_match($pattern, $dt))
				{
					return "Invalid date format";
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
		if($this->PageAction=="SAVE")
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
		if($this->PageAction=="SAVE")
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
		if($this->PageAction=="SAVE")
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
					return "Course Fee must contain 10 numbers";
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
		if($this->PageAction=="SAVE")
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
					return "Enter numeric value for cme credits";
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
$mPage = new Main("Add CME Course For CME Provider", $myPage, $myPage->role);
$mPage->showPage();
$myPage->security->clearLandingPage();
session_write_close();
?>
