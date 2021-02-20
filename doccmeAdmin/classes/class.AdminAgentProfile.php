<?php
/*
 * Created on Mar 29, 2007
 *
 *	author Poornima Kamatgi
 *	
 *	this is Profile class defines
 *	user profiles and registers
 *	SESSION variables(userid, username, role)
 *	it also defines methods that set or unset the
 *	SESSION variables
 *
 */
  class AdminAgentProfile
 {
 	var $userId;
 	var $userName;
 	var $role;
 	 	
 	function AdminAgentProfile()
 	{
 		if(!isset($_SESSION["UserId"]))
 		{
 			//session_register("UserId");
 			$this->userId = "";
 			$_SESSION["UserId"]=$this->userId;
 		}
 		else
 		{
 			$this->userId = $_SESSION["UserId"];
 		}
 		
 		if(!isset($_SESSION["UserName"]))
 		{
 			//session_register("UserName");
 			$this->userName = "";
 			$_SESSION["UserName"]=$this->userName;
 		}
 		else
 		{
 			$this->userName = $_SESSION["UserName"];
 		}
 		
 		if(!isset($_SESSION["Role"]))
 		{
 			//session_register("Role");
 			$this->role = "";
 			$_SESSION["Role"]=$this->role;
 		}
 		else
 		{
 			$this->role = $_SESSION["Role"];
 		}
 	}
 	
 	function setUserId($userId)
 	{
 		$this->userId = $userId; 
 		$_SESSION["UserId"] = $this->userId;
 	}
 	function setUserName($userName)
 	{
 		$this->userName = $userName; 
 		$_SESSION["UserName"] = $this->userName;
 	}
 	function setRole($role)
 	{
 		$this->role = $role; 
 		$_SESSION["Role"] = $this->role;
 	}
 	function setProfile($userId, $userName, $role)
 	{
 		$this->setUserId($userId);
 		$this->setUserName($userName);
 		$this->setRole($role);
 	}
 	
 	function unsetProfile()
 	{
 		$_SESSION["UserId"]= "";
 		$_SESSION["UserName"] = "";
 		$_SESSION["Role"] = "";
 	}
 	
 	function getUsername()
 	{
 		return $_SESSION["UserName"];
 	}
 	
 	function getUserId()
 	{
 		return $_SESSION["UserId"];
 	}
 }
?>
