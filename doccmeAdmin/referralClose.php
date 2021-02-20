<?php
/*
 * Created on Oct 29, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.Error.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.AdminAgentSecurity.php");
session_start();
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
		$result = "";
		$this->role = $this->security->CheckRole();
		if($this->role == "AGENT")
		{
			$this->error = $this->bal->checkAccessOfAgent("13", $result);
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
		$id = $_GET["rid"];
		$this->error = $this->bal->closeReferral($id);
		
		if(!$this->error->isError())
		{
			session_write_close();
			header("location:./referralList.php");
		}
		else
		{
			echo $this->error->getUserMessage();
		}
	}
	function showContent()
	{
		
	}
	
}
$myPage = new Page();
$mPage = new Main("Referral Close", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>
