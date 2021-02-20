<?php
/*
 *	Created on Oct 11, 2007
 *	author Poornima Kamatgi
 *
 *	Admin assigns partial access status to all
 *	doctors registered in DocCME
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
			session_write_close();
			header("location:./inValidPageAccess.php");
		}
		elseif($this->role == "" || $this->role == "DOCTOR" || $this->role == "CMEProvider")
		{
			session_write_close();
			header("location:./index.php");
		}
		$this->error = $this->bal->assignPartialAccessToAllDoctors($result);
		if($this->error->isError())
		{
			return $this->error;
		}
	}
	function showContent()
	{
		include("./html/html.partialAccessDoctors.php");
	}
}
$myPage = new Page();
$mPage = new Main("Partial Access to Doctors", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>