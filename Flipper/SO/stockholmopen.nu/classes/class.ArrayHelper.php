<?php
// some nifty array functions
class ArrayHelper
{	
	// formats an assoc array to a "plain" array based on the key
	public function assocToOrderedByKey($a_aArr, $a_sKey)
	{
		$aRet = array();
		foreach($a_aArr as $value)
		{
			array_push($aRet,$value[$a_sKey]);
		}
		
		return $aRet;
	}	
	
	// formats an assoc array to a "plain" array, there should only be ONE key in the array
	public function assocToOrdered($a_aArr)
	{
		$aRet = array();
		$sKey = $this->getFirstKey($a_aArr);
		foreach($a_aArr as $value)
		{
			array_push($aRet,$value[$sKey]);
		}
		
		return $aRet;
	}	
	
	// gets the (first) key in an array
	public function getFirstKey($a_aArr)
	{
		if(isset($a_aArr[0]))
		{
			$aKey = array_keys($a_aArr[0]);
			return $aKey[0];
		}
		else
		{
			return null;
		}
	}
	
	// splits lines into an array
	public function splitArray($a_aFile, $s_SplitString, $a_iNeededOffset)
	{
		$aReturn = array();
		foreach($a_aFile as $val)
		{	
			$chars = preg_split("/" . $s_SplitString . "/", $val);
			array_push($aReturn, htmlspecialchars($chars[$a_iNeededOffset]));
		}

		return $aReturn;
	}

	// merges two arrays and sets a divider between the values
	public function mergeTwoArraysWithDivider($a_aArr1, $a_aArr2, $a_sDivider, $a_iStart = null)
	{
			$aReturn = array();
			// make sure the length is the same
			if(count($a_aArr1) != count($a_aArr2))
			{
				return false;
			}
			else // same length on the arrays
			{
				// if we don't want to start from 0
				if($a_iStart != null)
					$i = $a_iStart;
				else
					$i = 0;				
				foreach($a_aArr1 as $val)
				{
					$sString = $val . $a_sDivider . $a_aArr2[$i];
					array_push($aReturn, $sString);
					$i++;
				}
				
				return $aReturn;
			}
	}

	// creates an array with indexes from x number of arrays , for smarty output
	public function createOutputArray($a_aArrays, $a_aIndexes)
	{
		$aReturn = array();
		
		// make sure the number of arrays is the same as no of indexes
		if(count($a_aArrays) != count($a_aIndexes))
		{
			return false;
		}
		else // right number of indexes and arrays
		{
			// loop through the arrays
			$i = 0;
			foreach($a_aArrays as $array)
			{
				// loop through all arrays
				$ii = 0;
				foreach($array as $val)
				{
					// store the value in the return array with the $i index, at position $ii
					$aReturn[$ii][$a_aIndexes[$i]] = $val;
					$ii++;
				}
				$i++;
			}
			return $aReturn;	
		}
	}
	
	public function verifyThatAllPositionsHasData($a_aArr)
	{
		foreach($a_aArr as $val)
		{
			if($val == null)
			{
				return false;
				break;
			}
		}
		
		return true;
	}
	
	public function removeDuplicatesByKey($a_aArr, $a_sKey)
	{
		$aRet = array();
		$aStored = array();
		foreach($a_aArr as $val)
		{
			if(!in_array($val[$a_sKey], $aStored))
			{
				array_push($aRet, $val);
				array_push($aStored, $val[$a_sKey]);
			}
		}
		
		return $aRet;
	}
}
?>