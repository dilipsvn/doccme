<?php
/*
 *	Created on Apr 2, 2007
 *	author Poornima Kamatgi
 * 
 * 	this class displays list
 * 	of courses applied by the doctors
 * 	and whose book status is "PENDING"
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.AdminAgentSecurity.php");
require_once("./classes/class.Error.php");
require_once("./classes/class.BAL.php");

class Page
{
	var $security;
	var $role;
	var $error;
	var $appliedCourse;
	var $bal;
	
	function Page()
	{
		$this->security = new AdminAgentSecurity();
		$this->role = $this->security->CheckRole();
		$this->bal = new BAL();
		$this->error = new Error();
		$result = "";
		
		if($this->role == "AGENT")
		{
			$this->error = $this->bal->checkAccessOfAgent("8", $result);
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
		include("./html/html.bookCMECourse.php");
	}
}
$myPage = new Page();
$mPage = new Main("Booked Courses Page", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>
