<?php
function getYearsWithResults($a_sDir, $a_sFilePrefix, $a_sFileSuffix)
{
	$aYears = array();
	$iCurrentYear = date("Y");
	for($i = 2004; $i <= $iCurrentYear; $i++)
	{
		if(file_exists($a_sDir . $a_sFilePrefix . $i . $a_sFileSuffix))
			array_push($aYears, $i);		
	}
	return $aYears;
}
?>