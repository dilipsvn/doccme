<?php
/*
 *	Created on Nov 18, 2007
 *	author Poornima Kamatgi
 *
 *	this is model class of name
 *	it defines firstname, middlename, lastname
 *	variables, which will be set in this class
 *	when form data is saved  
 */
class ModelName
{
	var $firstName;
	var $middleName;
	var $lastName;
	
	function ModelName()
	{
		$this->firstName = "";
		$this->middleName = "";
		$this->lastName = "";
	}
	
	function autoSetfromPost()
	{
		if(isset($_REQUEST["firstName"]))
		{
			$this->firstName = $_REQUEST["firstName"];
		}
		else
		{
			$this->firstName = "";
		}
		
		if(isset($_REQUEST["middleName"]))
		{
			$this->middleName = $_REQUEST["middleName"];
		}
		else
		{
			$this->middleName = "";
		}
		
		if(isset($_REQUEST["lastName"]))
		{
			$this->lastName = $_REQUEST["lastName"];
		}
		else
		{
			$this->lastName = "";
		}
	}
	
}
?>
