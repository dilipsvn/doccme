<?php
/*
 *	Created on Mar 26, 2007
 *	author Poornima Kamatgi
 * 
 *	this class displays the list of
 *	CME Courses applied by the registered
 *	Doctor in past for reference
 */
 session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.Security.php");
require_once("./classes/class.Error.php");
class Page
{
	var $bal;
 	var $security;
 	var $error;
 	
	function Page()
	{
		$this->security = new Security();
 		$this->bal = new BAL();
 		$this->error = new Error();
 		
 		$role = $this->security->CheckRole();
		if($role == "DOCTOR")
		{
			$loginStatus = $this->security->CheckLoginStatus();
			
			if($loginStatus == "NOTLOGGEDIN")
			{
				$this->security->setLandingPage("viewAppliedCourseSummary.php");
				session_write_close();
				header("Location:./login.php?p=DOCTOR");
			}
		}
		elseif($role == "CMEProvider")
		{
			session_write_close();
			header("location:./inValidPageAccess.php");
		}
		elseif($role == "")
		{
			$this->security->setLandingPage("viewAppliedCourseSummary.php");
			session_write_close();
			header("location:./login.php?p=DOCTOR");
		}
		$userAgent = $this->security->CheckUserAgent();
		//echo "user agent : " . $userAgent;
		if($userAgent != $_SERVER["HTTP_USER_AGENT"])
		{
			$this->security->setLandingPage("viewAppliedCourseSummary.php");
			session_write_close();
			header("location:./login.php?p=DOCTOR");
		}
	}
	function showContent()
	{
		include("./html/html.viewAppliedCourseSummary.php");
	}
}
$myPage = new Page();
$mPage = new Main("View Booked Course Summary",$myPage);
$mPage->showPage();
$myPage->security->clearLandingPage();
session_write_close();
?>

