<?php
/*
 * Created on Oct 28, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
require_once("./classes/class.Error.php");

class Page
{
 	var $error;
 	
	function Page()
	{
		$this->error = new Error();
	}
	function showContent()
	{
		include("./html/html.responseOfContact.php");
	}
}
$myPage = new Page();
$mPage = new Main("",$myPage);
$mPage->showPage();
?>
