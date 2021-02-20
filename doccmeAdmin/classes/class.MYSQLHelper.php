<?php
/*
 *	Created on Sep 12, 2007
 *	author Poornima Kamatgi
 *
 *	MYSQL query execution Class
 *	
 */
 
require_once("class.MYSQLConnection.php");

class MYSQLHelper
{
	var $EL;
	
	function MYSQLHelper()
	{
		$this->EL = new ErrorLevel();
	}
	
	function executeQuery(&$result, $con, $sql)
	{
		$err = new Error();
		$result = mysql_query($sql, $con);
		if(mysql_error())
		{
			$err->setError(mysql_errno($con),mysql_error($con), $this->EL->getSQLError());
			return $err;
		}
		return $err;
	
	}
	
	function executeUpdate($con, $sql, &$rows_affected)
	{
		$err = new Error();
		$result = mysql_query($sql,$con);
		if(!$result)
		{
			$err->setError(mysql_errno($con),mysql_error($con), $this->EL->getSQLError());
			return $err;
		}
		$rows_affected = mysql_affected_rows($con);
		return $err;
	}
	
	function executeInsertId($con, $sql, &$Id)
	{
		$err = new Error();
		$result = mysql_query($sql, $con);
		if(!$result)
		{
			$err->setError(mysql_errno($con),mysql_error($con), $this->EL->getSQLError());
			return err;
		}
		$Id = mysql_insert_id($con);
		return $err;
	}
	
	function executeScalar($con, $sql, &$value)
	{
		$err = new Error();
		$result = mysql_query($sql, $con);
		if(!$result)
		{
			$err->setError(mysql_errno($con),mysql_error($con), $this->EL->getSQLError());
			return $err;
		}
		if(mysql_num_rows($result) > 0)
			$value = mysql_result($result, 0);
		else
			$value = NULL;
				
		return $err;
	}
	
	function getTableList($con,&$result)
	{
		$err = new Error();
		$sql = "SHOW TABLES";
		$result = mysql_query($sql,$con->getConnection());
		if(!$result)
		{
			$err->setError(mysql_errno($con),mysql_error($con), $this->EL->getSQLError());
			//echo "Error : " .mysql_errno($con); 
			return $err;
		}
		return $err;
	}
	
	function getFieldList($con,$tablename,&$result)
	{
		$err = new Error();
		$sql = "DESCRIBE " .$tablename;
		$result = mysql_query($sql,$con->getConnection());
		if(!$result)
		{
			$err->setError(mysql_errno($con),mysql_error($con), $this->EL->getSQLError());
			return $err;
		}
		return $err;
	}
	
	function getTableData($con,$tablename,&$result)
	{
		$err = new Error();
		$sql = "SELECT * FROM " .$tablename;
		$result = mysql_query($sql,$con->getConnection());
		if(!$result)
		{
			$err->setError(mysql_errno($con),mysql_error($con), $this->EL->getSQLError());
			return $err;
		}
		return $err;
	}
}
?>