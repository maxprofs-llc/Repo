<?php
function getYearsWithGallery($a_sFolder)
{
	$aYears = array();
	$iCurrentYear = date("Y");
	for($i = 2004; $i <= $iCurrentYear; $i++)
	{
		if(@is_dir($a_sFolder . $i))
			array_push($aYears, $i);
	}
	
	return $aYears;
}
?>