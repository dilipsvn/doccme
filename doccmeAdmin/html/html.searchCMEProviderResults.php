<?php
/*
 * Created on Mar 27, 2007
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
		Search CME Provider Results 
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
	<a href = "cmeproviders.php">CME Providers</a>>>
	<a href = "searchCMEProvider.php">Search CME Providers</a>>>
	</div>
	<br/>
<div id="resultBox">
	
	<?php
	$instituteName = $_REQUEST["instituteName"];
	$firstName = $_REQUEST["firstName"];
	$address1 = $_REQUEST["address1"];
	$city = $_REQUEST["city"];
	$state = $_REQUEST["State"];
	$email = $_REQUEST["email"];
	$loginName = $_REQUEST["loginName"];
	$queryString = "";
	if($instituteName !=null)
	{
		$queryString = $queryString . "&instituteName=" . $instituteName;
	}
	if($firstName !=null)
	{
		$queryString = $queryString . "&firstName=" . $firstName;
	}
	if($address1 !=null)
	{
		$queryString = $queryString . "&address1=" . $address1;
	}
	if($city !=null)
	{
		$queryString = $queryString . "&city=" . $city;
	}
	if($state !=null)
	{
		$queryString = $queryString . "&State=" . $state;
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
		$this->error = $this->bal->getCMEProviderSearchResultsWithLimits($this->CMEProvider, $result, $from, $pageCount, $count);
		if($result !=null)
		{
			
	?>
	<div class="textContent">
		<b>No. of  CMEProvider(s) registered with DocCME : <?php echo $count;?></b>
		<p>Click on CMEID to edit the details of CME Provider</p>
	</div>
	<br/>
		
	<div class="paginationbar">
	<?php
	$lastPage = ceil($count/$pageCount);
	if($count == 1 || $count == 0)
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
		    $prevpage = $from-1;
	   		echo "&nbsp;&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$prevpage&PageAction=SEARCH$queryString'><<- Prev </a> ";
		} // if
		
		echo "&nbsp;&nbsp; ( Page $from of $lastPage )&nbsp;&nbsp; ";
		if($from == $lastPage)
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
				<th class="tabledatahead">CMEID</th>
				<th class="tabledatahead">InstituteName</th>
				<th class="tabledatahead">FirstName</th>
				<th class="tabledatahead">City/State</th>
				<th class="tabledatahead">EmailId</th>
				<th class="tabledatahead">Website URL</th>
				<th class="tabledatahead">LoginName</th>
			</tr>
	<?php
			
			while($CMEProvider = mysql_fetch_assoc($result))
			{
				
	?>
				<tr>
				<td class="tabledata"><a href="./editCMEProviderDetails.php?id=<?php echo $CMEProvider["CMEId"];?>"><?php echo $CMEProvider["CMEId"]; ?></a></td>
				<td class="tabledata"><?php echo $CMEProvider["InstituteName"];?></td>
				<td class="tabledata"><?php echo $CMEProvider["FirstName"];?></td>
				<td class="tabledata">
<?php 
if($CMEProvider["City"] != "" && $CMEProvider["State"] != "")
{
echo $CMEProvider["City"] . "," . $CMEProvider["State"];
}
elseif($CMEProvider["City"] == "" && $CMEProvider["State"] == "")
{
echo "";
}
elseif($CMEProvider["City"] != "" && $CMEProvider["State"] == "")
{
echo $CMEProvider["City"];
}
elseif($CMEProvider["City"] == "" && $CMEProvider["State"] != "")
{
echo $CMEProvider["State"];
}
?>
</td>
				<td class="tabledata"><?php echo $CMEProvider["EmailId"];?></td>
				<td class="tabledata"><?php echo $CMEProvider["WebSiteUrl"];?></td>
				<td class="tabledata"><?php echo $CMEProvider["UserName"];?></td>
	<?php
			}
		}
		else
		{ 
	?>
			<br/>	
			<table border="1" cellspacing="1" cellpadding="1" width="75%">
			<tr>	
				<th class="tabledatahead">CMEID</th>
				<th class="tabledatahead">InstituteName</th>
				<th class="tabledatahead">FirstName</th>
				<th class="tabledatahead">City/State</th>
				<th class="tabledatahead">EmailId</th>
				<th class="tabledatahead">Website URL</th>
				<th class="tabledatahead">LoginName</th>
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
	if($count == 1 || $count == 0)
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
		    $prevpage = $from-1;
	   		echo "&nbsp;&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$prevpage&PageAction=SEARCH$queryString'><<- Prev </a> ";
		} // if
		
		echo "&nbsp;&nbsp; ( Page $from of $lastPage )&nbsp;&nbsp; ";
		if($from == $lastPage)
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
</div>
