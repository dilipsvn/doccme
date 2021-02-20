<?php
/*
 * Created on Dec 6, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
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
	var $middleName;
	var $lastName;
	var $contactPhone;
	var $email;
	var $loginName;
	var $newPassword;
	var $confirmNewPassword;
	var $status;
	var $remarks;
	
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
 		$this->id = $_GET["id"];
 		$result = "";
 		$this->role = $this->security->CheckRole();		
		if($this->role == "" || $this->role == "DOCTOR" || $this->role == "CMEProvider")
		{
			session_write_close();
			header("location:./index.php");
		}
		$this->error = $this->bal->getAgentDetails($this->id, $result);
		if(mysql_num_rows($result) == 0)
		{
			session_write_close();
			header("location:./invalidId.php");
		}
		else
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
				$this->email= new TextBox("Email Address","email",$Agent["EmailId"],"50","20");
				$this->Agent->email = $this->email->data;
				$this->loginName= new TextBox("User Name","loginName",$Agent["UserName"],"50","20", "true");
				$this->status = new SelectList("Status", "status", $Agent["Status"], "50", "25");
				$this->Agent->status = $this->status->data;
				$this->remarks = new TextBox("Remarks", "remarks", $Agent["Remarks"], "50", "25");
				$this->Agent->remarks = $this->remarks->data;
			}
		}
		}
		
	}

	function showContent()
	{
		include("./html/html.viewAgentDetails.php");
	}
	
}

$myPage = new Page();
$mPage = new Main("View Agent Details", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>
