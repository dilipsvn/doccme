<?php
/*
 * Created on Oct 29, 2007
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
		Referral List of Doctors
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/&nbsp;<input type=button id="lblLogout" name="Logout" value="Logout" onclick="dologout();">
		</div>
		<div style="clear:both; border: none;"> </div>
	</div>
	<div class = "ERROR">
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
	<div id="resultBox">
	<div class="textContent">
		This is the list of referrals made by the registered doctors of DocCME.
	</div>
	
	<?php
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
		$this->error = $this->bal->getReferralsWithLimits($result, $from, $pageCount, $count);
		if($result != null)
		{
			?>
						<div class="textContent">
		There are <?php echo $count;?>  referrals sent by registered doctors.<br/>
		
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
			echo  " <a href='{$_SERVER['PHP_SELF']}?from=1'> |< FIRST</a> ";
		    $prevpage = $from-1;
	   		echo "&nbsp;&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$prevpage'><<- Prev </a> ";
		} // if
		
		echo "&nbsp;&nbsp; ( Page $from of $lastPage )&nbsp;&nbsp; ";
		if($from == $lastPage)
		{
			 echo "  Next&nbsp;&nbsp;  Last  ";
		}
		else
		{
	   		$nextpage = $from + 1;
	  		 echo " <a href='{$_SERVER['PHP_SELF']}?from=$nextpage'>Next ->></a> ";
	  		 echo "&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$lastPage'>Last ->|</a> ";
		} // if
	}
	?>
	</div>
	<br/>
			<table border="1" cellspacing="1" cellpadding="1" width="100%">
				
				<tr>	
					<th class ="tabledatahead">ReferralId</th>
					<th class ="tabledatahead">Doc's UserName</th>
					<th class ="tabledatahead">Friend's Name</th>
					<th class ="tabledatahead">Friend's Email Id</th>
					<th class ="tabledatahead">Friend's Phone No. </th>
					<th class ="tabledatahead">Status</th>
				</tr>
		<?php
			while($referral = mysql_fetch_assoc($result))
			{
		?>
				<tr>
					<td ><?php echo $referral["ReferralId"];?></td>
					<td ><?php echo $referral["DocUserName"]; ?></td>
					<td ><?php echo $referral["FriendName"]; ?></td>
					<td ><?php echo $referral["FriendEmailId"];?></td>
					<td ><?php echo $referral["ContactPhone"];?></td>
					<td ><a href = "remarksForReferral.php?rid=<?php echo $referral["ReferralId"];?> ">Close</a></td>
	<?php
			}
		?>
		</table>
	<?php
		}
		else
		{ 
	?>
	<br/>
				<table border="1" cellspacing="1" cellpadding="1" width="75%">
			<tr>
					<th class ="tabledatahead">ReferralId</th>
					<th class ="tabledatahead">Doc's UserName</th>
					<th class ="tabledatahead">Friend's Name</th>
					<th class ="tabledatahead">Friend's Phone No. </th>
					<th class ="tabledatahead">Friend's Email Id</th>
				
			</tr>
				<tr>
				<td  colspan="5">No Matching Records Found</td>
				</tr>
				</table>
	<?php
		}
	
	?>
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
			echo  " <a href='{$_SERVER['PHP_SELF']}?from=1'> |< FIRST</a> ";
		    $prevpage = $from-1;
	   		echo "&nbsp;&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$prevpage'><<- Prev </a> ";
		} // if
		
		echo "&nbsp;&nbsp; ( Page $from of $lastPage )&nbsp;&nbsp; ";
		if($from == $lastPage)
		{
			 echo "  Next&nbsp;&nbsp;  Last  ";
		}
		else
		{
	   		$nextpage = $from + 1;
	  		 echo " <a href='{$_SERVER['PHP_SELF']}?from=$nextpage'>Next ->></a> ";
	  		 echo "&nbsp;&nbsp; <a href='{$_SERVER['PHP_SELF']}?from=$lastPage'>Last ->|</a> ";
		} // if
	}
	?>
	</div>
	<br/>
</div>
