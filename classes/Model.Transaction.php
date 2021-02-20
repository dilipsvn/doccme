<?php
/*
 * Created on Jan 3, 2008
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class ModelTransaction
{
	var $transactionId;
    var $bookingId;
	var $doctorId;
	var $courseId;
	var $transactionDate;
	var $paymentMode;
	var $amount;
	var $status;
		
	function ModelTransaction()
	{
		$this->transactionId = "";
		$this->doctorId = "";
                $this->bookingId = "";
		$this->courseId = "";
		$this->transactionDate = "";
		$this->paymentMode = "";
		$this->amount = "";
		$this->status = "";
	}
	
	function autoSetfromPost()
	{
		if(isset($_REQUEST["transactionId"]))
			$this->transactionId = $_REQUEST["transactionId"];
		else
			$this->transactionId = "";
		
		if(isset($_REQUEST["doctorId"]))
			$this->doctorId = $_REQUEST["doctorId"];
		else
			$this->doctorId = "";

                if(isset($_REQUEST["bookingId"]))
			$this->bookingId = $_REQUEST["bookingId"];
		else
			$this->bookingId = "";
			
		if(isset($_REQUEST["courseId"]))
			$this->courseId = $_REQUEST["courseId"];
		else
			$this->courseId = "";
			
		if(isset($_REQUEST["transactionDate"]))
			$this->transactionDate = $_REQUEST["transactionDate"];
		else
			$this->transactionDate = "";	
		
		if(isset($_REQUEST["paymentMode"]))
 		{
 			$this->paymentMode = $_REQUEST["paymentMode"];
 		}
 		else
 		{
 			$this->paymentMode = "";
 		}
 		if(isset($_REQUEST["amount"]))
			$this->amount = $_REQUEST["amount"];	
		else
			$this->amount = "";	
		
		if(isset($_REQUEST["status"]))
			$this->status = $_REQUEST["status"];	
		else
			$this->status = "";	
		
		
	}
	
}

?>

