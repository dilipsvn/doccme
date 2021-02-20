<?php
/*
 *	Created on Mar 18, 2007
 *	author Poornima Kamatgi
 *
 *	this is model class of applied course
 *	it defines variables of applied course
 *	which will be set in this class
 *	when form data is saved  
 */
 class ModelAppliedCourse
 {
 	var $bookingId;
 	var $doctorId;
 	var $courseId;
 	var $bookingDate;
 	var $paymentMode;
 	var $amount;
 	var $agentId;
 	var $bookStatus;
 		
 	function ModelAppliedCourse()
 	{
 		$this->bookingId = "";
 		$this->doctorId = "";
 		$this->courseId = "";
 		$this->bookingDate = "";
 		$this->paymentMode = "";
 		$this->amount = "";
 		$this->agentId = "";
 		$this->bookStatus = "";
 	}
 	function autoSetFromPost()
 	{
 		if(isset($_REQUEST["bookingId"]))
 		{
 			$this->bookingId = $_REQUEST["bookingId"];
 		}
 		else
 		{
 			$this->bookingId = "";
 		}
 		if(isset($_REQUEST["doctorId"]))
 		{
 			$this->doctorId = $_REQUEST["doctorId"];
 		}
 		else
 		{
 			$this->doctorId = "";
 		}
                if(isset($_REQUEST["courseId"]))
 		{
 			$this->bookingType = $_REQUEST["courseId"];
 		}
 		else
 		{
 			$this->courseId = "";
 		}
 		if(isset($_REQUEST["bookingDate"]))
 		{
 			$this->bookingDate = $_REQUEST["bookingDate"];
 		}
 		else
 		{
 			$this->bookingDate = "";
 		}
 		
 		if(isset($_REQUEST["paymentMode"]))
 		{
 			$this->paymentMode = $_REQUEST["paymentMode"];
 		}
 		else
 		{
 			$this->paymentMode = "";
 		}
 		if(isset($_REQUEST["amount"]))
 		{
 			$this->amount = $_REQUEST["amount"];
 		}
 		else
 		{
 			$this->amount = "";
 		}
 		if(isset($_REQUEST["agentId"]))
 		{
 			$this->agentId = $_REQUEST["agentId"];
 		}
 		else
 		{
 			$this->agentId = "";
 		}
 		if(isset($_REQUEST["bookingStatus"]))
 		{
 			$this->bookingStatus = $_REQUEST["bookingStatus"];
 		}
 		else
 		{
 			$this->bookingStatus = "";
 		}
 	}
 }
?>
