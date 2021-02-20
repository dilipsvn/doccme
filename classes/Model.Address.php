<?php
/*
 *	Created on Nov 18, 2006
 *	author Poornima Kamatgi
 *
 *	this is model class of address
 *	it defines address1, address2, city , state, country
 *	variables, which will be set in this class
 *	when form data is saved  
 */
class ModelAddress
{
	var $address1;
	var $address2;
	var $city;
	var $state;
	var $zip;
	var $country;
	
	function ModelAddress()
	{
		$this->address1 = "";
		$this->address2 = "";
		$this->city = "";
		$this->state = "";
		$this->zip = "";
		$this->country = "";
	}
	
	function autoSetfromPost()
	{
		if(isset($_REQUEST["address1"]))
		{
			$this->address1 = $_REQUEST["address1"];
		}
		else
		{
			$this->address1 = "";
		}
		if(isset($_REQUEST["address2"]))
		{
			$this->address2 = $_REQUEST["address2"];
		}
		else
		{
			$this->address2 = "";
		}
		if(isset($_REQUEST["city"]))
		{
			$this->city = $_REQUEST["city"];
		}
		else
		{
			$this->city = "";
		}
		if(isset($_REQUEST["State"]))
		{
			$this->state = $_REQUEST["State"];
		}
		else
		{
			$this->state = "";
		}
		if(isset($_REQUEST["zip"]))
		{
			$this->zip = $_REQUEST["zip"];
		}
		else
		{
			$this->zip = "";
		}
		if(isset($_REQUEST["country"]))
		{
			$this->country = $_REQUEST["country"];
		}
		else
		{
			$this->country = "";
		}
	}
	
	function clearFields()
	{
		$this->address1 = "";
		$this->address2 = "";
		$this->city = "";
		$this->state = "";
		$this->zip = "";
		$this->country = "";
	}
}
?>
