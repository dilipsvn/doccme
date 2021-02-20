<?php
/*
 *	Created on Oct 22, 2007
 *	author Poornima Kamatgi
 *
 *	this class sends
 *	email to CR of DocCME
 *	to call the doctor
 *	to give information about
 *	the facilities in DocCME
 *
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/Model.DocContact.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.EmailList.php");
class Page
{
	var $docContact;

	var $firstName;
	var $firstName_error;
	var $contactPhone;
	var $contactPhone_error;
	var $email;
	var $email_error;
	var $contactTime;
	var $contactTime_error;
	var $emailORPhone_error;
	var $bal;
	var $emailList;
	var $condt;
	//error class
 	var $error;

 	function Page()
	{
		$this->docContact = new ModelDocContact();
		$this->docContact->autoSetfromPost();
		$this->bal = new BAL();
		$this->condt = true;
		$this->error = new Error();
		$this->emailList = new EmailList();

		$this->firstName = new TextBox("Your Name","firstName",$this->docContact->name->firstName,"50","25");
		$this->contactPhone= new TextBox("Your Phone#","contactPhone",$this->docContact->contactPhone,"50","20");
		$this->email= new TextBox("Your Email Address","email",$this->docContact->email,"50","20");
		$this->contactTime= new TextBox("Best Time to Contact","contactTime",$this->docContact->contactTime,"50","20");

		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction= "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];
	}
	function formLoad()
	{
		if($this->PageAction=="SAVE")
		{
			$bal = new BAL();

			$this->firstName_error = $this->checkFirstName();
			if($this->firstName_error != "")
				$this->condt = false;
			$this->contactPhone_error = $this->checkContactPhone();
			if($this->contactPhone_error != "")
				$this->condt = false;
			$this->emailORPhone_error = $this->checkEmailORPhone();
			if($this->emailORPhone_error != "")
				$this->condt = false;
			$this->email_error = $this->checkEmail();
			if($this->email_error != "")
				$this->condt = false;
			$this->contactTime_error = $this->checkContactTime();
			if($this->contactTime_error != "")
				$this->condt = false;
			if($this->condt)
			{

				$this->error = $this->bal->registerDocContact($this->docContact);
				if(!$this->error->isError() && $this->email->data != "")
				{
					//echo "Our CR will contact you for inf on DocCME";
					//send email to  doctor
					$mailto = $this->email->data;
					$HTMLMail = "<HTML>";
					$HTMLMail .= "<HEAD> <TITLE>Application for Info about DocCME</TITLE> </HEAD>";
					$HTMLMail .= "<BODY>";
					$HTMLMail .= "<p>We are glad to know that you want us to call back for info on DocCME.</p>";
					$HTMLMail .= "<P> Your Contact Details : </P>";
					$HTMLMail .= "<CENTER> <TABLE>";
					$HTMLMail .= "<TR><TD> Name </TD><TD>&nbsp;</TD><TD> ".  $this->firstName->data. " </TD></TR>";
					$HTMLMail .= "<TR><TD> Email ID </TD><TD>&nbsp;</TD><TD>".  $this->email->data. "</TD></TR>";
					if($this->contactPhone->data != "")
					{
						$HTMLMail .= "<TR><TD> Phone </TD><TD>&nbsp;</TD><TD>".  $this->contactPhone->data."</TD></TR>";
					}
					if($this->contactTime->data != "")
					{
						$HTMLMail .= "<TR><TD>Best Time to Call </TD><TD>&nbsp;</TD><TD>".  $this->contactTime->data."</TD></TR>";
					}
					$HTMLMail .= "</TABLE></CENTER>";
					$HTMLMail .= "<p>One of our CR will contact you to give you the details of DocCME features</p><p>Regards <br/>Doccme Admin</p>";
					$HTMLMail .= "</BODY>";
					$HTMLMail .= "</HTML>";
					$subject = "Application for Info about DocCME";
					$headers  = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type: text/html; charset=iso-8859-1" ."\r\n";
					$headers .= "From: ".$this->emailList->getEmailId("CR") ."\r\n";

					if(!mail($mailto, $subject , $HTMLMail, $headers))
					{
						echo "Error in sending email to doctor : " . $this->firstName->data;
					}
					//send mail to admin
					$mailtoAdmin = $this->emailList->getEmailId("admin");
					$HTMLMail = "<HTML>";
					$HTMLMail .= "<HEAD> <TITLE>Application for Info about DocCME</TITLE> </HEAD>";
					$HTMLMail .= "<BODY>";
					$HTMLMail .= "<p>We have received request from a doctor to call back.</p>";
					$HTMLMail .= "<P> Applicant Details : </P>";
					$HTMLMail .= "<CENTER> <TABLE>";
					$HTMLMail .= "<TR><TD> Name </TD><TD>&nbsp;</TD><TD> ".  $this->firstName->data. " </TD></TR>";
					$HTMLMail .= "<TR><TD> Email ID </TD><TD>&nbsp;</TD><TD>".  $this->email->data. "</TD></TR>";
					$HTMLMail .= "<TR><TD> Phone </TD><TD>&nbsp;</TD><TD>".  $this->contactPhone->data."</TD></TR>";
					$HTMLMail .= "<TR><TD> Best Time to Call </TD><TD>&nbsp;</TD><TD>".  $this->contactTime->data."</TD></TR>";
					$HTMLMail .= "</TABLE></CENTER>";
					$HTMLMail .= "<p>One of our CR will contact her/him to give the details of DocCME features</p><p>Regards <br/>Doccme CR</p>";
					$HTMLMail .= "</BODY>";
					$HTMLMail .= "</HTML>";
					$subject = "Application for Doctor";
					$headers  = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type: text/html; charset=iso-8859-1" ."\r\n";
					$headers .= "From: ". $this->emailList->getEmailId("CR") ."\r\n";
					if(!mail($mailtoAdmin, $subject , $HTMLMail, $headers))
					{
						echo "Error in sending email to admin";
					}
					session_write_close();
					header("location:./responseOfContact.php");
				}
				session_write_close();
				header("location:./responseOfContact.php");
				
			}
		}
	}
	function showContent()
	{
		$this->formLoad();
		include ("./html/html.emailUs.php");

	}

	function checkFirstName()
	{
		if($this->PageAction=="SAVE")
		{
			if($this->firstName->data == "")
			{
				return "Name cannot be blank";
			}
			else
			{
				if(strrpos($this->firstName->data, "'") >= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->firstName->data) > 50 || strlen($this->firstName->data) < 4)
				{
						return "name must contain less than 50 chars but not less than 4 chars";
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

			if($this->contactPhone->data != "")
			{
				if(!preg_match("/^[0-9]{3}[\s -]?[0-9]{3}[\s -]?[0-9]{4}/", $this->contactPhone->data))
				{
					return "Enter valid phone no.";
				}
				elseif(strrpos($this->contactPhone->data, "'")>= 1)
				{
					return "Single quotes not allowed";
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
	function checkEmail()
	{
		if($this->PageAction=="SAVE")
		{
			if($this->email->data == "")
				return "";
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
						$this->error = $this->bal->checkDocContactDupEntriesForEmailId($this->email->data, $dupVal);
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
		}
	}
	function checkEmailORPhone()
	{
		if($this->PageAction=="SAVE")
		{
			if($this->email->data == "" && $this->contactPhone->data == "")
			{
				return "Specify email id or phone no.";
			}
			else
			{
				return "";
			}
		}
	}
}

$mPage = new Main("",new Page());
$mPage->showPage();
?>
