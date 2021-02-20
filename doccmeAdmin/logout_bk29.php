<?php
/*
 *	Created on Feb 10, 2007
 *	author Poornima Kamatgi
 * 
 *	this class enables Doctor or CME Provider
 *	to logout of DocCME
 */
 require_once("./classes/class.Main.php");
 require_once("./classes/class.AdminAgentSecurity.php");
 class Page
 {
 	var $security;
 	
 	function Page()
 	{
 		$this->security = new AdminAgentSecurity();
 		$this->security->logout();	
		session_destroy()
 		header("location:./index.php");
 	}
 	
}
 $mPage = new Main("Logout", new Page(), "");
 $mPage->showPage();	
?>