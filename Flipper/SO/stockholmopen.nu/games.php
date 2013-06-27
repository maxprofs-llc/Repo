<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.ArrayHelper.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "models/class.GamesInTournament.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oGamesInTournament = new GamesInTournament();
$oArrayHelper = new ArrayHelper();
$oHTTPContext = new HTTPContext();

$sSort = $oHTTPContext->getString("sSort");
$iYear = $oHTTPContext->getInt("iYear");
if($iYear == null)
	$iYear = YEAR;
	
$aGames = $oGamesInTournament->getGamesForYear($iYear, $sSort);
// remove any duplicates (from different divisions)
//$aGames = $oArrayHelper->removeDuplicatesByKey($aGames, "game_name");

$oTemplate->assign("sSort", $sSort);
$oTemplate->assign("aGames", $aGames);
$oTemplate->display("games.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>