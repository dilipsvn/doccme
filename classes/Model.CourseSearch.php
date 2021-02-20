<?php
/*
 * Created on Jan 23, 2007
 *	author Poornima Kamatgi
 *
 *	this is model class of coursesearch
 *	it defines variables of search criteria
 *	which will be set in this class
 *	when form data is saved  
 */
 require_once("Model.Address.php");
 require_once("Model.Date.php");
 
 class ModelCourseSearch
 {
 	var $courseDate;
 	var $specilaity;
 	var $address;
 	var $keyword;
 	
 	function ModelCourseSearch()
 	{
 		$this->speciality = "";
 		$this->courseDate = new ModelDate();
 		$this->address = new ModelAddress();
 		$this->keyword = "";
 	}
 	
 	function autoSetFromPost()
 	{
 		if(isset($_REQUEST["Speciality"]))
 		{
 			$this->speciality = $_REQUEST["Speciality"];
 		}
 		else
 		{
 			$this->speciality = "";
 		}
 		$this->courseDate->autoSetFromPost();
 		
 		$this->address->autoSetFromPost();
 		
 		if(isset($_REQUEST["keyword"]))
 		{
 			$this->keyword = $_REQUEST["keyword"];
 		}
 		else
 		{
 			$this->keyword = "";
 		}
 		
 	}
 }
?>