<?php
/*
 * Created on Mar 28, 2007
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
<div id="ContentMainDesc">
	<div class = "contentMainHeader">
		<div style="float: left; width: 48%; margin-left: 3px;">
		Search Agent
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();">
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
	<a href = "agents.php">Agent Options</a>>>
	<a href = "searchAgent.php">Search Agents</a>>>
	</div>
<div id="resultBox">
	<?php
	$firstName = $_REQUEST["firstName"];
	$lastName = $_REQUEST["lastName"];
	$email = $_REQUEST["email"];
	$loginName = $_REQUEST["loginName"];
	$queryString = "";
	
	if($firstName !=null)
	{
		$queryString = $queryString . "&firstName=" . $firstName;
	}
	if($lastName !=null)
	{
		$queryString = $queryString . "&lastName=" . $lastName;
	}
	if($email !=null)
	{
		$queryString = $queryString . "&email=" . $email;
	}
	if($loginName !=null)
	{
		$queryString = $queryString . "&loginName=" . $loginName;
	}
	
	$from = $_GET["from"];
	$pageCount = 10;
	if($from < 0)
	{
		echo "invalid range";
	}
	if($from == "")
	{
		$from = 1;
	}
	if($this->PageAction=="SEARCH")
	{
		$this->error = $this->bal->getAgentSearchResultsWithLimits($this->Agent, $result, $from, $pageCount, $count);
		if($result !=null)
		{
			
	?>
		<div class="textContent">
		There are <?php echo $count;?>  agents registered with DocCME.<br/>
		</div>
		<br/>
	<div class="paginationbar">
	<?php
	$lastPage = ceil($count/$pageCount);
	if($count == 1 || $count == 0 || $count <= $pageCount)
	{
		echo "";
	}
	else
	{
		if($from < 1)
		{
			$from = 1;
		}
		elseif ($from > $lastPage)
		{
	   		$from = $lastPage;
		} // if
		if($from == 1)
		{
			echo  "First &nbsp;&nbsp;  Prev  ";
		}
		else
		{
			echo  " <a href='{$_SERVER['PHP_SELF']}?from=1&PageAction=SEARCH$queryString'> |<- First</a> ";
		    $Prevpage = $from-1;
	   		echo "&nbsp;&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$prevpage&PageAction=SEARCH$queryString'><<- Prev </a> ";
		} // if
		
		echo "&nbsp;&nbsp; ( Page $from of $lastPage )&nbsp;&nbsp; ";
		if($from == $LastPage)
		{
			 echo "  Next&nbsp;&nbsp;  Last  ";
		}
		else
		{
	   		$nextpage = $from + 1;
	  		 echo " <a href='{$_SERVER['PHP_SELF']}?from=$nextpage&PageAction=SEARCH$queryString'>Next ->></a> ";
	  		 echo "&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$lastPage&PageAction=SEARCH$queryString'>Last ->|</a> ";
		} // if
	}
	?>
	</div>
	<br/>
			<table border="1" cellspacing="1" cellpadding="1" width="80%">
			<tr>	
				<tr>	
				<th class ="tabledatahead">AgentID</th>
				<th class ="tabledatahead">FirstName</th>
				<th class ="tabledatahead">LastName</th>
				<th class ="tabledatahead">ContactPhone</th>
				<th class ="tabledatahead">EmailId</th>
				<th class ="tabledatahead">UserName</th>
			</tr>
			</tr>
	<?php
			
			while($Agent = mysql_fetch_assoc($result))
			{
				
	?>
				<tr>
				<td class="tabledata"><a href="./editAgentDetails.php?id=<?php echo $Agent["UserId"];?>"><?php echo $Agent["UserId"]; ?></a></td>
				<td class="tabledata"><?php echo $Agent["FirstName"];?></td>
				<td class="tabledata"><?php echo $Agent["LastName"];?></td>
				<td class="tabledata"><?php echo $Agent["ContactPhone"];?></td>
				<td class="tabledata"><?php echo $Agent["EmailId"];?></td>
				<td class="tabledata"><?php echo $Agent["UserName"];?></td>
	<?php
			}
		}
		else
		{ 
	?>
				<table border="1" cellspacing="1" cellpadding="1" width="75%">
			<tr>	
				<th class ="tabledatahead">AgentID</th>
				<th class ="tabledatahead">FirstName</th>
				<th class ="tabledatahead">LastName</th>
				<th class ="tabledatahead">ContactPhone</th>
				<th class ="tabledatahead">EmailId</th>
				<th class ="tabledatahead">UserName</th>
			</tr>
				<tr>
				<td  colspan="7">No Matching Records Found</td>
				</tr>
	<?php
		}
	}
	?>
	</table>
	</div>
	<br/>
	<div class="paginationbar">
	<?php
	$lastPage = ceil($count/$pageCount);
	if($count == 1 || $count == 0 || $count <= $pageCount)
	{
		echo "";
	}
	else
	{
		if($from < 1)
		{
			$from = 1;
		}
		elseif ($from > $lastPage)
		{
	   		$from = $lastPage;
		} // if
		if($from == 1)
		{
			echo  "First &nbsp;&nbsp;  Prev  ";
		}
		else
		{
			echo  " <a href='{$_SERVER['PHP_SELF']}?from=1&PageAction=SEARCH$queryString'> |<- First</a> ";
		    $Prevpage = $from-1;
	   		echo "&nbsp;&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$prevpage&PageAction=SEARCH$queryString'><<- Prev </a> ";
		} // if
		
		echo "&nbsp;&nbsp; ( Page $from of $lastPage )&nbsp;&nbsp; ";
		if($from == $LastPage)
		{
			 echo "  Next&nbsp;&nbsp;  Last  ";
		}
		else
		{
	   		$nextpage = $from + 1;
	  		 echo " <a href='{$_SERVER['PHP_SELF']}?from=$nextpage&PageAction=SEARCH$queryString'>Next ->></a> ";
	  		 echo "&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$lastPage&PageAction=SEARCH$queryString'>Last ->|</a> ";
		} // if
	}
	?>
	</div>
	<br/>
</div>
