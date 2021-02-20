<?php
/** Testing database connection**/
echo "testing dbase connection";
$con = mysql_connect("localhost", "doccmeuser", "DocUser123");

		if(!$con)
		{
			echo "Error in Connecting to the database";
			
		}
		else
		{
		 echo " connected to db";
		 }
		if(!mysql_select_db("doccmedb",$con))
		{
			mysql_close($con);
			echo "Invalid Database name";
			
		}
		else
		{
			echo "valid db";
		}
?>