<?php
/*
 * Created on 29 Jan, 2008
 *
 *	author Poornima Kamatgi
 *
 *	this class displays 
 *  course details(non-editable)
 *	and make payment button
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.Error.php");
require_once("./classes/class.AdminAgentSecurity.php");
require_once("./classes/Model.AppliedCourse.php");
require_once("./classes/Model.Course.php");
require_once("./classes/Model.Doctor.php");
require_once("./classes/class.phpDate.php");
require_once("./classes/class.creditCardInfo.php");  
//include ("simlib.php");
class Page
{
	var $bal;
	var $security;
	var $error;

	var $course;
	var $courseId;
	var $courseTitle;
	var $courseDesc;
	var $courseFee;
	var $bookingId;
	var $doctorId;
	var $StateList;

	var $coursename;
	var $location;
	var $stdt;
	var $enddt;
	var $fees;
	var $expdt;
	var $cardno;
	var $creditCardInfo;
	var $apiLoginId;
	var $transactionKey;
	function Page()
	{
		$this->security = new AdminAgentSecurity();
		$this->role = $this->security->CheckRole();
		$this->bal = new BAL();
		$this->error = new Error();
		$this->creditCardInfo = new creditCardInfo();

		$this->course = new ModelCourse();
		$this->course->autoSetfromPost();
		
		$this->appliedCourse = new ModelAppliedCourse();
		$this->appliedCourse->autoSetFromPost();
		
		$this->doctor = new ModelDoctor();
		$this->doctor->autoSetFromPost();
		
		$result = "";
		if($this->role == "AGENT")
		{
			$this->error = $this->bal->checkAccessOfAgent("8", $result);
			$row = mysql_fetch_assoc($result);
			$this->access = $row["AccessType"];
			if($this->access == "DENIED")
			{
				session_write_close();
				header("location:./inValidPageAccess.php");
			}
		}
		elseif($this->role == "" || $this->role == "DOCTOR" || $this->role == "CMEProvider")
		{
			session_write_close();
			header("location:./index.php");
		}
		
		$this->apiLoginId = $this->creditCardInfo->getAPILoginId();
		$this->transactionKey = $this->creditCardInfo->getTransactionKey();

		$result1 = "";
		$this->bookingId = new TextBox("Booking Id","bookingId","","50","25");
		$this->doctorId = new TextBox("DoctorId","doctorId","","50","25");
		$this->agentId = new TextBox("AgentId","agentId","","50","25");
		$this->courseId = new TextBox("Course Id","courseId","","50","25");
		$this->doctorName = new TextBox("Doctor's Name","doctorName", "", "50","25");
		$this->courseTitle = new TextBox("Course Title","courseTitle","","50","25");
		$this->courseDesc = new TextBox("Course Description","courseDesc","","50","20");
		$this->address1 = new TextBox("Venue Address","address1","","50","20");
		$this->state = new TextBox("Venue State","state","","50","20");
		$this->country = new TextBox("Country","country","","50","20");
		$this->courseStartDate = new TextBox("Course Start Date","courseStartDate","","50","20");
		$this->courseEndDate = new TextBox("Course End Date","courseEndDate","","50","20");
		$this->lastDateForApp = new TextBox("Last Date For Application","lastDateForApp","","50","20");
		$this->courseFee= new TextBox("CourseFee","courseFee","","50","20");
		if (!isset($_REQUEST["PageAction"]))
			$this->PageAction = "NEW";
		else
			$this->PageAction = $_REQUEST["PageAction"];
		$this->stateForBilling = new SelectList("State","stateForBilling","");
		$this->bal->getComboStateList($this->StateList);
	
		
		if(!session_is_registered("bid"))
 		{
 			session_register("bid");
 			$this->bid = $_REQUEST["bid"];
 			$_SESSION["bid"] = $this->bid;
 		}
 		else
 		{
 			$this->bid = $_REQUEST["bid"];
 			$_SESSION["bid"] = $this->bid;
 		}
 		if(!session_is_registered("did"))
 		{
 			session_register("did");
 			$this->did = $_REQUEST["did"];
 			$_SESSION["did"] = $this->did;
 		}
 		else
 		{
 			$this->did = $_SESSION["did"];
 		}
 		
		$result1 = "";
		$this->error = $this->bal->getDocName($_REQUEST["did"], $result1);
		$row = mysql_fetch_array($result1);
		$this->docName = $row["FirstName"] ." " . $row["LastName"];
	}
	
	function showContent()
	{
		include("./html/html.makePaymentForCourse.php");
	}
}
$myPage = new Page();
$mPage = new Main("Make Payment of Course For Doctor", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>
