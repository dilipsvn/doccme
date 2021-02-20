<?php
/*
 * Created on Oct 31, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
session_start();
class Page
{
	var $role;
	function Page()
	{
		
		
	}
	function showContent()
	{
		include("./html/html.emailSent.php");	}
}
$myPage = new Page();
$mPage = new Main("Email Sent",new Page());
$mPage->showPage();
session_write_close();
?>
