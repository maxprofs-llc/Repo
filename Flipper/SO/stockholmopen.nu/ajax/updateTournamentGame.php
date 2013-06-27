<?php
$bExcludeInit = true;
require_once("../config/inc.config.php");
require_once(BASE_DIR . "ajax/ajaxHeader.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "models/class.GamesInTournament.php");
require_once(BASE_DIR . "models/class.User.php");

// make sure the user is an uber-admin
$oUser = new User();
if(!$oUser->isUberAdmin())
	exit;

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oGamesInTournament = new GamesInTournament();

$iYear = YEAR;
$oHTTPContext = new HTTPContext();
$iIDGameAndDivision = $oHTTPContext->getString("iIDGameAndDivision");
$bChecked = $oHTTPContext->getString("bChecked");

if($iIDGameAndDivision != null)
{
	// split the checkbox in value and division
	$aSplit = preg_split("/,/", $iIDGameAndDivision);
	$iIDGame = $aSplit[0];
	$iIDDivision = $aSplit[1];
}

if($bChecked == "true")
{
	$oGamesInTournament->insertGameInTournament($iIDGame, $iIDDivision, $iYear);		
}

if($bChecked == "false")
{
	$oGamesInTournament->deleteGameInTournament($iIDGame, $iIDDivision, $iYear);	
}

$oTemplate->assign("bChecked", $bChecked);
$oTemplate->display("ajax/updateTournamentGame.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>