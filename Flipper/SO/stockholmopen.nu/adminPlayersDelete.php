<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "classes/class.ArrayHelper.php");
require_once(BASE_DIR . "models/class.User.php");
require_once(BASE_DIR . "models/class.Entry.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");

$oUser = new User();
// make sure the user is a uber admin
loginRedirectUserAdmin($oUser, "admin_uber");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oDivisionsToYears = new DivisionsToYears();
$oHTTPContext = new HTTPContext();
$oArrayHelper = new ArrayHelper();
$oForm = new HTMLFormTemplate($oTemplate, "default", "get", $_SERVER['PHP_SELF']);

// get the input classes
$oSmartyConfigFile = new SmartyConfigFile(INPUTS_CONFIG_FILE);
$aInputClasses = $oSmartyConfigFile->getInputClasses();
// the input-names
$iInputYear = "iYear";

$iYear = $oHTTPContext->getInt($iInputYear);
if($iYear == null)
	$iYear = YEAR;

// get all tournament years
$aTournamentYears = $oDivisionsToYears->getAllTournamentYears("DESC");
$aTournamentYears = $oArrayHelper->assocToOrdered($aTournamentYears);
$oForm->createJavaScriptSelect($iInputYear, $_SERVER['PHP_SELF'], $aTournamentYears, false, $iYear, $aInputClasses["default"]);

// *** INIT THE FORM ***
$oForm->initForm();
// *** END FORM ***
$oTemplate = $oForm->endForm();

$oDivisionsToYears = new DivisionsToYears();
$oEntry = new Entry();

// get all divisions
$aDivisions = $oDivisionsToYears->getDivisionsFromYear($iYear);
$aPlayers = array();
foreach($aDivisions as $division)
{
	// get all players
	$oPlayer = new Player();
	$aPlayersTemp = $oPlayer->getPlayers($iYear, $division['division_name_short'], "nameAsc");
	foreach ($aPlayersTemp as $player)
	{
		$aTemp['division_name_short'] = $division['division_name_short'];
		$aTemp['id_player'] = $player['id_player'];
		$aTemp['player_first_name'] = $player['player_firstname'];
		$aTemp['player_last_name'] = $player['player_lastname'];
		$aTemp['dtp_paid_fee'] = $player['dtp_paid_fee'];
				
		// check if the player has played any entries
		if($oEntry->playerHasPlayedEntries($player['id_player']))
			$aTemp['player_has_played_entries'] = true;
		else
			$aTemp['player_has_played_entries'] = false;
		array_push($aPlayers, $aTemp);
	}
}

$oTemplate->assign("aPlayers", $aPlayers);
$oTemplate->display("admin/adminPlayersDelete.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>