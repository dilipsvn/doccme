<?php
/*
 *  Created on Feb 4, 2007
 *	author Poornima Kamatgi
 * 
 *	this class displays contact us 
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
		include("./html/html.contactus.php");
	}
}

$mPage = new Main("Contact Us",new Page());
$mPage->showPage();
?>
