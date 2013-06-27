<?php
ini_set("max_execution_time", 600);
ini_set("memory_limit", "64M");

// well... we want to exclude the init-file... ehm
$bExcludeInit = true;
if(!isset($bNoConfig))
	require_once("../config/inc.config.php");

require_once(BASE_DIR . "classes/class.LogFile.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.ScoreRange.php");
require_once(BASE_DIR . "functions/func.detectCommandLine.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "models/class.Entry.php");
require_once(BASE_DIR . "models/class.TournamentStats.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");
require_once(BASE_DIR . "models/class.User.php");
require_once(BASE_DIR . "models/class.Standings.php");


// detect if we're running from command line or not
if(!detectCommandLine())
{
	// if we're not running from command-line we have to be logged in as uber-admin
	$oUser = new User();
	// make sure the user is a scorekeep admin
	loginRedirectUserAdmin($oUser, "admin_scorekeep");
}

if(DISABLE_STANDINGS_CALC)
{
	echo "The standings calculation was disabled at " . date("Y-m-d H:i:s") . ", aborting\n";
	echo "----------------------------------------------------------------------------\n";
	exit;
}

$oHTTPContext = new HTTPContext();
$oScoreRange = new ScoreRange(TXT_FILE_SCORE_RANGE_FOLDER);
$oLogFile = new LogFile();
$oEntry = new Entry();
$oStandings = new Standings();
//$oTournamenStats = new TournamentStats();
//$oTournamenStats->setStats();

$iYear = $oHTTPContext->getInt("iYear");
if($iYear == null)
	$iYear = YEAR;

if(!isset($bNoOutput))
	echo "Started calculating standings for $iYear at " . date("Y-m-d H:i:s") . "\n";
	
$oDivisionsToYears = new DivisionsToYears();
$aDivisions = $oDivisionsToYears->getDivisionsFromYear($iYear);

// loop through all divisions and update them
foreach($aDivisions as $division)
{
	if(COUNT_CALC_STANDINGS_TIME == true)
	{
		$oLogFile = new LogFile();
		$sTimeStart = microtime(true);
	}

	$aScoreRange = $oScoreRange->parseScoreRangeFile($iYear, $division['division_name_short']);

	$oEntry->calculateAllEntries($iYear, $aScoreRange, $division['division_name_short']);
	
	// *** FIXING OF SAME ENTRY-SCORES
	// set all players average entry-score
	$oEntry->setAverageEntryScores($iYear, $division['division_name_short']);
	// let's fix the same-score spots... not sure if this is needed though?!
	$oStandings->correctPositions($iYear, $division['division_name_short']);
	// *** END OF FIXING OF SAME ENTRY-SCORES

	if(COUNT_CALC_STANDINGS_TIME == true)
	{
		$sTimeEnd = microtime(true);
		$sTime = $sTimeEnd - $sTimeStart;
		$oLogFile->writeTimeCalcStandings(LOG_FILE_CALC_STANDINGS, $sTime, $iYear, $division['division_name_short']);	
	}
}


$sTime = microtime(true) - PAGE_LOAD_START;

if(!isset($bNoOutput))
{
	echo "Done calculating standings for $iYear at " . date("Y-m-d H:i:s") . "\n";
	echo "It took " . round($sTime,2) . " seconds\n";
	echo "----------------------------------------------------------------------------\n";
}
?>