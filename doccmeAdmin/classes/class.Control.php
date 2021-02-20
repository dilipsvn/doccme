<?php
/*
 * 	Created on Mar 15, 2007
 *	author Poornima Kamatgi
 *
 * 	this is Control class which
 * 	defines html elements viz.
 * 	textbox, textarea, combo box
 * 	simulating the html elements using php
 * 	
 */
class Control
{
	var $label;
	var $name;
	
	function Control($valueLabel,$valueName)
	{
		$this->label = $valueLabel;
		$this->name = $valueName;
	}
}

class TextBox extends Control
{
	var $data;
	var $maxLength;
	var $size;
	var $readonly;
	
	function TextBox($valueLabel,$valueName,$valueData,$valueMaxLength,$valueSize,$valueReadonly=false)
	{
		parent::Control($valueLabel,$valueName);
		$this->data = $valueData;
		$this->maxLength = $valueMaxLength;
		$this->size = $valueSize;
		$this->readonly = $valueReadonly;  
	}
	
	function showLabel()
	{
		echo "<label id='lbl".$this->name ."' for='" .$this->name ."'> <strong>".$this->label ." </strong> </label>"; 
	}
	
	function showInput()
	{
		if($this->readonly)
			echo "<input type='text' id='" .$this->name ."'name='" .$this->name ."' size='" .$this->size ."'maxlength='" .$this->maxLength ."' value='" .$this->data ."' readonly='true' />";
		else
			echo "<input type='text' id='" .$this->name ."' name='" .$this->name ."' size='" .$this->size ."' maxlength='" .$this->maxLength ."' value='" .$this->data ."'/>";
	}
		
	function Text()
	{
		return $this->data;
	}
}

class Password extends Control
{
	var $data;
	var $maxLength;
	var $size;
	var $readonly;
	
	function Password($valueLabel,$valueName,$valueData,$valueMaxLength,$valueSize,$valueReadonly=false)
	{
		parent::Control($valueLabel,$valueName);
		$this->data = $valueData;
		$this->maxLength = $valueMaxLength;
		$this->size = $valueSize;
		$this->readonly = $valueReadonly;  
	}
	
	function showLabel()
	{
		echo "<label id='lbl".$this->name ."' for='" .$this->name ."'> <strong>".$this->label ." </strong> </label>"; 
	}
	
	function showInput()
	{
		if($this->readonly)
			echo "<input type='password' id='" .$this->name ."'name='" .$this->name ."' size='" .$this->size ."'maxlength='" .$this->maxLength ."' value='" .$this->data ."' readonly='true' />";
		else
			echo "<input type='password' id='" .$this->name ."' name='" .$this->name ."' size='" .$this->size ."' maxlength='" .$this->maxLength ."' value='" .$this->data ."'/>";
	}
		
	function Text()
	{
		return $this->data;
	}
}

class TextArea extends Control
{
	var $data;
	var $cols;
	var $rows;
	var $readonly;
	
	function TextArea($valueLabel, $valueName,$valueData, $valueRows, $valueCols)
	{
		parent::Control($valueLabel,$valueName);
		$this->data = $valueData;
		$this->rows = $valueRows;
		$this->cols = $valueCols;
		
	}
	function showLabel()
	{
		echo "<label id='lbl".$this->name ."' for='" .$this->name ."'> <strong>".$this->label ." </strong> </label>"; 
	}
	function showTextarea()
	{
		
			echo "<textarea name='" .$this->name ."'id = '".$this->name ."' rows='" .$this->rows ."'cols='" .$this->cols ."'value='" .$this->data ."' >". $this->data ."</textarea>";
	}	
	function Text()
	{
		return $this->data;
	}
}

class SelectList extends Control
{
	
	var $data;
	
	function SelectList($valueLabel,$valueName, $data)
	{
		
		parent::Control($valueLabel,$valueName);
		$this->data = $data;
	}
	
	function printOptionFromArray(&$arr)
	{
		foreach($arr as $list)
		{
			$this->printOption($list[0], $list[1]);
		}
	}
		
	function printOption($value, $text)
	{
		if($this->data==$value)
		{
			echo "<option value = '".$value. "' selected>" . $text . "</option>";
		}
		else
		{
			echo "<option value = '".$value. "'>" . $text . "</option>";
		}
	}
	
