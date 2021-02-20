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
class Page
{
	var $bal;
	var $security;
	var $error;
	
	function Page()
	{
		$this->bal = new BAL();
		$this->security = new Security();
		$this->error = new Error();
		$this->emailList = new EmailList();
		$role = $this->security->CheckRole();
		
		if($role == "DOCTOR")
		{
			$loginStatus = $this->security->CheckLoginStatus();
			
			if($loginStatus == "NOTLOGGEDIN")
			{
				$this->security->setLandingPage("thankyou.php");
				session_write_close();
				header("Location:./login.php?p=DOCTOR");
			}
			else
			{
				if(!isset($_SESSION["tid"]))
 				{
		 			//session_register("tid");
		 			$this->tid = $_POST["x_trans_id"];
		 			$_SESSION["tid"] = $this->tid;
 				}
		 		else
		 		{
		 			$this->tid = $_SESSION["tid"];
		 		}
				$txt = trim($_POST["x_response_reason_text"]);
				if($txt =="This transaction has been approved" || $txt == "(TESTMODE) This transaction has been approved.")
				{
					session_write_close();
					header("location:./coursePaymentSuccessful.php");
				}	
				else
				{
					session_write_close();
					header("location:./coursePaymentFailure.php");
				}
				//exit();
			}
		}
		elseif($role == "CMEProvider")
		{
			session_write_close();
			header("location:./inValidPageAccess.php");
		}
		elseif($role == "ADMIN" || $role == "AGENT")
		{
			if(!isset($_SESSION["tid"]))
 			{
		 		//session_register("tid");
		 		$this->tid = $_POST["x_trans_id"];
		 		$_SESSION["tid"] = $this->tid;
 			}
			else
			{
		 		$this->tid = $_SESSION["tid"];
			}
			$txt = $_POST["x_response_reason_text"];
			if(preg_match("/This transaction has been approved/", $txt))
			{
				if(!isset($_SESSION["restxt"]))
 				{
		 			//session_register("restxt");
		 			$this->restxt = "SUCCESS";
		 			$_SESSION["restxt"] = $this->restxt;
 				}
				else
				{
		 			$this->restxt = $_SESSION["restxt"];
				}
			}
			else
			{
				if(!session_is_registered("restxt"))
 				{
		 			session_register("restxt");
		 			$this->restxt = "FAILURE";
		 			$_SESSION["restxt"] = $this->restxt;
 				}
				else
				{
		 			$this->restxt = $_SESSION["restxt"];
				}
			}
			
			session_write_close();
			header("location:./doccmeAdmin/thankyou.php");
		}
		elseif($role == "")
		{
			session_write_close();
			header("location:./login.php?p=DOCTOR");
		}
		
		
		$userAgent = $this->security->CheckUserAgent();
		//echo "user agent : " . $userAgent;
		if($userAgent != $_SERVER["HTTP_USER_AGENT"])
		{
			$this->security->setLandingPage("thankyou.php");
			session_write_close();
			header("Location:./login.php?p=DOCTOR");
		}
		
	}
	function showContent()
	{
		
		include("./html/html.thankyou.php");
	}
}

$mPage = new Main("thank you",new Page());
$mPage->showPage();
session_write_close();
?>
