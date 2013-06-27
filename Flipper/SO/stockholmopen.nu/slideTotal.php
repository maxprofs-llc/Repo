<?php
// TO ADD A SLIDE-PAGE WITH "CUSTOM" TEXT: EDIT THE slideCustom.tpl.php file

require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");
require_once(BASE_DIR . "models/class.Standings.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");

$iPostsPerPage = SLIDE_POSTS_PER_PAGE;

$aDispTotal = null;

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();
$oDivisionsToYears = new DivisionsToYears();

$iYear = $oHTTPContext->getString("iYear");
$bTotal = $oHTTPContext->getString("bTotal");
$bCustom = $oHTTPContext->getString("bCustom");
$iStart = $oHTTPContext->getString("iStart");
$iIndexDivision = $oHTTPContext->getString("iIndexDivision");
$bSwitch = $oHTTPContext->getString("bSwitch");
$bStart = $oHTTPContext->getString("bStart");

$iPosStart = $iStart;

// if it's the start of the slide, display custom-slide page
if($bStart)
{	
	$bCustom = true;
	$bStart = false;
	$iIndexDivision = 0;
	$iStart = 0;
}

if($bSwitch)
{
	$bTotal = true;
	$bCustom = false;
	$bSwitch = false;
}

if($iStart == null)
	$iStart = 0;

if($iYear == null)
	$iYear = YEAR;
IF($iIndexDivision == null)
	$iIndexDivision = 0;	
	
$aDivisions = $oDivisionsToYears->getDivisionsFromYear($iYear);
if(isset($aDivisions[$iIndexDivision]['division_name_short']))
	$oTemplate->assign("sDivision", $aDivisions[$iIndexDivision]['division_name_short']);

$iTotalNoOfDivisions = count($aDivisions);

// *** TOTAL/MAIN STANDINGS ***
if($bTotal)
{
	if($iIndexDivision == null)
		$iIndexDivision = 0;
		
	$oStandings = new Standings();
	
	$aStandings = $oStandings->getStandings($iYear, $aDivisions[$iIndexDivision]['division_name_short'], null, false);
	$iTotalStandingsForDivision = count($aStandings);
	
	// construct the array we want to be displayed (not all)
	$aDispTotal = array();
	for($i = $iStart; $i < ($iStart+$iPostsPerPage); $i++)
	{
		if(isset($aStandings[$i]))
			array_push($aDispTotal, $aStandings[$i]);
	}

	// if we go over the number of entries/standings for the division, time to go to the next division
	if(($iStart + $iPostsPerPage) > $iTotalStandingsForDivision)
	{
		$iStart = 0;
		$iIndexDivision++;
	}
	else
		$iStart = $iStart + $iPostsPerPage;

	// check if we've reached the end of all divisions
	if(($iIndexDivision+1) > $iTotalNoOfDivisions)
	{
		$iStart = 0;
		$bStart = true;
		$iIndexDivision = 0;
	}
}

if($aDispTotal == null && $bTotal == true)
{
	$oTemplate->assign("bNoOutPut", "true");
	$bSwitch = true;
}

// have to reset start here too, ehm
if($bCustom)
	$iStart = 0;

// get the number of players in the finals
$oDivisionsToYears = new DivisionsToYears();
$oTemplate->assign("iNoOfPlayersInFinals", $oDivisionsToYears->getNumberOfPlayersInFinals($iYear, $aDivisions[$iIndexDivision]['division_name_short']));

$oTemplate->assign("sLocation", $_SERVER['PHP_SELF']);
$oTemplate->assign("iYear", $iYear);
$oTemplate->assign("iStart", $iStart);
$oTemplate->assign("bTotal", $bTotal);
$oTemplate->assign("bStart", $bStart);
$oTemplate->assign("bSwitch", $bSwitch);
$oTemplate->assign("iIndexDivision", $iIndexDivision);

if($bCustom)
{
	// to ...kind of... get rid of the custom-page	
	$oTemplate->assign("bNoOutPut", true);
	$oTemplate->assign("bCustom", true);
	$oTemplate->assign("bSwitch", true);
	$oTemplate->display("slideCustom.tpl.php");
}
elseif($bTotal)
{
	$oTemplate->assign("aPlayers", $aDispTotal);
	$oTemplate->assign("bDisplayEntries", true);
	$oTemplate->assign("bIncludedFromSlide", true);
	$oTemplate->assign("iPosStart", $iPosStart);
	$oTemplate->display("slideTotal.tpl.php");
}

require_once(BASE_DIR . "includes/inc.end.php");
?>