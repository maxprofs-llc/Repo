<?php
require_once("class.IP.php");
require_once(BASE_DIR . "models/class.User.php");

class LogFile
{
	public function appendFile($a_sFileName, $a_sText)
	{
		$rFileHandle = fopen($a_sFileName, "a");
		fwrite($rFileHandle, $a_sText);
		fclose($rFileHandle);			
	}

	public function writeToFile($a_sFileName, $a_sText)
	{
		$rFileHandle = fopen($a_sFileName, "w");
		fwrite($rFileHandle, $a_sText);
		fclose($rFileHandle);			
	}	

	public function deleteFile($a_sFileName)
	{
		if(@file_exists($a_sFileName))
			unlink($a_sFileName);
	}
	
	public function writeActiveUsers($a_sFileName, $a_aActiveUsers, $a_aActiveGuests)
	{
		// build the string that contains users, and guests
		$sUsers = null;
		foreach($a_aActiveUsers as $user)
		{
			$sUsers.= $user['user_username'] . ",";
		}
		
		foreach($a_aActiveGuests as $guest)
		{
			$sUsers.= "Guest,";
		}
		
		// strip the last "," from the string
		$sUsers = substr($sUsers,0,(strlen($sUsers) - 1));		
		$iCount = count($a_aActiveGuests) + count($a_aActiveUsers);
		
		$sText = date("Y-m-d H:i:s") . " - ";
		$sText.= "Total: " . $iCount . " - ";
		$sText.= $sUsers . "\n";
		$this->appendFile($a_sFileName, $sText);		
	}
	
	public function writeQueryError($a_sFileName, $a_sQuery, $a_sTime)
	{
		$aStrip = array("\t");
		$a_sQuery = str_replace($aStrip, "", $a_sQuery);
		$sText = "Page: " . $_SERVER['PHP_SELF'] . " - ";
		$sText.= date("Y-m-d H:i:s") . " - ";
		$sText.= "Time: " . round($a_sTime,8) . "\n";
		$sText.= $a_sQuery . "\n";
		$sText.= "\n";		
		$this->appendFile($a_sFileName, $sText);
	}	
	
	public function writeQuery($a_sFileName, $a_sQuery, $a_sTime, $a_sbPage = false, $a_bDebug = false)
	{
		$aStrip = array("\t");
		$a_sQuery = str_replace($aStrip, "", $a_sQuery);
		$sText = "Page: " . $_SERVER['PHP_SELF'] . " - ";
		$sText.= date("Y-m-d H:i:s") . " - ";
		$sText.= "Time: " . round($a_sTime,8) . "\n";
		$sText.= $a_sQuery . "\n";
		$sText.= "\n";		
		
		// if it's the single-page-queries
		if($a_sbPage)
		{
			if(!defined('OVERRIDE_QUERY_PAGE_WRITE'))
			{
				$oUser = new User();
				$sUserName = $oUser->getLoggedInUsername();
				if($sUserName != null)
				{
					// if it's the debug and the user is logged in, use the users name as suffix to the file
					$this->appendFile($a_sFileName . "." . $sUserName, $sText);					
				}
				else
					$this->appendFile($a_sFileName, $sText);
			}
		}
		else
		{
			// the normal queries
			$this->appendFile($a_sFileName, $sText);
		}
	}

	public function writePageQuery($a_sFileName, $a_sQuery, $a_sTime, $a_bDebug = false)
	{
		$this->writeQuery($a_sFileName, $a_sQuery, $a_sTime, true, $a_bDebug);			
	}
	
	public function writePageLoad($a_sFileName)
	{
		$oUser = new User();
		$sUserName = $oUser->getLoggedInUsername();
		if($sUserName == null)
			$sUserName = "John Doe";
			
		$oIP = new IP();
		$sText = date("Y-m-d H:i:s") . " - ";
		$sText.= $oIP->getUserIP() . " - ";
		$sText.= $sUserName . " - ";
		$sText.= $_SERVER['PHP_SELF'];		
		if($_SERVER['QUERY_STRING'] != null)
			$sText.= "?" . $_SERVER['QUERY_STRING'];
		$sText.="\n";
		$this->appendFile($a_sFileName, $sText);
	}
	
