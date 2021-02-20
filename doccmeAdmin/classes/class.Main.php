<?php
/*
 *	Created on Mar 15, 2007
 *	author Poornima Kamatgi
 *
 *	this is main class which defines 
 *	methods that build a html page
 *	of DocCME
 *	html tags are simulated using php
 *
 */
class Main
{
	var $title;
	var $content;
	var $role;
	var $access;
	
	function Main($valTitle, $valContent, $valRole)
	{
		$this->title = $valTitle;
		$this->content = $valContent;	
		$this->role = $valRole;
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
		echo "<link href='../css/StyleSheet.css' rel='stylesheet' type='text/css' />";
		echo "</head>";
	}
	function printPageHeader()
	{
		echo "<div id='Header'>";
		echo "<div id='headerText'>";
		if($this->role == "ADMIN")
		{
			echo "Admin Page";
		}
		elseif($this->role == "AGENT")
		{
			echo "Agent Page";
		}
		
		echo "</div>";
		echo "</div>";
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
		if($this->title == "" && ($this->role == ""))
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
		if($this->role == "ADMIN")
		{
			$this->doNavgForAdmin();
		}
		elseif($this->role == "AGENT")
		{
			$this->doNavgForAgent();
		}
		if($this->role == "")
		{
			echo "<div id='adminContentMain'>";
			$this->content->showContent();
			echo "</div>";
			echo "<div class='ClearFloat'></div>";
			echo "</div>";
			//$this->doFooter();
			echo "</div>";
			echo "</body>";
		}
		else
		{
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
	}
	function doNavgForAdmin()
	{
		echo "<div id='Navg'>";
		echo "<div class ='leftMenuLinks'><a href='home.php'>Home</a></div>";
		echo "<div class ='leftMenuLinks'><a href='myProfile.php'>My Profile</a></div>";
		echo "<div class ='leftMenuLinks'><a href='cmeCourses.php'>CME Courses</a></div>";
		echo "<div class ='leftMenuLinks'><a href='cmeproviders.php'>CME Providers</a></div>";
		echo "<div class ='leftMenuLinks'><a href='doctors.php'>Doctors</a></div>";
		echo "<div class ='leftMenuLinks'><a href='agents.php'>Agents</a></div>";
		echo "<div class ='leftMenuLinks'><a href='approveCMECourse.php'>Approve CME Course</a></div>";
		echo "<div class ='leftMenuLinks'><a href='searchCMECourse.php'>Search CME Course</a></div>";
		echo "<div class ='leftMenuLinks'><a href='bookCMECourse.php'>Book CME Course</a></div>";
		echo "<div class ='leftMenuLinks'><a href='viewBookedCourses.php'>View Booked Courses</a></div>";
		echo "<div class ='leftMenuLinks'><a href='viewTransactions.php'>View Transactions</a></div>";
		echo "<div class ='leftMenuLinks'><a href='grantORRevokeAccess.php'>Grant/Revoke Access to Agents</a></div>";
		echo "<div class ='leftMenuLinks'><a href='contactList.php'>Contacts</a></div>";
		echo "<div class ='leftMenuLinks'><a href='referralList.php'>Referrals</a></div>";
		echo "<div id='leftImage1'></div>";
		echo "<div id='leftImage2'></div>";
		echo "<div id='leftImage3'></div>";
		echo "<div id='leftContent'>";
		echo "</div>";
		echo "</div>";
	}
	
	function doNavgForAgent()
	{
		echo "<div id='Navg'>";
		echo "<div class ='leftMenuLinks'><a href='home.php'>Home</a></div>";
		echo "<div class ='leftMenuLinks'><a href='myProfile.php'>My Profile</a></div>";
		echo "<div class ='leftMenuLinks'><a href='cmeCourses.php'>CME Courses</a></div>";
		echo "<div class ='leftMenuLinks'><a href='cmeproviders.php'>CME Providers</a></div>";
		echo "<div class ='leftMenuLinks'><a href='doctors.php'>Doctors</a></div>";
		echo "<div class ='leftMenuLinks'><a href='searchCMECourse.php'>Search CME Course</a></div>";
		echo "<div class ='leftMenuLinks'><a href='bookCMECourse.php'>Book CME Course</a></div>";
		echo "<div class ='leftMenuLinks'><a href='approveCMECourse.php'>Approve CME Course</a></div>";
		echo "<div class ='leftMenuLinks'><a href='viewBookedCourses.php'>View Booked Courses</a></div>";
		echo "<div id='leftImage1'></div>";
		echo "<div id='leftImage2'></div>";
		echo "<div id='leftImage3'></div>";
		echo "<div id='leftContent'>";
		echo "<b>Doctor's Blog</b>";
		echo "<p> Coming Soon....</p>";
		echo "<p>Latest Trends in Doctors Educations. </p>";
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
