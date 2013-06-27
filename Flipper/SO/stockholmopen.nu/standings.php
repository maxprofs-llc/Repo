<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.LogFile.php");
require_once(BASE_DIR . "models/class.Standings.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);

// if we've decidede to use caching
if(TEMPLATE_CACHING)
{
	$oTemplate->caching = true;
	$oTemplate->cache_lifetime = TEMPLATE_CACHE_TIME_STANDINGS; 
}

// only do all this if the template isn't cached, or if we've decided to not use caching
if(!$oTemplate->is_cached('standings.tpl.php', $_SERVER['REQUEST_URI']) || !TEMPLATE_CACHING) 
{
	$oHTTPContext = new HTTPContext();
	$oStandings = new Standings();
	
	$iYear = $oHTTPContext->getInt("iYear");
	$sDivision = $oHTTPContext->getString("sDivision");
	$sSort = $oHTTPContext->getString("sSort");
	
	if($iYear == null)
		$iYear = YEAR;
	if($sDivision == null)
		$sDivision = "A";
	
	if(COUNT_GET_STANDINGS_TIME == true)
	{
		$oLogFile = new LogFile();
		$sTimeStart = microtime(true);
	}
			
	$aStandings = $oStandings->getStandings($iYear, $sDivision, $sSort, false);
	
	if(COUNT_GET_STANDINGS_TIME == true)
	{
		$sTimeEnd = microtime(true);
		$sTime = $sTimeEnd - $sTimeStart;
		$oLogFile->writeTimeGetStandings(LOG_FILE_GET_STANDINGS, $sTime, $iYear, $sDivision);	
	}
	
	// get the number of players in the finals
	$oDivisionsToYears = new DivisionsToYears();
	$oTemplate->assign("iNoOfPlayersInFinals",$oDivisionsToYears->getNumberOfPlayersInFinals($iYear, $sDivision));
	$oTemplate->assign("aPlayers", $aStandings);
	$oTemplate->assign("bDisplayEntries", true);
	$oTemplate->assign("iYear", $iYear);
	$oTemplate->assign("sDivision", $sDivision);
	$oTemplate->assign("sSort", $sSort);
	$oTemplate->assign("sLinkMain", $_SERVER['PHP_SELF'] . "?iYear=" . $iYear . "&amp;sDivision=" . $sDivision);
}

$oTemplate->display("standings.tpl.php", $_SERVER['REQUEST_URI']);

require_once(BASE_DIR . "includes/inc.end.php");
?>
