<?php
/*
 * Created on Oct 29, 2007
 *
 * this class lists the referrals
 * of doctors who expect call back from
 * DocCME for info regd it
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
			$this->error = $this->bal->checkAccessOfAgent("14", $result);
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
		include("./html/html.referralList.php");
	}
}
$myPage = new Page();
$mPage = new Main("Referrals Page", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>
