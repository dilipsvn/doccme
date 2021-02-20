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
require_once("./classes/class.Security.php");
require_once("./classes/class.BAL.php");
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
		$this->security = new Security();
		$this->error = new Error();
		$this->emailList = new EmailList();
		$role = $this->security->CheckRole();
		if($role == "DOCTOR")
		{
			$loginStatus = $this->security->CheckLoginStatus();
			
			if($loginStatus == "NOTLOGGEDIN")
			{
				$this->security->setLandingPage("coursePaymentSuccessful.php");
				session_write_close();
				header("Location:./login.php?p=DOCTOR");
			}
		}
		elseif($role == "CMEProvider")
		{
			session_write_close();
			header("location:./inValidPageAccess.php");
		}
		elseif($role == "")
		{
			$this->security->setLandingPage("coursePaymentSuccessful.php");
			session_write_close();
			header("location:./login.php?p=DOCTOR");
		}
		$userAgent = $this->security->CheckUserAgent();
		//echo "user agent : " . $userAgent;
		if($userAgent != $_SERVER["HTTP_USER_AGENT"])
		{
			$this->security->setLandingPage("coursePaymentSuccessful.php");
			session_write_close();
			header("location:./login.php?p=DOCTOR");
		}
		//assigning transaction details
		$this->transaction->autoSetfromPost();
		$this->transaction->transactionId = $_SESSION["tid"];
		$this->transaction->bookingId = $_SESSION["bid"];
		$this->transaction->doctorId = $_SESSION["UserId"];
		$this->transaction->paymentMode = "Credit Card";
		$this->transaction->status = "APPROVED";
		$bid = $_SESSION["bid"];
		$status = "BOOKED";
		$resultDoc = "";
		$this->error = $this->bal->getDocEmailId($_SESSION["UserId"], $resultDoc);
		$row = mysql_fetch_array($resultDoc);
		$emailId = $row["EmailId"];
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
					$this->error = $this->bal->getCourseDetails($courseId, $resultCourse);
					if(mysql_num_rows($resultCourse) != 0)
					{
						while($course = mysql_fetch_assoc($resultCourse))
						{
									
							//send email to registered doctor
							$mailto = $emailId;
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
							$HTMLMail .= "<P>Please feel free to call us on 1-866-465-6181 for any additional support.</P>";
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

$mPage = new Main("Course Payment Successful",new Page());
$mPage->showPage();
session_write_close();
?>
