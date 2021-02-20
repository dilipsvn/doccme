<?php
/*
 * Created on 1 Feb, 2008
 *	author Poornima Kamatgi
 * 
 *	this class displays the
 *	directions to use speciality field
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
		include("./html/html.help.php");
	}
}

$mPage = new Main("",new Page());
$mPage->showPage();
?>