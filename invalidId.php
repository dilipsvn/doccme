<?php
/*
 * Created on Dec 6, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
session_start();
 require_once("./classes/class.Main.php");
 require_once("./classes/class.Security.php");
 class Page
 {
 	//security object
	var $security;
 	var $role;
 	
 	function Page()
 	{
 		$this->security = new Security();
 		
 	}
 	
 	function showContent()
 	{
 		include("./html/html.invalidId.php");
 	}
 }
 $myPage = new Page();
 $mPage = new Main("Invalid Id", $myPage);
 $mPage->showPage();
 session_write_close();	
?>
