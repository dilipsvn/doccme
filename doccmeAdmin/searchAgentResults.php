<?php
/*
 * Created on Mar 28, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/Model.Agent.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.AdminAgentSecurity.php");
class Page
{
	//Model Object
	var $Agent;
	
	//Form Control
	
	var $firstName;
	var $lastName;
	var $email;
	var $loginName;
	var $bal;
	
	//array
	var $StateList;
	var $security;
	//error class
	var $error;
			
	function Page()
	{
		$this->bal = new BAL();
		$this->Agent = new ModelAgent();
		$this->Agent->autoSetfromPost();
		$this->security = new AdminAgentSecurity();
		$this->error = new Error();
		$result = "";
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
								
		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction= "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];
	}
		
	function showContent()
	{
		include("./html/html.searchAgentResults.php");
	}
	
}
$myPage = new Page();
$mPage = new Main("Search Agent Results", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>
