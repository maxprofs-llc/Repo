<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "classes/class.ArrayHelper.php");
require_once(BASE_DIR . "models/class.User.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");

$oUser = new User();
// make sure the user is a uber admin
loginRedirectUserAdmin($oUser, "admin_uber");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oEntry = new Entry();
$oArrayHelper = new ArrayHelper();
$oHTTPContext = new HTTPContext();
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
$aTemp = $aTournamentYears;
$aTournamentYears = array("-");
$i = 0;
foreach($aTemp as $val)
{
	array_push($aTournamentYears, $val);	
}

// create the inputs
$oForm->createJavaScriptSelect($iInputYear, $_SERVER['PHP_SELF'], $aTournamentYears, false, $iYear, $aInputClasses["default"]);

// *** INIT THE FORM ***
$oForm->initForm();

// *** END FORM ***
$oForm->endForm();

// get all players
$oPlayer = new Player();
$aPlayers = $oPlayer->getPlayers($iYear);
$oTemplate->assign("aPlayers", $aPlayers);
$oTemplate->display("admin/adminEmailAddresses.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>