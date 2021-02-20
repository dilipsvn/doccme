<?php
/*
 *	Created on Mar 18, 2007
 *	author Poornima Kamatgi
 * 
 * 	this class simulates select query
 * 	using php based on parameters viz.
 * 	field list, condition, order by value
 * 	group by value
 * 	also defines method to simulate select query
 * 	for counting rows in table
 * 	defines method to simaulate select query
 * 	to retrieve records with limits
 * 
 * 	revised on Mar 23, 2007
 */
 class QueryBuilder
 {
 	var $tableName;
 	var $fieldList;
 	var $condition;
 	var $orderByCond;
 	var $groupByCond;
 	var $query;
 	var $limit;
 	var $countNoRows;
 	
 	function QueryBuilder($tblName)
 	{
 		$this->tableName = strtolower($tblName);
 	}
 	function setFieldList($fldList)
 	{
 		$this->fieldList = $fldList;
 	}
 	function setCondition($cond)
 	{
 		$this->condition = $cond;
 	}
 	function setOrderByCond($ordByCond)
 	{
 		$this->orderByCond = $ordByCond;
 	}
 	function setgrpByCond($grpByCond)
 	{
 		$this->groupByCond = $grpByCond;
 	}
 	function generateQuery()
 	{
 		if($this->condition != "" && $this->fieldList != "")
 		{
 			$this->query = "SELECT ". $this->fieldList . "FROM " . $this->tableName . " WHERE " . $this->condition;
 		}
 		elseif($this->condition == "" && $this->fieldList != "")
 		{
 			$this->query = "SELECT ". $this->fieldList . "FROM " . $this->tableName;
 		
 		}
 		elseif($this->condition == "" && $this->fieldList == "")
 		{
 			$this->query = "SELECT * FROM " . $this->tableName;
 		
 		}
 		elseif($this->condition != "" && $this->fieldList == "")
 		{
 			$this->query = "SELECT  * FROM " . $this->tableName . " WHERE " . $this->condition;
 		
 		}
 		return $this->query;
 	}
 	
 	function generateQueryCount()
 	{
 		if($this->condition != "")
 		{
 			$this->query =  "SELECT COUNT(*) FROM " . $this->tableName .  " WHERE "  . $this->condition;
 		}
 		else
 		{
 			$this->query =  "SELECT COUNT(*) FROM "  . $this->tableName;
 		}
 		return $this->query;
 	}
 	function generateQueryWithLimit(&$from, $numOfRecords)
 	{
 		return $this->generateQuery() . "  LIMIT  " . ($from - 1)  * $numOfRecords .", " . $numOfRecords;
 	}
 }
?>
