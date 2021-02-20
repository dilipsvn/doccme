<?php
/*
 * 	Created on Feb 4, 2007
 *	author Poornima Kamatgi
 * 
 *	this class displays about us 
 *	page of DocCME
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
		include("./html/html.aboutus.php");
	}
}

$mPage = new Main("About Us",new Page());
$mPage->showPage();
?>