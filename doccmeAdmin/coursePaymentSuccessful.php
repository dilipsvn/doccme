<?php
/*
 * Created on Oct 3, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.Error.php");
require_once("./classes/class.EmailList.php");
require_once("./classes/class.AdminAgentSecurity.php");
require_once("./classes/class.BAL.php");
require_once("./classes/Model.AppliedCourse.php");
require_once("./classes/Model.Transaction.php");
class Page
{
	var $bal;
	var $security;
	var $error;
	var $transaction;
	
	function Page()
	{
		$this->bal = new BAL();
		$this->transaction = new ModelTransaction();
		$this->security = new AdminAgentSecurity();
		$this->error = new Error();
		$this->appliedCourse = new ModelAppliedCourse();
		$this->emailList = new EmailList();
		$result = "";
		$this->role = $this->security->CheckRole();
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
		//assigning transaction details
		$this->transaction->autoSetfromPost();
		$this->transaction->transactionId = $_SESSION["tid"];
		$this->transaction->bookingId = $_SESSION["bid"];
		$this->transaction->doctorId = $_SESSION["did"];
		$this->transaction->paymentMode = "Credit Card";
		$this->transaction->status = "APPROVED";
		$bid = $_SESSION["bid"];
		
		$status = "BOOKED";
		$resultDoc = "";
		$this->error = $this->bal->getDocEmailId($_SESSION["did"], $resultDoc);
		$row = mysql_fetch_array($resultDoc);
		$this->emailId = $row["EmailId"];
		$this->error = $this->bal->updateBookingDetails($bid, $status);
		if($this->error->isError())
		{
			return $this->error;
		}
		else
		{
					
					$resultId = "";
					$this->error = $this->bal->getBookedCourseId($bid, $resultId);
					$row = mysql_fetch_array($resultId);
					$courseId = $row["CourseId"];
					$this->transaction->courseId = $courseId;
					$resultCourse = "";
					$this->error = $this->bal->getCMECourseDetails($resultCourse, $courseId);
					if(mysql_num_rows($resultCourse) != 0)
					{
						while($course = mysql_fetch_assoc($resultCourse))
						{
									
							//send email to registered doctor
							$mailto = $this->emailId;
							$HTMLMail = "<HTML>";
							$HTMLMail .= "<HEAD> <TITLE>Thank You for Booking with DocCME</TITLE> </HEAD>";
							$HTMLMail .= "<BODY>";
							$HTMLMail .= "<p>Dear Doctor,</p>";
							$HTMLMail .= "<p>Thank you for taking time to visit DocCME and book a course for your training needs. We appreciate the trust and support. Following are the details of the transaction.</p>";
							$HTMLMail .= "<CENTER> <TABLE>";
							$HTMLMail .= "<p><TR><td class = 'tabledata'> Course </TD><td class = 'tabledata'>&nbsp;</TD><td class = 'tabledata'> ".  $course["CourseTitle"]. " </TD></TR></p>";
							$HTMLMail .= "<p><TR><td class = 'tabledata'> Location </TD><td class = 'tabledata'>&nbsp;</TD><td class = 'tabledata'> ".  $course["Venue_Address1"]. " </TD></TR></p>";
							$HTMLMail .= "<p><TR><td class = 'tabledata'> Start Date </TD><td class = 'tabledata'>&nbsp;</TD><td class = 'tabledata'>".  $course["CourseStartDate"]. "</TD></TR></p>";
							$HTMLMail .= "<p><TR><td class = 'tabledata'> End Date </TD><td class = 'tabledata'>&nbsp;</TD><td class = 'tabledata'>".  $course["CourseEndDate"]."</TD></TR></p>";
							$HTMLMail .= "<p><TR><td class = 'tabledata'> Fees </TD><td class = 'tabledata'>&nbsp;</TD><td class = 'tabledata'>".  $course["CourseFee"]."</TD></TR></p>";
							$HTMLMail .= "</TABLE></CENTER>";
							$HTMLMail .= "<P>Please feel free to call us on 866-465-6181 for any additional support.</P>";
							$HTMLMail .= "<p>Best Regards <br/>Doccme Team<br/></p>";
							$HTMLMail .= "</BODY>";
							$HTMLMail .= "</HTML>";
							$subject = "Thank You for Booking with DocCME";
							$headers  = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type: text/html; charset=iso-8859-1" ."\r\n";
							$headers .= "From: <info@doccme.com >" ."\r\n";
			
							if(!mail($mailto, $subject , $HTMLMail, $headers))
							{
								echo "Error in sending email to doctor : " . $this->firstName->data;
							}
							$this->transaction->amount = $course["CourseFee"];
							$this->error = $this->bal->addTransaction($this->transaction);
							if($this->error->isError())
							{
								echo $this->error->getUserMessage();
								//return $this->error;
							}
							//send mail to admin
							$mailtoAdmin = $this->emailList->getEmailId("admin");
							$HTMLMail = "<HTML>";
							$HTMLMail .= "<HEAD> <TITLE>Doctor has booked a course</TITLE> </HEAD>";
							$HTMLMail .= "<BODY>";
							$HTMLMail .= "<p>Dear Admin,</p>";
							$HTMLMail .= "<p>A doctor has booked course.</p>";
							$HTMLMail .= "<p>Following are the details of the transaction.</p>";
							$HTMLMail .= "<CENTER> <TABLE>";
							$HTMLMail .= "<p><TR><td class = 'tabledata'> Course </TD><td class = 'tabledata'>&nbsp;</TD><td class = 'tabledata'> ".  $course["CourseTitle"]. " </TD></TR></p>";
							$HTMLMail .= "<p><TR><td class = 'tabledata'> Location </TD><td class = 'tabledata'>&nbsp;</TD><td class = 'tabledata'> ".  $course["Venue_Address1"]. " </TD></TR></p>";
							$HTMLMail .= "<p><TR><td class = 'tabledata'> Start Date </TD><td class = 'tabledata'>&nbsp;</TD><td class = 'tabledata'>".  $course["CourseStartDate"]. "</TD></TR></p>";
							$HTMLMail .= "<p><TR><td class = 'tabledata'> End Date </TD><td class = 'tabledata'>&nbsp;</TD><td class = 'tabledata'>".  $course["CourseEndDate"]."</TD></TR></p>";
							$HTMLMail .= "<p><TR><td class = 'tabledata'> Fees </TD><td class = 'tabledata'>&nbsp;</TD><td class = 'tabledata'>".  $course["CourseFee"]."</TD></TR></p>";
							$HTMLMail .= "</TABLE></CENTER>";
							$HTMLMail .= "<p>Best Regards <br/>Doccme Team<br/></p>";
							$HTMLMail .= "</BODY>";
							$HTMLMail .= "</HTML>";
							$subject = "Doctor has booked a course";
							$headers  = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type: text/html; charset=iso-8859-1" ."\r\n";
							$headers .= "From: <info@doccme.com >" ."\r\n";
							if(!mail($mailtoAdmin, $subject , $HTMLMail, $headers))
							{
								echo "Error in sending email to admin";
							}
						}
					}
					
				}
				unset($_SESSION["bid"]);
				unset($_SESSION["tid"]);
	}
	function showContent()
	{
		include("./html/html.coursePaymentSuccessful.php");
	}
}
$myPage = new Page();
$mPage = new Main("Course Payment Successful", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>
