<?php
/*
 * Created on Apr 3, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<script language="JavaScript" type="text/javascript">
function dologout()
{
	document.location.href="./logout.php";
}
</script>
<script language="JavaScript" type="text/javascript">
function doViewList()
{
	if(document.getElementById('userId').value=="")
	{
		alert("Please Select a User");
		document.getElementById('userId').focus();
		return ;
	}
	document.getElementById('PageAction').value="VIEW";
	document.getElementById('frmUsers').submit();
}
function doResetList()
{
	if(document.getElementById('userId').value=="")
	{
		alert("Please Select a User");
		document.getElementById('userId').focus();
		return ;
	}
	document.getElementById('PageAction').value="RESET";
	document.getElementById('frmUsers').submit();
}
function doChangeAccess(ModuleId, Access)
{
	if(document.getElementById('userId').value=="")
	{
		alert("Please Select a User");
		document.getElementById('userId').focus();
		return ;
	}
	document.getElementById('PageAction').value="ASSIGN";
	document.getElementById('ModuleID').value=ModuleId;
	document.getElementById('Access').value=Access;
	document.getElementById('frmUsers').submit();
}
</script>
<div id="ContentMainDesc">
<div class = "contentMainHeader">
		<div style="float: left; width: 48%; margin-left: 3px;">
		Access List of Agents in DocCME
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();"/>
		</div>
		<div style="clear:both; border: none;"> </div>
	</div>
<div class="ERROR">
<?php
if($this->error->isError())
{
	echo $this->error->getUserMessage();
}
?>
</div>
<div class="textContent">
	<a href = "home.php">Home</a>>>
	</div>
<div class="textContent">
<p>Access List of Registered Agents</p>
<p>For newly added agents please click "Reset Accesslist" button to assign access for each module in DocCME.</p>
</div>

  <form name="frmUsers" id="frmUsers" action="./grantORRevokeAccess.php" method="post">
  <input type="hidden" name="PageAction" id="PageAction" value=""/>
  <input type="hidden" name="ModuleID"  id="ModuleID" value=""/>
  <input type="hidden" name="Access" id="Access" value=""/>
  <table border="0" cellpadding="2" cellspacing="2" width="100%">
		<tr>
			<td class = "labelOfInput"><?php $this->userId->showLabel(); ?> </td>
			<td class = "inputbox"><?php $this->userId->showSelectList($this->usersList); ?>
		
			<td class = "inputbox"> <input type="button" value="View Access List" onclick="doViewList();"/> &nbsp;
			</td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;</td>
			<td>&nbsp;&nbsp;</td>
			<td class = "inputbox"> <input type="button" value="Reset Access List" onclick="doResetList();"/> &nbsp;
		</tr>

  </table>
  <div id="resultBox">
  <?php
  		
  		if($this->PageAction == "VIEW")
 		{
			$this->error = $this->bal->viewAccessList($this->agent, $result);
			
		}
		if($this->PageAction == "RESET")
		{
			$this->error = $this->bal->resetAccessList($this->agent, $result);
		}
		if($this->PageAction == "ASSIGN")
		{
			$moduleId = $_REQUEST["ModuleID"];
			$access = $_REQUEST["Access"];
			$this->error = $this->bal->assignAccessList($this->agent, $moduleId, $access, $result);
		}
		
		if($result != null)
		{
			
	?>
			<table border="1" cellpadding="2" cellspacing="2" width="100%">
			<tr>
				<th >ModuleId</th>
				<th >ModuleName</th>
				<th >AccessType</th>
				<th >Action</th>
			</tr>
	<?php
			while($access = mysql_fetch_assoc($result))
			{
	?>
				<tr>
					<td ><?php echo $access["ModuleId"];?></td>
					<td ><?php echo $access["ModuleName"];?></td>
					<td ><?php echo $access["AccessType"];?></td>
					<td >
					<input type="button" name="btnAccess" id="btnAccess" value="<?php echo $this->getAccess($access["AccessType"]);?>" onclick="doChangeAccess(<?php echo $access["ModuleId"];?>, '<?php echo $this->getAccess($access["AccessType"]);?>')"/>
					</td>
				</tr>
	<?php
			}
	?>
	</table>
	<?php
		}
  ?>
  
  </div>
  </form>
  </div>
