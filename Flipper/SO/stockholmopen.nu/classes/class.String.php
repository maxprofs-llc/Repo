<?php
// various string functions
class String
{
	public function sanitizeAndFormatPosts($a_sString)
	{
		$a_sString = htmlspecialchars($a_sString);
		$a_sString = nl2br($a_sString);
		$aNotWanted = array("script", "object", "param", "applet", "link", "meta", "bgsound", "embed", "base", "basefont", "body", "button", "form", "frame", "iframe", "frameset", "head", "html", "ilayer", "input", "layer", "map", "noembed", "noframes", "nolayer", "noscript", "server", "textarea", "title");
	   	
		foreach ($aNotWanted as $delete) 
		{	
      		$a_sString = preg_replace('/<[[:space:]]*' . $delete . '[^<>]*>/i', "<!-- $delete tag deleted -->", $a_sString);
      		$a_sString = preg_replace('/<\/[[:space:]]*' . $delete . '[^<>]*>/i', "<!-- /$delete tag deleted -->", $a_sString);
   		}
   		
   		$a_sString = preg_replace('/([a-z_-]+script|vbs)\:/i', "Scripts not allowed here", $a_sString);
   		$a_sString = preg_replace('/view-source\:/i', "", $a_sString);
   		$a_sString = preg_replace('/about\:blank/i', "", $a_sString);
  		$a_sString = preg_replace('/[a-z]\:[\/'.preg_quote("\\").']nul[\/'.preg_quote("\\").']nul/i', "", $a_sString);
   
  		return $a_sString;	

	}
	
	public function sanitizeAndFormatPostsInArray($a_aArr, $a_sKey)
	{
		$iCount = count($a_aArr);
		for($i = 0; $i < $iCount; $i++)
		{
			$a_aArr[$i][$a_sKey] = $this->sanitizeAndFormatPosts($a_aArr[$i][$a_sKey]);
		}
		return $a_aArr;
	}
	
	public function stripHttp($a_sString)
	{
		$aPatterns[0] = '/http:\/\//';
		$aReplacements[0] = '';
		return preg_replace($aPatterns, $aReplacements, $a_sString);
	}
	
	public function makeURL($a_sString)
	{
		if($a_sString != null)
		{
			if(substr($a_sString,0,7) != "http://")
			return "http://" . $a_sString;
				else
			return $a_sString;
		}
		else
		{
			return null;
		}
	}
	
	public function antiSpamEmail($a_sEmailAddress)
	{
		return str_replace("@", "(at)", $a_sEmailAddress);
	}
	
	public function getDateFromDateTime($a_sDate)
	{
		return substr($a_sDate,2,8);
	}
	
	public function getDateFromDateTimeInArray($a_aArr, $a_sKey)
	{	
		$iCount = count($a_aArr);
		for($i = 0; $i < $iCount; $i++)
		{
			$a_aArr[$i][$a_sKey] = $this->getDateFromDateTime($a_aArr[$i][$a_sKey]);
		}
		return $a_aArr;
	}
	
	
	public function formatDateTime($a_sDate)
	{
		return substr($a_sDate,2,8) . " " . substr($a_sDate,11,5);
	}
	
	public function formatDateTimeInArray($a_aArr, $a_sKey)
	{	
		$iCount = count($a_aArr);
		for($i = 0; $i < $iCount; $i++)
		{
			$a_aArr[$i][$a_sKey] = $this->formatDateTime($a_aArr[$i][$a_sKey]);
		}
		return $a_aArr;
	}
	
	public function stripNonNumericChars($a_sString)
	{
		// not sure which PHP function that actually does what I want here
		// so...whatever...
		
		$aAllowed = array("1","2","3","4","5","6","7","8","9","0");
		$iStrLength = strlen($a_sString);
		$sRet = null;
		for($i = 0; $i < $iStrLength; $i++)
		{
			$cChar = substr($a_sString, $i, 1);
			if(in_array($cChar, $aAllowed))
				$sRet .= $cChar;
		}

		return $sRet;
	}
	
	public function endingWithZero($a_sString)
	{
		$iStrLen = strlen($a_sString);
		if(substr($a_sString, ($iStrLen-1), 1) != "0")
			return false;
		else
			return true;			
	}
	
