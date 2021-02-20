<?php
/*
 * Created on Mar 23, 2007
 *	author Poornima Kamatgi
 *
 *	this is model class of Login
 *	it defines variables of Login(login name, passwrd, confirm Password)
 *	which will be set in this class
 *	when form data is saved  
 */
class ModelLogin
{
	var $logiName;
	var $password;
	var $confirmPassword;
	
	function ModelLogin()
	{
		$this->logiName = "";
		$this->password = "";
		$this->confirmPassword = "";
	}
	function autoSetFromPost()
	{
		if(isset($_REQUEST["loginName"]))
		{
			$this->loginName = $_REQUEST["loginName"];
		}
		else
		{
			$this->loginName = "";
		}
		if(isset($_REQUEST["password"]))
		{
			$this->password = $_REQUEST["password"];
		}
		else
		{
			$this->password = "";
		}
		if(isset($_REQUEST["confirmPassword"]))
		{
			$this->confirmPassword = $_REQUEST["confirmPassword"];
		}
		else
		{
			$this->confirmPassword = "";
		}
	}
}
?>
