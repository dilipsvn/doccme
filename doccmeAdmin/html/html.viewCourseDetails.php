<?php
/*
 * Created on Dec 6, 2007
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
		View Course Details
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
<br/>
	<div id = "displayBox">
	<table border="0" cellpadding="2" cellspacing="2" width="100%">
		<tr>
			<td  class = "labelOfInput"><?php $this->courseId->showLabel();?></td>
			<td class = "inputbox"><?php echo $this->courseId->data;?>
			</td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->CMEId->showLabel();?></td>
			<td class = "inputbox"><?php echo $this->CMEId->data;?>
			</td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->courseTitle->showLabel();?></td>
			<td class = "inputbox"><?php echo $this->courseTitle->data;?>
			</td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->courseDesc->showLabel();?></td>
			<td class = "inputbox">
                         <?php
                                          if( $this->courseDesc->data != "")
                                           {
                                                  echo $this->courseDesc->data;
                                            }
                                            else
                                             {
                                                  echo $this->courseTitle->data;
                                            }
                                         ?>
			</td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->speciality->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->speciality->data;?>
			</td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->address1->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->address1->data;  ?>
			</td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->address2->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->address2->data;  ?>
			</td>
		</tr>

		<tr>
			<td  class = "labelOfInput"><?php $this->city->showLabel();?> </td>
			<td class = "inputbox"><?php echo $this->city->data;?>
			</td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->state->showLabel();?> </td>
			<td class = "inputbox"><?php echo $this->state->data;?>
			</td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->zip->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->zip->data;  ?>
			</td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->country->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->country->data;  ?> </td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->contactPerson->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->contactPerson->data;  ?>
			</td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->contactPhone->showLabel(); ?> </td>
			<td class ="inputbox"><?php echo $this->contactPhone->data;  ?>
			</td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->fax->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->fax->data;  ?>
			</td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->email->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->email->data;  ?>
			</td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->courseStartDate->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->courseStartDate->data;  ?>
			</td>
		</tr>

		<tr>
			<td  class = "labelOfInput"><?php $this->courseEndDate->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->courseEndDate->data;  ?>
			</td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->lastDateForApp->showLabel(); ?> </td>
			<td class = "inputbox"> <?php echo $this->lastDateForApp->data;  ?>
			</td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->nearestHotel->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->nearestHotel->data;  ?>
			</td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->nearestAirport->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo $this->nearestAirport->data;  ?>
			</td>
		</tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->courseFee->showLabel(); ?> </td>
			<td class = "inputbox"><?php echo "$".$this->courseFee->data;  ?>
			</td>
		</tr>
		<tr>
		<tr>
			<td  class = "labelOfInput"><?php $this->cmeCredits->showLabel();?> </td>
			<td class = "inputbox"><?php echo $this->cmeCredits->data;?>
			</td>
		</tr>
	</table>
</div>
</div>
