<?php
/*
 * Created on Apr 3, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.Error.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.AdminAgentSecurity.php");
require_once("./classes/Model.Agent.php");
class Page
{
	//user role
	var $role;
	
	//agent object
	var $agent;	
	//security object
	var $security;
	
	var $userId;
	var $usersList;
	var $bal;
	var $error;
	var $PageAction;
			
	function Page()
	{
		$this->security = new AdminAgentSecurity();
		$this->error = new Error();
		$this->bal = new BAL();
		$result = "";
		$this->agent = new ModelAgent();
		$this->agent->autoSetFromPost();
		$this->role = $this->security->CheckRole();
		
		
		if($this->role == "AGENT")
		{
			$this->error = $this->bal->checkAccessOfAgent("12", $result);
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
		$this->userId = new SelectList("Users", "userId", $this->agent->userId);
		
		
		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction= "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];
			
		$this->error = $this->bal->getComboUserList($this->usersList);	
	}
	function getAccess(&$access)
  	{
  		if($access == "GRANTED")
  		{
  			return "Deny Access";
  		}
  		elseif($access == "DENIED")
  		{
  			return "Grant Access";
  		}
  		
  	}	
	
	function showContent()
	{
		include("./html/html.grantORRevokeAccess.php");
	}
}
$myPage = new Page();
$mPage = new Main("Grant OR Revoke Access to Agents", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>
