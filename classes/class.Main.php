<?php
/*
 *	Created on Dec 9, 2006
 *	author Poornima Kamatgi
 *
 *	this is main class which defines 
 *	methods that build a html page
 *	of DocCME
 *	html tags are simulated using php
 *
 */
 ob_start();
class Main
{
	var $title;
	var $content;
	
	function Main($valTitle, $valContent)
	{
		/*For checking https request */
		//if(substr($_SERVER['SCRIPT_URI'],0,5) == "http:")
		//{
		//	$new_url = "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
       	//	header("Location: $new_url");
		//}
		
		/**************************************************/
		
		$this->title = $valTitle;
		$this->content = $valContent;	
	}
	function beginHTML()
	{
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">';
	}
	function closeHTML()
	{
		echo "</html>";
	}
	function doHTMLHeader()
	{
		echo "<head>";
		echo "<title>".$this->title ."</title>";
		echo "<link href='./css/StyleSheet.css' rel='stylesheet' type='text/css' />";
		//include ("./js/html.formValidate.php");
		//echo "<script language='JavaScript' type='text/javascript' src='./js/html.formValidate.php'></script>";
		echo "</head>";
	}
	
	function printPageHeader()
	{
		echo "<div id='Header'></div>";
	}

	function doFooter()
	{
		echo "<div id='Footer'>";
		echo "<div id='FooterBar'></div>";
		echo "</div>";
		echo "<div id = 'footerTextLeft'>";
		echo "&copy; 2006 DocCME (Division of Global Access Med, LLC.)";
		echo "</div>";
		echo "<div id = 'footerTextRight'>";
		echo "<span class = 'highlightFooterText'>Powered by";
		echo "<a id = 'footerTextRightIrmac' href='http://www.irmac.com'> IRMAC </a>";
		echo "</span></div>";
		echo "<div id = 'horizontalMenu'>";
		echo "<ul>";
		echo "<a class='policyList' href='legal.php#copyrights'>All Rights Reserved<span class='bar'>|</span></a>";
		echo "<a class='policyList' href='legal.php#disclaimer'>Legal Disclaimer<span class='bar'>|</span></a>";
		echo "<a class='policyList' href='legal.php#privacy'>Privacy Policy</a>";
		echo "</ul></div>";
		echo "<div class='ClearFloat'></div>";
	}
	function doBody()
	{
		if($this->title == "Welcome to DocCME")
		{
			echo "<body>";
			echo "<div id='Holder'>";
			$this->printPageHeader();
			echo "<div id='ContentSection'>";
			$this->doNavg();
			echo "<div id='ContentMain'>";
			$this->content->showContent();
			echo "</div>";
			echo "<div class='ClearFloat'></div>";
			echo "</div>";
			$this->doFooter();
			echo "</div>";
	
			echo "</body>";
		}
		elseif($this->title == "")
		{
			echo "<body>";
			echo "<div id='Holder'>";
			echo "<div id='ContentSection'>";
			$this->content->showContent();
			echo "</div>";
			echo "</div>";
			echo "</body>";
		}
		else
		{
			echo "<body>";
			echo "<div id='Holder'>";
			$this->printPageHeader();
			echo "<div id='ContentSection'>";
			$this->doNavg();
			echo "<div id='ContentMain'>";
			$this->content->showContent();
			echo "</div>";
			echo "<div class='ClearFloat'></div>";
			echo "</div>";
			$this->doFooter();
			echo "</div>";
	
			echo "</body>";
		}
	}
	function doNavg()
	{
		echo "<div id='Navg'>";
		echo "<div class ='leftMenuLinks'><a href='index.php'>Home</a></div>";
		echo "<div class ='leftMenuLinks'><a href='doctorsLounge.php'>Doctor&acute;s Lounge</a></div>";
		echo "<div class ='leftMenuLinks'><a href='cmesearch.php'>CME Search</a></div>";
		echo "<div class ='leftMenuLinks'><a href='cmeproviderLounge.php'>CME Provider&acute;s Lounge</a></div>";
		echo "<div class ='leftMenuLinks'><a href='aboutus.php'>About Us</a></div>";
		echo "<div class ='leftMenuLinks'><a href='contactus.php'>Contact Us</a></div>";
		//echo "<a id = 'leftMenuLinks' href='#'> Site Map</a><br />";
		//echo "<div id='leftImage1'></div>";
		echo "<div id='leftImage2'></div>";
		echo "<div id='leftImage3'></div>";
		echo "<div id='leftContent'>";
		echo "  ";
		echo "  ";
		echo "</div>";
		echo "</div>";
	}
	
	function showPage()
	{
		$this->beginHTML();
		$this->doHTMLHeader();
		$this->doBody();
		$this->closeHTML();
	}
}
?>
