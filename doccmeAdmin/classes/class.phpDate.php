<?php
/*
 * Created on Mar 8, 2007
 *	author Poornima Kamatgi
 * 
 * 	this is date class that defines
 * 	methods for converting form date
 * 	format to database date format
 * 	and vice versa, these methods also check
 * 	valid date format
 * 
 * 	revised on Mar 15, 2007
 */
 require_once("class.Error.php");
 
 class phpDate
 {
 	var $dt;
 	var $m;
 	var $d;
 	var $y;
 	var $error;
 	 	
 	function phpDate()
 	{
 		$this->m = 0;
 		$this->d = 0;
 		$this->y = 0;
 		$this->dt = null;
 		$this->error = new Error();
 	}
 	
 	function getPhpDate()
 	{
 		if($this->m == 0 || $this->d == 0 || $this->y == 0)
 		{
 			return null;
 		}
 		else
 		{
 			$this->dt =  mktime(0,0,0, $this->m, $this->d, $this->y);
 			return $this->dt;
 		}
 	}
 
 	function getFormDate()
 	{
 		if($this->m == 0 || $this->d == 0 || $this->y == 0)
 		{
 			return "";
 		}
 		else
 		{
 			$this->dt =  mktime(0,0,0, $this->m, $this->d, $this->y);
 			return date("m/d/Y", $this->dt);
 		}
 	}
 	 	
 	function getMySqlDate()
 	{
 		if($this->m == 0 || $this->d == 0 || $this->y == 0)
 		{
 			return "";
 		}
 		else
 		{
 			$this->dt =  mktime(0,0,0, $this->m, $this->d, $this->y);
 			return date("Y-m-d", $this->dt);
 		}
 	} 
 	
 	function setPhpDate($date)
 	{
 		$this->dt = $date;
 	}
 	
 	function setFormDate($dt)
 	{
 		$arrdt = explode("/", $dt);
		$m = $arrdt[0];
		$d = $arrdt[1];
		$y = $arrdt[2];
		$dt = mktime(0,0,0, $m, $d, $y);
	 	if(!$dt)
	 	{
	 		$this->m = 0;
 			$this->d = 0;
 			$this->y = 0;
 			
	 	}
	 	else
	 	{
	 		$this->m = $m;
 			$this->d = $d;
 			$this->y = $y;
 			
	 	}
	}
	
	function setMySqlDate($dt)
	{
		$arrdt = explode("-", $dt);
 		$y = $arrdt[0];
		$m = $arrdt[1];
		$d = $arrdt[2];
	 	$dt = mktime(0,0,0, $m, $d, $y);
	 	if(!$dt)
	 	{
	 		$this->m = 0;
 			$this->d = 0;
 			$this->y = 0;
 			
	 	}
	 	else
	 	{
	 		$this->m = $m;
 			$this->d = $d;
 			$this->y = $y;
 			
	 	}
	}
	
	function setBlankDate()
	{
		$this->m = 0;
		$this->d = 0;
		$this->y = 0;
		$this->dt = 0;
		
	}
}
?>