<?php
/*
 *	Created on Mar 28, 2007
 *	author Poornima Kamatgi 
 *
 *	this class displays
 *	options/operations on agents
 *	that can be accomlished by 
 *	the admin
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.Error.php");
require_once("./classes/class.AdminAgentSecurity.php");
class Page
{
	var $security;
	var $role;
	var $error;
	
	function Page()
	{
		$this->security = new AdminAgentSecurity();
		$this->error = new Error();
		$this->bal = new BAL();
		$result ="";
		$this->role = $this->security->CheckRole();
		
		if($this->role == "AGENT")
		{
			$this->error = $this->bal->checkAccessOfAgent("5", $result);
			$row = mysql_fetch_assoc($result);
			$this->access = $row["AccessType"];
			if($this->access == "DENIED")
			{
				session_write_close();
				header("location:./inValidPageAccess.php");
			}
		}
		elseif($this->role == "" || $this->role == "DOCTOR" || $this->role == "CMEProvider")
		{
			session_write_close();
			header("location:./index.php");
		}
	}
	function showContent()
	{
		include("./html/html.agents.php");
	}
}
$myPage = new Page();
$mPage = new Main("Agent's Page", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>