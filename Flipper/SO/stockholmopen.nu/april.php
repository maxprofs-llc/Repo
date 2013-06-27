<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "classes/class.PagingLink.php");
require_once(BASE_DIR . "models/class.News.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.GamesInTournament.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oNews = new News();
$oForm = new HTMLFormTemplate($oTemplate, null, "get", $_SERVER['PHP_SELF'], "form");
$oHTTPContext = new HTTPContext();
// get the input classes
$oSmartyConfigFile = new SmartyConfigFile(INPUTS_CONFIG_FILE);
$aInputClasses = $oSmartyConfigFile->getInputClasses();

$iLimit = 10;
$iStart = $oHTTPContext->getInt("iStart");
if($iStart == null)
	$iStart = 0;
$aNews = $oNews->getNews($iLimit, $iStart);

// create the paging links
$iNumberOfNews = $oNews->getNumberOfNews();

for($i = 0; $i < $iNumberOfNews; $i++)
{
	$aNewsLinks[$i]['link'] = $i + 1;
}

$oPagingLink = new PagingLink();
//$aLinks = $oPagingLink->buildPagingLinksFromArray($aAllGames, $iPageStart, $iPageLimit, "game_name", "game.php?iYear=" . $iYear . "&sDivision=" . $sDivision . "&bShowAll=true", 5, ".", " | ");
$aLinks = $oPagingLink->buildPagingLinksFromArray($aNewsLinks, $iStart, $iLimit, "link", "index.php", 10, null, " | ", "?");
// *** INIT THE FORM ***
$oForm->initForm();
// *** END THE FORM ***
$oForm->endForm();

$oPlayer = new Player();
$oGamesInTournament = new GamesInTournament();
$iNumberOfPlayers = $oPlayer->getNumberOfPlayersFromYear(YEAR);
$iNumberOfGamesInTournament = $oGamesInTournament->getNumberOfGamesFromYear(YEAR);
$iNumberOfCountries = $oPlayer->getCountryCountFromYear(YEAR);
$oTemplate->assign("iNumberOfPlayers", $iNumberOfPlayers);
$oTemplate->assign("iNumberOfGamesInTournament", $iNumberOfGamesInTournament);
$oTemplate->assign("iNumberOfCountries", $iNumberOfCountries);

$oTemplate->assign("aLinks", $aLinks);
$oTemplate->assign("aNews", $aNews);
$oTemplate->display("april.tpl.php");


require_once(BASE_DIR . "includes/inc.end.php");
?>
