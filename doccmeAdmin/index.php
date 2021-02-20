<?php
/*
 * Created on Mar 29, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/Model.Login.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.Error.php");
require_once("./classes/class.AdminAgentSecurity.php");

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

	//error object
	var $error;

	//security object
	var $security;

	function Page()
	{
		$this->loginModel = new ModelLogin();
		$this->loginModel->autoSetfromPost();
		$this->error = new Error();
		$this->security =  new AdminAgentSecurity();

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
		include("./html/html.index.php");
	}
}

$myPage = new Page();
$mPage = new Main("Doccme Admin Login", $myPage, "");

if($myPage->pageAction != "LOGIN")
{

	$mPage->showPage();
}
else
{
	$isLogin = $myPage->security->doLogin($myPage->bal, $myPage->loginModel);
	if($isLogin)
	{
		$role = $_SESSION["Role"];
		$redirectPage = $myPage->security->getRedirectPage();
		if($redirectPage == "")
		{
			if($role == "ADMIN" ||$role == "AGENT")
			{
				session_write_close();
				header("Location:./home.php");
			}
			else
			{
				session_write_close();
				header("location:./index.php");
			}
		}
		elseif($redirectPage != "")
		{
			session_write_close();
			header("Location:./" . $redirectPage);
		}
	}
	else
	{
		session_write_close();
		header("location:./index.php?msg=failure");
	}
}
session_write_close();
?>