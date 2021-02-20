<?php
/*
 * Created on Dec 24, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class creditCardInfo
{
	var $apiLoginId;
	var $transactionKey;
	var $timeStamp;
	var $fingerPrint;
	var $sequence;

	function getAPILoginId()
	{
		//$this->apiLoginId = "69SV9wb2qR";
		//Test Account
		$this->apiLoginId = "4GK67Mkhu";
		$apiLogid = $this->apiLoginId;
		return $apiLogid;
	}
	function getTransactionKey()
	{
		//$this->transactionKey = "6W9Y72m48Dquy2Yq";
		//Test Account
		$this->transactionKey = "83s4G52pzPhHJ77y";
		$tranKey =  $this->transactionKey;
		return $tranKey;
	}
	function hmac($key, $data)
	{
		return (bin2hex (mhash(MHASH_MD5, $data, $key)));
		//return 1;
	}
	function CalculateFP($loginid, $x_tran_key, $amount, $sequence, $tstamp, $currency = "")
	{
		return (hmac($x_tran_key, $loginid . "^" . $sequence . "^" . $tstamp . "^" . $amount . "^" . $currency));
	}
	function InsertFP($loginid, $x_tran_key, $amount, $sequence, $currency = "")
	{
		$this->timeStamp = time ();
		$this->fingerPrint = $this->hmac($x_tran_key, $loginid . "^" . $sequence . "^" . $this->timeStamp . "^" . $amount . "^" . $currency);
		
		echo ('<input type="hidden" name="x_fp_sequence" value="' . $sequence . '">' );
		echo ('<input type="hidden" name="x_fp_timestamp" value="' . $this->timeStamp . '">' );
		echo ('<input type="hidden" name="x_fp_hash" value="' . $this->fingerPrint . '">' );
		return (0);
	}


}
?>
