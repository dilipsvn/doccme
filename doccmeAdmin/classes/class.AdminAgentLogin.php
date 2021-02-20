<?php
/*
 * Created on Mar 29, 2007
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
 */
  require_once("class.BAL.php");
  require_once("class.AdminAgentProfile.php");
  require_once("Model.Login.php");
  require_once("class.Error.php");
  
 class AdminAgentLogin
 {
	var $adminAgentProfile;
	var $password;
	var $error;
	
	function AdminAgentLogin()
	{
		$this->adminAgentProfile = new AdminAgentProfile();
		$this->password = "";
		$this->error = new Error();
	}
	
	function validateLogin(&$bal, &$loginModel)
	{
		$result = "";
		$error = new Error();
		$error = $bal->checkLoginDetails($result, $loginModel->loginName, $loginModel->password);
		$row = mysql_fetch_assoc($result);
		$id = $row["UserId"];
		if($id != "")
		{
			if($id == "1")
			{
				$role = "ADMIN";
				$this->adminAgentProfile->setProfile($id, $loginModel->loginName, $role);
				return true;
			}
			else
			{
				$role = "AGENT";
				$this->adminAgentProfile->setProfile($id, $loginModel->loginName, $role);
				return true;
			}
		}
		else
		{
			return false;
		}
	
	}
	
	function getLoggedUserId()
	{
		$id = $this->adminAgentProfile->getUserId();
 		return $id;
	}
	function logout()
	{
		$this->password = "";
		$this->adminAgentProfile->unsetProfile();
	}
 }
?>