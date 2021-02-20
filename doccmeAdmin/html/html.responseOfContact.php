<?php
/*
 * Created on Oct 28, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<div class="ERROR">
<?php
if($this->error->isError())
{
	echo $this->error->getErrorMessage();
}

?>
</div>
<div class= "textContent">
<p>Thanks for contacting DocCME , <br/>our Customer-Care will get back to you soon.</p>
</div>
<input type="button" name="btnClose" Value="Close" onClick="javascript: window.close();">
