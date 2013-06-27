<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "models/class.Game.php");
require_once(BASE_DIR . "models/class.GamesInTournament.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.Entry.php");

$sTimeStart = microtime(true);
$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();
$oGame = new Game();
$oGamesInTournament = new GamesInTournament();
$oPlayer = new Player();
$oEntry = new Entry();
$oString = new String();
$sGameSearch = $oHTTPContext->getString("sGameSearch");
$bFromLink = $oHTTPContext->getString("bFromLink");

// if we come from a link, we want to get the *exact* game string
if(!$bFromLink)
	$aSearchGames = $oGame->searchGames($sGameSearch, true);
else
	$aSearchGames = null;

$bMultipleGames = false;
// check if we get multiple games on the search
if(count($aSearchGames) > 1)
	$bMultipleGames = true;	
else
{
	$iIDGame = $oGame->getGameIDFromName($sGameSearch);
	$aGameYearsAndDivisions = $oGamesInTournament->getGameYearAndDivisions($iIDGame);
	$aGames = array();
	$i = 0;
	foreach($aGameYearsAndDivisions as $game)
	{
		// some strange array storing here, print them if you need some guidance (!)
		$aTemp[0] = $game;
		$aGameAndEntryData = $oEntry->addEntryRoundsToGame($aTemp, $game['division_name_short'], $game['git_year_in_tournament']);
		$aGames[$i++] = $aGameAndEntryData[0];
	}
}

$iLimit = 10;
$oTemplate->assign("iLimit", $iLimit);
$oTemplate->assign("bShowAll", true);
$oTemplate->assign("bFromSearch", true);
$oTemplate->assign("sGameSearch", $sGameSearch);

if($sGameSearch == null)
{
	// empty search string
	$oTemplate->assign("bEmptyString", true);
	$oTemplate->display("errorPages/errorGameSearch.tpl.php");
}
if($bMultipleGames)
{
	// multiple games in the search
	$oTemplate->assign("bMultipleGames", true);
	$oTemplate->assign("aSearchGames", $aSearchGames);
	$oTemplate->display("errorPages/errorGameSearch.tpl.php");
}
if($sGameSearch == null)
{
	$oTemplate->assign("bGameNull", true);
	$oTemplate->display("errorPages/errorGameSearch.tpl.php");
}
elseif($aGames == null)
{
	$oTemplate->assign("bNotFound", true);
	// no search results
	$oTemplate->display("errorPages/errorGameSearch.tpl.php");
}
else
{
	$oTemplate->assign("aGames", $aGames);
	$oTemplate->display("game.tpl.php");
}

$sTimeEnd = microtime(true);
$oLogFile->writeSearch(LOG_FILE_SEARCH, ($sTimeEnd - $sTimeStart), "gameSearch", $sGameSearch);

require_once(BASE_DIR . "includes/inc.end.php");
?>
