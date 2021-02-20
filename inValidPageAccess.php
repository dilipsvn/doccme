<?php
/*
 *	Created on Feb 10, 2007
 *	author Poornima Kamatgi
 *
 *	this class displays message for invalid
 *	page access if a doctor who is logged in
 *	tries to access protected page of CME Provider
 *	or vice-versa
 */
 session_start();
 require_once("./classes/class.Main.php");
 require_once("./classes/class.Security.php");
 class Page
 {
 	var $security;
 	
 	function Page()
 	{
 		
 	}
 	
 	function showContent()
 	{
 		include("./html/html.InvalidPageAccess.php");
 	}
 }
 $mPage = new Main("Invalid Page Access", new Page());
 $mPage->showPage();
 session_write_close();	
?>
