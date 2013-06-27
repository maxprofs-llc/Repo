<?php
require_once("class.LogFile.php");

class ScoreRange
{
	private $sFolder = null;
	private $oLogFile = null;
		
	public function __construct($a_sFolder)
	{
		$this->sFolder = $a_sFolder;
		$this->oLogFile = new LogFile();
	}
	
	public function parseScoreRangeFile($a_iYear, $a_sDivision)
	{
		$sFileName = $this->sFolder . $a_sDivision . "/scoreRange." .$a_iYear . ".txt";
		// if the file doesn't exits: copy last years file
		$a_iTempYear = $a_iYear - 1;	
		$sOldFile = $this->sFolder . $a_sDivision . "/scoreRange." . $a_iTempYear . ".txt";
		@copy($sOldFile, $sFileName);

		if(!file_exists($sFileName))
		{
			echo "The score file doesn't exist. Aborting";
			// write to the error log
			$this->oLogFile->writeScoreFileErrorLog($a_iYear);
			exit;
		}
		
		$aArr = array();
		$rFileHandle = fopen($sFileName, 'r');
		while (!feof($rFileHandle)) 
		{
   			$line = fgets($rFileHandle);
			array_push($aArr, $line);
		}
		fclose($rFileHandle);
		
		return $aArr;	
	}
	
	public function getTopScore($a_iYear, $a_sDivision)
	{
		$aScores = $this->parseScoreRangeFile($a_iYear, $a_sDivision);
		return $aScores[0];
	}
}