<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "classes/class.PagingLink.php");
require_once(BASE_DIR . "classes/class.URL.php");
require_once(BASE_DIR . "models/class.GamesInTournament.php");
require_once(BASE_DIR . "models/class.Entry.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oEntry = new Entry();
$oHTTPContext = new HTTPContext();
$oForm = new HTMLFormTemplate($oTemplate, "default", "get", $_SERVER['PHP_SELF']);

$oURL = new URL;
$sCurrentURL = $oURL->getCurrentRelativeURL();

// get the input classes
$oSmartyConfigFile = new SmartyConfigFile(INPUTS_CONFIG_FILE);
$aInputClasses = $oSmartyConfigFile->getInputClasses();
// the input-names
$sInputLimit = "iLimit";

$iPageStart = $oHTTPContext->getInt("iStart");
if($iPageStart == null)
	$iPageStart = 0;
	
$iLimit = $oHTTPContext->getInt($sInputLimit);
if($iLimit == null)
	$iLimit = 10;

// remove "iLimit=n" from the URL
$oForm->createJavaScriptNumberSelect($sInputLimit, $sCurrentURL, 20, false, $iLimit, $aInputClasses["default"], $cPrefix);
// *** INIT THE FORM ***
$oForm->initForm();
// *** END FORM ***
$oTemplate = $oForm->endForm();
$oGamesInTournament = new GamesInTournament();

$iPageLimit = 5;
	
$aGames = $oEntry->addHighestScoresToGame($iLimit, $iPageStart, $iPageLimit, true);
// add the years and divisions to the games
$i = 0;
foreach($aGames as $game)
{
	// get the years and divisions the game has been in the tournament
	$aGames[$i]['game_year_and_divisions'] = $oGamesInTournament->getGameYearAndDivisions($game['games_id_game']);
	$i++;
}

//printArray($aGames);
$aAllGames = $oGamesInTournament->getAllGamesEverUsed(true, false);
$oPagingLink = new PagingLink();
$aLinks = $oPagingLink->buildPagingLinksFromArray($aAllGames, $iPageStart, $iPageLimit, "game_name", $sCurrentURL, 3, ".", "|");
$oTemplate->assign("aLinks", $aLinks);
$oTemplate->assign("aGames", $aGames);
$oTemplate->display("statsTopScores.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>
