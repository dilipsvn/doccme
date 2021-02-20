<?php
/*
 * Created on Oct 31, 2007
 *
 * this class takes the email id
 * and sends the password to doctor/cmeprovider
 */
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.BAL.php");
require_once("./classes/Model.Agent.php");
require_once("./classes/class.EmailList.php");
session_start();
class Page
{
	var $email;
	var $email_error;
	var $doctor;
	var $cmeprovider;
	var $condt;
	var $bal;
	var $role;
	var $emaiList;
	function Page()
	{
		$this->bal = new BAL();
		$this->agent = new ModelAgent();
		$this->condt = true;
		$this->emailList = new EmailList();
		$this->agent->autoSetfromPost();
		$this->email = new TextBox("EmailId", "email", $this->agent->email, "50", "20");
		if($this->role == "DOCTOR" || $this->role == "CMEProvider")
		{
			session_write_close();
			header("location:./index.php");
		}		
		if (!isset($_REQUEST["PageAction"]))
					$this->pageAction= "NEW";
		else
		$this->pageAction = $_REQUEST["PageAction"];
	}
	function formLoad()
	{
		if($this->pageAction == "SAVE")
		{
			$this->email_error = $this->checkEmail();
			if($this->email_error != "")
				$this->condt = false;
			if($this->condt)
			{
					
					$result = "";
					$this->error = $this->bal->getUserNamePassword($this->email->data, $result);
					$res = mysql_fetch_array($result);
					$this->userName = $res["UserName"];
					$this->password = $res["Password"];
									
					$mailto = $this->email->data;
					$HTMLMail = "<HTML>";
					$HTMLMail .= "<HEAD> <TITLE>Your Login Details</TITLE> </HEAD>";
					$HTMLMail .= "<BODY>";
					$HTMLMail .= "<p>Dear Customer,</p>";
					$HTMLMail .= "<p>Thank you for sending query regarding your password.</p>";
					$HTMLMail .= "<P> Your Login and Password details for DocCME web application: </P>";
					$HTMLMail .= "<CENTER> <TABLE>";
					$HTMLMail .= "<TR><TD> User Name </TD><TD>&nbsp;</TD><TD> ".  $this->userName. " </TD></TR>";
					$HTMLMail .= "<TR><TD> Password </TD><TD>&nbsp;</TD><TD> ".  $this->password. " </TD></TR>";
								
					$HTMLMail .= "</TABLE></CENTER>";
					$HTMLMail .= "<p>Regards <br/>DocCME Administrator</p>";
					$HTMLMail .= "<P>PS: Please call (+1-866-465-6181) or email if you have any questions or need additional help.</P>";
					$HTMLMail .= "</BODY>";
					$HTMLMail .= "</HTML>";
					$subject = "Your Login Details";
					$headers  = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type: text/html; charset=iso-8859-1" ."\r\n";
					$headers .= "From: ". $this->emailList->getEmailId("CR") ."\r\n";
	
					if(!mail($mailto, $subject , $HTMLMail, $headers))
					{
						echo "Error in sending email to user : " . $this->email->data;
					}
					session_write_close();
					header("location:./emailSent.php");
			}
		}
	}
	function showContent()
	{
		$this->formLoad();
		include("./html/html.forgotPassword.php");
	}
	function checkEmail()
	{
		if($this->pageAction=="SAVE")
		{
			
			if($this->email->data == "")
				return "Email Address cannot be blank";
			else
			{	
				if(strrpos($this->email->data, "'") >= 1)
				{
					return "Single quotes not allowed";
				}
				else
				{
					if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/", $this->email->data))
					{
						$dupVal = "";
						$this->error = $this->bal->checkAgentDupEntriesForEmailId($this->email->data, $dupVal);
						if($dupVal != "")
						{
							return "";
						}
						else
						{
							return "Invalid email Id";
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

$mPage = new Main("Forgot Password",new Page(), "");
$mPage->showPage();
session_write_close();
?>
