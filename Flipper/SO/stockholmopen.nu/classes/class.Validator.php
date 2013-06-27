<?php
class Validator
{
	public function validEmail($a_sEmail)
	{
		if (preg_match('/^[a-z0-9._-]+@[a-z0-9._-]+\.([a-z]{2,4})$/i', $a_sEmail))
		{ 
			return true;	
		}
		else
		{
			return false;
		}
	}
	
	public function validValues($a_aValidValues, $a_mValue)
	{
		if(is_array($a_aValidValues))
		{
			if(in_array($a_mValue, $a_aValidValues))
				return true;
			else
				return false;
		}
		else
			return false;
	}
	
	public function validValuesInArray($a_aValidValues, $a_aValue)
	{
		foreach($a_aValue as $val)
		{
			if(!$this->validValues($a_aValidValues, $val))
				return false;
		}
		
		return true;
	}
	
	public function validYear($a_iStart, $a_iStop, $a_mValue)
	{
		for($i = $a_iStart; $i <= $a_iStop; $i++)
		{
			if($i == $a_mValue)
				return true;
		}
		
		return false;
	}
	
	public function validMonthNo($a_mValue)
	{
		$aMonths = array("01","02","03","04","05","06","07","08","09","10","11","12");
		if(!$this->validValues($aMonths, $a_mValue))
			return false;
		else
			return true;			
	}
	
	public function validDayNo($a_mValue)
	{
		$aMonths = array("01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31");
		if(!$this->validValues($aMonths, $a_mValue))
			return false;
		else
			return true;			
	}
	
	public function validHttpURL($a_sUrl)
	{
		if(preg_match("#^http://[a-zA-Z0-9\\-\\.]+\\.[a-zA-Z]{2,5}#", $a_sUrl)) 
        	return true;
		else
			return false; 
	}
	
	public function uniqueValuesInArray($a_aArr)
	{
		$aChecked = array();		
		foreach($a_aArr as $val)
		{
			if(in_array($val, $aChecked))
				return false;
			array_push($aChecked, $val);			
		}
		
		return true;
	}
	
	function validDate($a_sDate)
	{
		if(preg_match("/^\d{4}-(((0[13578]|1[02])-([0-2]\d$|3[01]$))|((0[469]|11)-([0-2]\d$|30$))|((02-([0-1]\d$)|02-2[0-8])))|((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))-02-29$/", $a_sDate)) 
        	return true;
		else
			return false;	
	}

	// validates a time in the hh:mm:ss format
	function validTime($a_sTime)
	{
		if(preg_match("/^([1-9]|1[0-2]):[0-5]\d(:[0-5]\d(\.\d{1,3})?)?$/", $a_sTime)) 
        	return true;
		else
			return false;	
	}
	
	// validates a date-time string in the YYYY-MM-DD HH:ii:ss format
	function validDateTime($dateTime)
	{
		if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $dateTime, $matches)) 
		{
			if (checkdate($matches[2], $matches[3], $matches[1])) 
			{
				return true;
			}
		}
		return false;
	}
	
	/*
	function validDateTime($a_sDateTime)
	{
		$sDate = substr($a_sDateTime, 0, 10);
		$sTime = substr($a_sDateTime, 11, 8);
		if(!$this->validDate($sDate))
			return false;
		elseif(!$this->validTime($sTime))
			return false;
		else
			return true;
	}
	*/
	
	function checkValidIp($ip)
	{
		if(!eregi("^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$",$ip)) 
			$return = FALSE;
		else 
			$return = TRUE;

		$tmp = explode(".", $ip);

		if($return == TRUE)
		{
			foreach($tmp AS $sub)
			{
				$sub = $sub * 1;
				if($sub<0 || $sub>256) 
					$return = FALSE;
			}
		}
		return $return;
	}

	function numberInRange($a_iStart, $a_iEnd, $a_iNumber)
	{
		// strip a leading "0" if the number is more than two chars
		// and starts with "0"
		$iStrLen = strlen($a_iNumber);
		if((substr($a_iNumber,0,1) == "0") && ($iStrLen > 1))
			$iNumber = substr($a_iNumber, 1, $iStrLen);
		else
			$iNumber = $a_iNumber;

		if($iNumber < $a_iStart)
			return false;
		elseif($iNumber > $a_iEnd)
			return false;
		else
			return true;
	}
	
	function positiveInt($inData)
	{
		if($inData == null)
			return false;
		
		if($inData == 0)
			return false;	
			
		if(preg_match('/^[0-9]+$/', $inData))
			return true;
		else
			return false;
	}
}
?>