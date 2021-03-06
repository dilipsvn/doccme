<?php
/*
 * Created on Dec 17, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/Model.CMEProvider.php");
require_once("./classes/class.BAL.php");
require_once("./classes/class.EmailList.php");
require_once("./classes/class.Security.php");
class Page
{
	//Model Object
	var $CMEProvider;
	
	//Form Control
	var $CMEId;
	var $instituteName;
	var $instituteName_error;
	var $firstName;
	var $firstName_error;
	var $middleName;
	var $middleName_error;
	var $lastName;
	var $lastName_error;
	var $address1;
	var $address1_error;
	var $address2;
	var $address2_error;
	var $city;
	var $city_error;
	var $state;
	var $state_error;
	var $zip;
	var $zip_error;
	var $workPhone;
	var $workPhone_error;
	var $homePhone;
	var $homePhone_error;
	var $mobilePhone;
	var $mobilePhone_error;
	var $fax;
	var $fax_error;
	var $email;
	var $websiteUrl;
	var $websiteUrl_error;
	var $loginName;
	var $newPassword;
	var $confirmNewPassword;
	var $bal;
	
	//array
	var $StateList;
	var $SpecialityList;
	var $emailList;
	var $condt;
	//error class
 	var $error;
 	var $security;	
	function Page()
	{
		$this->CMEProvider = new ModelCMEProvider();
		$this->CMEProvider->autoSetfromPost();
		$this->bal = new BAL();
		$this->condt = true;
		$this->error = new Error();
		$this->emailList = new EmailList();
		$this->security = new Security();
		
		if (!isset($_REQUEST["PostBack"]))
			$this->postBack= "false";
		else
			$this->postBack = $_REQUEST["PostBack"];
		
		$result = "";		
 		$this->cmeproviderId = $_SESSION["UserId"];
 		
 		$role = $this->security->CheckRole();
		if($role == "CMEProvider")
		{
			$loginStatus = $this->security->CheckLoginStatus();
			
			if($loginStatus == "NOTLOGGEDIN")
			{
				$this->security->setLandingPage("editCMEProviderDetails.php");
				session_write_close();
				header("Location:./login.php?p=CMEProvider");
			}
		}
		elseif($role == "Doctor")
		{
			session_write_close();
			header("location:./inValidPageAccess.php");
		}
		elseif($role == "")
		{
			$this->security->setLandingPage("editCMEProviderDetails.php");
			session_write_close();
			header("location:./login.php?p=CMEProvider");
		}
 		$userAgent = $this->security->CheckUserAgent();
		//echo "user agent : " . $userAgent;
		if($userAgent != $_SERVER["HTTP_USER_AGENT"])
		{
			$this->security->setLandingPage("editCMEProviderDetails.php");
			session_write_close();
			header("Location:./login.php?p=CMEProvider");
		}
		$result = "";
		$this->error = $this->bal->getCMEProviderDetails($this->cmeproviderId, $result);
		/*if(mysql_num_rows($result) == 0)
		{
			session_write_close();
			header("location:./invalidId.php?type=cmeproviderId");
		}*/
	
 			if($this->postBack == "false")
			{
				if($result != null)
				{
					while($CMEProvider = mysql_fetch_assoc($result))
					{
						$this->CMEId = new TextBox("CME ID", "CMEId", $CMEProvider["CMEId"], "50", "25", "true");
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
						$this->state = new SelectList("State", "State",$CMEProvider["State"]);
						$this->CMEProvider->address->state = $this->state->data;
						$this->zip = new TextBox("Zip","zip",$CMEProvider["Zip"],"20","10");
						$this->CMEProvider->address->zip = $this->zip->data;
						$this->country = new TextBox("Country","country","USA","50","20", "true");
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
						$this->websiteUrl= new TextBox("Website URL","websiteUrl",$CMEProvider["WebSiteUrl"],"50","20");
						$this->CMEProvider->websiteUrl = $this->websiteUrl->data;
						$this->loginName= new TextBox("User Name","loginName",$CMEProvider["UserName"],"50","20", "true");
					}
				}
			}
			else
			{
					$this->CMEId = new TextBox("CMEID", "CMEId", $this->CMEProvider->CMEId, "50", "25", "true");
					$this->instituteName = new TextBox("Institute Name", "instituteName", $this->CMEProvider->instituteName, "50", "25");
					$this->firstName = new TextBox("First Name","firstName",$this->CMEProvider->name->firstName,"50","25", "true");
					$this->middleName = new TextBox("Middle Name","middleName",$this->CMEProvider->name->middleName,"50","25");
					$this->lastName = new TextBox("Last Name","lastName",$this->CMEProvider->name->lastName,"50","25", "true");
					$this->address1 = new TextBox("Address1 ","address1",$this->CMEProvider->address->address1,"250","35");
					$this->address2 = new TextBox("Address2 ","address2",$this->CMEProvider->address->address2,"250","35");
					$this->city = new TextBox("City","city",$this->CMEProvider->address->city,"50","20");
					$this->state = new SelectList("State", "State", $this->CMEProvider->address->state);
					$this->zip = new TextBox("Zip","zip",$this->CMEProvider->address->zip,"20","10");
					$this->country = new TextBox("Country","country","USA","50","20", "true");
					$this->workPhone = new TextBox("Primary Phone No.","workPhone",$this->CMEProvider->phone->workPhone,"50","20");
					$this->homePhone = new TextBox("Secondary Phone No.","homePhone",$this->CMEProvider->phone->homePhone,"50","20");
					$this->fax = new TextBox("Fax","fax",$this->CMEProvider->phone->fax,"50","20");
					$this->mobilePhone = new TextBox("Mobile","mobilePhone",$this->CMEProvider->phone->mobilePhone,"50","20");
					$this->email= new TextBox("Email Address","email",$this->CMEProvider->email,"50","20", "true");
					$this->websiteUrl= new TextBox("Website URL","websiteUrl",$this->CMEProvider->websiteUrl,"50","20");
					$this->loginName= new TextBox("User Name","loginName",$this->CMEProvider->login->loginName,"50","20", "true");
			}
		
		$this->password= new Password("Old Password","password",$this->CMEProvider->password,"50","20");
		$this->newPassword= new Password("New Password","newPassword","","50","20");
		$this->confirmNewPassword= new Password("Confirm New Password","confirmNewPassword","","50","20");
		
		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction= "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];
				
		$this->error =  $this->bal->getComboStateList($this->StateList);
	}
			
	function formLoad()
	{
		if($this->PageAction == "UPDATE")
		{
			$this->CMEProvider->autoSetFromPost();
			//validation
		
			$this->instituteName_error = $this->checkInstituteName();
			if($this->instituteName_error != "")
				$this->condt = false;
			$this->firstName_error = $this->checkFirstName();
			if($this->firstName_error != "")
				$this->condt = false;
			$this->middleName_error = $this->checkMiddleName();
			if($this->middleName_error != "")
				$this->condt = false;
			$this->lastName_error = $this->checkLastName();
			if($this->lastName_error != "")
				$this->condt = false;
			$this->address1_error = $this->checkAddress1();
			if($this->address1_error != "")
				$this->condt = false;
			$this->address2_error = $this->checkAddress2();
			if($this->address2_error != "")
				$this->condt = false;
			$this->city_error = $this->checkCity();
			if($this->city_error != "")
				$this->condt = false;
			$this->state_error = $this->checkState();
			if($this->state_error != "")
				$this->condt = false;
			$this->zip_error = $this->checkZip();
			if($this->zip_error != "")
				$this->condt = false;
			$this->workPhone_error = $this->checkWorkPhone();
			if($this->workPhone_error != "")
				$this->condt = false;
			$this->homePhone_error = $this->checkHomePhone();
			if($this->homePhone_error != "")
				$this->condt = false;
			$this->fax_error = $this->checkFax();
			if($this->fax_error != "")
				$this->condt = false;
			$this->mobilePhone_error = $this->checkMobilePhone();
			if($this->mobilePhone_error != "")
				$this->condt = false;
			$this->websiteUrl_error = $this->checkWebsiteUrl();
			if($this->websiteUrl_error != "")
				$this->condt = false;
				
			if($this->condt)
			{
				$this->error = $this->bal->editCMEProviderDetails($this->CMEProvider);
				if(!$this->error->isError())
				{
					session_write_close();
					header("location:./cmeProviderOptions.php?msg=detailssuccess");
				}
			}
			
		}
		elseif($this->PageAction == "RESET")
		{
			$this->condt = true;
			$password = $_REQUEST["password"];
			$newPassword = $_REQUEST["newPassword"];
			$confirmNewPassword = $_REQUEST["confirmNewPassword"];
			$this->password_error = $this->checkOldPassword($password);
			if($this->password_error != "")
				$this->condt = false;
			$this->newPassword_error = $this->checkNewPassword($newPassword);
			if($this->newPassword_error != "")
				$this->condt = false;
			$this->confirmNewPassword_error = $this->checkConfirmPassword($confirmNewPassword);
			if($this->confirmNewPassword_error != "")
				$this->condt = false;
			$this->equalPass_error = $this->checkEqualPasswords($newPassword, $confirmNewPassword);
			if($this->equalPass_error != "")
				$this->condt = false;
			if($this->condt)
			{
				$this->error = $this->bal->resetCMEProviderPassword($this->CMEProvider, $password, $newPassword);
				if(!$this->error->isError())
				{
					session_write_close();
					header("location:./cmeProviderOptions.php?msg=resetsuccess");
				}
			}
		}
	}
	function showContent()
	{
		$this->formLoad();
		include ("./html/html.editCMEProviderDetails.php");

	}
	
