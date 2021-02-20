<?php
/*
 *	Created on Mar 28, 2007
 *	author Poornima Kamatgi
 *
 * 	this is agent registration page class
 * 	this class includes html page representation of form
 * 	this class validates the fields in form
 * 	saves the agent info by calling appropriate BAL method
 *
 * 	revised on May 29, 2007
 *
 */
 session_start();
 require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/Model.Agent.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.EmailList.php");
require_once("./classes/class.AdminAgentSecurity.php");
class Page
{
	//Model Object
	var $agent;

	//Form Control
	var $firstName;
	var $firstName_error;
	var $middleName;
	var $middleName_error;
	var $lastName;
	var $lastName_error;
	var $contactPhone;
	var $contactPhone_error;
	var $email;
	var $email_error;
	var $loginName;
	var $loginName_error;
	var $password;
	var $password_error;
	var $confirmPassword;
	var $confirmPassword_error;
	var $equalPassword_error;

	var $bal;
	var $security;
	//error class
 	var $error;
 	var $role;
 	var $condt;
 	var $emailList;
	function Page()
	{
		$this->agent = new ModelAgent();
		$this->agent->autoSetfromPost();
		$this->bal = new BAL();
		$this->error = new Error();
		$this->emailList = new EmailList();
		$this->condt = true;
		$this->security = new AdminAgentSecurity();
		$this->role = $this->security->CheckRole();
		$result = "";
		if($this->role == "AGENT")
		{
			$this->error = $this->bal->checkAccessOfAgent("5", $result);
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

		$this->firstName = new TextBox("First Name","firstName",$this->agent->name->firstName,"50","25");
		$this->middleName = new TextBox("Middle Name","middleName",$this->agent->name->middleName,"50","25");
		$this->lastName = new TextBox("Last Name","lastName",$this->agent->name->lastName,"50","25");
		$this->contactPhone = new TextBox("ContactPhone","contactPhone",$this->agent->contactPhone,"50","20");
		$this->email= new TextBox("Email Address","email",$this->agent->email,"50","20");
		$this->loginName= new TextBox("User Name","loginName",$this->agent->login->loginName,"50","20");
		$this->password= new Password("Password","password",$this->agent->login->password,"50","20");
		$this->confirmPassword= new Password("Confirm Password","confirmPassword",$this->agent->login->confirmPassword,"50","20");


		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction= "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];

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
			$this->contactPhone_error = $this->checkContactPhone();
			if($this->contactPhone_error != "")
				$this->condt = false;
			$this->email_error = $this->checkEmail();
			if($this->email_error != "")
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
				$this->error = $this->bal->registerAgent($this->agent);
				if(!$this->error->isError())
				{
					//send email to registered agent
					$mailto = $this->email->data;
					$HTMLMail = "<HTML>";
					$HTMLMail .= "<HEAD> <TITLE>Application for Agent</TITLE> </HEAD>";
					$HTMLMail .= "<BODY>";
					$HTMLMail .= "<p>We are pleased to confirm your registration with us.";
					$HTMLMail .= "Thank you for registering your company with us. ";
					$HTMLMail .= "You will find our services very helpful to your bottom line. ";
					$HTMLMail .= "<b> It will benefit you:</b></p>  ";
					$HTMLMail .= "&nbsp;&nbsp;<p>1.Improve profits by reducing payrolls.</p> ";
					$HTMLMail .= "&nbsp;&nbsp;<p>2.Reduce the number of calls to your office.</p>  ";
					$HTMLMail .= "&nbsp;&nbsp;<p>3.Improve profits by reducing your advertisement costs.</p>  ";
					$HTMLMail .= "<b> Applicant Details : </b></p>  ";
					$HTMLMail .= "<CENTER> <TABLE>";
					$HTMLMail .= "<TR><TD> First Name </TD><TD>&nbsp;</TD><TD> ".  $this->firstName->data. " </TD></TR>";
					$HTMLMail .= "<TR><TD> Last Name </TD><TD>&nbsp;</TD><TD> ".  $this->lastName->data. " </TD></TR>";
					$HTMLMail .= "<TR><TD> Email ID </TD><TD>&nbsp;</TD><TD>".  $this->email->data. "</TD></TR>";
					$HTMLMail .= "<TR><TD> Login Name </TD><TD>&nbsp;</TD><TD>".  $this->loginName->data."</TD></TR>";
					$HTMLMail .= "<TR><TD> Password </TD><TD>&nbsp;</TD><TD>".  $this->password->data."</TD></TR>";
					$HTMLMail .= "</TABLE></CENTER>";
					$HTMLMail .= "<p>We hope that you will find it very convenient in working with DocCME</p><p>Regards <br/>Doccme Admin</p>";
					$HTMLMail .= "</BODY>";
					$HTMLMail .= "</HTML>";
					$subject = "Application for Agent";
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
					$HTMLMail .= "<HEAD> <TITLE>Application for Agent</TITLE> </HEAD>";
					$HTMLMail .= "<BODY>";
					$HTMLMail .= "<p>We  confirm  registration of the agent with us.</p>";
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
					$subject = "Application for Agent";
					$headers  = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type: text/html; charset=iso-8859-1" ."\r\n";
					$headers .= "From: <info@doccme.com >" ."\r\n";
					if(!mail($mailtoAdmin, $subject , $HTMLMail, $headers))
					{
						echo "Error in sending email to admin";
					}
					session_write_close();
					header("location:./agents?msg=success");
				}
			}

		}
	}

	function showContent()
	{
		$this->formLoad();
		include ("./html/html.agentRegister.php");

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
						return "first name must contain more than or equal to  3 chars";
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
	function checkContactPhone()
	{
		if($this->PageAction=="SAVE")
		{
			if($this->contactPhone->data == "")
			{
				return "";

			}
			else
			{
				if(strrpos($this->contactPhone->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(!preg_match("/^(\([0-9]{3}\)|[0-9]{3})[- \s]?[0-9]{3}[\s -]?[0-9]{4}/", $this->contactPhone->data))
				{
					return "Enter valid phone no.";
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
						$this->error = $this->bal->checkAgentDupEntriesForEmailId($this->email->data, $dupVal);
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
				elseif(strlen($this->loginName->data) > 30)
				{
					return "login name must contain less than 30 chars";
				}
				elseif(strlen($this->loginName->data) < 6)
				{
					return "login name must contain more than 6 chars";
				}
				$dupVal = "";
				$this->error = $this->bal->checkAgentDupEntriesForUserName($this->loginName->data, $dupVal);
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
			if($this->email->data == "")
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
$myPage =  new Page();
$mPage = new Main("Admin's Agent Register", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>
