<?php
/*
 * Created on Apr 5, 2007
 *	author Poornima Kamatgi
 *
 *	this is model class of Accesslist
 *	it defines variables of AccessList( user id, module id, accesstype)
 *	which will be set in this class
 *	when admin either grants or revokes access
 *	to an agent for a module in DocCME
 */
class ModelModule
{
	var $userId;
	var $moduleId;
	var $accessType;
		
	function ModelModule()
	{
		$this->userId = "";
		$this->moduleId = "";
		$this->accessType = "";
	}
	
	function autoSetfromPost()
	{
		if(isset($_REQUEST["userId"]))
		{
			$this->userId = $_REQUEST["userId"];
		}
		else
		{
			$this->userId = "";
		}
		if(isset($_REQUEST["moduleId"]))
		{
			$this->moduleId = $_REQUEST["moduleId"];
		}
		else
		{
			$this->moduleId = "";
		}
		if(isset($_REQUEST["accesType"]))
		{
			$this->accessType = $_REQUEST["accessType"];
		}
		else
		{
			$this->accessType = "";
		}
		
	}
}
?>