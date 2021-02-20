<?php
/*
 * Created on Dec 6, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
session_start();
 require_once("./classes/class.Main.php");
 require_once("./classes/class.AdminAgentSecurity.php");
 class Page
 {
 	//security object
	var $security;
 	var $role;
 	
 	function Page()
 	{
 		$this->security = new AdminAgentSecurity();
 		$this->role = $this->security->CheckRole();
 		if($this->role == ""|| $this->role == "DOCTOR" || $this->role == "CMEProvider")
		{
			session_write_close();
			header("location:./index.php");
		}	
 	}
 	
 	function showContent()
 	{
 		include("./html/html.invalidId.php");
 	}
 }
 $myPage = new Page();
 $mPage = new Main("Invalid Id", $myPage, $myPage->role);
 $mPage->showPage();
 session_write_close();	
?>
