<?php
/*
 * 	Created on Feb 4, 2007
 *	author Poornima Kamatgi
 * 
 *	this class index page of 
 *	page of DocCME which displays
 *	introduction of DocCME
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.Security.php");
class Page
{
	var $security;
	function Page()
	{
		/** https check
		* NOTE: This code is repeated from class.main.php jut to ensure https
		*       before session is created
		*/
		//if(substr($_SERVER['SCRIPT_URI'],0,5) == "http:")
		//{
		//	$new_url = "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
       	//	header("Location: $new_url");
		//}
		/**************************************************/
		
		$this->security = new Security();
		
		$role = $this->security->CheckRole();
		
		if($role == "ADMIN")
		{
			
				$_SESSION["UserId"] = "";
				$_SESSION["UserName"] = "";
				$_SESSION["Role"] = "";
				$_SESSION["LoginStatus"] = "";
				session_write_close();
				
				unset($_SESSION["UserId"]);
				unset($_SESSION["UserName"]);
				unset($_SESSION["Role"]);
				unset($_SESSION["LoginStatus"]);
				session_start();
				//header("Location:http://www.doccme.com");
		
		}
		elseif($role = "DOCTOR")
		{
			$isLogin = $this->security->CheckLoginStatus();
			if($isLogin == "LOGGEDIN")
			{
				$this->doc = "true";
			}
		}
		elseif($role == "CMEProvider")
		{
			$isLogin = $this->security->CheckLoginStatus();
			if($isLogin == "LOGGEDIN")
			{
				$this->cme = "true";
			}
		}
		
		
	}
	function showContent()
	{
		include("./html/html.index.php");
	}
}

$mPage = new Main("Welcome to DocCME",new Page());
$mPage->showPage();
?>