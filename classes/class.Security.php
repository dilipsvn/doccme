<?php
/*
 *	Created on Dec 2, 2006
 *	author Poornima Kamatgi
 *
 *	this is security class which declares
 *	SESSION variables - login status and landing page
 *	loginsSatus is set on basis of valid login of user
 *	landingPage is set when user tries to access a proteted
 *	page without valid login, this ladningPage
 *	value is then used to store the page url for redirection after
 *	user is successfully logged in
 *	
 *	revised on Feb 18, 2007
 */
 require_once("class.Login.php");
 
 class Security
 {
 	var $login;
 	var $LoginStatus;
 	var $landingPage;
 	var $LoginVal;
 	var $userAgent;
 	function Security()
 	{
 		$this->login = new Login();
 		
 		if(!isset($_SESSION["LoginStatus"]))
 		{
 			//session_register("LoginStatus");
 			$this->LoginStatus = "NOTLOGGEDIN";
 			$_SESSION["LoginStatus"] = $this->LoginStatus;
 		}
 		else
 		{
 			$this->LoginStatus = $_SESSION["LoginStatus"];
 		}
 		
 		if(!isset($_SESSION["LandingPage"]))
 		{
 			//session_register("LandingPage");
 			$this->landingPage = "";
 			$_SESSION["LandingPage"] = $this->landingPage;
 		}
 		else
 		{
 			$this->landingPage = $_SESSION["LandingPage"];
 		}
 		if(!isset($_SESSION["User_Agent"]))
 		{
 			//session_register("User_Agent");
 			$this->userAgent = $_SERVER["HTTP_USER_AGENT"];
 			$_SESSION["User_Agent"] = $this->userAgent;
 		}
 		else
 		{
 			$this->userAgent = $_SESSION["User_Agent"];
 		}
 		$this->LoginVal = "";
 	}
 	
  	function setLoginStatus($loginStatus)
 	{
 		$this->LoginStatus = $loginStatus;
 		$_SESSION["LoginStatus"] = $this->LoginStatus;
 	}
 	
 	function setLandingPage($landingPage)
 	{
 		$this->landingPage = $landingPage;
 		$_SESSION["LandingPage"] = $this->landingPage;
 	}
 	
 	function doLogin(&$bal, &$loginModel, &$role)
 	{
 		$this->LoginVal = $this->login->validateLogin($bal, $loginModel, $role);
 		if($this->LoginVal)
 		{
 			$this->setLoginStatus("LOGGEDIN");
 			
 		}
 		else
 		{
 			$this->setLoginStatus("NOTLOGGEDIN");
 		}
 		return $this->LoginVal;
 	}
 	
 	function CheckRole()
 	{
 		return $_SESSION["Role"];
 	}
 	
 	function CheckLoginStatus()
 	{
 		return $_SESSION["LoginStatus"];
 	}
 	function CheckUserAgent()
 	{
 		return $_SESSION["User_Agent"];
 	}
 	
 	function getRedirectPage()
 	{
 		return $_SESSION["LandingPage"];
 	}
 	
 	function getUserName()
 	{
 		$name = $this->login->getSessionUsrName();
 		return $name;
 	}
 	
 	function getCMEId()
 	{
 		$id = $this->login->getSessionUsrId();
 		return $id;
 	}
 	
 	function clearLandingPage()
 	{
 		$_SESSION["LandingPage"] = "";
 	}
 	
 	function logout()
 	{
 		$_SESSION["LoginStatus"] = "NOTLOGGEDIN";
 		$this->login->logout();
 	}
 }
?>