<?php
/*
 *	Created on Jan 17, 2007
 *	author Poornima Kamatgi
 *
 *	this class displays information for CME Provider 
 *	also displays login link for registered CME Providers
 *	and 'get Registered' link for new CME Providers
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
		$this->security = new Security();
		$role = $this->security->CheckRole();
		if($role = "CMEProvider")
		{
			$isLogin = $this->security->CheckLoginStatus();
			if($isLogin == "LOGGEDIN")
			{
				session_write_close();
				header("location:./cmeProviderOptions.php");
			}
		}
		elseif($role == "DOCTOR")
		{
			session_write_close();
			header("location:./inValidPageAccess.php");
		}
		elseif($role == "")
		{
			$this->security->setLandingPage("cmeProviderOptions.php");
			session_write_close();
			header("location:./login.php?p=CMEProvider");
		}
	}
	function showContent()
	{
		include("./html/html.CMEProviderLounge.php");
	}
}

$mPage = new Main("CME Provider's Lounge",new Page());
$mPage->showPage();
session_write_close();
?>
