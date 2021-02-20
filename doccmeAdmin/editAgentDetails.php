<?php
/*
 *	Created on Mar 28, 2007
 *	author Poornima Kamatgi
 *
 *	this class enables admin
 *	to edit the details of
 *	registered agent in DocCME
 *	and also reset the password
 *	of an agent if required
 * 
 */
 session_start();
 require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/Model.Agent.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.AdminAgentSecurity.php");
class Page
{
	//Model Object
	var $Agent;
	
	//Form Control
	var $userId;
	var $firstName;
	var $firstName_error;
	var $middleName;
	var $middleName_error;
	var $lastName;
	var $lastName_error;
	var $contactPhone;
	var $contactPhone_error;
	var $email;
	var $loginName;
	var $newPassword;
	var $confirmNewPassword;
	var $status;
	var $status_error;
	var $remarks;
	var $remarks_error;
	
	//BAL object
	var $bal;
	
	//array
	var $StatusList;
	
	//Error object
	var $error;
	var $security;		
	function Page()
	{
		$this->Agent = new ModelAgent();
		$this->Agent->autoSetfromPost();
		$this->bal = new BAL();
		$this->security = new AdminAgentSecurity();
		$this->error = new Error();
		$result = "";
		$this->condt = true;		
 		$this->id = $_GET["id"];
 		$result = "";
 		$this->role = $this->security->CheckRole();		
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
		if (!isset($_REQUEST["PostBack"]))
			$this->postBack= "false";
		else
			$this->postBack = $_REQUEST["PostBack"];
		$this->error = $this->bal->getAgentDetails($this->id, $result);
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
					while($Agent = mysql_fetch_assoc($result))
					{
						$this->userId = new TextBox("Agent ID", "userId", $Agent["UserId"], "50", "25", "true");
						$this->Agent->userId = $this->userId->data;
						$this->firstName = new TextBox("First Name","firstName",$Agent["FirstName"],"50","25", "true");
						$this->Agent->name->firstName = $this->firstName->data;
						$this->middleName = new TextBox("Middle Name","middleName",$Agent["MiddleName"],"50","25");
						$this->Agent->name->middleName = $this->middleName->data;
						$this->lastName = new TextBox("Last Name","lastName",$Agent["LastName"],"50","25");
						$this->Agent->name->lastName = $this->lastName->data;
						$this->contactPhone = new TextBox("ContactPhone","contactPhone",$Agent["ContactPhone"],"50","20");
						$this->Agent->phone->mobilePhone = $this->mobilePhone->data;
						$this->email= new TextBox("Email Address","email",$Agent["EmailId"],"50","20", "true");
						$this->Agent->email = $this->email->data;
						$this->loginName= new TextBox("User Name","loginName",$Agent["UserName"],"50","20", "true");
						$this->status = new SelectList("Status", "status", $Agent["Status"]);
						$this->Agent->status = $this->status->data;
						$this->remarks = new TextBox("Remarks", "remarks", $Agent["Remarks"], "50", "25");
						$this->Agent->remarks = $this->remarks->data;
					}
				}
			}
			else
			{
				$this->userId = new TextBox("Agent ID", "userId", $this->Agent->userId, "50", "25", "true");
				$this->firstName = new TextBox("First Name","firstName",$this->Agent->name->firstName,"50","25");
				$this->middleName = new TextBox("Middle Name","middleName",$this->Agent->name->middleName,"50","25");
				$this->lastName = new TextBox("Last Name","lastName",$this->Agent->name->lastName,"50","25");
				$this->contactPhone = new TextBox("ContactPhone","contactPhone",$this->Agent->contactPhone,"50","20");
				$this->email= new TextBox("Email Address","email",$this->Agent->email,"50","20", "true");
				$this->loginName= new TextBox("User Name","loginName",$this->Agent->login->loginName,"50","20", "true");
				$this->status = new SelectList("Status", "status", $this->Agent->status);
				$this->remarks = new TextBox("Remarks", "remarks", $this->Agent->remarks, "50", "25");
			}
		}
		
		$this->newPassword= new Password("New Password","newPassword","","50","20");
		$this->confirmNewPassword= new Password("Confirm New Password","confirmNewPassword","","50","20");
		
		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction= "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];
			
		$this->error = $this->bal->getComboUserStatusList($this->StatusList);
	}
	
	function formLoad()
	{
		if($this->PageAction == "UPDATE")
		{
			$this->Agent->autoSetFromPost();
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
			$this->status_error = $this->checkStatus();
			if($this->status_error != "")
				$this->condt = false;
			$this->remarks_error = $this->checkRemarks();
			if($this->remarks_error != "")
				$this->condt = false;
			if($this->condt)
			{
				$this->error = $this->bal->editAgentDetails($this->Agent);
				if(!$this->error->isError())
				{
					session_write_close();
					header("location:./searchAgent.php?msg=successagentdet");
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
				$this->error = $this->bal->resetAgentPassword($this->Agent, $newPassword);
				if(!$this->error->isError())
				{
					session_write_close();
					header("location:./searchAgent.php?msg=successagentpass");
				}
			}
		}
	}
	
	function showContent()
	{
		$this->formLoad();
		include("./html/html.editAgentDetails.php");
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
				elseif(strlen($this->firstName->data) > 50)
				{
						return "first name must contain less than 50 chars";
				}
				elseif(strlen($this->firstName->data) < 3)
				{
						return "first name must contain more than or equal to 3 chars";
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
	function checkContactPhone()
	{
		if($this->PageAction=="UPDATE")
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
$mPage = new Main("Edit Agent Details", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>
