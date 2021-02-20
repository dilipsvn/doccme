<?php
/*
 * Created on Oct 29, 2007
 *
* author Poornima Kamatgi
 * 
 * 	this class displays the 
 * 	list of courses doctor had already attended
 */
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.Error.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.AdminAgentSecurity.php");
session_start();
class Page
{
	var $security;
	var $role;
	var $error;
	var $id;
	function Page()
	{
		$this->security = new AdminAgentSecurity();
		$this->error = new Error();
		$this->bal = new BAL();
		$result = "";
		$this->id = $_GET["id"];
		$this->role = $this->security->CheckRole();
		if($this->role == "AGENT")
		{
			$this->error = $this->bal->checkAccessOfAgent("4", $result);
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
		include("./html/html.docArchivedCourses.php");
	}
}
$myPage = new Page();
$mPage = new Main("Doctor's  Archived Courses", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>
