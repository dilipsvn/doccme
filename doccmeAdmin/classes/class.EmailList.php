<?php
/*
 * Created on Oct 24, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class EmailList
{
	var $arrOfEmails;
	
	function EmailList()
	{
		$this->arrOfEmails = array("admin"=> "rreshi@yahoo.com", 
					   "poornima"=> "kamatgi.poornima@gmail.com",
					   "CR"=> "info@doccme.com"
					  );
	}
	function getEmailId($name)
	{
		foreach($this->arrOfEmails as $key=>$val)
		{
			if($key == $name)
			{
				return $val;
			}
			
		}
		return "";
	}
}
?>
