<?php
/*
 * Created on Dec 2, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
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
		if($role == "CMEProvider")
		{
			session_write_close();
			header("location:./inValidPageAccess.php");
		}
	$courseStartDate = $_REQUEST["courseStartDate"];
	$courseEndDate = $_REQUEST["courseEndDate"];
	$speciality = $_REQUEST["Speciality"];
	$state = $_REQUEST["State"];
	$city = $_REQUEST["city"];
	$keyword = $_REQUEST["keyword"];
	$queryString = "";
	if($courseStartDate !=null)
	{
			$queryString = $queryString . "&courseStartDate=" . $courseStartDate;
	}
	if($courseEndDate!=null)
	{
			$queryString = $queryString . "&courseEndDate=" . $courseEndDate;
	}
	if($speciality !=null)
	{
		$queryString = $queryString . "&Speciality=" . $speciality;
	}
	if($city !=null)
	{
		$queryString = $queryString . "&city=" . $city;
	}
	if($state !=null)
	{
		$queryString = $queryString . "&State=" . $state;
	}
	if($keyword !=null)
	{
		$queryString = $queryString . "&keyword=" . $keyword;
	}

	$from = $_GET["from"];
	$pagecnt = 10;
	if($from < 0)
	{
		echo "invalid range";
	}
	if($from == "")
	{
		$from = 1;
	}

	if($this->PageAction=="SEARCH")
	{
		$this->courseStartDate_error = $this->checkCourseStartDate();
		if($this->courseStartDate_error != "")
			$this->flag = false;
		$this->courseEndDate_error = $this->checkCourseEndDate();
		if($this->courseEndDate_error != "")
			$this->flag = false;
		$this->city_error = $this->checkCity();
			if($this->city_error != "")
				$this->flag = false;
		$this->keyword_error = $this->checkKeyword();
		if($this->keyword_error != "")
				$this->flag = false;		
		if($this->flag == true)
		{
			session_write_close();
			header("location:./cmeCourseSearchResultsForGuest.php?PageAction=SEARCH".$queryString);
		}
	}
	
	
	}

	function showContent()
	{
		include("./html/html.cmeSearchGuest.php");
	}

	function checkCourseStartDate()
	{
		$pattern = '/^(?=\d)(?:(?:(?:(?:(?:0?[13578]|1[02])(\/|-|\.)31)\1|(?:(?:0?[1,3-9]|1[0-2])(\/|-|\.)(?:29|30)\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})|(?:0?2(\/|-|\.)29\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))|(?:(?:0?[1-9])|(?:1[0-2]))(\/|-|\.)(?:0?[1-9]|1\d|2[0-8])\4(?:(?:1[6-9]|[2-9]\d)?\d{2}))($|\ (?=\d)))?(((0?[1-9]|1[012])(:[0-5]\d){0,2}(\ [AP]M))|([01]\d|2[0-3])(:[0-5]\d){1,2})?$/';
		$dt = $this->courseStartDate->data;
		if($this->PageAction=="SEARCH")
		{
			if($this->courseStartDate->data == "")
			{
				$this->flag = true;
			}
			else
			{
				$temp1 = explode("/", $this->courseStartDate->data);
	 			$startDate = mktime(0,0,0, $temp1[0],$temp1[1],$temp1[2]);
				$temp2 = explode("/", date("m/d/Y"));
			 	$curdate = mktime(0,0,0, $temp2[0], $temp2[1], $temp2[2]);
				if(strrpos($this->courseStartDate->data, "'")>= 1)
				{
					//$this->flag = false;
					return "Single quotes not allowed";
				}
				elseif(!preg_match($pattern, $dt))
				{
					//$this->flag = false;
					return "Invalid date format";
				}
				elseif(($startDate - $curdate) < 0)
				{
					//$this->flag = false;
					return "Start Date must be greater than or equal to current date";
				}
				else
				{
					return "";
				}
			}
		}
	}
	function checkCourseEndDate()
	{
		$pattern = '/^(?=\d)(?:(?:(?:(?:(?:0?[13578]|1[02])(\/|-|\.)31)\1|(?:(?:0?[1,3-9]|1[0-2])(\/|-|\.)(?:29|30)\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})|(?:0?2(\/|-|\.)29\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))|(?:(?:0?[1-9])|(?:1[0-2]))(\/|-|\.)(?:0?[1-9]|1\d|2[0-8])\4(?:(?:1[6-9]|[2-9]\d)?\d{2}))($|\ (?=\d)))?(((0?[1-9]|1[012])(:[0-5]\d){0,2}(\ [AP]M))|([01]\d|2[0-3])(:[0-5]\d){1,2})?$/';
		$dt = $this->courseEndDate->data;
		if($this->PageAction=="SEARCH")
		{
			if($this->courseEndDate->data == "")
			{
				$this->flag = true;
			}
			else
			{
				$temp2 = explode("/", $this->courseEndDate->data);
			 	$endDate = mktime(0,0,0, $temp2[0],$temp2[1],$temp2[2]);
			 	$temp1 = explode("/", date("m/d/Y"));
			 	$curdate = mktime(0,0,0, $temp1[0], $temp1[1], $temp1[2]);
				$temp3 = explode("/", $this->courseStartDate->data);
			 	$stDate = mktime(0,0,0, $temp3[0],$temp3[1],$temp3[2]);
				if(strrpos($this->courseEndDate->data, "'")>= 1)
				{
					
					//$this->flag = false;
					return "Single quotes not allowed";
				}
				elseif(!preg_match($pattern, $dt))
				{

					//$this->flag = false;
					return "Invalid date format";

				}
				elseif(($endDate - $curdate) < 0)
				{
					//$this->flag = false;
					return "End Date must be greater than or equal to current date";
				}
				elseif(($endDate - $stDate) < 0)
				{
					//$this->flag = false;
					return "End Date must be greater than Start date";
				}
				else
				{
					return "";
				}
			}
		}
	}
	function checkCity()
	{
		if($this->PageAction=="SEARCH")
		{
			if($this->city->data != "")
			{
				if(strrpos($this->city->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->city->data) > 50)
				{
					return "City must contain less than 50 characters";
				}
				else
				{
						
						return "";
				}
			}
		}
	}
	function checkKeyword()
	{
		if($this->PageAction=="SEARCH")
		{
			if($this->keyword->data == "")
			{
				
				return "";
			}
			else
			{
				if(strrpos($this->keyword->data, "'") > 0)
				{
					return "Single quotes not allowed";

				}
				else
				{
					
					return "";
				}
			}
		}
	}

}
$myPage = new Page();
$mPage = new Main("CME Course Search",$myPage);
$mPage->showPage();

$myPage->security->clearLandingPage();
session_write_close();
?>
