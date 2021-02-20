<?php
/*
 *	Created on Feb 5, 2007
 *	author Poornima Kamatgi
 * 
 *	this class displays list of
 *	cme courses which are added the 
 *	cme provider who is logged in DocCME
 *	CME Provider can click on the Course Id
 *	to enter course details page
 *	where she /he can edit the details
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
 	var $page;
 	
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
				$this->security->setLandingPage("viewEditCourse.php");
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
			$this->security->setLandingPage("viewEditCourse.php");
			session_write_close();
			header("location:./login.php?p=CMEProvider");
		}
		$userAgent = $this->security->CheckUserAgent();
		//echo "user agent : " . $userAgent;
		if($userAgent != $_SERVER["HTTP_USER_AGENT"])
		{
			$this->security->setLandingPage("viewEditCourse.php");
			session_write_close();
			header("location:./login.php?p=CMEProvider");
		}
		
	}
	
	function showContent()
	{
		include("./html/html.viewEditCourse.php");
	}
}
$myPage = new Page();
$mPage = new Main("View / Edit Course",$myPage);
$mPage->showPage();

$myPage->security->clearLandingPage();
session_write_close();
?>