	// written by Luka Petric a long time ago. I'll leave it like this since it works
	// just fine
	public function punctuation($hs)
	{
		$poang = null;
		if($hs > 100)
	 	{
	 	 	$langd = strlen($hs);
	 		//$antalp = floor($langd/3); not used?
	 	 	$go=true;
	
			while($go)
			{
				$delstring[]=substr($hs,$langd-3,3);
				$langd-=3;
				if($langd<3)
				{
					$go=false;
					$delstring[]=substr($hs,0,$langd);
				}
			}
	 
	 		for($i=count($delstring);$i>-1;$i--)
	 		{
	 			if(isset($delstring[$i]))
	 			{
		 			$delstring[$i] = trim($delstring[$i]);
		 			
			 		if($delstring[$i]!="")
					{
						if($i!=0)
						{
							$poang= $poang . $delstring[$i] . ".";
		 				}
		 				else
		 				{
		 					$poang= $poang . $delstring[$i];
		 				}
		 			}
	 			}
	 		}
	 	}
	 	else
	 	{
	 		$poang = $hs;
	 	}
		
	 	return($poang);
	}
	
	public function pinScore($iScore)
	{
	 	$sPinScore = null;
		$iStrLen = strlen($iScore);
	 	$sSuffix = null;
	 	
		if($iStrLen == 13)
		{
			$sPinScore = substr($iScore,0,1);
			$sPinScore2 = substr($iScore,1,3);
			$sPinScore = $sPinScore.'.'.$sPinScore2;
			$sSuffix = 'Trillion';
		}
	 
		if($iStrLen == 12)
		{
			$sPinScore = substr($iScore,0,3);
			$sPinScore2 = substr($iScore,3,1);
			$sPinScore = $sPinScore.'.'.$sPinScore2;
			$sSuffix = "B";
		}
	
		if($iStrLen == 11)
		{
			$sPinScore = substr($iScore,0,2);
			$sPinScore2 = substr($iScore,2,1);
			$sPinScore = $sPinScore.'.'.$sPinScore2;
			$sSuffix = "B";
		}
	
		if($iStrLen == 10)
		{
			$sPinScore = substr($iScore,0,1);
			$sPinScore2 = substr($iScore,1,1);
			$sPinScore = $sPinScore.'.'.$sPinScore2;
			$sSuffix = "B";
		}
	
		if($iStrLen == 9)
		{
			$sPinScore = substr($iScore,0,3);
			$sPinScore2 = substr($iScore,3,1);
			$sPinScore = $sPinScore.'.'.$sPinScore2;
			$sSuffix = "M";
		}
	
		if($iStrLen == 8)
		{
			$sPinScore = substr($iScore,0,2);
			$sPinScore2 = substr($iScore,2,1);
			$sPinScore = $sPinScore.'.'.$sPinScore2;
			$sSuffix = 'M';
		}
	
		if($iStrLen == 7)
		{
			$sPinScore = substr($iScore,0,1);
			$sPinScore2 = substr($iScore,1,1);
			$sPinScore = $sPinScore.'.'.$sPinScore2;
			$sSuffix = 'M';
		}
	
		if($iStrLen == 6)
		{
			$sPinScore = substr($iScore,0,3);
			$sPinScore2 = substr($iScore,3,1);
			$sPinScore = $sPinScore.'.'.$sPinScore2;
			$sSuffix = 'K';
		}
	
		if($iStrLen == 5)
		{
			$sPinScore = substr($iScore,0,2);
			$sPinScore2 = substr($iScore,2,1);
			$sPinScore = $sPinScore.'.'.$sPinScore2;
			$sSuffix = 'K';
		}
	
		if($iStrLen == 4)
		{
			$sPinScore = substr($iScore,0,1);
			$sPinScore2 = substr($iScore,1,1);
			$sPinScore = $sPinScore.'.'.$sPinScore2;
			$sSuffix = 'K';
		}
	
		if($iStrLen == 3)
		{
			$sPinScore = $iScore;
		}
	
		if($iStrLen == 2)
		{
			$sPinScore = $iScore;
		}
	
		if($iStrLen == 1)
		{
			$sPinScore = $iScore;
		}
	
		$iStrLen = strlen($sPinScore);
		if($sPinScore != 0)
		{
			if(substr($sPinScore, ($iStrLen-2), 2) == ".0")
				$sPinScore = substr($sPinScore, 0, ($iStrLen-2));
		}	
				
		return $sPinScore . $sSuffix;
	}
	
	public function truncate($a_sStr, $a_iLength, $a_sSuffix = null)
	{
		if(strlen($a_sStr) > $a_iLength)
			return substr($a_sStr, 0, $a_iLength) . $a_sSuffix;
		else
			return $a_sStr;
	}
	
	/*
	public function cleanPlayerSearchString($a_sStr)
	{
		// will remove a (nnnn) pattern, a la (2007)
		$sReg = "#\((\d+)\)#";
		return trim(preg_replace($sReg, "", $a_sStr));
	}
	*/
	
	public function mySQLTimestampToSimpleDateTime($sDate)
	{
//		return substr($sDate, 8, 2) . "/" . substr($sDate, 5, 2) . " " . substr($sDate, 11, 5);
		return substr($sDate, 0, 10) . " " . substr($sDate, 11, 5);
	}
}