	public function writePageData($a_sFileName, $a_sTime, $a_sMemoryUsagePeak, $a_sMemoryUsage)
	{
		$sText = date("Y-m-d H:i:s") . " - ";
		$sText.= $_SERVER['PHP_SELF'];
		if(isset($_SERVER['QUERY_STRING']))
		{		
			if($_SERVER['QUERY_STRING'] != null)
				$sText.= "?" . $_SERVER['QUERY_STRING'];
		}
		$sText.= " - ";		
		$sText.= "Time: " . round($a_sTime, 2) . " - ";
		$sText.= "MemPeak: " . $a_sMemoryUsagePeak . " - ";
		$sText.= "Mem: " . $a_sMemoryUsage . "\n";
		$this->appendFile($a_sFileName, $sText);
	}
	
	public function writeEntryAction($a_sFileName, $a_sUserName, $a_iIDEntry, $a_sType)
	{
		$oIP = new IP();
		$sText = date("Y-m-d H:i:s") . " - ";
		$sText.= "Entry ID: " . $a_iIDEntry . " - ";
		$sText.= "Action: " . $a_sType . " - ";
		$sText.= "By: " . $a_sUserName . " - ";
		$sText.= "IP: " . $oIP->getUserIP() . "\n";
		$this->appendFile($a_sFileName, $sText);		
	}

	public function writeTeamAction($a_sFileName, $a_sUserName, $a_iIDTeam, $a_sType)
	{
		$oIP = new IP();
		$sText = date("Y-m-d H:i:s") . " - ";
		$sText.= "Team ID: " . $a_iIDTeam . " - ";
		$sText.= "Action: " . $a_sType . " - ";
		$sText.= "By: " . $a_sUserName . " - ";
		$sText.= "IP: " . $oIP->getUserIP() . "\n";
		$this->appendFile($a_sFileName, $sText);		
	}	
	
	public function writeScoreFileErrorLog($a_iYear)
	{
		$sText = date("Y-m-d H:i:s") . " - ";
		$sText.= "Could not open the score range file for " . $a_iYear . " - ";
		$sText.= "File: " . $_SERVER['PHP_SELF'] . "\n";
		$this->appendFile(LOG_FILE_ERROR_LOG, $sText);
			
	}

	public function writeEntryRoundNumberError($a_iYear, $a_sDivision)
	{
		$sText = date("Y-m-d H:i:s") . " - ";
		$sText.= "Missing entry-rounds / entry number for: " . $a_iYear . " and " . $a_sDivision . " - ";
		$sText.= "File: " . $_SERVER['PHP_SELF'] . "\n";
		$this->appendFile(LOG_FILE_ERROR_LOG, $sText);			
	}	
	
	public function writeCalculateScoreDivisionErrorLog($a_sFileName, $a_iYear, $a_sDivision)
	{
		$sText = date("Y-m-d H:i:s") . " - ";
		$sText.= "The selected division (". $a_sDivision .") is not used " . $a_iYear . " - ";
		$sText.= "File: " . $_SERVER['PHP_SELF'] . "\n";
		$this->appendFile($a_sFileName, $sText);
			
	}
	
	public function writeSQLQueryTime($a_sFileName, $a_sQuery, $a_sTime)
	{
		$sText = date("Y-m-d H:i:s") . " - ";
		$sText.= "Query: " . $a_sQuery . " - ";
		$sText.= "Time: " . round($a_sTime, 5) . " - ";
		$sText.= "File: " . $_SERVER['PHP_SELF'] . "\n";
		$this->appendFile($a_sFileName, $sText);
	}
	
	public function writeTimeCalcStandings($a_sFileName, $a_sTime, $a_iYear, $a_sDivision)
	{
		$sText = date("Y-m-d H:i:s") . " - ";
		$sText.= "Time: " . round($a_sTime, 2) . " - ";
		$sText.= "Year: " . $a_iYear . " - ";
		$sText.= "Division: " . $a_sDivision . " - ";
		$sText .= "File: " . $_SERVER['PHP_SELF'] . "\n";
		$this->appendFile($a_sFileName, $sText);
	}
	
