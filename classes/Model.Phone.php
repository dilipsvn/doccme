<?php
/*
 * 	Created on Nov 25, 2006
 *	author Poornima Kamatgi
 *
 *	this is model class of Phone
 *	it defines variables of Phone(work phone, home phone, mobile phone and fax)
 *	which will be set in this class
 *	when form data is saved  
 */
class ModelPhone
{
	var $workPhone;
	var $homePhone;
	var $mobilePhone;
	var $fax;
	
	function ModelPhone()
	{
	 	$this->workPhone = "";
	 	$this->homePhone = "";
	 	$this ->mobilePhone = "";
	 	$this->fax = "";
	}
	
	function autoSetfromPost()
	{
		if(isset($_REQUEST['workPhone']))
		{
			$this->workPhone = $_REQUEST['workPhone'];
		}
		else
		{
			$this->workPhone = "";
		}
		if(isset($_REQUEST['homePhone']))
		{
			$this->homePhone = $_REQUEST['homePhone'];
		}
		else
		{
			$this->homePhone = "";
		}
		if(isset($_REQUEST['mobilePhone']))
		{
			$this->mobilePhone = $_REQUEST['mobilePhone'];
		}
		else
		{
			$this->mobilePhone = "";
		}
		if(isset($_REQUEST['fax']))
		{
			$this->fax = $_REQUEST['fax'];
		}
		else
		{
			$this->fax = "";
		}
	}
	
	function clearFields()
	{
		$this->workPhone = "";
	 	$this->homePhone = "";
	 	$this ->mobilePhone = "";
	 	$this->fax = "";
	}
}
?>
