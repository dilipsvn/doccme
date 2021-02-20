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
require_once("./classes/class.AdminAgentSecurity.php");
require_once("./classes/class.BAL.php");
class Page
{
	var $bal;
	var $security;
	var $error;
	
	function Page()
	{
		$this->bal = new BAL();
		$this->security = new AdminAgentSecurity();
		$this->error = new Error();
		$this->emailList = new EmailList();
		$result = "";
		$this->role = $this->security->CheckRole();
		if($this->role == "AGENT")
		{
			$this->error = $this->bal->checkAccessOfAgent("3", $result);
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
	}
	function showContent()
	{
		
		include("./html/html.courseAddSuccessful.php");
	}
}
$myPage = new Page();
$mPage = new Main("Course Regsitration Successful", $myPage, $myPage->role);
$mPage->showPage();
$myPage->security->clearLandingPage();
session_write_close();
?>
