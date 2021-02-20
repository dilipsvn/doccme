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
		Contacts List of Doctors
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
	<div id="resultBox">
	<div class="textContent">
		This is the list of contacts made by doctors who expect call from
		DocCME to provide information regarding how DocCME is helpful for them.
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
		$this->error = $this->bal->getContactsWithLimits($result, $from, $pageCount, $count);
		if($result != null)
		{
			?>
		<div class="textContent">
		There are <?php echo $count;?>  contacts of doctors.<br/>
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
					<th class="tabledatahead">ContactId</th>
					<th class="tabledatahead">Doctor's Name</th>
					<th class="tabledatahead">Phone No. </th>
					<th class="tabledatahead">Email Id</th>
					<th class="tabledatahead">Best time to contact</th>
					<th class="tabledatahead">Status</th>
				</tr>
		<?php
			while($contact = mysql_fetch_assoc($result))
			{
		?>
				<tr>
					<td class="tabledata"><?php echo $contact["DoctorContactId"];?></td>
					<td class="tabledata"><?php echo $contact["Name"]; ?></td>
					<td class="tabledata"><?php echo $contact["ContactPhone"];?></td>
					<td class="tabledata"><?php echo $contact["EmailId"];?></td>
					<td class="tabledata"><?php echo $contact["ContactTime"];?></td>
					<td class="tabledata"><a href = "remarksForContact.php?cid=<?php echo $contact["DoctorContactId"];?> ">Close</a></td>
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
					<th class="tabledatahead">ContactId</th>
					<th class="tabledatahead">Doctor's Name</th>
					<th class="tabledatahead">Phone No. </th>
					<th class="tabledatahead">Email Id</th>
					<th class="tabledatahead">Best time to contact</th>	
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
