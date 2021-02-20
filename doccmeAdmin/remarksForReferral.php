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
require_once("./classes/Model.Referral.php");
require_once("./classes/class.AdminAgentSecurity.php");
session_start();
class Page
{
	var $remarks;
	
	var $security;
	var $role;
	var $error;
	var $referral;
	function Page()
	{
		$this->security = new AdminAgentSecurity();
		$this->error = new Error();
		$this->bal = new BAL();
		$this->referral = new ModelReferral();
		$result = "";
		$this->referral->autoSetfromPost();
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
		$this->remarks = new TextArea("Remarks", "remarks", $this->referral->remarks, "5", "35");
		$this->referralId = $_GET["rid"];
		$this->referral->referralId = $_GET["rid"];
		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction= "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];
		
	}
	function showContent()
	{
		$this->formLoad();
		include("./html/html.remarksForReferral.php");
	}
	function formLoad()
	{
		if($this->PageAction == "Add Remarks")
		{
			$this->error = $this->bal->updateReferralRemarks($this->referral);
			if(!$this->error->isError())
			{
				session_write_close();
				header("location:./referralClose.php?rid=". $this->referral->referralId);
			}
		}
	}
}
$myPage = new Page();
$mPage = new Main("Remarks for Referral", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>

