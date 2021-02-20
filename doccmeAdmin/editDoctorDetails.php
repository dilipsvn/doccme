<?php
/*
 *	Created on Mar 28, 2007
 *	author Poornima Kamatgi
 *
 *	this class enables admin/agent
 *	to edit the details of
 *	registered doctor in DocCME
 *	and also reset the password
 *	of an doctor if required
 * 
 */
 session_start();
 require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/Model.Doctor.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.AdminAgentSecurity.php");

class Page
{
	//Model Object
	var $Doctor;
	
	//Form Control
	var $doctorId;
	var $firstName;
	var $firstName_error;
	var $middleName;
	var $middleName_error;
	var $lastName;
	var $lastName_error;
	var $sex;
	var $sex_error;
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
	var $contactTime;
	var $contactTime_error;
	var $speciality;
	var $speciality_error;
	var $workPhone;
	var $workPhone_error;
	var $homePhone;
	var $homePhone_error;
	var $mobilePhone;
	var $mobilePhone_error;
	var $fax;
	var $fax_error;
	var $email;
	var $email_error;
	var $loginName;
	var $loginName_error;
	var $status;
	var $remarks;
	var $remarks_error;
	
	//BAL object
	var $bal;
	var $security;
	var $condt;
	//array
	var $StateList;
	var $StatusList;
	var $SpecialityList;
	
	//Error object
	var $error;
			
