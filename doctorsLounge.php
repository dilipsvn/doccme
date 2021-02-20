<?php
/*
 * Created on Jan 17, 2007
 *	author Poornima Kamatgi
 *
 *	this class displays informtion for  doctor
 *	also displays login link for registered Doctor
 *	and 'get Registered' link for new Doctor
 */
session_start();
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.Security.php");
class Page
{
	var $security;
	
	function Page()
	{
		$this->security = new Security();
		
		$role = $this->security->CheckRole();
		if($role = "DOCTOR")
		{
			$isLogin = $this->security->CheckLoginStatus();
			if($isLogin == "LOGGEDIN")
			{
				session_write_close();
				header("location:./doctorOptions.php");
			}
		}
		elseif($role == "CMEProvider")
		{
			session_write_close();
			header("location:./inValidPageAccess.php");
		}
		
	}
	function showContent()
	{
		include("./html/html.DoctorsLounge.php");
	}
}

$mPage = new Main("Doctor's Lounge",new Page());
$mPage->showPage();
session_write_close();
?>
