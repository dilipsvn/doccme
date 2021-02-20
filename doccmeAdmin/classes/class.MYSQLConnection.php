<?php
/*
 * 	Created on Dec 1, 2006
 *	author Poornima Kamatgi
 *	
 *	this ia database connection class
 *	this class connects to the database
 *	using server name, username, password
 *	returns link id, which is used to 
 *	maintain the communication with database
 *
 *	revised on Sep 12, 2007
 *	added methods for transactions
 *	and variable - serverType(LOCAL/PRODUCTION) 
 */
require_once("class.Error.php");
 
class MYSQLConnection
{
	var $server;
	var $username;
	var $password;
	var $database;
	var $conlink;
	var $EL;

	function MYSQLConnection()
	{
		$this->EL = new ErrorLevel();
		//$serverType="LOCAL";
		//$serverType = "PRODUCTION";
		$serverType = "DEV";
		
		//Local Server Setting
	/*	if($serverType == "LOCAL")
		{
			$this->server = "localhost";
			$this->username = "root";
			$this->password = "";
			$this->database = "doccme2";
		}*/
		
		//Production server Setting
	/*	if($serverType == "PRODUCTION")
		{
			$this->server = "p50mysql207.secureserver.net";
			$this->username = "doccmeuser";
			$this->password = "DocUser123";
			$this->database = "doccmeuser";
		}*/
		
		//Development server Setting
		if($serverType == "DEV")
		{
			$this->server = "doccme.db.11552848.hostedresource.com";
			//$this->server = "localhost";
			$this->username = "doccme";
			$this->password = "Doccme#123";
			$this->database = "doccme";
		}
	}
	
	function getServer()
	{
		return $this->server;
	}
	
	function setServer($value)
	{
		$this->server = $value;
	}
	
	function getUser()
	{
		return $this->username;
	}
	
	function setUser($value)
	{
		$this->username = $value;
	}
	
	function getPassword()
	{
		return $this->password;
	}
	
	function setPassword($value)
	{
		$this->password = $value;
	}
	
	function getDatabase()
	{
		return $this->database;
	}
	
	function setDatabase($value)
	{
		$this->database = $value;
	}
	
	function getConnection()
	{
		return $this->conlink;
	}
	
	function setConnection($value)
	{
		$this->conlink = $value;
	}
	 
	function connect()
	{
		$err = new Error();
		$this->conlink = mysql_connect($this->server, $this->username, $this->password);
		if(!$this->conlink)
		{
			$err->setError(0, "Error in Connecting to the database", $this->EL->getDBError());	
			return $err;
		}
		else if (!mysql_select_db($this->database,$this->conlink))
		{
			mysql_close($this->conlink);
			$err->setError(0, "Invalid Database name", $this->EL->getDBError());
			return $err;
		}
		else
			return $err;
	}
	
	function begin()
	{
		$null = mysql_query("START TRANSACTION", $this->conlink);
      	return mysql_query("BEGIN", $this->conlink);
	}
	
	function commit()
	{
		return mysql_query("COMMIT", $this->conlink);
	}
	
	function rollback()
	{
		return mysql_query("ROLLBACK", $this->conlink);
	}
	
	function resultCount($result)
	{
		return mysql_num_rows($result);
	}
	
	function columnCount($result)
	{
		return mysql_num_fields($result);
	}
	
	function freeResult(&$result)
	{
		mysql_free_result($result);
	}
	
	function disconnect()
	{
		if($this->conlink)
			mysql_close($this->conlink);
	}
}

?>
