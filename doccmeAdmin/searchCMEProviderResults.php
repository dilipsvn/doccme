<?php
/*
 * Created on Mar 27, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 session_start();
 require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/Model.CMEProvider.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.AdminAgentSecurity.php");

class Page
{
	//Model Object
	var $CMEProvider;
	
	//Form Control
	var $instituteName;
	var $firstName;
	var $address1;
	var $city;
	var $state;
	var $email;
	var $websiteUrl;
	var $loginName;
	var $bal;
	
	//array
	var $StateList;
	
	//error class
	var $error;
	var $errorInAccess;
	var $errorInStateList;
	
	//role variable
	var $role;
	
	//access variable
	var $access;
			
	//security object
	var $security;		
			
	function Page()
	{
		$this->CMEProvider = new ModelCMEProvider();
		$this->CMEProvider->autoSetfromPost();
		$this->bal = new BAL();
		$this->error = new Error();
		$result = "";
		$this->security = new AdminAgentSecurity();
		$this->access = "";
		
		
		$this->role = $this->security->CheckRole();
		if($this->role == "AGENT")
		{
			$this->error = $this->bal->checkAccessOfAgent("3", $result);
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
		
		
		$this->error = $this->bal->getComboStateList($this->StateList);	
		
	}
		
	function showContent()
	{
		include("./html/html.searchCMEProviderResults.php");
	}
	
}
$myPage = new Page();
$mPage = new Main("Results of Search CME Provider", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>

