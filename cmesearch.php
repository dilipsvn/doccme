<?php
/*
 *	Created on Feb 5, 2007
 *	author Poornima Kamatgi
 *	
 *	this class checks the login of a doctor
 *	if valid then doctor is redirected to 
 *	cme search page if not to login page again
 *	if a cme provider tries to access this page
 *	then she/he is redirected to invalid page access
 *	message page
 * 
 */
 session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.Security.php");

class Page
{
 	var $security;
 	
	function Page()
	{
		$this->security = new Security();
		$role = $this->security->CheckRole();
		if($role == "DOCTOR")
		{
			$isLogin = $this->security->CheckLoginStatus();
			if($isLogin == "NOTLOGGEDIN")
			{
				//$this->security->setLandingPage("doctorOptions.php");
				session_write_close();
				header("location:./cmeCourseSearch.php");
			}
			elseif($isLogin == "LOGGEDIN")
			{
				//$this->security->setLandingPage("doctorOptions.php");
				session_write_close();
				header("location:./cmeCourseSearch.php");
			}
		}
		elseif($role == "CMEProvider")
		{
			session_write_close();
			header("location:./inValidPageAccess.php");
		}
		elseif($role == "")
		{
			session_write_close();
			header("location:./cmeSearchGuest.php");
		}
	}
	function showContent()
	{
		include("./html/html.cmesearch.php");
	}
}
$myPage = new Page();
$mPage = new Main("CME Search",$myPage);
$mPage->showPage();
$myPage->security->clearlandingPage();
session_write_close();
?>
