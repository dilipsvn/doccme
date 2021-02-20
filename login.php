<?php
/*
 *	Created on Nov 25, 2006
 *	author Poornima Kamatgi
 *
 *	this class enables doctor or cme provider
 *	to login into DocCME after validation
 *	of login details
 *
 *	revised on Jan 23, 2007
 *	added code for page redirection
 *
 *	revised on Jun 20, 2008
 *	fixed the bug in session storage of
 *	redirect page
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.Security.php");
require_once("./classes/Model.Login.php");
require_once("./classes/class.BAL.php");

class Page
{
	//Model Object
	var $loginModel;

	//Form Control
	var $loginName;
	var $password;

	//page action
	var $pageAction;

	//user role
	var $userRole;

	var $rowSet;

	//BAL object
	var $bal;

	//security object
	var $security;

	var $page;



	function Page()
	{
		$this->loginModel = new ModelLogin();
		$this->loginModel->autoSetfromPost();
		$this->security = new Security();
		$this->bal = new BAL();

		$this->loginName = new TextBox("User Name", "loginName", $this->loginModel->loginName, "50", "20");
		$this->password = new Password("Password", "password", $this->loginModel->password, "50", "20");
		if (!isset($_REQUEST["PageAction"]))
					$this->pageAction= "NEW";
				else
		$this->pageAction = $_REQUEST["PageAction"];

	}

	function showContent()
	{
		include ("./html/html.login.php");
	}

}
$myPage = new Page();
$mPage = new Main("Login", $myPage);

if($myPage->pageAction != "LOGIN")
{

	$mPage->showPage();
}
else
{
	$myPage->userRole = $_GET["p"];
	$isLogin = $myPage->security->doLogin($myPage->bal, $myPage->loginModel, $myPage->userRole);
	$array_doctorpages = array("doctorOptions.php", "cmeCourseSearch.php", "cmeCourseSearchResults.php",	"viewAppliedCourseSummary.php", "bookCourse.php","doctorPayCourse.php", "coursePaymentSuccessful.php",
"coursePaymentFailure.php", "docArchivedCourse.php", "editDoctorDetails.php");

	$array_cmepages = array("cmeProviderOptions.php", "addCourse.php", "viewEditCourse.php", "editCourse.php",	"viewRegisteredCourseSummary.php", "editCMEProviderDetails.php");

	if($isLogin)
	{
		$redirectPage = $myPage->security->getRedirectPage();
		if($redirectPage != "")
		{

			if($myPage->userRole == "DOCTOR")
			{
				$key = array_search($redirectPage, $array_cmepages);
				if($key !== FALSE)
				{
					$myPage->security->clearLandingPage();
					session_write_close();
					header("Location:./doctorOptions.php");
				}
				else
				{
					session_write_close();
					header("Location:./" . $redirectPage);
				}

			}
			elseif($myPage->userRole == "CMEProvider")
			{
				$key = array_search($redirectPage, $array_doctorpages);
				if($key !== FALSE)
				{
					$myPage->security->clearLandingPage();
					session_write_close();
					header("Location:./cmeProviderOptions.php");
				}
				else
				{
					session_write_close();
					header("Location:./" . $redirectPage);
				}
			}

		}
		elseif($redirectPage == "")
		{
			if($myPage->userRole == "DOCTOR")
			{
				session_write_close();
				header("Location:./doctorOptions.php");

			}
			elseif($myPage->userRole == "CMEProvider")
			{
				session_write_close();
				header("Location:./cmeProviderOptions.php");
			}
			elseif($myPage->userRole == "")
			{
				session_write_close();
				echo "Invalid Access";
			}
		}
	}
	else
	{
		if($myPage->userRole == "DOCTOR")
		{
			header("location:./login.php?p=DOCTOR&msg=failure");
		}
		if($myPage->userRole == "CMEProvider")
		{
			header("location:./login.php?p=CMEProvider&msg=failure");
		}
		elseif($myPage->userRole == "")
		{
			session_write_close();
			echo "Invalid Access";
		}
	}

}
session_write_close();
?>