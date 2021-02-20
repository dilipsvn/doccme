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
require_once("./classes/class.AdminAgentSecurity.php");
require_once("./classes/class.Error.php");
require_once("./classes/class.BAL.php");
require_once("./classes/Model.Doctor.php");

class Page
{
	
	var $firstName;
	var $middleName;
	var $lastName;
	var $sex;
	var $address1;
	var $address2;
	var $city;
	var $state;
	var $zip;
	var $country;
	var $contactTime;
	var $speciality;
	var $workPhone;
	var $homePhone;
	var $mobilePhone;
	var $fax;
	var $email;
	var $loginName;
	var $doctor;
	var $security;
	var $role;
	var $error;
	var $bal;
	
		
	function Page()
	{
		$this->security = new AdminAgentSecurity();
		$this->bal = new BAL();
		$this->error = new Error();
		$this->Doctor = new ModelDoctor();
		$this->role = $this->security->CheckRole();
		if($this->role == "" || $this->role == "DOCTOR" || $this->role == "CMEProvider")
		{
			session_write_close();
			header("location:./index.php");
		}
		$this->id = $_GET["id"];
		$result = "";
		$this->Doctor->autoSetfromPost();
		$this->error = $this->bal->getDoctorDetails($this->id, $result);
		if($result != null)
		{
			while($Doctor = mysql_fetch_assoc($result))
			{
				$this->doctorId = new TextBox("Doctor ID", "doctorId", $Doctor["DoctorId"], "50", "25", "true");
				$this->Doctor->doctorId = $this->doctorId->data;
				$this->firstName = new TextBox("First Name","firstName",$Doctor["FirstName"],"50","25", "true");
				$this->Doctor->name->firstName = $this->firstName->data;
				$this->middleName = new TextBox("Middle Name","middleName",$Doctor["MiddleName"],"50","25");
				$this->Doctor->name->middleName = $this->middleName->data;
				$this->lastName = new TextBox("Last Name","lastName",$Doctor["LastName"],"50","25");
				$this->Doctor->name->lastName = $this->lastName->data;
				$this->sex = new SelectList("Sex","sex",$Doctor["Sex"]);
				$this->Doctor->sex = $this->sex->data;
				$this->address1 = new TextBox("Address1 ","address1",$Doctor["Address1"],"250","35");
				$this->Doctor->address->address1  = $this->address1->data;
				$this->address2 = new TextBox("Address2 ","address2",$Doctor["Address2"],"250","35");
				$this->Doctor->address->address2  = $this->address2->data;
				$this->city = new TextBox("City","city",$Doctor["City"],"50","20");
				$this->Doctor->address->city = $this->city->data;
				$this->state = new TextBox("State", "State", $Doctor["State"],"50","20");
				$this->Doctor->address->state = $this->state->data;
				$this->zip = new TextBox("Zip","zip",$Doctor["Zip"],"20","10");
				$this->Doctor->address->zip = $this->zip->data;
				$this->workPhone = new TextBox("Phone (Work)","workPhone",$Doctor["WorkPhone"],"50","20");
				$this->Doctor->phone->workPhone = $this->workPhone->data;
				$this->homePhone = new TextBox("Phone (Home)","homePhone",$Doctor["HomePhone"],"50","20");
				$this->Doctor->phone->homePhone = $this->homePhone->data;
				$this->fax = new TextBox("Fax","fax",$Doctor["Fax"],"50","20");
				$this->Doctor->phone->fax = $this->fax->data;
				$this->mobilePhone = new TextBox("Mobile","mobilePhone",$Doctor["MobilePhone"],"50","20");
				$this->Doctor->phone->mobilePhone = $this->mobilePhone->data;
				$this->email= new TextBox("Email Address","email",$Doctor["EmailId"],"50","20");
				$this->Doctor->email = $this->email->data;
				$this->speciality = new TextBox("Speciality", "Speciality", $Doctor["Speciality"],"50","20");
				$this->Doctor->speciality = $this->speciality->data;
				$this->contactTime= new TextBox("Best Time to Contact","contactTime",$Doctor["ContactTime"],"50","20");
				$this->Doctor->contactTime = $this->contactTime->data; 
				$this->loginName= new TextBox("User Name","loginName",$Doctor["UserName"],"50","20");
				$this->Doctor->loginName = $this->loginName->data;
				$this->status = new TextBox("Status", "status", $Doctor["Status"],"50","20");
				$this->Doctor->status = $this->status->data;
				$this->remarks = new TextBox("Remarks", "remarks", $Doctor["Remarks"], "50", "25");
				$this->Doctor->remarks = $this->remarks->data;
			}
		}
		
		
	}
	
	function showContent()
	{
		include("./html/html.viewDoctorDetails.php");
	}
}
$myPage = new Page();
$mPage = new Main(" View Doctor Details", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>

