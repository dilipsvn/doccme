<?php
/*
 * Created on Oct 23, 2006
 *	author Poornima Kamatgi
 *
 *	this is model class of Doctors'
 *	conatct which will be set in this class
 *	when form data is saved  
 */
require_once("Model.Name.php");//including Model.Name.php
require_once("Model.Phone.php");//including Model.Phone.php	
require_once("Model.Login.php");
class ModelReferral
{
	var $referralId;
	var $referredDate;
	var $docUserName;
	var $friendName;
	var $friendEmail;
	var $contactPhone;
	var $status;
	var $remarks;
	
	function ModelReferral()
	{
		$this->referralId = "";
		$this->referredDate = "";
		$this->docUserName = "";
		$this->friendName = "";
		$this->friendEmail = "";
		$this->contactPhone = "";
		$this->status = "";
		$this->remarks = "";
	}
	
	function autoSetfromPost()
	{
		if(isset($_REQUEST["referralId"]))
			$this->referralId = $_REQUEST["referralId"];
		else
			$this->referralId = "";
		
		if(isset($_REQUEST["referredDate"]))
			$this->referredDate = $_REQUEST["referredDate"];
		else
			$this->referredDate = "";
				
		if(isset($_REQUEST["docUserName"]))
			$this->docUserName = $_REQUEST["docUserName"];
		else
			$this->docUserName = "";
		
		if(isset($_REQUEST["friendName"]))
			$this->friendName = $_REQUEST["friendName"];
		else
			$this->friendName = "";
			
		if(isset($_REQUEST["friendEmail"]))
			$this->friendEmail = $_REQUEST["friendEmail"];
		else
			$this->friendEmail = "";
		
		if(isset($_REQUEST["contactPhone"]))
			$this->contactPhone = $_REQUEST["contactPhone"];
		else
			$this->contactPhone = "";					
		
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


