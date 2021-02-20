<?php
/*
 * Created on Oct 3, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.Error.php");
require_once("./classes/class.EmailList.php");
require_once("./classes/class.AdminAgentSecurity.php");
require_once("./classes/class.BAL.php");
class Page
{
	var $bal;
	var $security;
	var $error;
	
	function Page()
	{
		$this->security = new AdminAgentSecurity();
		$this->role = $this->security->CheckRole();
		$this->bal = new BAL();
		$this->error = new Error();
			
		$result = "";
		if($this->role == "AGENT")
		{
			$this->error = $this->bal->checkAccessOfAgent("8", $result);
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
		$txt = $_SESSION["restxt"];
		
		if($txt == "SUCCESS")
		{
			session_write_close();
			header("location:./coursePaymentSuccessful.php");
			
			
		}
		elseif($txt == "FAILURE")
		{
			session_write_close();
			header("location:./coursePaymentFailure.php");
			
		}
		
		
	}
	function showContent()
	{
		
		include("./html/html.thankyou.php");
	}
	
}
$myPage = new Page();
$mPage = new Main("Thank You", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>
