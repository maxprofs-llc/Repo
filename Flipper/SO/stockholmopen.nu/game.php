<?php
// this page is used for both player listings and entry listings
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "classes/class.LogFile.php");
require_once(BASE_DIR . "classes/class.PagingLink.php");
require_once(BASE_DIR . "classes/class.URL.php");
require_once(BASE_DIR . "models/class.Entry.php");
require_once(BASE_DIR . "models/class.Game.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.GamesInTournament.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oURL = new URL;
$sCurrentURL = $oURL->getCurrentRelativeURL();
		
// if we've decidede to use caching
if(TEMPLATE_CACHING)
{
	$oTemplate->caching = true;
	$oTemplate->cache_lifetime = TEMPLATE_CACHE_TIME_STANDINGS; 
}

// only do all this if the template isn't cached, or if we've decided to not use caching
if(!$oTemplate->is_cached('game.tpl.php', $_SERVER['REQUEST_URI']) || !TEMPLATE_CACHING) 
{
	$oHTTPContext = new HTTPContext();
	$oEntry = new Entry();
	$oGame = new Game();
	$oPlayer = new Player();
	$oGamesInTournament = new GamesInTournament();
	
	$iIDGame = $oHTTPContext->getInt("iIDGame");
	$iYear = $oHTTPContext->getInt("iYear");
	$sDivision = $oHTTPContext->getString("sDivision");
	$bShowAll = $oHTTPContext->getString("bShowAll");
	$bInclude = $oHTTPContext->getString("bInclude");
	$iLimit = $oHTTPContext->getInt("iLimit");
	
	if(($bShowAll == true && $bInclude != true) && $iLimit == null)// set default limit
		$iLimit = 10;	
		
	// ugly solutions ahead... nevertheless...
		
	// if the file is included (from AJAX calls) we want to set the limit to an 
	// "infinite" value the first time it's included the limit value will be 10
	if($bInclude == true && $iLimit == 10)
	{
		$iLimit = 0;
	}
	else if($bInclude == true && $iLimit == 0)
	{
		$iLimit = 10;
	}
	
	if(COUNT_GET_GAME_TIME == true)
	{
		$oLogFile = new LogFile();
		$sTimeStart = microtime(true);
	}
	
	if($iIDGame != null)
	{
		$aGame = $oGame->getGame($iIDGame);
		$aGames = $oEntry->addEntryRoundsToGame($aGame, $sDivision, $iYear);
	}
	
	if($bShowAll)
	{
		$oForm = new HTMLFormTemplate($oTemplate, "default", "get", $_SERVER['PHP_SELF']);
		// get the input classes
		$oSmartyConfigFile = new SmartyConfigFile(INPUTS_CONFIG_FILE);
		$aInputClasses = $oSmartyConfigFile->getInputClasses();
		// the input-names
		$sInputLimit = "iLimit";
	
		$oForm->createJavaScriptNumberSelect($sInputLimit, $sCurrentURL, 20, false, $iLimit, $aInputClasses["default"], $cPrefix);
		// *** INIT THE FORM ***
		$oForm->initForm();
		// *** END FORM ***
		$oTemplate = $oForm->endForm();
		
		$iPageStart = $oHTTPContext->getInt("iStart");
		$iPageLimit = SLIDE_POSTS_PER_PAGE_GAMES;
		if($iPageStart == null)
			$iPageStart = 0;	
		$aGames = $oGame->getAllGamesByYearAndDivision($iYear, $sDivision, $iPageStart, $iPageLimit);
		$aGames = $oEntry->addEntryRoundsToGames($aGames, $sDivision, $iYear, $iLimit);
		$aAllGames = $oGame->getAllGamesByYearAndDivision($iYear, $sDivision);
		$oPagingLink = new PagingLink();
		$aLinks = $oPagingLink->buildPagingLinksFromArray($aAllGames, $iPageStart, $iPageLimit, "game_name", $sCurrentURL, 5, ".", " | ");
		$oTemplate->assign("aLinks", $aLinks);
	}
	
	if(COUNT_GET_GAME_TIME == true)
	{
		$sTimeEnd = microtime(true);
		$sTime = $sTimeEnd - $sTimeStart;
		$oLogFile->writeTimeGetGame(LOG_FILE_GET_GAME, $sTime, $iYear, $iIDGame);	
	}
	
	$oTemplate->assign("iYear", $iYear);
	$oTemplate->assign("iIDGame", $iIDGame);
	$oTemplate->assign("aGames", $aGames);
	$oTemplate->assign("sDivision", $sDivision);
	$oTemplate->assign("bShowAll", $bShowAll);
	$oTemplate->assign("bInclude", $bInclude);
	$oTemplate->assign("iLimit", $iLimit);
	
	if($iYear != null && $iIDGame != null)
	{
		// get the years and divisions the game has been in the tournament, excluding the current year, and divison
		$aGameYearsAndDivisions = $oGamesInTournament->getGameYearAndDivisions($iIDGame, $iYear, true, $sDivision);
		$oTemplate->assign("aGameYearsAndDivisions", $aGameYearsAndDivisions);
	}
	
	$oTemplate->assign("bShowAll", $bShowAll);
}

$oTemplate->display("game.tpl.php", $_SERVER['REQUEST_URI']);
require_once(BASE_DIR . "includes/inc.end.php");
?>