	function Page()
	{
		$this->Doctor = new ModelDoctor();
		$this->Doctor->autoSetfromPost();
		$this->bal = new BAL();
		$this->error = new Error();
		$this->id = $_GET["id"];
		$result = "";
		$this->condt = true;
 		$this->security = new AdminAgentSecurity();
 		$this->role = $this->security->CheckRole();
 		if($this->role == "AGENT")
		{
			$this->error = $this->bal->checkAccessOfAgent("4", $result);
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
 		if (!isset($_REQUEST["PostBack"]))
			$this->postBack= "false";
		else
			$this->postBack = $_REQUEST["PostBack"];
		
 		$this->error = $this->bal->getDoctorDetails($this->id, $result);
 		if(mysql_num_rows($result) == 0)
		{
			session_write_close();
			header("location:./invalidId.php");
		}
		else
		{
			if($this->postBack == "false")
			{
				if($result != null)
				{
					while($Doctor = mysql_fetch_assoc($result))
					{
						$this->doctorId = new TextBox("Doctor ID", "doctorId", $Doctor["DoctorId"], "50", "25", "true");
						$this->Doctor->doctorId = $this->doctorId->data;
						$this->firstName = new TextBox("First Name","firstName",$Doctor["FirstName"],"50","25", "true");
						$this->Doctor->name->firstName = $this->firstName->data;
						$this->middleName = new TextBox("Middle Name","middleName",$Doctor["MiddleName"],"50","25");
						$this->Doctor->name->middleName = $this->middleName->data;
						$this->lastName = new TextBox("Last Name","lastName",$Doctor["LastName"],"50","25");
						$this->Doctor->name->lastName = $this->lastName->data;
						$this->sex = new TextBox("Sex","sex",$Doctor["Sex"],"50","25","true");
						$this->Doctor->sex = $this->sex->data;
						$this->address1 = new TextBox("Address1 ","address1",$Doctor["Address1"],"250","35");
						$this->Doctor->address->address1  = $this->address1->data;
						$this->address2 = new TextBox("Address2 ","address2",$Doctor["Address2"],"250","35");
						$this->Doctor->address->address2  = $this->address2->data;
						$this->city = new TextBox("City","city",$Doctor["City"],"50","20");
						$this->Doctor->address->city = $this->city->data;
						$this->state = new SelectList("State", "State", $Doctor["State"]);
						$this->Doctor->address->state = $this->state->data;
						$this->zip = new TextBox("Zip","zip",$Doctor["Zip"],"20","10");
						$this->Doctor->address->zip = $this->zip->data;
						$this->country = new TextBox("Country","country","USA","50","20", "true");
						$this->workPhone = new TextBox("Primary Phone No.","workPhone",$Doctor["WorkPhone"],"50","20");
						$this->Doctor->phone->workPhone = $this->workPhone->data;
						$this->homePhone = new TextBox("Secondary Phone No.","homePhone",$Doctor["HomePhone"],"50","20");
						$this->Doctor->phone->homePhone = $this->homePhone->data;
						$this->fax = new TextBox("Fax","fax",$Doctor["Fax"],"50","20");
						$this->Doctor->phone->fax = $this->fax->data;
						$this->mobilePhone = new TextBox("Mobile","mobilePhone",$Doctor["MobilePhone"],"50","20");
						$this->Doctor->phone->mobilePhone = $this->mobilePhone->data;
						$this->email= new TextBox("Email Address","email",$Doctor["EmailId"],"50","20", "true");
						$this->Doctor->email = $this->email->data;
						$this->speciality = new SelectList("Speciality", "Speciality", $Doctor["Speciality"]);
						$this->Doctor->speciality = $this->speciality->data;
						$this->contactTime= new TextBox("Best Time to Contact","contactTime",$Doctor["ContactTime"],"50","20");
						$this->Doctor->contactTime = $this->contactTime->data; 
						$this->loginName= new TextBox("User Name","loginName",$Doctor["UserName"],"50","20", "true");
						$this->status = new SelectList("Status", "status", $Doctor["Status"]);
						$this->Doctor->status = $this->status->data;
						$this->remarks = new TextBox("Remarks", "remarks", $Doctor["Remarks"], "50", "25");
						$this->Doctor->remarks = $this->remarks->data;
					}
				}
			}
			else
			{
				$this->doctorId = new TextBox("Doctor ID", "doctorId", $this->Doctor->doctorId, "50", "25", "true");
				$this->firstName = new TextBox("First Name","firstName",$this->Doctor->name->firstName,"50","25", "true");
				$this->middleName = new TextBox("Middle Name","middleName",$this->Doctor->name->middleName,"50","25");
				$this->lastName = new TextBox("Last Name","lastName",$this->Doctor->name->lastName,"50","25");
				$this->sex = new SelectList("Sex","sex",$this->Doctor->sex);
				$this->address1 = new TextBox("Address 1","address1",$this->Doctor->address->address1,"250","35");
				$this->address2 = new TextBox("Address 2","address2",$this->Doctor->address->address2,"250","35");
				$this->city = new TextBox("City","city",$this->Doctor->address->city,"50","20");
				$this->state = new SelectList("State", "State", $this->Doctor->address->state);
				$this->zip = new TextBox("Zip","zip",$this->Doctor->address->zip,"20","10");
				$this->country = new TextBox("Country","country","USA","50","20", "true");
				$this->workPhone = new TextBox("Primary Phone No.","workPhone",$this->Doctor->phone->workPhone,"50","20");
				$this->homePhone = new TextBox("Secondary Phone No.","homePhone",$this->Doctor->phone->homePhone,"50","20");
				$this->fax = new TextBox("Fax","fax",$this->Doctor->phone->fax,"50","20");
				$this->mobilePhone = new TextBox("Mobile","mobilePhone",$this->Doctor->phone->mobilePhone,"50","20");
				$this->email= new TextBox("Email Address","email",$this->Doctor->email,"50","20", "true");
				$this->speciality = new SelectList("Speciality", "Speciality", $this->Doctor->speciality);
				$this->contactTime= new TextBox("Best Time to Contact","contactTime",$this->Doctor->contactTime,"50","20");
				$this->loginName= new TextBox("User Name","loginName",$this->Doctor->login->loginName,"50","20", "true");
				$this->status = new SelectList("Status", "status", $this->Doctor->status);
				$this->remarks = new TextBox("Remarks", "remarks", $this->Doctor->remarks, "50", "25");
			}
		}
	
		$this->newPassword= new Password("New Password","newPassword","","50","20");
		$this->confirmNewPassword= new Password("Confirm New Password","confirmNewPassword","","50","20");
		
		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction= "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];
		
		$this->error =  $this->bal->getComboSexList($this->SexList);
		$this->error =  $this->bal->getComboStateList($this->StateList);
		$this->error =  $this->bal->getComboSpecialityList($this->SpecialityList);
		$this->error = $this->bal->getComboUserStatusList($this->StatusList);
						
	}
	
	function formLoad()
	{
		if($this->PageAction == "UPDATE")
		{
			$this->Doctor->autoSetFromPost();
			//validation
			$this->firstName_error = $this->checkFirstName();
			if($this->firstName_error != "")
				$this->condt = false;
			$this->middleName_error = $this->checkMiddleName();
			if($this->middleName_error != "")
				$this->condt = false;
			$this->lastName_error = $this->checkLastName();
			if($this->lastName_error != "")
				$this->condt = false;
			$this->sex_error = $this->checkSex();
			if($this->sex_error != "")
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
			$this->workPhone_error = $this->checkWorkPhone();
			if($this->workPhone_error != "")
				$this->condt = false;
			$this->homePhone_error = $this->checkHomePhone();
			if($this->homePhone_error != "")
				$this->condt = false;
			$this->fax_error = $this->checkFax();
			if($this->fax_error != "")
				$this->condt = false;
			$this->mobilePhone_error = $this->checkMobilePhone();
			if($this->mobilePhone_error != "")
				$this->condt = false;
			$this->email_error = $this->checkEmail();
			if($this->email_error != "")
				$this->condt = false;
			$this->speciality_error = $this->checkSpeciality();
			if($this->speciality_error != "")
				$this->condt = false;
			$this->contactTime_error = $this->checkContactTime();
			if($this->contactTime_error != "")
				$this->condt = false;
			$this->status_error = $this->checkStatus();
			if($this->status_error != "")
				$this->condt = false;
			$this->remarks_error = $this->checkRemarks();
			if($this->remarks_error != "")
				$this->condt = false;	
			
			if($this->condt)
			{
				$this->error = $this->bal->editDoctorDetails($this->Doctor);
				if(!$this->error->isError())
				{
					session_write_close();
					header("location:./searchDoctor.php?msg=successdocdet");
				}
			}
			
		}
		elseif($this->PageAction == "RESET")
		{
			$this->condt = true;
			$newPassword = $_REQUEST["newPassword"];
			$confirmNewPassword = $_REQUEST["confirmNewPassword"];
			$this->newPassword_error = $this->checkPassword($newPassword);
			if($this->newPassword_error != "")
				$this->condt = false;
			$this->confirmNewPassword_error = $this->checkConfirmPassword($confirmNewPassword);
			if($this->confirmNewPassword_error != "")
				$this->condt = false;
			$this->equalPass_error = $this->checkEqualPasswords($newPassword, $confirmNewPassword);
			if($this->equalPass_error != "")
				$this->condt = false;
			if($this->condt)
			{
				$this->error = $this->bal->resetDoctorPassword($this->Doctor, $newPassword);
				if(!$this->error->isError())
				{
					session_write_close();
					header("location:./searchDoctor.php?msg=successdocpass");
				}
			}
		}
	}
	
	function showContent()
	{
		$this->formLoad();
		include("./html/html.editDoctorDetails.php");
	}
	function checkFirstName()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->firstName->data == "")
			{
				return "First Name cannot be blank";
			}
			else
			{
				if(strrpos($this->firstName->data, "'") >= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->firstName->data) > 50 || strlen($this->firstName->data) < 3)
				{
						return "first name must contain less than 50 chars but not less than 3 chars";
				}
				else
				{
					return "";
				}
			}
		}
	}
	function checkMiddleName()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->middleName->data != "")
			{

				if(strrpos($this->middleName->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->middleName->data) > 50)
				{
						return "middle name must contain less than 50 characters";
				}
				else
				{
					return "";

				}
			}
			else
				return "";
		}
	}
	function checkLastName()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->lastName->data == "")
			{
				return "Last Name cannot be blank";
			}
			else
			{
				if(strrpos($this->lastName->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->lastName->data) > 50 )
				{
						return "last name must contain less than 50 characters";
				}
				else
				{
						return "";
				}
			}
		}
	}
	function checkSex()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->sex->data == "")
				return "";
			else
			{

					return "";

			}
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
				elseif(strlen($this->address1->data) > 100 || strlen($this->address1->data) < 5)
				{
						return "Address1 must contain less than 100 characters but not less than 5 chars";
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
						return "Address2 must contain less than 100 chars";
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
						return "City must contain less than 50 chars but not less than 4 chars";
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
	function checkWorkPhone()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->workPhone->data != "")
			{
				if(strrpos($this->workPhone->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(!preg_match("/^(\([0-9]{3}\)|[0-9]{3})[- \s]?[0-9]{3}[\s -]?[0-9]{4}/", $this->workPhone->data))
				{
					return "Enter valid phone no.";
				}
				else
				{
					return "";
				}
			}
			else
			{
				return "";
			}
		}
	}
	function checkHomePhone()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->homePhone->data != "")
			{

				if(strrpos($this->homePhone->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(!preg_match("/^(\([0-9]{3}\)|[0-9]{3})[- \s]?[0-9]{3}[\s -]?[0-9]{4}/", $this->homePhone->data))
				{
					return "Enter valid phone no.";
				}
				else
				{
					return "";
				}
			}
			else
				return "";
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
			else
				return "";
		}
	}
	function checkMobilePhone()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->mobilePhone->data != "")
			{

				if(strrpos($this->mobilePhone->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(!preg_match("/^(\([0-9]{3}\)|[0-9]{3})[- \s]?[0-9]{3}[\s -]?[0-9]{4}/", $this->mobilePhone->data))
				{
					return "Enter valid phone no.";
				}
				else
				{
					return "";
				}
			}
			else
				return "";
		}
	}
	function checkEmail()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->email->data == "")
				return "Email Address cannot be blank";
			else
			{
				if(strrpos($this->email->data, "'") >= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->email->data) > 50 || strlen($this->email->data) < 10)
				{
					return "Email must contain less than or equal to 50 chars not less than 10 chars";
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
		if($this->PageAction=="UPDATE")
		{
			if($this->speciality->data == "")
				return "";
			else
			{
				return "";
			}
		}
	}
	function checkStatus()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->status->data == "")
				return "Select Status";
			else
			{
				return "";
			}
		}
	}
	function checkContactTime()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->contactTime->data != "")
			{
				if(strrpos($this->contactTime->data, "'") >= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->contactTime->data) > 50 || strlen($this->contactTime->data) < 3 )
				{
					return "contact time must contain less than or equal to 50 chars not less than 3 chars";
				}
				else
				{
					return "";
				}
			}
			else
				return "";
		}
	}
	function checkLoginName()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->loginName->data == "")
				return "Login Name cannot be blank";
			else
			{
				if(strrpos($this->loginName->data, "'") >= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->loginName->data) > 30 || strlen($this->loginName->data) < 6)
				{
					return "login name must contain less than or equal to 30 chars not less than 6 chars";
				}
				else
				{
					return "";
				}
			}
		}
	}
	function checkPassword($pass)
	{
		if($this->PageAction=="RESET")
		{
			if($pass == "")
				return "Password cannot be blank";
			else
			{
				if(strrpos($pass, "'") >= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($pass) > 15)
				{
					return "Password must contain less than or equal to 15 chars";
				}
				elseif(strlen($pass) < 7)
				{
					return "Password must not contain less than 7 chars";
				}
				elseif(!preg_match("/[a-z][0-9]/", $pass))
				{
					return "Password must contain letters followed by atleast one digit";
				}
				else
				{
					return "";
				}
			}
		}
	}
	function checkConfirmPassword($pass)
	{
		if($this->PageAction=="RESET")
		{
			if($pass == "")
				return "Confirm Password cannot be blank";
			else
			{
				if(strrpos($pass, "'") >=1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($pass) > 15)
				{
					return "Confirm password must contain less than or equal to 15 chars";
				}
				elseif(strlen($pass) < 7)
				{
					return "Confirm password must not contain less than 7 chars";
				}
				elseif(!preg_match("/[a-z][0-9]/", $pass))
				{
					return "Confirm password must contain letters followed by atleast one digit";
				}
				else
				{
					return "";
				}
			}
		}
	}
	function checkEqualPasswords($newPass, $confirmPass)
	{
		if($this->PageAction=="RESET")
		{
			if(($newPass != "") && ($confirmPass != ""))
			{
				if(strcmp($newPass, $confirmPass) == 0)
				{
					return  "";
				}
				else
				{
					return "Password and Confirm password must be same";
				}
			}
		}
	}
	function checkRemarks()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->remarks->data != "")
			{
				if(strrpos($this->remarks->data, "'") >= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->remarks->data) > 250)
				{
					return "remarks time must contain less than or equal to 250 chars";
				}
				else
				{
					return "";
				}
			}
			else
				return "";
		}
	}
}

$myPage = new Page();
$mPage = new Main("Edit Doctor Details", $myPage, $myPage->role);
$mPage->showPage();
session_write_close(); 
?>
