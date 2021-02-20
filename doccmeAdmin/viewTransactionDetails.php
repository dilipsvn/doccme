<?php
/*
 * Created on Dec 4, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.AdminAgentSecurity.php");
require_once("./classes/class.Error.php");
require_once("./classes/class.BAL.php");
require_once("./classes/Model.Transaction.php");

class Page
{
	
	var $transactionId;
        var $bookingId;
	var $doctorId;
	var $courseId;
	var $paymentMode;
	var $amount;
	var $status;
	var $transaction;
	var $security;
	var $role;
	var $error;
	var $bal;
	
		
	function Page()
	{
		$this->security = new AdminAgentSecurity();
		$this->bal = new BAL();
		$this->error = new Error();
		$this->transaction = new ModelTransaction();
		$this->role = $this->security->CheckRole();
		if($this->role == "" || $this->role == "DOCTOR" || $this->role == "CMEProvider")
		{
			session_write_close();
			header("location:./index.php");
		}
		$this->id = $_GET["id"];
		$result = "";
		$this->transaction->autoSetfromPost();
		$this->error = $this->bal->getTransactionDetails($this->id, $result);
		if($result != null)
		{
			while($transaction = mysql_fetch_assoc($result))
			{
				$this->transactionId = new TextBox("Transaction ID", "transactionId", $transaction["TransactionId"], "50", "25", "true");
				//$this->transaction->transactionId = $this->transactionId->data;
				$this->bookingId = new TextBox("Booking Id","bookingId",$transaction["BookingId"],"50","25", "true");
				//$this->transaction->bookingId = $this->booking->data;
				$this->doctorId = new TextBox("Doctor Id","doctorId",$transaction["DoctorId"],"50","25");
				//$this->transaction->doctorId = $this->doctor->data;
				$this->courseId = new TextBox("Course Id","courseId",$transaction["CourseId"],"50","25");
				//$this->transaction->name->lastName = $this->lastName->data;
				$this->paymentMode = new SelectList("PaymentMode","paymentMode",$transaction["PaymentMode"],"50","25");
				//$this->transaction->sex = $this->sex->data;
				$this->amount = new TextBox("Amount ","amount",$transaction["Amount"],"50","35");
				//$this->transaction->address->address1  = $this->address1->data;
				$this->status = new TextBox("Status", "status", $transaction["TransactionStatus"],"50","20");
				//$this->transaction->status = $this->status->data;
				
			}
		}
		
		
	}
	
	function showContent()
	{
		include("./html/html.viewTransactionDetails.php");
	}
}
$myPage = new Page();
$mPage = new Main(" View Transaction Details", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>

