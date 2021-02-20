<?php
/*
 * Created on 16 Jun, 2008
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class insertarchive
 {
    function insertCourse()
	{
		
		
		//$serverType="LOCAL";
		$serverType = "PRODUCTION";
		
		//Local Server Setting
		if($serverType == "LOCAL")
		{
			$this->server = "localhost";
			$this->username = "root";
			$this->password = "";
			$this->database = "doccme2";
		}

		//Production server Setting
		if($serverType == "PRODUCTION")
		{
			$this->server = "localhost";
			$this->username = "doccme";
			$this->password = "woodbury";
			$this->database = "doccme_doccme3";
		}
		$this->conlink = mysql_connect($this->server, $this->username, $this->password);
		if(!$this->conlink)
		{
			$err->setError(0, "Error in Connecting to the database", $this->EL->getDBError());
			
		}
		else if (!mysql_select_db($this->database,$this->conlink))
		{
			mysql_close($this->conlink);
			$err->setError(0, "Invalid Database name", $this->EL->getDBError());
			
		}
		$sqlInsert = "INSERT INTO AppliedCourses(DoctorId, CourseId, BookingDate, PaymentMode," .
				"Amount, AgentId, BookStatus)" .
				" VALUES(55,4,NOW(),'Credit Card'," .
				"415.00, '', 'BOOKED')";
		
		$result = mysql_query($sqlInsert, $this->conlink);
		if(mysql_error())
		{
			echo "record cud not b inserted";
		}
		else
		{
			echo"record inserted";
		}
		
	}
	
 }
 $insertObj = new insertarchive();
 $insertObj->insertCourse();
?>

