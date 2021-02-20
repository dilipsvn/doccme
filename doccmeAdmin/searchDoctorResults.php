<?php
/*
 * Created on Mar 28, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
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
	var $doctor;
	
	//Form Control
	
	var $firstName;
	var $sex;
	var $lastName;
	var $address1;
	var $city;
	var $state;
	var $email;
	var $speciality;
	var $loginName;
	var $bal;
	
	//array
	var $StateList;
	
	//error class
	var $error;
	//var $errorOfAccess;
	
	//role variable
	var $role;
	
	//access variable
	var $access;
			
	//security object
	var $security;		
	function Page()
	{
		$this->bal = new BAL();
		$this->error = new Error();
		$this->doctor = new ModelDoctor();
		$this->doctor->autoSetfromPost();
		$this->security = new AdminAgentSecurity();
		$this->access = "";
		$result = "";	 
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
							
		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction= "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];
			
	}
		
	function showContent()
	{
		include("./html/html.searchDoctorResults.php");
	}
	
	
}
$myPage = new Page();
$mPage = new Main("Search Doctor Results", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>