	public function writeTimeGetStandings($a_sFileName, $a_sTime, $a_iYear, $a_sDivision)
	{
		$sText = date("Y-m-d H:i:s") . " - ";
		$sText.= "Time: " . round($a_sTime, 2) . " - ";
		$sText.= "Year: " . $a_iYear . " - ";
		$sText.= "Division: " . $a_sDivision . " - ";
		$sText.= "File: " . $_SERVER['PHP_SELF'] . "\n";
		$this->appendFile($a_sFileName, $sText);
	}
	
	public function writeTimeGetGame($a_sFileName, $a_sTime, $a_iYear, $a_iGameID)
	{
		$sText = date("Y-m-d H:i:s") . " - ";
		$sText.= "Time: " . round($a_sTime, 2) . " - ";
		$sText.= "Year: " . $a_iYear . " - ";
		$sText.= "Game ID: " . $a_iGameID . " - ";
		$sText.= "File: " . $_SERVER['PHP_SELF'] . "\n";
		$this->appendFile($a_sFileName, $sText);
	}
	
	public function writeTimeSetEntryRoundScoreForGame($a_sFileName, $a_sTime, $a_iYear, $a_iGameID)	
	{
		$sText = "Method: setEntryRoundScoreForGame() - ";
		$sText.= date("Y-m-d H:i:s") . " - ";
		$sText.= "Time: " . round($a_sTime, 2) . " - ";
		$sText.= "Year: " . $a_iYear . " - ";
		$sText.= "Game ID: " . $a_iGameID . "\n";
		$this->appendFile($a_sFileName, $sText);				
	}
	
	public function writeTimeSetEntryData($a_sFileName, $a_sTime, $a_iYear)	
	{
		$sText = "Method: setEntryData() - ";
		$sText.= date("Y-m-d H:i:s") . " - ";
		$sText.= "Time: " . round($a_sTime, 2) . " - ";
		$sText.= "Year: " . $a_iYear . "\n";
		$this->appendFile($a_sFileName, $sText);				
	}	

	public function writeTimeSetEntryPositions($a_sFileName, $a_sTime, $a_iYear, $a_sDivision)	
	{
		$sText = "Method: setEntryPositions() - ";
		$sText.= date("Y-m-d H:i:s") . " - ";
		$sText.= "Time: " . round($a_sTime, 2) . " - ";
		$sText.= "Year: " . $a_iYear . " - ";
		$sText.= "Division: " . $a_sDivision . "\n";
		$this->appendFile($a_sFileName, $sText);				
	}
	
	public function writeSearch($a_sFileName, $a_sTime, $a_sType, $a_sString)
	{
		$oIP = new IP();
		$sText = date("Y-m-d H:i:s") . " - ";	
		$sText.= "IP: " . $oIP->getUserIP() . " - ";
		$sText.= "Search Type: " . $a_sType . " - ";
		$sText.= "Search String: " . $a_sString . " - ";
		$sText.= "Time: " . round($a_sTime, 2) . "\n";
		$this->appendFile($a_sFileName, $sText);
	}
	
	public function writeLogin($a_sFileName, $a_sUserName)
	{
		$oIP = new IP();
		$sText = date("Y-m-d H:i:s") . " - ";
		$sText.= "IP: " . $oIP->getUserIP() . " - ";
		$sText.= "Username: " . $a_sUserName . "\n";
		$this->appendFile($a_sFileName, $sText);
	}
	
	public function writeFailedForm($a_sFileName, $a_sFormName, $a_sError = null)
	{
		$oIP = new IP();
		$sText = date("Y-m-d H:i:s") . " - ";
		$sText.= "IP: " . $oIP->getUserIP() . " - ";
		$sText.= "Form: " . $a_sFormName;
		
		if($a_sError != null)
			$sText.= " - Error: " . $a_sError;
			
		$sText.="\n";
		
		$this->appendFile($a_sFileName, $sText);
	}
}
?>
