<?php
/*
 * Created on Mar 12, 2007
 *	author Poornima Kamatgi
 *
 *	this is model class of date
 *	it defines variables of date(start date, end date, last for application)
 *	of course which will be set in this class
 *	when form data is saved  
 */
 require_once("class.phpDate.php"); 
 require_once("class.Error.php");
 class ModelDate
 {
 	var $courseStartDate;
 	var $courseEndDate;
 	var $lastDateForApp;
 	var $error;
 	
 	function ModelDate()
 	{
 		/*$this->courseStartDate = new phpDate();
 		$this->courseEndDate = new phpDate();
 		$this->lastDateForApp = new phpDate();*/
 		$this->courseStartDate = "";
 		$this->courseEndDate = "";
 		$this->lastDateForApp = "";
 		$this->error = new Error();
 	}
 	
 	function autoSetFromPost()
 	{
 		if(isset($_REQUEST["courseStartDate"]) && ($_REQUEST["courseStartDate"] != ""))
 		{
 			//$this->error = $this->courseStartDate->setFormDate($_REQUEST["courseStartDate"]);
 			$this->courseStartDate = $_REQUEST["courseStartDate"];
 		}
 		else
 		{
 			//$this->courseStartDate->setBlankDate();
 			$this->courseStartDate = "";
 		}	
 		if(isset($_REQUEST["courseEndDate"]) && ($_REQUEST["courseEndDate"] != ""))
 		{
 			//$this->error = $this->courseEndDate->setFormDate($_REQUEST["courseEndDate"]);
 			$this->courseEndDate = $_REQUEST["courseEndDate"];
 		}
 		else
 		{
 			//$this->courseEndDate->setBlankDate();
 			$this->courseEndDate = "";
 		}	
 		if(isset($_REQUEST["lastDateForApp"])&& ($_REQUEST["lastDateForApp"] != ""))
 		{
 			//$this->error = $this->lastDateForApp->setFormDate($_REQUEST["lastDateForApp"]);
 			$this->lastDateForApp = $_REQUEST["lastDateForApp"];
 		}	
 		else
 		{
 			//$this->lastDateForApp->setBlankDate();
 			$this->lastDateForApp = "";
 		}	
 	}
 	
 	function clearFields()
 	{
 		$this->courseStartDate = null;
 		$this->courseEndDate = null;
 		$this->lastDateForApp = null;
 	}
 }
 ?>