	function showSelectList(&$arr)
	{
		echo "<select id ='".$this->name ."' name = '" . $this->name . "'>";
		if($this->name == "paymentMode")
		{
			$this->printOption("Credit Card", "Credit card ");	
		}
		else
		{
			$this->printOption("", "Select  " . $this->label);
		}	
		$this->printOptionFromArray($arr);
		echo "</select>";
	}
	
	function showLabel()
	{
		echo "<label id='lbl".$this->name ."' for='" .$this->name ."'> <strong>".$this->label ." </strong> </label>"; 
	}
	
	function showInput()
	{
		if($this->readonly)
			echo "<input type='text' id='" .$this->name ."'name='" .$this->name ."' size='" .$this->size ."'maxlength='" .$this->maxLength ."' value='" .$this->data ."' readonly='true' />";
		else
			echo "<input type='text' id='" .$this->name ."' name='" .$this->name ."' size='" .$this->size ."' maxlength='" .$this->maxLength ."' value='" .$this->data ."'/>";
	}
	
	function Text()
	{
		return $this->data;
	}
}
class SelectMultiList extends Control
{
	
	var $data;
	var $size;
	function SelectMultiList($valueLabel,$valueName, $data, $size)
	{
		
		parent::Control($valueLabel,$valueName);
		$this->data = $data;
		$this->size = $size;
	}
	
	function printOptionFromArray(&$arr)
	{
		foreach($arr as $list)
		{
			$this->printOption($list[0], $list[1]);
		}
	}
		
	function printOption($value, $text)
	{
		if($this->data==$value)
		{
			echo "<option value = '".$value. "' selected>" . $text . "</option>";
		}
		else
		{
			echo "<option value = '".$value. "'>" . $text . "</option>";
		}
	}
	
	function showSelectMultiList(&$arr)
	{
		echo "<select multiple id ='".$this->name ."' name = '" . $this->name . "' size = '". $this->size . "'>";
		$this->printOptionFromArray($arr);
		echo "</select>";
	}
	
	function showLabel()
	{
		echo "<label id='lbl".$this->name ."' for='" .$this->name ."'> <strong>".$this->label ." </strong> </label>"; 
	}
	
	function showInput()
	{
		if($this->readonly)
			echo "<input type='text' id='" .$this->name ."'name='" .$this->name ."' size='" .$this->size ."'maxlength='" .$this->maxLength ."' value='" .$this->data ."' readonly='true' />";
		else
			echo "<input type='text' id='" .$this->name ."' name='" .$this->name ."' size='" .$this->size ."' maxlength='" .$this->maxLength ."' value='" .$this->data ."'/>";
	}
	
	function Text()
	{
		return $this->data;
	}
}

class Table
{
	var $rows;
	var $cols;
	var $cellspacing;
	var $cellpadding;
	var $width;
	var $border;
	var $class;
	
	function startTable($border,$cellspacing, $cellpadding, $width)
	{
		echo "<table border='" . $border . "'cellspacing = '". $cellspacing . "'cellpadding =' ". $cellpadding . "'width='" . $width ."'>";
		
	}
	
	function printTableHeaders($cols, $arrayOfHeaders, $class, $width)
	{
		for($i=0;$i<$cols; $i++)
		{
			echo "<th class= '". $class . "' width = '". $width . "'>" . $arrayOfHeaders[$i] . "</th>";
		
		}
	}
	
	function printTableData($rows, $cols, $arr, $class, $width)
	{
		if($arr != null)
		{
			for($i=0; $i<=$rows;$i++)
			{	
				echo "<tr>";
				for($j=0;$j<$cols;$j++)
				{
					echo "<td class= '". $class . "' width = '". $width . "'>" .$arr[$i][$j]. "</td>";
				}
				echo "</tr>";
			}	
		}
		else
		{
			echo "<tr>";
			echo "<td class= '". $class . "'colspan = '". $cols . "'>" . "No matching records found " . "</td>";
			echo "</tr>";
		}
		
	}
	
	function endTable()
	{
		echo "</table>";
	}
}
?>
