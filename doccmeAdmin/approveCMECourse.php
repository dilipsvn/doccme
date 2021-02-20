<?php
/*
 *	Created on Mar 31, 2007
 *	author oornima Kamatgi
 *
 *	this class displays list
 *	of cme courses courses which
 *	need to be approved(whose status is "NEW")
 *	i.e change their status to "APPROVED"
 *	so that the approved courses are available for
 *	search by doctors
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.AdminAgentSecurity.php");
require_once("./classes/class.Error.php");
require_once("./classes/class.BAL.php");
require_once("./classes/Model.Course.php");
require_once("./classes/class.phpDate.php");
class Page
{
	var $course;
 	var $status;
  	var $courseId;
	var $security;
	var $role;
	var $error;
	var $bal;
	var $courseStatusList;
		
	function Page()
	{
		$this->course = new ModelCourse();
 		$this->course->autoSetFromPost();
		$this->security = new AdminAgentSecurity();
		$this->bal = new BAL();
		$this->error = new Error();
		$result = "";
		$this->role = $this->security->CheckRole();
		if($this->role == "AGENT")
		{
			$this->error = $this->bal->checkAccessOfAgent("6", $result);
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
		$this->error = $this->bal->getComboCourseStatusList($this->courseStatusList);
	}
	
	function showContent()
	{
		include("./html/html.approveCMECourse.php");
	}
}
$myPage = new Page();
$mPage = new Main(" NEW CME Course Page", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>