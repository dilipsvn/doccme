<?php
/*
 *	Created on Mar 26, 2007
 *	author Poornima Kamatgi
 * 
 *	this class displays the list of
 *	CME Courses registered by the registered
 *	Doctor which are added by the CME Provider
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
		if($role == "CMEProvider")
		{
			$loginStatus = $this->security->CheckLoginStatus();
			
			if($loginStatus == "NOTLOGGEDIN")
			{
				$this->security->setLandingPage("viewRegisteredCourseSummary.php");
				session_write_close();
				header("Location:./login.php?p=CMEProvider");
			}
		}
		elseif($role == "DOCTOR")
		{
			session_write_close();
			header("location:./inValidPageAccess.php");
		}
		elseif($role == "")
		{
			$this->security->setLandingPage("viewRegisteredCourseSummary.php");
			session_write_close();
			header("location:./login.php?p=CMEProvider");
		}
		$userAgent = $this->security->CheckUserAgent();
		//echo "user agent : " . $userAgent;
		if($userAgent != $_SERVER["HTTP_USER_AGENT"])
		{
			$this->security->setLandingPage("viewRegisteredCourseSummary.php");
			session_write_close();
			header("location:./login.php?p=CMEProvider");
		}
	}
	function showContent()
	{
		include("./html/html.viewRegisteredCourseSummary.php");
	}
}
$myPage = new Page();
$mPage = new Main("View Booked Course Summary",$myPage);
$mPage->showPage();
$myPage->security->clearLandingPage();
session_write_close();
?>

