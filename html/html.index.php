<script language="JavaScript" type="text/javascript" >
function modelesswin(url,mwidth,mheight)
{
if (document.all && window.print) //if ie5
eval('window.showModelessDialog(url,"","help:0;resizable:1;dialogWidth:'+mwidth+'px;dialogHeight:'+mheight+'px")')
else
eval('window.open(url,"","width='+mwidth+'px,height='+mheight+'px,resizable=1,scrollbars=1")')
}
</script>
<!-- <div id="ContentMainImage">
	<img src="./images/HomePage.jpg" alt="Doccme Home Page" />
</div> -->
<div id="ContentMainDesc">
<?php
if($this->doc == "true" || $this->cme == "true" )
{
	
	?>
<div class = "contentMainHeader">
		<div style="float: left; width: 48%; margin-left: 3px;">
		Home Page
		</div>
		<div style="float:right; text-align:right; width: 48%; margin-right: 3px;">
		Logged in as<?php echo " " . $_SESSION["UserName"];?>/<a href="logout.php">Logout</a>
		</div>
		<div style="clear:both; border: none;"> </div>
	</div>
<?php
}

?>
	<div id="welcomeLogo"></div>
	<div class="textContent">
		<p>Our goal is to give you access to an extensive database of CMEs to find quickly  the CME program of your interest and at the location of your choice.</p>
		<div class="ProgramListHeading">Highlights of our Program:</div>
			<div class="PrgList">
				<ul>
					<li>Select a CME based on specialty, location, date and / or CME provider.</li>
					<li>Immense time savings.</li>
					<li>Exceptional personalized service.</li>
					<li>Book a CME anywhere in the world with one phone call.</li>
				</ul>
	  		</div>
	</div>
	<div id="CallEmailUsSectionIndex">
		<div class="CallUsButton">
			<img src="./images/phone_num.gif" width="172px" height="21px"/>
		</div>
		<div class = "CallEmailContent">or</div>
		<div class="EmailUsButton">
			<a  href="javascript:var mywin=window.open('./emailUs.php','Email','toolbar=no,status=no,menubar=no,resizeable=no,width=342,height=180,titlebar=no');">
				<img src="./images/email_but.gif" width="172px" height="21px" border="0"/>
			</a>
		</div>
		<div class="clearFloatLeft"></div>
	</div>

	<div class="textContent">
		<p>To<a href="docRegister.php"><span class="highlightContent"> register in the CME program </span></a>of your choice please give us a call or send us an 
		<a  href="javascript:var mywin=window.open('./emailUs.php','Email','toolbar=no,status=no,menubar=no,resizeable=no,width=342,height=162,titlebar=no');">
		 <span class="highlightContent">email</span>
		 </a>
		 .</p>
		<p>Our aim is to help you select the CME of your choice at the place of your choice in the shortest time possible. We will take care of the rest. </p>
	</div>
</div>
