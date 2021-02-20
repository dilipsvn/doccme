<?php 
	if(substr($_SERVER['SCRIPT_URI'],0,5) == "http:")
	{
		$new_url = "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		header("Location: $new_url");
	}
?>
<html>
<head>
	<title>Test PHP Server Variables</title>
</head>
<body>
<div style="text-align:center;">
	
	<table border="1" cellspacing="0" cellpadding="3" style="width:75%;">
		<tr>
			<th colspan="2" style="width:100%">SERVER Variable</th>
		</tr>
	<?php
		
		foreach($_SERVER as $key => $val)
		{
			echo "<tr>";
			echo "<td>$key</td><td>$val</td>";
			echo "</tr>";
		}
	?>
	</table>
	<p>&nbsp;</p>
	<table border="1" cellspacing="0" cellpadding="3" style="width:75%;">
		<tr>
			<th colspan="2" style="width:100%">ENV Variable</th>
		</tr>
	<?php
		
		foreach($_ENV as $key => $val)
		{
			echo "<tr>";
			echo "<td>$key</td><td>$val</td>";
			echo "</tr>";
		}
	?>
	</table>
	<p>&nbsp;</p>
	<table border="1" cellspacing="0" cellpadding="3" style="width:75%;">
		<tr>
			<th colspan="2" style="width:100%">REQUEST Variable</th>
		</tr>
	<?php
		
		foreach($_REQUEST as $key => $val)
		{
			echo "<tr>";
			echo "<td>$key</td><td>$val</td>";
			echo "</tr>";
		}
	?>
	</table>
</div>
</body>
</html>