<html>
<body>

<table width="54%" border="1">
<caption>Irmac Employe Project Details</caption>
<tr>
	<th>id</th>
	<th>EmpId</th>
	<th>EmpFirstName</th>
	<th>CompanyName</th>
	<th>ProjectDescription</th>
	<th>ProjectStartYear</th>
	<th>Duration</th>
	<th>RolePlayed</th>
	<th>ProjectType</th>
	<th>URL</th>
	<th>EmpFile1</th>
	<th>EmpFile2</th>
  </tr>

<?php
include("dbconnect.php");
$name = $_POST['FirstName'];
$empid = $_POST['Empid'];
$year = $_POST['Year'];
if($name)
{

$query = "select id,Emp_id,Emp_FirstName,Emp_CompanyName,Emp_projDesc,Emp_StartDate,Emp_Duration_months,Emp_Role,Emp_ProjType,Emp_url,	Emp_File1,Emp_File2 from emp_info where Emp_FirstName='$name' AND Emp_StartDate='$year'";
$result=mysql_query($query);

while($row=mysql_fetch_object($result))
{
?>  
<tr>
<td><?=($row->id)?></td>
<td><?=($row->Emp_id)?></td>
<td><?=($row->Emp_FirstName)?></td>
<td><?=($row->Emp_CompanyName)?></td>
<td><?=($row->Emp_projDesc)?></td>
<td><?=($row->Emp_StartDate)?></td>
<td><?=($row->Emp_Duration_months)?></td>
<td><?=($row->Emp_Role)?></td>
<td><?=($row->Emp_ProjType)?></td>
<td><?=($row->Emp_url)?></td>
<td><?=($row->Emp_File1)?></td>
<td><?=($row->Emp_File2)?></td>
</tr>
<?php
}
}

?>

</table>
</body>
</html>
