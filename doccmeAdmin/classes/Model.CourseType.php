<?php
/*
 * Created on Oct 20, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class ModelCourseType
{
	var $type;
	var $name;
		
	function ModelCourseType()
	{
		$this->type = "";
		$this->name = "";
		
	}
	
	function autoSetfromPost()
	{
		if(isset($_REQUEST["type"]))
		{
			$this->type = $_REQUEST["type"];
		}
		else
		{
			$this->type = "";
		}
		if(isset($_REQUEST["name"]))
		{
			$this->name = $_REQUEST["name"];
		}
		else
		{
			$this->name = "";
		}
		
	}
}
?>