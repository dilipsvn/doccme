<?php
/*
 * Created on Mar 15, 2007
 *	author Poornima Kamatgi
 *
 *	this is model class of Course
 *	it defines variables of  course
 *	which will be set in this class
 *	when form data is saved  
 */
 require_once("Model.Address.php");
 require_once("Model.Phone.php");
 require_once("Model.Date.php");
 class ModelCourse
 {
 	var $courseId;
 	var $CMEId;
 	var $courseAddDate;
 	var $courseTitle;
 	var $courseDesc;
 	var $specialityField;
 	var $speciality;
 	var $address;
 	var $contactPerson;
 	var $contactPhone;
 	var $phone;
 	var $email;
 	var $courseDate;
 	var $nearestHotel;
 	var $nearestAirport;
 	var $courseFee;
 	var $status;
	var $remarks;
	var $cmeCredits;
 	 	
 	function ModelCourse()
 	{
 		$this->courseId = "";
 		$this->CMEId = "";
 		$this->courseAddDate = "";
 		$this->courseTitle = "";
 		$this->courseDescription = "";
 		$this->specialityField = "";
 		$this->speciality = "";
 		$this->address = new ModelAddress();
 		$this->contactPerson = "";
 		$this->contactPhone = "";
 		$this->phone = new ModelPhone();
 		$this->email = "";
 		$this->courseDate = new ModelDate();
 		$this->nearestHotel = "";
 		$this->nearestAirport = "";
 		$this->courseFee = "";
 		$this->status = "";
		$this->remarks = "";
		$this->cmeCredits = "";
 	}
 	
 	function autoSetFromPost()
 	{
 		if(isset($_REQUEST["courseId"]))
 		{
 			$this->courseId = $_REQUEST["courseId"];
 		}
 		else
 		{
 			$this->courseId = "";
 		}
 		if(isset($_REQUEST["CMEId"]))
 		{
 			$this->CMEId = $_REQUEST["CMEId"];
 		}
 		else
 		{
 			$this->CMEId = "";
 		}
 		if(isset($_REQUEST["courseAddDate"]))
 		{
 			$this->courseAddDate = $_REQUEST["courseAddDate"];
 		}
 		else
 		{
 			$this->courseAddDate = "";
 		}
 		if(isset($_REQUEST["courseTitle"]))
 		{
 			$this->courseTitle = $_REQUEST["courseTitle"];
 		}
 		else
 		{
 			$this->courseTitle = "";
 		}
 		if(isset($_REQUEST["courseDesc"]))
 		{
 			$this->courseDesc = $_REQUEST["courseDesc"];
 		}
 		else
 		{
 			$this->courseDesc = "";
 		}
 		if(isset($_REQUEST["specialityField"]))
 		{
 			$this->specialityField = $_REQUEST["specialityField"];
 		}
 		else
 		{
 			$this->specialityField = "";
 		}
 		if(isset($_REQUEST["Speciality"]))
 		{
 			$this->speciality = $_REQUEST["Speciality"];
 		}
 		else
 		{
 			$this->speciality = "";
 		}
 		$this->address->autoSetFromPost();
 		
 		if(isset($_REQUEST["contactPerson"]))
 		{
 			$this->contactPerson = $_REQUEST["contactPerson"];
 		}
 		else
 		{
 			$this->contactPerson = "";
 		}
 		if(isset($_REQUEST["contactPhone"]))
 		{
 			$this->contactPhone = $_REQUEST["contactPhone"];
 		}
 		else
 		{
 			$this->contactPhone = "";
 		}
 		
 		$this->phone->autoSetFromPost();
 		
 		if(isset($_REQUEST["email"]))
 		{
 			$this->email = $_REQUEST["email"];
 		}
 		else
 		{
 			$this->email = "";
 		}
 		
 		$this->courseDate->autoSetFromPost();
 		
 		if(isset($_REQUEST["nearestHotel"]))
 		{
 			$this->nearestHotel = $_REQUEST["nearestHotel"];
 		}
 		else
 		{
 			$this->nearestHotel = "";
 		}
 		if(isset($_REQUEST["nearestAirport"]))
 		{
 			$this->nearestAirport = $_REQUEST["nearestAirport"];
 		}
 		else
 		{
 			$this->nearestAirport = "";
 		}
 		if(isset($_REQUEST["courseFee"]))
 		{
 			$this->courseFee = $_REQUEST["courseFee"];
 		}
 		else
 		{
 			$this->courseFee = "";
 		}
 		
 		if(isset($_REQUEST["status"]))
			$this->status = $_REQUEST["status"];
		else
			$this->status = "";
			
		if(isset($_REQUEST["remarks"]))
			$this->remarks = $_REQUEST["remarks"];
		else
			$this->remarks = "";
 		if(isset($_REQUEST["cmeCredits"]))
			$this->cmeCredits = $_REQUEST["cmeCredits"];
		else
			$this->cmeCredits = "";
 		
 	}
 	
 }
?>
