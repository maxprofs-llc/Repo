<?php
// TO ADD A SLIDE-PAGE WITH "CUSTOM" TEXT: EDIT THE slideCustom.tpl.php file
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "models/class.Entry.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.Standings.php");
require_once(BASE_DIR . "models/class.Game.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");

$iPostsPerPage = SLIDE_POSTS_PER_PAGE;

$aDispTotal = null;
$aDispGames = null;
$aGames = null;

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();
$oDivisionsToYears = new DivisionsToYears();
$oEntry = new Entry();
$oPlayer = new Player();

$iYear = $oHTTPContext->getString("iYear");
$bTotalAndGames = $oHTTPContext->getString("bTotalAndGames");
$bTotal = $oHTTPContext->getString("bTotal");
$bGames = $oHTTPContext->getString("bGames");
$bCustom = $oHTTPContext->getString("bCustom");
$iStart = $oHTTPContext->getString("iStart");
$iIndexGame = $oHTTPContext->getString("iIndexGame");
$iIndexDivision = $oHTTPContext->getString("iIndexDivision");
$bSwitch = $oHTTPContext->getString("bSwitch");
$bStart = $oHTTPContext->getString("bStart");

if($iYear == null)
	$iYear = YEAR;

// if it's the start of the slide, display custom-slide page
if($bStart)
{	
	$bCustom = true;
	$bTotal = false;
	$bGames = false;
	$iIndexDivision = 0;
}

// switch between games, total and custom
if($bSwitch && $bStart == false)
{
	if($bTotal)
	{
		$bGames = true;
		$bTotal = false;
	}
	elseif($bGames)
	{
		$bGames = false;
		$bTotal = true;
	}
	elseif($bCustom)
	{
		$bGames = false;
		$bCustom = false;	
		$bTotal = true;
	}
	
	$bSwitch = false;
}

if($bStart)
{
	$bStart = false;
}

if($iStart == null)
	$iStart = 0;

$iPosStart = $iStart;

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
	
	// KLUDGE: this should, of course, be done in the SQL instead
	// construct the array we want to be displayed (not all)
	$aDispTotal = array();
	for($i = $iStart; $i < ($iStart+$iPostsPerPage); $i++)
	{
		if(isset($aStandings[$i]))
			array_push($aDispTotal, $aStandings[$i]);
	}

	// if we go over the number of entries/standings for the division, time to wrap
	if(($iStart + $iPostsPerPage) > $iTotalStandingsForDivision)
	{
		// if this is Total AND Games, switch into game-mode for the division
		if($bTotalAndGames)
		{
			$bSwitch = true;
		}
		$iStart = 0;
	}
	else
		$iStart = $iStart + $iPostsPerPage;		
}

// *** GAME STANDINGS ***
if($bGames)
{
	if($iIndexGame == null)
		$iIndexGame = 0;

	$oGame = new Game();
	$aGamesInDivision = $oGame->getAllGamesByYearAndDivision($iYear, $aDivisions[$iIndexDivision]['division_name_short']);

	$iTotalGamesInDivision = count($aGamesInDivision);
	$iMiddleOfGames = round($iTotalGamesInDivision / 2, 0);
	
	if(isset($aGamesInDivision[$iIndexGame]['id_game']))
	{
		$aGame = $oGame->getGame($aGamesInDivision[$iIndexGame]['id_game']);
		$aGames = $oEntry->addEntryRoundsToGame($aGame, $aDivisions[$iIndexDivision]['division_name_short'], $iYear, true, true);
		$iTotalEntriesForGame = count($aGames[0]['entry_rounds']);
	}
	else
	{
		$iTotalEntriesForGame = 0;
	}
	
	// KLUDGE: this should be done with a limit in the select, no time for that though
	
	// construct the array we want to be displayed (not all)
	$aDispGames = $aGames;
	// copy the stats to the new array
	$aDispGames[0]["stats"] = $aGames[0]["stats"];

	$aEntryRounds = array();
	for($i = $iStart; $i < ($iStart+$iPostsPerPage); $i++)
	{
		if(isset($aGames[0]['entry_rounds'][$i]))
		{
			array_push($aEntryRounds, $aGames[0]['entry_rounds'][$i]);
		}
	}
	$aDispGames[0]['entry_rounds'] = $aEntryRounds;
	
	// if we go over the number of rounds for the game, time to wrap
	if(($iStart + $iPostsPerPage) > $iTotalEntriesForGame)
	{
		$iStart = 0;
		$iIndexGame++;

		// if the game-index is above the total number of games for the division, go to next division, and total standings
		if(($iIndexGame+1) > $iTotalGamesInDivision)
		{
			$iIndexDivision++;
			if($iIndexDivision == $iTotalNoOfDivisions)
			{
				// start over with the divisions
				$iIndexDivision = 0;
				$bStart = true;
			}
			$iIndexGame = 0;
			$bSwitch = true;
		}
		
		// if we're in the middle of the games, show the total standings
		if($iIndexGame == $iMiddleOfGames)
		{
			$bSwitch = true;
		}
	}
	else
		$iStart = $iStart + $iPostsPerPage;

}

if($aDispTotal == null && $bTotal == true)
{
	$oTemplate->assign("bNoOutPut", "true");
	$bSwitch = true;
}

if($aDispGames[0]['entry_rounds'] == null && $bGames == true)		
{
	$oTemplate->assign("bNoOutPut", "true");
	// QUE: don't know why switch was set to true here, commenting this since it will switch to total standings if there are no output from entries
	// on a page for a game
	//$bSwitch = true;
}


// get the number of players in the finals
$oDivisionsToYears = new DivisionsToYears();
$oTemplate->assign("iNoOfPlayersInFinals", $oDivisionsToYears->getNumberOfPlayersInFinals($iYear, $aDivisions[$iIndexDivision]['division_name_short']));
$oTemplate->assign("sLocation", $_SERVER['PHP_SELF']);
$oTemplate->assign("iYear", $iYear);
$oTemplate->assign("iStart", $iStart);
$oTemplate->assign("bTotal", $bTotal);
$oTemplate->assign("bGames", $bGames);
$oTemplate->assign("bTotalAndGames", $bTotalAndGames);
$oTemplate->assign("bStart", $bStart);
$oTemplate->assign("bSwitch", $bSwitch);
$oTemplate->assign("iIndexGame", $iIndexGame);
$oTemplate->assign("iIndexDivision", $iIndexDivision);

if($bCustom)
{
	// to ...kind of... get rid of the custom-page
	//$oTemplate->assign("bNoOutPut", true);
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
elseif($bGames)
{
	$oTemplate->assign("bSlide", true);
	$oTemplate->assign("aGames", $aDispGames);
	$oTemplate->display("slideGame.tpl.php");
}
require_once(BASE_DIR . "includes/inc.end.php");
?>