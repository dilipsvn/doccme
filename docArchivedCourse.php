<?php
/*
 *	Created on Feb 15, 2007
 *	author Poornima Kamatgi
 * 
 *	this class displays the list of
 *	archived cme courses to registered doctor
 *	who is logged in
 *	
 */
 session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.Security.php");
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
 		$isLogin = $this->security->CheckLoginStatus();
		if($role == "DOCTOR")
		{
			$loginStatus = $this->security->CheckLoginStatus();
			
			if($isLogin == "NOTLOGGEDIN")
			{
			   	$this->security->setLandingPage("docArchivedCourse.php");
				session_write_close();
				header("Location:./login.php?p=DOCTOR");
				exit();
			}
		}
		elseif($role == "CMEProvider")
		{
			session_write_close();
			header("location:./inValidPageAccess.php");
		}
		elseif($role == "")
		{
			$this->security->setLandingPage("docArchivedCourse.php");
			session_write_close();
			header("location:./login.php?p=DOCTOR");
		}
		$userAgent = $this->security->CheckUserAgent();
		//echo "user agent : " . $userAgent;
		if($userAgent != $_SERVER["HTTP_USER_AGENT"])
		{
			$this->security->setLandingPage("docArchivedCourse.php");
			session_write_close();
			header("location:./login.php?p=DOCTOR");
		}
		
	}
	function showContent()
	{
		include("./html/html.DocArchivedCourse.php");
	}
	
	function DisplayError()
	{
		if($this->error != "")
		{
			echo $this->error->userDisplay;
		}
	}
	
}
$myPage = new Page();
$mPage = new Main("Archived Course",$myPage);
$mPage->showPage();
$myPage->security->clearLandingPage();
session_write_close();
?>