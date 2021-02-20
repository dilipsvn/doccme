<?php
/*
 *	Created on Nov 25, 2006
 *	author Poornima Kamatgi
 * 
 * 	this is login class, it defines
 * 	method that validates the login
 * 	of user of DocCME and returns true or false
 * 	to security class
 * 	if login name and password are correct
 * 	it calls Profiles class's method that sets
 * 	the SESSION variables(user id, user name and role)
 * 
 * 	it also defines method for logout,
 * 	clears the SESSION variables in this method
 * 
 * 	revised on Mar 9, 2007
 * 
 */
  require_once("class.BAL.php");
  require_once("class.Profile.php");
  require_once("Model.Login.php");
  require_once("class.Error.php");
 class Login
 {
	var $profile;
	var $password;
	var $error;
	
	function Login()
	{
		$this->profile = new Profile();
		$this->password = "";
		$this->error = new Error();
	}
	
	function validateLogin(&$bal, &$loginModel, &$role)
	{
		$result = "";
		if($role == "DOCTOR")
		{
			$this->error = $bal->loginCheckDoctor($result, $loginModel->loginName, $loginModel->password);
			$row = mysql_fetch_array($result);
			$id = $row["DoctorId"];
			if($id != "")
			{
				$this->profile->setProfile($id, $loginModel->loginName, $role);
				return true;
			}
			else
			{
				return false;
			}
		}
		elseif($role == "CMEProvider")
		{
			$this->error = $bal->loginCheckCMEProvider($result, $loginModel->loginName, $loginModel->password);
			$row = mysql_fetch_array($result);
			$id = $row["CMEId"];
			if($id != "")
			{
				$this->profile->setProfile($id, $loginModel->loginName, $role);
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	
	function getSessionUsrName()
	{
		return $this->profile->getUsername();
	}
	
	function getSessionUsrId()
	{
		return $this->profile->getUserId();
	}
	
	function logout()
	{
		$this->password = "";
		$this->profile->unsetProfile();
	}
 }
?>
