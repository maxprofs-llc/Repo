<?php
require_once(BASE_DIR . "classes/class.LogFile.php");
require_once("database/MDB2.php");

class MDB2Wrapper
{
    private $oDB = null;

    public function __construct($a_oDB)
    {
		$this->oDB =& $a_oDB;
    }
	
	public function query($a_sQueryType, $a_sQuery)
	{
		$aAllowedTypes = array("query", "queryAll", "exec");
		if(!in_array($a_sQueryType, $aAllowedTypes))
			die("The query-type: <i>" . $a_sQueryType . "</i> cannot be used. Aborting... everything.");
		
		$oLogFile = new LogFile();
		$sTimeStart = microtime(true);
			
		if($a_sQueryType == "query")
			$mRes = $this->oDB->query($a_sQuery);

		if($a_sQueryType == "queryAll")
			$mRes = $this->oDB->queryAll($a_sQuery);
	
		if($a_sQueryType == "exec")
			$mRes = $this->oDB->exec($a_sQuery);

		//printArray($this->oDB);

		$sTimeEnd = microtime(true);
		$sTime = $sTimeEnd - $sTimeStart;
	
		if (PEAR::isError($mRes)) 
		{
			if(LOG_QUERY_ERRORS)
			{
				$oLogFile->writeQueryError(LOG_FILE_QUERY_ERRORS, $a_sQuery, $sTime);
			}

			if(DISPLAY_QUERY_ERRORS)
			{
				echo "<h2>Query Error:</h2>";
				echo "$a_sQuery<br />";
				trigger_error($mRes->getMessage(), E_USER_ERROR);
				$mRes = null;
			}
			
		}		
		
		if($sTime > SLOW_QUERY_TIME)
			$oLogFile->writeSQLQueryTime(LOG_FILE_SLOW_QUERY, $a_sQuery, $sTime);	
		
		if(LOG_QUERY)
			$oLogFile->writeQuery(LOG_FILE_QUERY, $a_sQuery, $sTime);		

		// this is used to log each page's queries, pretty useless in a ive environment, since it logs ALL user's queries, and flushes the file
		if(LOG_PAGE_QUERY)
			$oLogFile->writePageQuery(LOG_FILE_PAGE_QUERY, $a_sQuery, $sTime);		

		return $mRes;
	}
}
?>