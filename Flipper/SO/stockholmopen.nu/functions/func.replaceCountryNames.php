<?php
function replaceCountryNames($a_aArr, $a_sConfigFile, $a_bMakeOrdered = false)
{
	// read the smarty config file to an array
	$aLines = file($a_sConfigFile);
	$aCountryNameArr = array();
	foreach($aLines as $val)
	{
		$aSplit =  preg_split('/=/', $val, -1);
		// put it in an array a la: array[C_SV] = Sverige
		$aCountryNameArr[$aSplit[0]] = $aSplit[1];
	}

	$i = 0;
	foreach($a_aArr as $value)
	{
		$a_aArr[$i]['country_name'] = $aCountryNameArr[$value['country_def']];
		$i++;
	}
	
	$aRet = $a_aArr;
	
	// create an ordered list with just the country names
	if($a_bMakeOrdered == true)
	{
		$i = 0;
		foreach($a_aArr as $value)
		{
			$aRet[$i] = $a_aArr[$i]['country_name'];
			$i++;
		}
	}

	return $aRet;
}
?>