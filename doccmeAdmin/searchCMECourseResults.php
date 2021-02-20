<?php
/*
 * Created on Apr 5, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/Model.CourseSearch.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.AdminAgentSecurity.php");
require_once("./classes/class.Error.php");
 
class Page
{
	var $courseSearch;
	
	var $courseStartDate;
	var $courseEndDate;
	var $speciality;
	var $city;
	var $state;
	var $keyword;
	var $bal;
	var $security;
	var $flag;
		
	var $StateList;
	var $SpecialityList;
	
	
	var $error;
	var $role;
	
	function Page()
	{
		$this->bal = new BAL();
		$this->security = new AdminAgentSecurity();
		$this->error = new Error();
		$result = "";
		$this->flag = true;		
		$this->courseSearch = new ModelCourseSearch();
		$this->courseSearch->autoSetfromPost();				
		$this->error = $this->bal->getComboStateList($this->StateList);
		$this->error = $this->bal->getComboSpecialityList($this->SpecialityList);	
		
		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction= "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];	
			
		$this->role = $this->security->CheckRole();
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
		include("./html/html.searchCMECourseResults.php");
	}
}
$myPage = new Page();
$mPage = new Main("CME Course Search Results",$myPage, $myPage->role);
$mPage->showPage();

$myPage->security->clearLandingPage();
session_write_close();
?>
