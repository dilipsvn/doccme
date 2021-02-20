<?php
/*
 *	Created on Mar 28, 2007
 *	author Poornima Kamatgi
 * 
 * 	this is view transaction page
 * 
 * 	
 * 	
 */
 session_start();
 require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.AdminAgentSecurity.php");
class Page
{
	
	var $bal;
	var $security;	
	//error class
 	var $error;
 	var $role;
 	
 		
	function Page()
	{
		
		$this->bal = new BAL();
		$this->error = new Error();
		$this->security = new AdminAgentSecurity();
		$this->role = $this->security->CheckRole();
		$result = "";
		if($this->role == "AGENT")
		{
			session_write_close();
			header("location:./inValidPageAccess.php");
		}
		elseif($this->role == "" || $this->role == "DOCTOR" || $this->role == "CMEProvider")
		{
			session_write_close();
			header("location:./index.php");
		}
	}
		
	function showContent()
	{
		include ("./html/html.viewTransactions.php");
		
	}
	
}
$myPage =  new Page();
$mPage = new Main("View Transactions Page", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>