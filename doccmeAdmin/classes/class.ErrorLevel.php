<?php
/*
 *	Created on Dec 9, 2006
 *	author Poornima Kamatgi
 *
 *	this is enumeration which defines
 *	levels of error - 4
 *	revised on Sep 12, 2007
 *	defined ErrorLevel class
 *	which is compatible with PHP 4 and PHP 5
 */
 class ErrorLevel
{
	var $NOERROR;
	var $DBLEVEL;
	var $SQLLEVEL;
	var $DALLEVEL;
	var $BALLEVEL;
	var $UILEVEL;
	
	function ErrorLevel()
	{
		$this->NOERROR = 0;
		$this->DBLEVEL = 1;
		$this->SQLLEVEL = 2;
		$this->DALLEVEL = 3;
		$this->BALLEVEL = 4;
		$this->UILEVEL = 5;
	}
	
	function getNoError()
	{
		return $this->NOERROR;
	}
	
	function getDBError()
	{
		return $this->DBLEVEL;
	}
	
	function getSQLError()
	{
		return $this->SQLLEVEL;
	}
	
	function getDALError()
	{
		return $this->DALLEVEL;
	}
	
	function getBALError()
	{
		return $this->BALLEVEL;
	}
	
	function getUIError()
	{
		return $this->UILEVEL;
	}
}
?>