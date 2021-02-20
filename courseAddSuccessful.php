<?php
/*
 * Created on Jan 29, 2008
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.Error.php");
require_once("./classes/class.EmailList.php");
require_once("./classes/class.Security.php");
require_once("./classes/class.BAL.php");
class Page
{
	var $bal;
	var $security;
	var $error;
	
	function Page()
	{
		$this->bal = new BAL();
		$this->security = new Security();
		$this->error = new Error();
		$this->emailList = new EmailList();
		$role = $this->security->CheckRole();
		if($role == "CMEProvider")
		{
			$loginStatus = $this->security->CheckLoginStatus();
			
			if($loginStatus == "NOTLOGGEDIN")
			{
				$this->security->setLandingPage("courseAddSuccessful.php");
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
			$this->security->setLandingPage("courseAddSuccessful.php");
			session_write_close();
			header("location:./login.php?p=CMEProvider");
		}
		
		$userAgent = $this->security->CheckUserAgent();
		//echo "user agent : " . $userAgent;
		if($userAgent != $_SERVER["HTTP_USER_AGENT"])
		{
			$this->security->setLandingPage("courseAddSuccessful.php");
			session_write_close();
			header("Location:./login.php?p=CMEProvider");
		}
	}
	function showContent()
	{
		
		include("./html/html.courseAddSuccessful.php");
	}
}

$mPage = new Main("Course Registration Success",new Page());
$mPage->showPage();
session_write_close();
?>
