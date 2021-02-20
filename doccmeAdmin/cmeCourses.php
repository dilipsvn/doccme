<?php
/*
 * Created on Oct 19, 2007
 *
 * this class enables admin to
 * see active and archived courses
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.Error.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.AdminAgentSecurity.php");
require_once("./classes/Model.CourseType.php");
class Page
{
	//user role
	var $role;
	
	//agent object
	var $typeOfCourse;	
	//security object
	var $security;
	
	
	var $courseTypeList;
	var $bal;
	var $error;
	var $PageAction;
			
	function Page()
	{
		$this->security = new AdminAgentSecurity();
		$this->error = new Error();
		$this->bal = new BAL();
		$result = "";
		
		$this->role = $this->security->CheckRole();
		$this->typeOfCourse = new ModelCourseType();
		$this->typeOfCourse->autoSetFromPost();
		if($this->role == "AGENT")
		{
			$this->error = $this->bal->checkAccessOfAgent("10", $result);
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
		$this->type = new SelectList("CMECourses", "type", $this->typeOfCourse->type);
				
		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction= "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];
			
		$this->error = $this->bal->getComboCourseTypeList($this->courseTypeList);	
	}
	
	
	function showContent()
	{
		include("./html/html.cmeCourses.php");
	}
}
$myPage = new Page();
$mPage = new Main("CMECourses", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>

