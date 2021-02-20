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
		
		$this->instituteName = new TextBox("Institute Name", "instituteName", $this->CMEProvider->instituteName, "50", "25");
		$this->firstName = new TextBox("First Name","firstName",$this->CMEProvider->name->firstName,"50","25");
		$this->address1 = new TextBox("Address1 ","address1",$this->CMEProvider->address->address1,"250","35");
		$this->city = new TextBox("City","city",$this->CMEProvider->address->city,"50","20");
		$this->state = new SelectList("State", "State", $this->CMEProvider->address->state);
		$this->email= new TextBox("Email Address","email",$this->CMEProvider->email,"50","20");
		$this->loginName= new TextBox("User Name","loginName",$this->CMEProvider->login->loginName,"50","20");
							
		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction= "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];
		
		
		$this->error = $this->bal->getComboStateList($this->StateList);	
		$instituteName = $_REQUEST["instituteName"];
		$firstName = $_REQUEST["firstName"];
		$address1 = $_REQUEST["address1"];
		$city = $_REQUEST["city"];
		$state = $_REQUEST["State"];
		$email = $_REQUEST["email"];
		$loginName = $_REQUEST["loginName"];
		$queryString = "";
		if($instituteName !=null)
		{
			$queryString = $queryString . "&instituteName=" . $instituteName;
		}
		if($firstName !=null)
		{
			$queryString = $queryString . "&firstName=" . $firstName;
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
		if($loginName !=null)
		{
			$queryString = $queryString . "&loginName=" . $loginName;
		}
		if($this->PageAction=="SEARCH")
		{
			session_write_close();
			header("location:./searchCMEProviderResults.php?PageAction=SEARCH".$queryString);
		}
	}
		
	function showContent()
	{
		include("./html/html.searchCMEProvider.php");
	}
	function checkInstituteName()
	{
		if($this->PageAction=="SEARCH")
		{
			if($this->instituteName->data == "")
				echo "";
			else
			{
				if(strrpos($this->instituteName->data, "'") >= 1)
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
	function checkFirstName()
	{
		if($this->PageAction=="SEARCH")
		{
			if($this->firstName->data == "")
			{
				echo "";
			}
			else
			{
				if(strrpos($this->firstName->data, "'") >= 1)
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
	function checkAddress1()
	{
		if($this->PageAction=="SEARCH")
		{
			if($this->address1->data == "")
				echo  "";
			else
			{
				if(strrpos($this->address1->data, "'")>= 1)
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
	function checkCity()
	{
		if($this->PageAction=="SEARCH")
		{
			if($this->city->data == "")
				echo  "";
			else
			{
				if(strrpos($this->city->data, "'")>= 1)
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
					echo "Single quotes not allowed";
				}
				else
				{
					echo "";
				}
			}
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
$mPage = new Main("Search CME Provider For Admin", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>
