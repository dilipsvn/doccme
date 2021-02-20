<?php
/*
 *	Created on Dec 13, 2008
 *	author Poornima Kamatgi
 *
 * 	this class displays
 *	 cme courses by
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/Model.CourseSearch.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.Security.php");
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
	var $flag;
	var $bal;
	var $security;

	var $StateList;
	var $SpecialityList;

	var $error;

	function Page()
	{
		$this->courseSearch = new ModelCourseSearch();
		$this->courseSearch->autoSetfromPost();
		$this->bal = new BAL();
		$this->security = new Security();
		$this->error = new Error();
		$this->flag = true;
		$this->courseStartDate = new TextBox("", "courseStartDate",$this->courseSearch->courseDate->courseStartDate, "50", "20");
		$this->courseEndDate = new TextBox("", "courseEndDate",$this->courseSearch->courseDate->courseEndDate, "50", "20");
		$this->speciality = new SelectList("Speciality", "Speciality", $this->courseSearch->speciality);
		$this->city = new TextBox("City", "city",$this->courseSearch->address->city, "50", "20");
		$this->state = new SelectList("State", "State", $this->courseSearch->address->state);
		$this->keyword = new TextBox("", "keyword",$this->courseSearch->keyword, "50", "20");

		$this->bal->getComboStateList($this->StateList);
		$this->bal->getComboSpecialityList($this->SpecialityList);

		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction= "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];

		$role = $this->security->CheckRole();
		
		if($role == "DOCTOR")
		{
			$loginStatus = $this->security->CheckLoginStatus();

			if($loginStatus == "NOTLOGGEDIN")
			{
				$this->security->setLandingPage("cmeCourseSearch.php");
				session_write_close();
				header("Location:./login.php?p=DOCTOR");
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
		$userAgent = $this->security->CheckUserAgent();
		//echo "user agent : " . $userAgent;
		if($userAgent != $_SERVER["HTTP_USER_AGENT"])
		{
			$this->security->setLandingPage("cmeCourseSearch.php");
			session_write_close();
			header("Location:./login.php?p=DOCTOR");
		}
		/*$from = $_GET["from"];
		$pagecnt = 10;
		if($from < 0)
		{
			session_write_close();
			header("location:./invalidId.php?type=range");
		}
		if($from == "")
		{
			$from = 1;
		}
		
		$resCount = 0;
		$this->error = $this->bal->getCMECourseSearchCount($this->courseSearch, $resCount);
		if($this->error->isError())
		{
			return $this->error;
		}
	    if($from > $resCount)
	    {
	    	session_write_close();
			header("location:./invalidId.php?type=range");
	    }*/
	}

	function showContent()
	{
		include("./html/html.CMECourseSearchResults.php");
	}

	
}
$myPage = new Page();
$mPage = new Main("CME Course Search Results",$myPage);
$mPage->showPage();

$myPage->security->clearLandingPage();
session_write_close();
?>
