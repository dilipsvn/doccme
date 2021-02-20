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
require_once("./classes/Model.Doctor.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.AdminAgentSecurity.php");


class Page
{
	//Model Object
	var $doctor;
	
	//Form Control
	
	var $firstName;
	var $sex;
	var $lastName;
	var $address1;
	var $city;
	var $state;
	var $email;
	var $speciality;
	var $loginName;
	var $bal;
	
	//array
	var $StateList;
	
	//error class
	var $error;
	//var $errorOfAccess;
	
	//role variable
	var $role;
	
	//access variable
	var $access;
			
	//security object
	var $security;		
	function Page()
	{
		$this->doctor = new ModelDoctor();
		$this->doctor->autoSetfromPost();
		$this->bal = new BAL();
		$this->error = new Error();
		
		$this->security = new AdminAgentSecurity();
		$this->access = "";
		$result = "";	 
		$this->role = $this->security->CheckRole();
		if($this->role == "AGENT")
		{
			$this->error = $this->bal->checkAccessOfAgent("4", $result);
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
		$this->firstName = new TextBox("First Name","firstName",$this->doctor->name->firstName,"50","25");
		$this->lastName = new TextBox("Last Name","lastName",$this->doctor->name->lastName,"50","25");
		$this->sex = new SelectList("Sex","sex",$this->doctor->sex);
		$this->address1 = new TextBox("Address 1","address1",$this->doctor->address->address1,"250","35");
		$this->city = new TextBox("City","city",$this->doctor->address->city,"50","20");
		$this->state = new SelectList("State", "State", $this->doctor->address->state);
		$this->email= new TextBox("Email Address","email",$this->doctor->email,"50","20");
		$this->speciality = new SelectList("Speciality", "Speciality", $this->doctor->speciality);
		$this->loginName= new TextBox("User Name","loginName",$this->doctor->login->loginName,"50","20");
		
		$this->error =  $this->bal->getComboSexList($this->SexList);
		$this->error =  $this->bal->getComboStateList($this->StateList);
		$this->error =  $this->bal->getComboSpecialityList($this->SpecialityList);
					
		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction= "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];
		$firstName = $_REQUEST["firstName"];
		$lastName = $_REQUEST["lastName"];
		$sex = $_REQUEST["sex"];
		$address1 = $_REQUEST["address1"];
		$city = $_REQUEST["city"];
		$state = $_REQUEST["State"];
		$email = $_REQUEST["email"];
		$speciality = $_REQUEST["Speciality"];
		$loginName = $_REQUEST["loginName"];
		$queryString = "";
		if($firstName !=null)
		{
			$queryString = $queryString . "&firstName=" . $firstName;
		}
		if($lastName !=null)
		{
			$queryString = $queryString . "&lastName=" . $lastName;
		}
		if($sex !=null)
		{
			$queryString = $queryString . "&sex=" . $sex;
		}
		if($address1 !=null)
		{
			$queryString = $queryString . "&address1=" . $address1;
		}
		if($city !=null)
		{
			$queryString = $queryString . "&city=" . $city;
		}
		if($state !=null)
		{
			$queryString = $queryString . "&State=" . $state;
		}
		if($email !=null)
		{
			$queryString = $queryString . "&email=" . $email;
		}
		if($speciality !=null)
		{
			$queryString = $queryString . "&Speciality=" . $speciality;
		}
		if($loginName !=null)
		{
			$queryString = $queryString . "&loginName=" . $loginName;
		}
		if($this->PageAction=="SEARCH")
		{
			session_write_close();
			header("location:./searchDoctorResults.php?PageAction=SEARCH".$queryString);
		}
	}
		
	function showContent()
	{
		include("./html/html.searchDoctor.php");
	}
	
	function checkFirstName()
	{
		if($this->PageAction=="SEARCH")
		{
			if($this->firstName->data == "")
					echo "";
			else
			{	if(strrpos($this->firstName->data, "'") >= 1)
				{
					echo "Single quotes not allowed";
				}
				else
				{
					echo "";
				}
			}
		}
	}
	function checkLastName()
	{
		if($this->PageAction=="SEARCH")
		{
			if($this->lastName->data == "")
				echo "";
			else
			{
				if(strrpos($this->lastName->data, "'") >= 1)
				{
					echo "Single quotes not allowed";
				}
				else
				{
					echo "";
				}	
			}
		}
	}
	function checkSex()
	{
		if($this->PageAction=="SEARCH")
		{
			if($this->sex->data == "")
				echo "";
			else
				echo "";
		}	 
	}
	function checkAddress1()
	{
		if($this->PageAction=="SEARCH")
		{
			if($this->address1->data == "")
				echo "";
			else
			{
				if(strrpos($this->address1->data, "'") >= 1)
				{
					return "Single quotes not allowed";
				}
				else
				{
					echo "";
				}
			}	
		} 
	}
	function checkCity()
	{
		if($this->PageAction=="SEARCH")
		{
			if($this->city->data == "")
				echo "";
			else
			{
				if(strrpos($this->city->data, "'") >= 1)
				{
					return "Single quotes not allowed";
				}
				else
				{
					echo "";
				}
			}
		}	 
	}
	function checkState()
	{
		if($this->PageAction=="SEARCH")
		{
			if($this->state->data == "")
				echo "";
			else
				echo "";
		}	 
	}
	
	function checkEmail()
	{
		if($this->PageAction=="SEARCH")
		{
			if($this->email->data == "")
				echo "";
			else
			{
				if(strrpos($this->email->data, "'") >= 1)
				{
					return "Single quotes not allowed";
				}
				else
				{
					echo "";
				}
			}
		}	 
	}
	function checkSpeciality()
	{
		if($this->PageAction=="SEARCH")
		{
			if($this->speciality->data == "")
				echo "";
			else
				echo "";
		}	 
	}
	
	function checkLoginName()
	{
		if($this->PageAction=="SEARCH")
		{
			if($this->loginName->data == "")
				echo "";
			else
			{
				if(strrpos($this->loginName->data, "'") >= 1)
				{
					echo "Single quotes not allowed";
				}
				else
				{
					echo "";
				}
			}
		}	 
	}
}
$myPage = new Page();
$mPage = new Main("Search Doctor For Admin", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>
