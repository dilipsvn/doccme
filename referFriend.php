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
require_once("./classes/Model.Referral.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.EmailList.php");
require_once("./classes/class.Security.php");
class Page
{
	var $referral;
	
	var $docUserName;
	var $docUserName_error;
	var $friendName;
	var $friendName_error;
	var $friendEmail;
	var $friendEmail_error;
	var $contactPhone;
	var $contactPhone_error;
	var $emailORPhone_error;
	var $security;
	var $bal;
	var $emailList;
	var $condt;
	//error class
 	var $error;
 	
 	function Page()
	{
		$this->referral = new ModelReferral();
		$this->referral->autoSetfromPost();
		$this->bal = new BAL();
		$this->condt = true;
		$this->error = new Error();
		$this->security = new Security();
		$this->emailList = new EmailList();
		
		$role = $this->security->CheckRole();
		if($role == "DOCTOR")
		{
			$loginStatus = $this->security->CheckLoginStatus();
			
			if($loginStatus == "LOGGEDIN")
			{
				$this->docUserName = new TextBox("Your Login Name","docUserName", $_SESSION["UserName"],"50","25", "true");
			}
			elseif($loginStatus == "NOTLOGGEDIN" || $loginStatus == "")
			{
				$this->docUserName = new TextBox("Your Login Name","docUserName",$this->referral->docUserName,"50","25");
			}
		}
		elseif($role == "")
		{
			$this->docUserName = new TextBox("Your Login Name","docUserName",$this->referral->docUserName,"50","25");
		}
		$this->friendName = new TextBox("Your Friend's Name","friendName",$this->referral->friendName,"50","25");
		$this->friendEmail= new TextBox("Your Friend's Email Address","friendEmail",$this->referral->friendEmail,"50","20");
		$this->contactPhone= new TextBox("Your Friend's Phone#","contactPhone",$this->referral->contactPhone,"50","20");
		
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
			$this->docUserName_error = $this->checkDocUserName();
			if($this->docUserName_error != "")
				$this->condt = false;
			$this->friendName_error = $this->checkFriendName();
			if($this->friendName_error != "")
				$this->condt = false;
			$this->friendEmail_error = $this->checkFriendEmail();
			if($this->FriendEmail_error != "")
				$this->condt = false;
			$this->contactPhone_error = $this->checkContactPhone();
			if($this->contactPhone_error != "")
				$this->condt = false;
			$this->emailORPhone_error = $this->checkEmailORPhone();
			if($this->emailORPhone_error != "")
				$this->condt = false;		
			if($this->condt)
			{
				
				$this->error = $this->bal->registerReferral($this->referral);
				if(!$this->error->isError() && $this->friendEmail->data != "")
				{
					//echo "Our CR will contact you for inf on DocCME";
					//send email to  doctor
					$mailto = $this->friendEmail->data;
					$HTMLMail = "<HTML>";
					$HTMLMail .= "<HEAD> <TITLE>Referral sent by doctor</TITLE> </HEAD>";
					$HTMLMail .= "<BODY>";
					$HTMLMail .= "<p>Dear " . $this->friendName->data .",</p><br/>";
					$HTMLMail .= "<p>Your friend has referred you for giving you a call regd info on DocCME.</p>";
					$HTMLMail .= "<P> Your Contact Details : </P>";
					$HTMLMail .= "<CENTER> <TABLE>";
					$HTMLMail .= "<TR><TD> Name </TD><TD>&nbsp;</TD><TD> ".  $this->friendName->data. " </TD></TR>";
					if($this->friendEmail->data != "")
					{
						$HTMLMail .= "<TR><TD> Email ID </TD><TD>&nbsp;</TD><TD>".  $this->friendEmail->data. "</TD></TR>";
					}
					if($this->contactPhone->data != "")
					{
						$HTMLMail .= "<TR><TD> Phone </TD><TD>&nbsp;</TD><TD>".  $this->contactPhone->data."</TD></TR>";
					}
					$HTMLMail .= "</TABLE></CENTER>";
					$HTMLMail .= "<p>One of our CR will contact you to give you the details of DocCME features</p><p>Regards <br/>Doccme Admin</p>";
					$HTMLMail .= "</BODY>";
					$HTMLMail .= "</HTML>";
					$subject = "Referral sent by your friend";
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
					$HTMLMail .= "<HEAD> <TITLE>Referral sent by doctor</TITLE> </HEAD>";
					$HTMLMail .= "<BODY>";
					$HTMLMail .= "<p>We have received request from a doctor to call back.</p>";
					$HTMLMail .= "<P> Referral Details : </P>";
					$HTMLMail .= "<CENTER> <TABLE>";
					$HTMLMail .= "<TR><TD> Name </TD><TD>&nbsp;</TD><TD> ".  $this->friendName->data. " </TD></TR>";
					if($this->friendEmail->data != "")
					{
						$HTMLMail .= "<TR><TD> Email ID </TD><TD>&nbsp;</TD><TD>".  $this->friendEmail->data. "</TD></TR>";
					}
					if($this->contactPhone->data != "")
					{
						$HTMLMail .= "<TR><TD> Phone </TD><TD>&nbsp;</TD><TD>".  $this->contactPhone->data."</TD></TR>";
					}
					$HTMLMail .= "</TABLE></CENTER>";
					$HTMLMail .= "<p>One of our CR will contact her/him to give the details of DocCME features</p><p>Regards <br/>Doccme CR</p>";
					$HTMLMail .= "</BODY>";
					$HTMLMail .= "</HTML>";
					$subject = "Referral sent by doctor";
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
		include ("./html/html.referFriend.php");

	}
	
	function checkDocUserName()
	{
		if($this->PageAction=="SAVE")
		{
			if($this->docUserName->data == "")
			{
				return "Your login name cannot be blank";
			}
			else
			{
				if(strrpos($this->docUserName->data, "'") >= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->docUserName->data) > 50)
				{
						return "name must contain less than 50 chars ";
				}
				elseif(strlen($this->docUserName->data) < 6)
				{
						return "name must contain more than 5 chars";
				}
				$dupVal = "";
				$this->error = $this->bal->checkDocDupEntriesForUserName($this->docUserName->data, $dupVal);
				if($dupVal != "")
				{
					return "";
				}
				else
				{
					return "Invalid login name";
				}
			}
		}
	}
	function checkFriendName()
	{
		if($this->PageAction=="SAVE")
		{
			if($this->friendName->data == "")
			{
				return "Friend's Name cannot be blank";
			}
			else
			{
				if(strrpos($this->friendName->data, "'") >= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->friendName->data) > 50)
				{
						return "name must contain less than 50 chars";
				}
				elseif(strlen($this->friendName->data) < 3)
				{
						return "name must more than 2 chars";
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
	function checkEmailORPhone()
	{
		if($this->PageAction=="SAVE")
		{
			if($this->friendEmail->data == "" && $this->contactPhone->data == "")
			{
				return "Specify email id or phone no.";
			}
			else
			{
				return "";
			}
		}
	}
	function checkFriendEmail()
	{
		if($this->PageAction=="SAVE")
		{
			if($this->friendEmail->data == "")
				return "";
			else
			{	
				if(strrpos($this->friendEmail->data, "'") >= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->friendEmail->data) > 50 )
				{
					return "Email must contain less than or equal to 50 chars ";	
				}
				else
				{
					if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/", $this->friendEmail->data))
					{
						$dupVal = "";
						$this->error = $this->bal->checkReferralDupEntriesForEmailId($this->friendEmail->data, $dupVal);
						if($dupVal != "")
						{
							return "Person with emailId already referred, refer other friend";
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
	
}

$mPage = new Main("",new Page());
$mPage->showPage();
session_write_close();
?>
