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
		$this->Agent = new ModelAgent();
		$this->Agent->autoSetfromPost();
		$this->bal = new BAL();
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
		$this->firstName = new TextBox("First Name","firstName",$this->Agent->name->firstName,"50","25");
		$this->lastName = new TextBox("Last Name","lastName",$this->Agent->name->lastName,"50","25");
		$this->email= new TextBox("Email Address","email",$this->Agent->email,"50","20");
		$this->loginName= new TextBox("User Name","loginName",$this->Agent->login->loginName,"50","20");
		
						
		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction= "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];
			
		$firstName = $_REQUEST["firstName"];
		$lastName = $_REQUEST["lastName"];
		$email = $_REQUEST["email"];
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
			header("location:./searchAgentResults.php?PageAction=SEARCH".$queryString);
		}
	}
		
	function showContent()
	{
		include("./html/html.searchAgent.php");
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
	function checkLastName()
	{
		if($this->PageAction=="SEARCH")
		{
			if($this->lastName->data == "")
				echo  "";
			else
			{
				if(strrpos($this->lastName->data, "'")>= 1)
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
$mPage = new Main("Search Agent For Admin", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>