<?php
/*
 * Created on 16 Jun, 2008
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class cmeproviderexcel
 {
    var $server;
	var $username;
	var $password;
	var $database;
	var $conlink;
	var $con;
	
	function showCMEProviderData()
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
		$sqlSelect = "SELECT * FROM CMEProvider";
		
		$result = mysql_query($sqlSelect, $this->conlink);
		
			echo '<table border="1" cellspacing="1" cellpadding="1" width="80%">';
			echo '<tr>';	
				echo '<th>CMEID</th>';
				echo '<th>InstituteName</th>';
				echo '<th>FirstName</th>';
				echo '<th>MiddleName</th>';
				echo '<th>LastName</th>';
				echo '<th>Address1</th>';
				echo '<th>Adress2</th>';
				echo '<th>City</th>';
				echo '<th>State</th>';
				echo '<th>Zip</th>';
				echo '<th>Country</th>';
				echo '<th>WorkPhone</th>';
				echo '<th>HomePhone</th>';
				echo '<th>Fax</th>';
				echo '<th>MobilePhone</th>';
				echo '<th>EmailId</th>';
				echo '<th>Website URL</th>';
				echo '<th>LoginName</th>';
				echo '<th>Password</th>';
				echo '<th>Status</th>';
				echo '<th>Remarks</th>';
			echo '</tr>';
			while($cmeproviders = mysql_fetch_assoc($result))
			{
				echo '<tr>';
				echo '<td>'.$cmeproviders["CMEId"].'</td>';
				echo '<td>'.$cmeproviders["InstituteName"].'</td>';
				echo '<td>'.$cmeproviders["FirstName"].'</td>';
				echo '<td>'.$cmeproviders["MiddleName"].'</td>';
				echo '<td>'.$cmeproviders["LastName"].'</td>';
				echo '<td>'.$cmeproviders["Address1"].'</td>';
				echo '<td>'.$cmeproviders["Address2"].'</td>';
				echo '<td>'.$cmeproviders["City"].'</td>';
				echo '<td>'.$cmeproviders["State"].'</td>';
				echo '<td>'.$cmeproviders["Zip"].'</td>';
				echo '<td>'.$cmeproviders["Country"].'</td>';
				echo '<td>'.$cmeproviders["WorkPhone"].'</td>';
				echo '<td>'.$cmeproviders["HomePhone"].'</td>';
				echo '<td>'.$cmeproviders["Fax"].'</td>';
				echo '<td>'.$cmeproviders["MobilePhone"].'</td>';
				echo '<td>'.$cmeproviders["EmailId"].'</td>';
				echo '<td>'.$cmeproviders["WebSiteUrl"].'</td>';
				echo '<td>'.$cmeproviders["UserName"].'</td>';
				echo '<td>'.$cmeproviders["Password"].'</td>';
				echo '<td>'.$cmeproviders["Status"].'</td>';
				echo '<td>'.$cmeproviders["Remarks"].'</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
	
 }
 $cmeproviderObj = new cmeproviderexcel();
 $cmeproviderObj->showCMEProviderData();
?>

