<?php
/*
 * 	Created on Dec 9, 2006
 *	author Poornima Kamatgi
 *
 *	this is error class , defines
 *	methods to handle 4 levels of error
 *	defined in ErrorLevel class
 *	
 *	revised on Feb 16, 2007
 *	revised on Sep 12, 2007
 */
 require_once("class.ErrorLevel.php");
class Error
{
	var $errorno;
	var $errormessage;
	var $userdisplay;
	var $errorlevel;
	var $EL;
	
	function Error()
	{
		$this->errorno = 0;
		$this->errormessage = "";
		$this->userdisplay = "";
		$this->EL = new ErrorLevel();
		$this->errorlevel = $this->EL->getNoError();
	}
	
	function getErrorLevel()
	{
		return $this->errorlevel;
	}
	
	function setError($errorno, $errormessage, $errorlevel, $userdisplay = "")
	{
		$this->errorno =errorno;
		$this->errormessage = $errormessage;
		$this->errorlevel = $errorlevel;
		$this->userdisplay = $userdisplay;
	}
	
	function isError()
	{
		if($this->errorlevel == $this->EL->getNoError())
			return false;
		else
			return true;
	}
	
	function setDisplayMessage($msg)
	{
		$this->userdisplay = $msg;
	}
	
	function getUserMessage()
	{
		if($this->userdisplay=="")
			return $this->errormessage;
		else
			return $this->userdisplay;
	}
	
	function getErrorMessage()
	{
		return $this->errormessage;
	}
}
?>