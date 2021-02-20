<?php
/*
 *  Created on Mar 28, 2007
 *	author Poornima Kamatgi
 *
 *	this class enables an admin/agent
 *	to register Doctor in DocCME by filling
 *	in the details after registration, Doctor can
 *	login and avail the facilities in DocCME
 *
 *
 */
 session_start();
 require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/Model.Doctor.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.EmailList.php");
require_once("./classes/class.AdminAgentSecurity.php");
class Page
{
	//Model Object
	var $doctor;

	//Form Control
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
	var $password;
	var $password_error;
	var $confirmPassword;
	var $confirmPassword_error;
	var $equalPassword_error;

	var $security;
	var $bal;
	var $emailList;
	//array
	var $StateList;
	var $SpecialityList;
	var $SexList;

	//error class
 	var $error;

    var $condt;

	function Page()
	{
		$this->doctor = new ModelDoctor();
		$this->doctor->autoSetfromPost();
		$this->bal = new BAL();
		$this->emailList = new EmailList();
		$this->condt = true;
		$this->error = new Error();
		$result = "";
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

		$this->firstName = new TextBox("First Name","firstName",$this->doctor->name->firstName,"50","25");
		$this->middleName = new TextBox("Middle Name","middleName",$this->doctor->name->middleName,"50","25");
		$this->lastName = new TextBox("Last Name","lastName",$this->doctor->name->lastName,"50","25");
		$this->sex = new SelectList("Sex","sex",$this->doctor->sex);
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
		$this->loginName= new TextBox("User Name","loginName",$this->doctor->login->loginName,"50","20");
		$this->password= new Password("Password","password",$this->doctor->login->password,"50","20");
		$this->confirmPassword= new Password("Confirm Password","confirmPassword",$this->doctor->login->confirmPassword,"50","20");




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
		if($this->PageAction=="SAVE")
		{

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
			$this->loginName_error = $this->checkLoginName();
			if($this->loginName_error != "")
				$this->condt = false;
			$this->password_error = $this->checkPassword();
			if($this->password_error != "")
				$this->condt = false;
			$this->confirmPassword_error = $this->checkConfirmPassword();
			if($this->confirmPassword_error != "")
				$this->condt = false;
			$this->equalPassword_error = $this->checkEqualPasswords();
			if($this->equalPassword_error != "")
				$this->condt = false;
			if($this->condt)
			{
				$this->error = $this->bal->registerDoctor($this->doctor);
				if(!$this->error->isError())
				{
					//send email to registered doctor
					$mailto = $this->email->data;
					$HTMLMail = "<HTML>";
					$HTMLMail .= "<HEAD> <TITLE>Application for Doctor</TITLE> </HEAD>";
					$HTMLMail .= "<p>Dear Doctor,</p>";
					$HTMLMail .= "<p>We want to thank you and appreciate you registering with us. We guarantee all our services and our commitment to excellent service. </p>";
					$HTMLMail .= "<p>One of our customer service agents will get back to you in next 24 hours according to the availability specified by you. </p>";
					$HTMLMail .= "<p> Again we appreciate your business and will make every effort to meet your expectations. </p>";
					$HTMLMail .= "<p> Please do not hesitate to call us as soon as possible.</p>";
					$HTMLMail .= "<P>Following are the details of your email.</P>";
					$HTMLMail .= "<P> Applicant Details : </P>";
					$HTMLMail .= "<CENTER> <TABLE>";
					$HTMLMail .= "<TR><TD> First Name </TD><TD>&nbsp;</TD><TD> ".  $this->firstName->data. " </TD></TR>";
					$HTMLMail .= "<TR><TD> Last Name </TD><TD>&nbsp;</TD><TD> ".  $this->lastName->data. " </TD></TR>";
					$HTMLMail .= "<TR><TD> Email ID </TD><TD>&nbsp;</TD><TD>".  $this->email->data. "</TD></TR>";
					$HTMLMail .= "<TR><TD> Login Name </TD><TD>&nbsp;</TD><TD>".  $this->loginName->data."</TD></TR>";
					$HTMLMail .= "<TR><TD> Password </TD><TD>&nbsp;</TD><TD>".  $this->password->data."</TD></TR>";
					$HTMLMail .= "</TABLE></CENTER>";
					$HTMLMail .= "<p>We hope that you will find it very handy in booking  medical courses</p><p>Regards <br/>Doccme Admin</p>";
					$HTMLMail .= "</BODY>";
					$HTMLMail .= "</HTML>";
					$subject = "Application for Doctor";
					$headers  = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type: text/html; charset=iso-8859-1" ."\r\n";
					$headers .= "From: <info@doccme.com >" ."\r\n";

					if(!mail($mailto, $subject , $HTMLMail, $headers))
					{
						echo "Error in sending email to doctor : " . $this->firstName->data;
					}
					//send mail to admin
					$mailtoAdmin = $this->emailList->getEmailId("admin");
					$HTMLMail = "<HTML>";
					$HTMLMail .= "<HEAD> <TITLE>Application for Doctor</TITLE> </HEAD>";
					$HTMLMail .= "<BODY>";
					$HTMLMail .= "<p>Dear Admin,</p>";
					$HTMLMail .= "<p>We  confirm  registration of the Doctor with us.</p>";
					$HTMLMail .= "<P> Applicant Details : </P>";
					$HTMLMail .= "<CENTER> <TABLE>";
					$HTMLMail .= "<TR><TD> First Name </TD><TD>&nbsp;</TD><TD> ".  $this->firstName->data. " </TD></TR>";
					$HTMLMail .= "<TR><TD> Last Name </TD><TD>&nbsp;</TD><TD> ".  $this->lastName->data. " </TD></TR>";
					$HTMLMail .= "<TR><TD> Email ID </TD><TD>&nbsp;</TD><TD>".  $this->email->data. "</TD></TR>";
					$HTMLMail .= "<TR><TD> Login Name </TD><TD>&nbsp;</TD><TD>".  $this->loginName->data."</TD></TR>";
					$HTMLMail .= "<TR><TD> Password </TD><TD>&nbsp;</TD><TD>".  $this->password->data."</TD></TR>";
					$HTMLMail .= "</TABLE></CENTER>";
					$HTMLMail .= "<p>Regards <br/>Doccme CR</p>";

					$HTMLMail .= "</BODY>";
					$HTMLMail .= "</HTML>";
					$subject = "Application for Doctor";
					$headers  = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type: text/html; charset=iso-8859-1" ."\r\n";
					$headers .= "From: <info@doccme.com >" ."\r\n";
					if(!mail($mailtoAdmin, $subject , $HTMLMail, $headers))
					{
						echo "Error in sending email to admin";
					}
					session_write_close();
					header("location:./doctors.php?msg=success");
				}

			}

		}
	}

