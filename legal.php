<?php
/*
 * Created on 7 Feb, 2008
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
require_once("./classes/class.Main.php");
require_once("./classes/class.Control.php");
class Page
{
	function Page()
	{
	}
	function showContent()
	{
		include("./html/html.legal.php");
	}
}

$mPage = new Main("DocCME - Privacy Policy",new Page());
$mPage->showPage();
?>
