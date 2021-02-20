<?php
/*
 * Created on Mar 29, 2007
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
 */
  require_once("class.AdminAgentLogin.php");
 
 class AdminAgentSecurity
 {
 	var $login;
 	var $LoginStatus;
 	var $landingPage;
 	var $LoginVal;
 		
 	function AdminAgentSecurity()
 	{
 		$this->login = new AdminAgentLogin();
 		
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
 	 	
 	function doLogin(&$bal, &$loginModel)
 	{
 		$this->LoginVal = $this->login->validateLogin($bal, $loginModel);
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
 	 	 	
 	function getRedirectPage()
 	{
 		return $_SESSION["LandingPage"];
 	}
 	
 	function getUserName()
 	{
 		$name = $this->login->getSessionUsrName();
 		return $name;
 	}
 	
 	function getSessionUserId()
 	{
 		$id = $this->login->getLoggedUserId();
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
