<?php
/*
 * Created on Dec 4, 2007
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
	var $CMEId;
	var $instituteName;
	var $firstName;
	var $middleName;
	var $lastName;
	var $address1;
	var $address2;
	var $city;
	var $state;
	var $zip;
	var $workPhone;
	var $homePhone;
	var $mobilePhone;
	var $fax;
	var $email;
	var $websiteUrl;
	var $loginName;
	var $newPassword;
	var $confirmNewPassword;
	var $status;
	var $remarks;
	
	//BAL object
	var $bal;
	
	//array
	var $StateList;
	var $StatusList;
	
	var $security;
	//Error object
	var $error;
			
	function Page()
	{
		$this->CMEProvider = new ModelCMEProvider();
		$this->CMEProvider->autoSetfromPost();
		$this->bal = new BAL();
		$this->error = new Error();
		$this->security = new AdminAgentSecurity();
		$result = "";		
 		$this->id = $_GET["id"];
 		$result = "";
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
 		$this->error = $this->bal->getCMEProviderDetails($this->id, $result);
		
		if($result != null)
		{
			while($CMEProvider = mysql_fetch_assoc($result))
			{
				$this->CMEId = new TextBox("CME ID", "CMEId", $CMEProvider["CMEId"], "50", "25", true);
				$this->CMEProvider->CMEId = $this->CMEId->data;
				$this->instituteName = new TextBox("Institute Name", "instituteName", $CMEProvider["InstituteName"], "50", "25");
				$this->CMEProvider->instituteName = $this->instituteName->data;
				$this->firstName = new TextBox("First Name","firstName",$CMEProvider["FirstName"],"50","25", "true");
				$this->CMEProvider->name->firstName = $this->firstName->data;
				$this->middleName = new TextBox("Middle Name","middleName",$CMEProvider["MiddleName"],"50","25");
				$this->CMEProvider->name->middleName = $this->middleName->data;
				$this->lastName = new TextBox("Last Name","lastName",$CMEProvider["LastName"],"50","25");
				$this->CMEProvider->name->lastName = $this->lastName->data;
				$this->address1 = new TextBox("Address1 ","address1",$CMEProvider["Address1"],"250","35");
				$this->CMEProvider->address->address1  = $this->address1->data;
				$this->address2 = new TextBox("Address2 ","address2",$CMEProvider["Address2"],"250","35");
				$this->CMEProvider->address->address2  = $this->address2->data;
				$this->city = new TextBox("City","city",$CMEProvider["City"],"50","20");
				$this->CMEProvider->address->city = $this->city->data;
				$this->state = new TextBox("State", "State",$CMEProvider["State"],"50","20");
				$this->CMEProvider->address->state = $this->state->data;
				$this->zip = new TextBox("Zip","zip",$CMEProvider["Zip"],"20","10");
				$this->CMEProvider->address->zip = $this->zip->data;
				$this->workPhone = new TextBox("Phone (Work)","workPhone",$CMEProvider["WorkPhone"],"50","20");
				$this->CMEProvider->phone->workPhone = $this->workPhone->data;
				$this->homePhone = new TextBox("Phone (Home)","homePhone",$CMEProvider["HomePhone"],"50","20");
				$this->CMEProvider->phone->homePhone = $this->homePhone->data;
				$this->fax = new TextBox("Fax","fax",$CMEProvider["Fax"],"50","20");
				$this->CMEProvider->phone->fax = $this->fax->data;
				$this->mobilePhone = new TextBox("Mobile","mobilePhone",$CMEProvider["MobilePhone"],"50","20");
				$this->CMEProvider->phone->mobilePhone = $this->mobilePhone->data;
				$this->email= new TextBox("Email Address","email",$CMEProvider["EmailId"],"50","20");
				$this->CMEProvider->email = $this->email->data;
				$this->websiteUrl= new TextBox("Website URL","websiteUrl",$CMEProvider["WebsiteUrl"],"50","20");
				$this->CMEProvider->websiteUrl = $this->websiteUrl->data;
				$this->loginName= new TextBox("User Name","loginName",$CMEProvider["UserName"],"50","20", "true");
				$this->status = new TextBox("Status", "status", $CMEProvider["Status"],"50","20");
				$this->CMEProvider->status = $this->status->data;
				$this->remarks = new TextBox("Remarks", "remarks", $CMEProvider["Remarks"], "50", "25");
				$this->CMEProvider->remarks = $this->remarks->data;
			}
		}
		
	}
		
	function showContent()
	{
		
		include("./html/html.viewCMEProviderDetails.php");
	}
	
}

$myPage = new Page();
$mPage = new Main("View CME Provider Details", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>
