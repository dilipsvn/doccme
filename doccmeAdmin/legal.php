<?php
/*
 * Created on 7 Feb, 2008
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.AdminAgentSecurity.php");
class Page
{
	//user role
	var $role;
		
	//security object
	var $security;
	function Page()
	{
		$this->security = new AdminAgentSecurity();
		$this->role = $this->security->CheckRole();
		
		if($this->role == "" || $this->role == "DOCTOR" || $this->role == "CMEProvider")
		{
			session_write_close();
			header("location:./index.php");
		}	
	}
	function showContent()
	{
		include("./html/html.legal.php");
	}
}
$myPage = new Page();
$mPage = new Main("DocCME - Privacy Policy", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>
