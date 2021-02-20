<?php
/*
 * Created on Dec 17, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/Model.Doctor.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.EmailList.php");
require_once("./classes/class.Security.php");
class Page
{
	//Model Object
	var $doctor;
	
	//Form Control
	var $firstName;
	var $middleName;
	var $middleName_error;
	var $lastName;
	var $sex;
	var $address1;
	var $address1_error;
	var $address2;
	var $address2_error;
	var $city;
	var $city_error;
	var $state;
	var $zip;
	var $zip_error;
	var $email;
	var $email_error;
	var $loginName;
	var $password;
	var $password_error;
	var $newPassword;
	var $newPassword_error;
	var $confirmPassword;
	var $confirmPassword_error;
	var $equalPassword_error;
	var $contactTime;
	var $contactTime_error;
	var $speciality;
	var $speciality_error;
	var $phoneNum_error;
	var $workPhone;
	var $workPhone_error;
	var $homePhone;
	var $homePhone_error;
	var $mobilePhone;
	var $mobilePhone_error;
	var $fax;
	var $fax_error;
	
	var $bal;
	
	//array
	var $StateList;
	var $SpecialityList;
	var $SexList;
	var $emailList;
	var $condt;
	//error class
 	var $error;
 	var $security;	
	function Page()
	{
		$this->doctor = new ModelDoctor();
		$this->doctor->autoSetfromPost();
		$this->bal = new BAL();
		$this->condt = true;
		$this->error = new Error();
		$this->emailList = new EmailList();
		$this->security = new Security();
		
		if (!isset($_REQUEST["PostBack"]))
			$this->postBack= "false";
		else
			$this->postBack = $_REQUEST["PostBack"];
		
		$result = "";		
 		$this->doctorId = $_SESSION["UserId"];
 		
 		$role = $this->security->CheckRole();
		if($role == "DOCTOR")
		{
			$loginStatus = $this->security->CheckLoginStatus();
			
			if($loginStatus == "NOTLOGGEDIN")
			{
				$this->security->setLandingPage("editDoctorDetails.php");
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
			$this->security->setLandingPage("editDoctorDetails.php");
			session_write_close();
			header("location:./login.php?p=DOCTOR");
		}
 		$userAgent = $this->security->CheckUserAgent();
		//echo "user agent : " . $userAgent;
		if($userAgent != $_SERVER["HTTP_USER_AGENT"])
		{
			$this->security->setLandingPage("editDoctorDetails.php");
			session_write_close();
			header("Location:./login.php?p=DOCTOR");
		}
		$this->error = $this->bal->getDoctorDetails($this->doctorId, $result);
		if(mysql_num_rows($result) == 0)
		{
			session_write_close();
			header("location:./invalidId.php?type=doctorId");
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
						$this->doctor->doctorId = $this->doctorId->data;
						$this->firstName = new TextBox("First Name","firstName",$Doctor["FirstName"],"50","25", "true");
						$this->doctor->name->firstName = $this->firstName->data;
						$this->middleName = new TextBox("Middle Name","middleName",$Doctor["MiddleName"],"50","25");
						$this->doctor->name->middleName = $this->middleName->data;
						$this->lastName = new TextBox("Last Name","lastName",$Doctor["LastName"],"50","25", "true");
						$this->doctor->name->lastName = $this->lastName->data;
						$this->sex =  new TextBox("Sex","sex",$Doctor["Sex"],"50","25", "true");
						$this->doctor->sex = $this->sex->data;
						$this->address1 = new TextBox("Address1 ","address1",$Doctor["Address1"],"250","35");
						$this->doctor->address->address1  = $this->address1->data;
						$this->address2 = new TextBox("Address2 ","address2",$Doctor["Address2"],"250","35");
						$this->doctor->address->address2  = $this->address2->data;
						$this->city = new TextBox("City","city",$Doctor["City"],"50","20");
						$this->doctor->address->city = $this->city->data;
						$this->state = new SelectList("State", "State", $Doctor["State"]);
						$this->doctor->address->state = $this->state->data;
						$this->zip = new TextBox("Zip","zip",$Doctor["Zip"],"20","10");
						$this->doctor->address->zip = $this->zip->data;
						$this->country = new TextBox("Country","country","USA","50","20", "true");
						$this->workPhone = new TextBox("Primary Phone No.","workPhone",$Doctor["WorkPhone"],"50","20");
						$this->doctor->phone->workPhone = $this->workPhone->data;
						$this->homePhone = new TextBox("Secondary Phone No.","homePhone",$Doctor["HomePhone"],"50","20");
						$this->doctor->phone->homePhone = $this->homePhone->data;
						$this->fax = new TextBox("Fax","fax",$Doctor["Fax"],"50","20");
						$this->doctor->phone->fax = $this->fax->data;
						$this->mobilePhone = new TextBox("Mobile","mobilePhone",$Doctor["MobilePhone"],"50","20");
						$this->doctor->phone->mobilePhone = $this->mobilePhone->data;
						$this->email= new TextBox("Email Address","email",$Doctor["EmailId"],"50","20");
						$this->doctor->email = $this->email->data;
						$this->speciality = new SelectList("Speciality", "Speciality", $Doctor["Speciality"]);
						$this->doctor->speciality = $this->speciality->data;
						$this->contactTime= new TextBox("Best Time to Contact","contactTime",$Doctor["ContactTime"],"50","20");
						$this->doctor->contactTime = $this->contactTime->data; 
						$this->loginName= new TextBox("User Name","loginName",$Doctor["UserName"],"50","20", "true");
						
					}
				}
			}
			else
			{
				$this->doctorId = new TextBox("Doctor ID", "doctorId", $this->doctor->doctorId, "50", "25", "true");
				$this->firstName = new TextBox("First Name","firstName",$this->doctor->name->firstName,"50","25", "true");
				$this->middleName = new TextBox("Middle Name","middleName",$this->doctor->name->middleName,"50","25");
				$this->lastName = new TextBox("Last Name","lastName",$this->doctor->name->lastName,"50","25");
				$this->sex = new TextBox("Sex","sex",$this->doctor->sex, "50", "25", "true");
				$this->address1 = new TextBox("Address 1","address1",$this->doctor->address->address1,"250","35");
				$this->address2 = new TextBox("Address 2","address2",$this->doctor->address->address2,"250","35");
				$this->city = new TextBox("City","city",$this->doctor->address->city,"50","20");
				$this->state = new SelectList("State", "State", $this->doctor->address->state);
				$this->zip = new TextBox("Zip","zip",$this->doctor->address->zip,"20","10");
				$this->country = new TextBox("Country","country","USA","50","20", "true");
				$this->workPhone = new TextBox("Primary Phone No.","workPhone",$this->doctor->phone->workPhone,"50","20");
				$this->homePhone = new TextBox("Secondary Phone No.","homePhone",$this->doctor->phone->homePhone,"50","20");
				$this->fax = new TextBox("Fax","fax",$this->doctor->phone->fax,"50","20");
				$this->mobilePhone = new TextBox("Mobile","mobilePhone",$this->doctor->phone->mobilePhone,"50","20");
				$this->email= new TextBox("Email Address","email",$this->doctor->email,"50","20");
				$this->speciality = new SelectList("Speciality", "Speciality", $this->doctor->speciality);
				$this->contactTime= new TextBox("Best Time to Contact","contactTime",$this->doctor->contactTime,"50","20");
				$this->loginName= new TextBox("User Name","loginName",$this->doctor->login->loginName,"50","20", "true");
			
			}
		}
		$this->password= new Password("Old Password","password",$this->doctor->password,"50","20");
		$this->newPassword= new Password("New Password","newPassword","","50","20");
		$this->confirmNewPassword= new Password("Confirm New Password","confirmNewPassword","","50","20");
		
		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction= "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];
		
		$this->error =  $this->bal->getComboSexList($this->SexList);
		$this->error =  $this->bal->getComboStateList($this->StateList);
		$this->error =  $this->bal->getComboSpecialityList($this->SpecialityList);
	}
			
	function formLoad()
	{
		if($this->PageAction == "UPDATE")
		{
			$this->doctor->autoSetFromPost();
			//validation
			$this->middleName_error = $this->checkMiddleName();
			if($this->middleName_error != "")
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
			
			if($this->condt)
			{
				$this->error = $this->bal->editDoctorDetails($this->doctor);
				if(!$this->error->isError())
				{
					session_write_close();
					header("location:./doctorOptions.php?msg=detailssuccess");
				}
			}
			
		}
		elseif($this->PageAction == "RESET")
		{
			$this->condt = true;
			$password = $_REQUEST["password"];
			$newPassword = $_REQUEST["newPassword"];
			$confirmNewPassword = $_REQUEST["confirmNewPassword"];
			$this->password_error = $this->checkOldPassword($password);
			if($this->password_error != "")
				$this->condt = false;
			$this->newPassword_error = $this->checkNewPassword($newPassword);
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
				$this->error = $this->bal->resetDoctorPassword($this->doctor, $password, $newPassword);
				if(!$this->error->isError())
				{
					session_write_close();
					header("location:./doctorOptions.php?msg=resetsuccess");
				}
			}
		}
	}
	function showContent()
	{
		$this->formLoad();
		include ("./html/html.editDoctorDetails.php");

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
		if($this->PageAction=="SAVE")
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
					if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/", $this->email->data))
					{
						$dupVal = "";
						$this->error = $this->bal->checkDocDupEntriesForEmailId($this->email->data, $dupVal);
						if($dupVal != "")
						{
							return "EmailId already exists, choose other email id";
						}
						else
						{
							return "";
						}
					}
					else
					{
						return "Enter valid email id";
					}
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
	
	function checkOldPassword($pass)
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
				elseif(!preg_match("/[a-z A-Z][0-9]/", $pass))
				{
					return "Password must contain atleast one digit";
				}
				else
				{
					$dupVal = "";
					$this->error = $this->bal->checkDocPasswordExists($this->doctor->doctorId, $pass, $dupVal);
					if($dupVal != "")
					{
						return "";
					}
					else
					{
						return "User Name and Password do not match";
					}
				}	
			}
		}
	}
	function checkNewPassword($pass)
	{
		if($this->PageAction=="RESET")
		{
			if($pass == "")
				return "New Password cannot be blank";
			else
			{
				if(strrpos($pass, "'") >= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($pass) > 15)
				{
					return "New Password must contain less than or equal to 15 chars";
				}
				elseif(strlen($pass) < 7)
				{
					return "New Password must not contain less than 7 chars";
				}
				elseif(!preg_match("/[a-z A-Z][0-9]/", $pass))
				{
					return "New Password must contain letters followed by atleast one digit";
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
					return "\n\nPassword and Confirm password must be same";
				}
			}
		}
	}
	
}
	

$mPage = new Main("Edit Doctor's Personal Details",new Page());
$mPage->showPage();
session_write_close();
?>

