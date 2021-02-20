<?php
/*
 * Created on Mar 31, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.Error.php");
require_once("./classes/class.AdminAgentSecurity.php");
class Page
{
	
	
	//Form Control
	var $userId;
	var $firstName;
	var $middleName;
	var $lastName;
	var $email;
	var $loginName;
	var $password;
	var $confirmPassword;
	var $contactPhone;
	var $status;
	var $remarks;
	//user role
	var $role;
	
	// BAL object
	var $bal;
	
	//error object
	var $error;
		
	//security object
	var $security;
			
	function Page()
	{
		$this->security = new AdminAgentSecurity();
		$this->bal = new BAL();
		$this->error = new Error();
		$result ="";
		$this->role = $this->security->CheckRole();
		if($this->role == "AGENT")
		{
			$this->error = $this->bal->checkAccessOfAgent("2", $result);
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
		$this->userId = new TextBox("Agent Id","userId","","50","25");
		$this->firstName = new TextBox("First Name","firstName","","50","25");
		$this->middleName = new TextBox("Middle Name","middleName","","50","25");
		$this->lastName = new TextBox("Last Name","lastName","","50","25");
		$this->contactPhone = new TextBox("ContactPhone","contactPhone","","50","20");
		$this->email= new TextBox("Email Address","email","","50","20");
		$this->loginName= new TextBox("User Name","loginName","","50","20");
		$this->status = new TextBox("Status","status","","50","20");
		$this->remarks = new TextBox("Remarks","remarks","","50","20");
		
	}
		
	function showContent()
	{
		include("./html/html.myProfile.php");
	}
}
$myPage = new Page();
$mPage = new Main("Welcome Admin", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>
