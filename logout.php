<?php
/*
 *	Created on Feb 10, 2007
 *	author Poornima Kamatgi
 * 
 *	this class enables Doctor or CME Provider
 *	to logout of DocCME
 */ob_start();
session_start();
 require_once("./classes/class.Main.php");
 require_once("./classes/class.Security.php");
 class Page
 {
 	var $security;
 	
 	function Page()
 	{
 		$this->security = new Security();
 		$this->security->logout();	
		header("location:./index.php");
 	}
 	
 	function showContent()
 	{
 		include("./html/html.Logout.php");
 	}
 }
 $mPage = new Main("Logout", new Page());
 $mPage->showPage();	
?>