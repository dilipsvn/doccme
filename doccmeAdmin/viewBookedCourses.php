<?php
/*
 * Created on Apr 2, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.AdminAgentSecurity.php");
require_once("./classes/class.Error.php");
require_once("./classes/class.BAL.php");

class Page
{
	var $course;
 	var $status;
  	var $courseId;
	var $security;
	var $role;
	var $error;
	var $bal;
	var $StatusList;
		
	function Page()
	{
		$this->security = new AdminAgentSecurity();
		$this->bal = new BAL();
		$this->error = new Error();
		$this->role = $this->security->CheckRole();
		if($this->role == "" || $this->role == "DOCTOR" || $this->role == "CMEProvider")
		{
			$this->security->setLandingPage("viewBookedCourses.php");
			session_write_close();
			header("location:./index.php");
		}
		
		
	}
	
	function showContent()
	{
		include("./html/html.viewBookedCourses.php");
	}
}
$myPage = new Page();
$mPage = new Main(" View Booked Courses Page", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>
