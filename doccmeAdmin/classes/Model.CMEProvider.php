<?php
/*
 * Created on Mar 15, 2007
 *	author Poornima Kamatgi
 *
 *	this is model class of CMEProvider
 *	it defines variables of CMEProvider
 *	which will be set in this class
 *	when form data is saved  
 */
require_once("Model.Name.php");//including Model.Name.php
require_once("Model.Address.php");//including Model.Address.php	
require_once("Model.Phone.php");//including Model.Phone.php	
require_once("Model.Login.php");//including Model.Login.php

class ModelCMEProvider
{
	var $CMEId;
	var $regDate;
	var $instituteName;
	var $name;
	var $address;
	var $email;
	var $websiteurl;
	var $login;
	var $phone;
	var $status;
	var $remarks;
	
	function ModelCMEProvider()
	{
		$this->CMEId = "";
		$this->regDate = "";
		$this->instituteName = "";
		$this->name = new ModelName();
		$this->address = new ModelAddress();
		$this->contactPhone = "";
		$this->email = "";
		$this->websiteUrl = "";
		$this->login = new ModelLogin();
		$this->phone = new ModelPhone();
		$this->status = "";
		$this->remarks = "";
	}
	
	function autoSetfromPost()
	{
		if(isset($_REQUEST["CMEId"]))
			$this->CMEId = $_REQUEST["CMEId"];
		else
			$this->CMEId = "";
		if(isset($_REQUEST["regDate"]))
			$this->regDate = $_REQUEST["regDate"];
		else
			$this->regDate = "";
		if(isset($_REQUEST["instituteName"]))
			$this->instituteName = $_REQUEST["instituteName"];
		else
			$this->instituteName = "";
			
		$this->name->autoSetfromPost();
					
		$this->address->autoSetfromPost();
			
		if(isset($_REQUEST["email"]))
			$this->email = $_REQUEST["email"];
		else
			$this->email = "";
			
				
		if(isset($_REQUEST["websiteUrl"]))
			$this->websiteUrl = $_REQUEST["websiteUrl"];	
		else
			$this->websiteUrl = "";
			
		
		$this->login->autoSetfromPost();
		$this->phone->autoSetfromPost();
		
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