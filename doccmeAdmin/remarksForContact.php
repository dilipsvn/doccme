<?php
/*
 * Created on Nov 20, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.Error.php");
require_once("./classes/class.BAL.php");
require_once("./classes/Model.DocContact.php");
require_once("./classes/class.AdminAgentSecurity.php");
session_start();
class Page
{
	var $remarks;
	
	var $security;
	var $role;
	var $error;
	var $docContact;
	function Page()
	{
		$this->security = new AdminAgentSecurity();
		$this->error = new Error();
		$this->bal = new BAL();
		$this->docContact = new ModelDocContact();
		$result = "";
		$this->docContact->autoSetfromPost();
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
		$this->remarks = new TextArea("Remarks", "remarks", $this->docContact->remarks, "5", "35");
		$this->contactId = $_GET["cid"];
		$this->docContact->contactId = $_GET["cid"];
		
		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction= "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];
		
	}
	function showContent()
	{
		$this->formLoad();
		include("./html/html.remarksForContact.php");
	}
	function formLoad()
	{
		if($this->PageAction == "Add Remarks")
		{
			$this->error = $this->bal->updateContactRemarks($this->docContact);
			if(!$this->error->isError())
			{
				session_write_close();
				header("location:./contactClose.php?cid=". $this->docContact->contactId);
			}
		}
	}
}
$myPage = new Page();
$mPage = new Main("Remarks for Contact", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>

