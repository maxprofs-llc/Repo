<?php
function getYearsAndDivisionsWithFinals($a_sDir)
{
	$aYears = array();
	$iCurrentYear = date("Y");
	$aYearsAndDivisions = array();
	$iStore = 0;
	for($i = $iCurrentYear; $i >= 2004; $i--)
	{
		$sDir = $a_sDir . $i;
		if(@is_dir($sDir)) 
		{
    		if($rDh = @opendir($sDir))
    		{
        		while(($sFile = @readdir($rDh)) !== false) 
        		{
        			if($sFile != "." && $sFile != "..")
        			{
        				// we don't want any of the backup-files
        				if(substr($sFile,0,3) != "bak")
        				{
							// strip ".HTML" or ".html" from the division "name"
							$sDivision = str_ireplace(".html", null, $sFile);
							$aYearsAndDivisions[$iStore]['year'] = $i;
							$aYearsAndDivisions[$iStore]['division'] = $sDivision;
							$iStore++;
        				}
        			}
        		}
        	closedir($rDh);
    		}
		}	
	}
	
	return $aYearsAndDivisions;
}
?>