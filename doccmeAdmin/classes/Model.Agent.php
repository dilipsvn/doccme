<?php
/*
 *	Created on Mar 28, 2007
 *	author Poornima Kamatgi
 *
 *	this is model class of agent
 *	it defines variables of agent
 *	which will be set in this class
 *	when form data is saved 
 */
 require_once("Model.Name.php");//including Model.Name.php
require_once("Model.Login.php");//including Model.Login.php

class ModelAgent
{
	var $userId;
	var $regDate;
	var $name;
	var $contactPhone;
	var $email;
	var $login;
	var $status;
	var $remarks;
	
	function ModelAgent()
	{
		$this->userId = "";
		$this->regDate = "";
		$this->name = new ModelName();
		$this->contactPhone = "";
		$this->email = "";
		$this->login = new ModelLogin();
		$this->status = "";
		$this->remarks = "";
	}
	
	function autoSetfromPost()
	{
		if(isset($_REQUEST["userId"]))
			$this->userId = $_REQUEST["userId"];
		else
			$this->userId = "";
		
		if(isset($_REQUEST["regDate"]))
			$this->regDate = $_REQUEST["regDate"];
		else
			$this->regDate = "";	
		
		$this->name->autoSetfromPost();
		
		if(isset($_REQUEST["contactPhone"]))
			$this->contactPhone = $_REQUEST["contactPhone"];
		else
			$this->contactPhone = "";
					
		if(isset($_REQUEST["email"]))
			$this->email = $_REQUEST["email"];
		else
			$this->email = "";
		
		$this->login->autoSetfromPost();
		if(isset($_REQUEST["status"]))
			$this->status = $_REQUEST["status"];
		else
			$this->status = "";
			
		if(isset($_REQUEST["remarks"]))
			$this->remarks = $_REQUEST["remarks"];
		else
			$this->remarks = "";
	}
}
?>