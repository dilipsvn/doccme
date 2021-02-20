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
require_once("./classes/Model.AppliedCourse.php");
require_once("./classes/class.AdminAgentSecurity.php");
require_once("./classes/Model.Transaction.php");
class Page
{
	var $bal;
	var $security;
	var $error;
	
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
		$bid = $_SESSION["bid"];
		$resultDoc="";
		$this->error = $this->bal->getDocEmailId($_SESSION["did"], $resultDoc);
		$row = mysql_fetch_array($resultDoc);
		$emailId = $row["EmailId"];
		$resultId = "";
		$this->error = $this->bal->getBookedCourseId($bid, $resultId);
		$row = mysql_fetch_array($resultId);
		$courseId = $row["CourseId"];
		$this->error = $this->bal->deleteBookingDetails($bid);
		if(!$this->error->isError())
		{
			$resultCourse = "";
			$this->error = $this->bal->getCMECourseDetails($courseId, $resultCourse);
			if(mysql_num_rows($resultCourse) != 0)
			{
				while($course = mysql_fetch_assoc($resultCourse))
				{	
					//send email to registered doctor
					$mailto = $emailId;
					$HTMLMail = "<HTML>";
					$HTMLMail .= "<HEAD> <TITLE>Course Booking Incomplete</TITLE> </HEAD>";
					$HTMLMail .= "<BODY>";
					$HTMLMail .= "<p>Dear Doctor,</p>";
					$HTMLMail .= "<p>We regret to inform you the failure of transaction regarding booking course.</p>";
					$HTMLMail .= "<p>Thank you for taking time to visit DocCME and book a course for your training needs. We appreciate the trust and support. Following are the details of the failed transaction.</p>";
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
					$subject = "Course Booking Incomplete";
					$headers  = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type: text/html; charset=iso-8859-1" ."\r\n";
					$headers .= "From: <info@doccme.com >" ."\r\n";
	
					if(!mail($mailto, $subject , $HTMLMail, $headers))
					{
						echo "Error in sending email to doctor : " . $this->firstName->data;
					}
					//send mail to admin
					$mailtoAdmin = $this->emailList->getEmailId("admin");
					$HTMLMail = "<HTML>";
					$HTMLMail .= "<HEAD> <TITLE>Course Booking Incomplete</TITLE> </HEAD>";
					$HTMLMail .= "<BODY>";
					$HTMLMail .= "<p>Dear Adimin,</p>";
					$HTMLMail .= "<p> Following are the details of the failed transaction.</p>";
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
					$subject = "Course Booking Incomplete";
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
		
		include("./html/html.coursePaymentFailure.php");
	}
}
$myPage = new Page();
$mPage = new Main("Course Payment Failure", $myPage, $myPage->role);
$mPage->showPage();
session_write_close();
?>
