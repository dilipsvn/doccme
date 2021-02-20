<?php
/*
 * 	Created on Apr 5, 2007
 *	author Poornima Kamatgi
 *
 *	this is model class of module 
 *	this class defines the variables of module
 *	(module id, module name, module path)
 *	admin can add module in DocCME
 *	by setting these variables using form
 *	values 
 * 
 */
class ModelModule
{
	var $moduleId;
	var $moduleName;
	var $modulePath;
		
	function ModelModule()
	{
		$this->moduleId = "";
		$this->moduleName = "";
		$this->modulePath = "";
	}
	
	function autoSetfromPost()
	{
		if(isset($_REQUEST["moduleId"]))
		{
			$this->moduleId = $_REQUEST["moduleId"];
		}
		else
		{
			$this->moduleId = "";
		}
		if(isset($_REQUEST["moduleName"]))
		{
			$this->moduleName = $_REQUEST["moduleName"];
		}
		else
		{
			$this->moduleName = "";
		}
		if(isset($_REQUEST["modulePath"]))
		{
			$this->modulePath = $_REQUEST["modulePath"];
		}
		else
		{
			$this->modulePath = "";
		}
		
	}
}
?>