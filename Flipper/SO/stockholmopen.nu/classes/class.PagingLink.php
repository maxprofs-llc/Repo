<?php
require_once("class.URL.php");

class PagingLink
{
	public function buildPagingLinksFromArray($a_aOutput, $a_iStart, $a_iLimit, $a_sIndex, $a_sLink, $a_iNoInString, $a_sTruncEnd, $a_sSeparator, $a_cPrefix = null)
	{
		//printArray($a_aOutput);
		$oURL = new URL;

		$iCount = count($a_aOutput);
		// if there are less posts than the limit we don't want to have any links, right?!
		if($iCount < $a_iLimit)
			return null;
		
		if(is_array($a_aOutput) && $iCount > 1)
		{
			$aStarts = array();
			$aEnds = array();
			
			for($i = 0; $i < $iCount; $i++)
			{
				if(isset($a_aOutput[$i]))
				{
					if($i%$a_iLimit == 0)
					{
						array_push($aStarts, substr(($a_aOutput[$i][$a_sIndex]),0,$a_iNoInString) . $a_sTruncEnd);
						if(isset($a_aOutput[$i+($a_iLimit-1)]))
							array_push($aEnds, substr(($a_aOutput[$i+($a_iLimit-1)][$a_sIndex]),0,$a_iNoInString) . $a_sTruncEnd);
						else
						{
							array_push($aEnds, substr(($a_aOutput[$iCount-1][$a_sIndex]),0,$a_iNoInString) . $a_sTruncEnd);
						}
					}
				}
			}
			
			// check if the last start is the same as the last end, if so remove it
			$iCountStarts = count($aStarts);
			if($aStarts[$iCountStarts-1] == $aEnds[$iCountStarts-1])
				$aEnds[$iCountStarts-1] = null;
	
			$iCount = count($aStarts);
			$aRet = array();
			for($i = 0; $i < $iCount; $i++)
			{
				if($i < ($iCount-1))
					$sSeparator = $a_sSeparator;
				else
					$sSeparator = null;
					
				if(($i*$a_iLimit) == $a_iStart)
					array_push($aRet, $aStarts[$i] . " - " . $aEnds[$i] . $sSeparator);
				else
				{
					if(isset($aEnds[$i]))
						$sEnd = " - " . $aEnds[$i];
					else
						$sEnd = null;

					if($a_cPrefix == null)
					{
						$cPrefix = $oURL->getPrefixToUseForVar();
						// remove "&iStart=n" from the link
						$sReg = "#\&amp;iStart=(\d+)#";
						$a_sLink = preg_replace($sReg, null, $a_sLink);
						$a_sLink = preg_replace($sReg, null, $a_sLink);
					}
					else
						$cPrefix = $a_cPrefix;
						
					array_push($aRet, "<a href='" . $a_sLink . $cPrefix . "iStart=" . ($i*$a_iLimit) . "'>" . $aStarts[$i] . $sEnd . "</a>" . $sSeparator);
				}
			}
			
			return $aRet;
		}
		else
			return null;
	}
}
?>