function checkInstituteName()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->instituteName->data == "")
				return "Institute Name cannot be blank";
			else
			{
				if(strrpos($this->instituteName->data, "'") >= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->instituteName->data) > 50 || strlen($this->instituteName->data) < 5)
				{
					return "Institute Name must contain less than 50 chars but not less than 5 chars";
				}
				else
				{
					return "";
				}
			}
		}
	}
	function checkFirstName()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->firstName->data == "")
			{
				return "";
			}
			else
			{
				if(strrpos($this->firstName->data, "'") >= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->firstName->data) > 50)
				{
						return "first name must contain less than 50 chars";
				}
				elseif(strlen($this->firstName->data) < 3)
				{
						return "first name must contain more than or equal to 3 chars";
				}
				else
				{
					return "";
				}
			}
		}
	}
	function checkMiddleName()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->middleName->data != "")
			{
				
				if(strrpos($this->middleName->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->middleName->data) > 50)
				{
						return "middle name must contain less than 50 characters";
				}
				else
				{
					return "";
				
				}
			}
		}
	}
	function checkLastName()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->lastName->data == "")
			{
				return "";
			}
			else
			{
				if(strrpos($this->lastName->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->lastName->data) > 50 )
				{
						return "last name must contain less than 50 characters";
				}
				else
				{
						return "";
				}
			}
		}
	}
	function checkAddress1()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->address1->data == "")
				return  "";
			else
			{
				if(strrpos($this->address1->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->address1->data) > 100 || strlen($this->address1->data) < 5)
				{
						return "Address1 must contain less than 100 characters but not less than 5 chars";
				}
				else
				{
						return "";
				}
			}
		} 
	}
	function checkAddress2()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->address2->data == "")
				return  "";
			else
			{
				if(strrpos($this->address2->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->address2->data) > 100 || strlen($this->address2->data) < 4)
				{
						return "Address2 must contain less than 100 chars not less than  4 chars";
				}
				else
				{
						return "";
				}
			}
		} 
	}
	function checkCity()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->city->data == "")
				return  "";
			else
			{
				if(strrpos($this->city->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->city->data) > 50 || strlen($this->city->data) < 4)
				{
						return "City must contain less than 50 chars but not less than 4 chars";
				}
				else
				{
						return "";
				}
			}
		}	 
	}
	
	
	function checkState()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->state->data == "")
				return  "";
			else
				return  "";
		}	 
	}
	function checkZip()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->zip->data == "")
				return  "";
			else
			{	
			 	if(strrpos($this->zip->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(!is_numeric($this->zip->data))
				{
					return "Enter numeric value for Zip code";
				}
				elseif(strlen($this->zip->data) > 5 || strlen($this->zip->data) < 5)
				{
					return "Zip code must contain 5 numbers";
				}
				else
				{
					return "";
				}
			}
		}	 
	}
	function checkWorkPhone()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->workPhone->data != "")
			{
				if(strrpos($this->workPhone->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(!ereg("^(\([0-9]{3}\)|[0-9]{3})[- \s]?[0-9]{3}[\s -]?[0-9]{4}", $this->workPhone->data))
				{
					return "Enter valid phone no.";
				}
				else
				{
					return "";
				}
			}
			else
			{
				return "Primary Phone No. cannot be blank";
			}
		}
	}
	function checkHomePhone()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->homePhone->data != "")
			{
				
				if(strrpos($this->homePhone->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(!ereg("^(\([0-9]{3}\)|[0-9]{3})[- \s]?[0-9]{3}[\s -]?[0-9]{4}", $this->homePhone->data))
				{
					return "Enter valid phone no.";
				}
				else
				{
					return "";
				}
			}
			else
			{
				return "";
			}
		}
	}
	function checkFax()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->fax->data != "")
			{
				if(strrpos($this->fax->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(!ereg("^(\([0-9]{3}\)|[0-9]{3})[- \s]?[0-9]{3}[\s -]?[0-9]{4}", $this->fax->data))
				{
					return "Enter valid fax no.";
				}
				else
				{
					return "";
				}
			}
			else
			{
				return "Fax cannot be blank";
			}
		}	 
	}
	function checkMobilePhone()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->mobilePhone->data != "")
			{
				
				if(strrpos($this->mobilePhone->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(!ereg("^(\([0-9]{3}\)|[0-9]{3})[- \s]?[0-9]{3}[\s -]?[0-9]{4}", $this->mobilePhone->data))
				{
					return "Enter valid phone no.";
				}
				else
				{
					return "";
				}
			}
			else
			{
				return "";
			}
		}
	}
	
	function checkWebsiteUrl()
	{
		if($this->PageAction=="UPDATE")
		{
			if($this->websiteUrl->data != "")
			{
				
				if(strrpos($this->websiteUrl->data, "'")>= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($this->websiteUrl->data) > 50 || strlen($this->websiteUrl->data) < 10)
				{
					return "Web site Url must contain less than or equal to 50 chars not less than 10 chars";	
				}
				else
				{
					return "";
				
				}
			}
			else
			{
				return "";
			}
		}
	}
	
	function checkOldPassword($pass)
	{
		if($this->PageAction=="RESET")
		{
			if($pass == "")
				return "Password cannot be blank";
			else
			{
				
				if(strrpos($pass, "'") >= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($pass) > 15)
				{
					return "Password must contain less than or equal to 15 chars";
				}
				elseif(strlen($pass) < 7)
				{
					return "Password must not contain less than 7 chars";
				}
				elseif(!preg_match("/[a-z A-Z][0-9]/", $pass))
				{
					return "Password must contain atleast one digit";
				}
				else
				{
					$dupVal = "";
					$this->error = $this->bal->checkCMEPasswordExists($this->CMEProvider->CMEId, $pass, $dupVal);
					if($dupVal != "")
					{
						return "";
					}
					else
					{
						return "User Name and Password do not match";
					}
				}	
			}
		}
	}
	function checkNewPassword($pass)
	{
		if($this->PageAction=="RESET")
		{
			if($pass == "")
				return "New Password cannot be blank";
			else
			{
				if(strrpos($pass, "'") >= 1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($pass) > 15)
				{
					return "New Password must contain less than or equal to 15 chars";
				}
				elseif(strlen($pass) < 7)
				{
					return "New Password must not contain less than 7 chars";
				}
				elseif(!preg_match("/[a-z A-Z][0-9]/", $pass))
				{
					return "New Password must contain letters followed by atleast one digit";
				}
				else
				{
					return "";
				}
			}
		}
	}
	function checkConfirmPassword($pass)
	{
		if($this->PageAction=="RESET")
		{
			if($pass == "")
				return "Confirm Password cannot be blank";
			else
			{
				if(strrpos($pass, "'") >=1)
				{
					return "Single quotes not allowed";
				}
				elseif(strlen($pass) > 15)
				{
					return "Confirm password must contain less than or equal to 15 chars";
				}
				elseif(strlen($pass) < 7)
				{
					return "Confirm password must not contain less than 7 chars";
				}
				elseif(!preg_match("/[a-z][0-9]/", $pass))
				{
					return "Confirm password must contain letters followed by atleast one digit";
				}
				else
				{
					return "";
				}
			}
		}
	}
	function checkEqualPasswords($newPass, $confirmPass)
	{
		if($this->PageAction=="RESET")
		{
			if(($newPass != "") && ($confirmPass != ""))
			{
				if(strcmp($newPass, $confirmPass) == 0)
				{
					return  "";
				}
				else
				{
					return "\n\nNew Password and Confirm Password must be same";
				}
			}
		}
	}
	
}
	

$mPage = new Main("Edit CMEProvider's Personal Details", new Page());
$mPage->showPage();
session_write_close();
?>


