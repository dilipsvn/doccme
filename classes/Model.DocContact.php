<?php
/*
 * Created on Nov 25, 2006
 *	author Poornima Kamatgi
 *
 *	this is model class of Doctors'
 *	conatct which will be set in this class
 *	when form data is saved  
 */
require_once("Model.Name.php");//including Model.Name.php
require_once("Model.Phone.php");//including Model.Phone.php	

class ModelDocContact
{
	var $contactId;
	var $contactedDate;
	var $name;
	var $contactPhone;
	var $email;
	var $contactTime;
	var $status;
	var $remarks;
	
	function ModelDocContact()
	{
		$this->contactId = "";
		$this->contactedDate = "";
		$this->name = new ModelName();
		$this->contactPhone = "";
		$this->email = "";
		$this->contactTime = "";
		$this->status = "";
		$this->remarks = "";
	}
	
	function autoSetfromPost()
	{
		if(isset($_REQUEST["contactId"]))
			$this->contactId = $_REQUEST["contactId"];
		else
			$this->contactId = "";
		
		if(isset($_REQUEST["contactedDate"]))
			$this->contactedDate = $_REQUEST["contactedDate"];
		else
			$this->contactedDate = "";	
		
		$this->name->autoSetfromPost();
		
		if(isset($_REQUEST["contactPhone"]))
			$this->contactPhone = $_REQUEST["contactPhone"];
		else
			$this->contactPhone = "";	
		
	
		if(isset($_REQUEST["email"]))
			$this->email = $_REQUEST["email"];
		else
			$this->email = "";
						
		if(isset($_REQUEST["contactTime"]))
			$this->contactTime = $_REQUEST["contactTime"];	
		else
			$this->contactTime = "";
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