	function showContent()
	{
		$this->formLoad();
		include ("./html/html.doctorRegister.php");

	}

	function checkFirstName()
	{
		if($this->PageAction=="SAVE")
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
				elseif(strlen($this->firstName->data) > 50) 
				{
					return "first name must contain less than 50 chars";
				}
				elseif(strlen($this->firstName->data) < 3)
				{
					return "first name should not less than 3 chars";
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
		if($this->PageAction=="SAVE")
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
		if($this->PageAction=="SAVE")
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
		if($this->PageAction=="SAVE")
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
				elseif(strlen($this->address2->data) > 100 || strlen($this->address2->data) < 4)
				{
						return "Address2 must contain less than 100 chars not less than  4 chars";
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
				return  "Zip cannot be blank";
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
		if($this->PageAction=="SAVE")
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
		if($this->PageAction=="SAVE")
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
			else
				return "";
		}
	}
	function checkMobilePhone()
	{
		if($this->PageAction=="SAVE")
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
		if($this->PageAction=="SAVE")
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
		if($this->PageAction=="SAVE")
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
		if($this->PageAction=="SAVE")
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
				$dupVal = "";
				$this->error = $this->bal->checkDocDupEntriesForUserName($this->loginName->data, $dupVal);
				if($dupVal != "")
				{
					return "User name already exists , choose another username";
				}
				else
				{
					return "";
				}
				}
			}
		}
	}
	function checkPassword()
	{
		if($this->PageAction=="SAVE")
		{
			if($this->password->data == "")
				return "Password cannot be blank";
			else
			{
				if(strrpos($this->password->data, "'") >= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->password->data) > 15)
				{
					return "Password must contain less than or equal to 15 chars";
				}
				elseif(strlen($this->password->data) < 7)
				{
					return "Password must not contain less than 7 chars";
				}
				elseif(!preg_match("/[a-z][0-9]/", $this->password->data))
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
	function checkConfirmPassword()
	{
		if($this->PageAction=="SAVE")
		{
			if($this->confirmPassword->data == "")
				return "Confirm Password cannot be blank";
			else
			{
				if(strrpos($this->confirmPassword->data, "'") >=1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->confirmPassword->data) > 15)
				{
					return "Confirm password must contain less than or equal to 15 chars";
				}
				elseif(strlen($this->confirmPassword->data) < 7)
				{
					return "Confirm password must not contain less than 7 chars";
				}
				elseif(!preg_match("/[a-z][0-9]/", $this->confirmPassword->data))
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
	function checkEqualPasswords()
	{
		if($this->PageAction=="SAVE")
		{
			if(($this->password->data != "") && ($this->confirmPassword->data != ""))
			{
				if(strcmp($this->password->data, $this->confirmPassword->data) == 0)
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

}
$myPage = new Page();
$mPage = new Main("Admin's Doctor Register", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>
