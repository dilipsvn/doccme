<?php
/*
 * Created on Mar 15, 2007
 *	author Poornima Kamatgi
 *
 *	this is model class of Doctor
 *	it defines variables of Doctor
 *	which will be set in this class
 *	when form data is saved  
 */
require_once("Model.Name.php");//including Model.Name.php
require_once("Model.Address.php");//including Model.Address.php	
require_once("Model.Phone.php");//including Model.Phone.php	
require_once("Model.Login.php");//including Model.Login.php

class ModelDoctor
{
	var $doctorId;
	var $regDate;
	var $name;
	var $sex;
	var $address;
	var $phone;
	var $email;
	var $speciality;
	var $contactTime;
	var $login;
	var $status;
	var $remarks;
	
	function ModelDoctor()
	{
		$this->doctorId = "";
		$this->regDate = "";
		$this->name = new ModelName();
		$this->sex = "";
		$this->address = new ModelAddress();
		$this->phone = new ModelPhone();
		$this->email = "";
		$this->speciality = "";
		$this->contactTime = "";
		$this->login = new ModelLogin();
		$this->status = "";
		$this->remarks = "";
	}
	
	function autoSetfromPost()
	{
		if(isset($_REQUEST["doctorId"]))
			$this->doctorId = $_REQUEST["doctorId"];
		else
			$this->doctorId = "";
		
		if(isset($_REQUEST["regDate"]))
			$this->regDate = $_REQUEST["regDate"];
		else
			$this->regDate = "";	
		
		$this->name->autoSetfromPost();
		
		if(isset($_REQUEST["sex"]))
			$this->sex = $_REQUEST["sex"];
		else
			$this->sex = "";
			
		$this->address->autoSetfromPost();
		
		$this->phone->autoSetfromPost();
	
		if(isset($_REQUEST["email"]))
			$this->email = $_REQUEST["email"];
		else
			$this->email = "";
			
		if(isset($_REQUEST["Speciality"]))
			$this->speciality = $_REQUEST["Speciality"];		
		else
			$this->speciality = "";
		
		if(isset($_REQUEST["contactTime"]))
			$this->contactTime = $_REQUEST["contactTime"];	
		else
			$this->contactTime = "";
		
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
