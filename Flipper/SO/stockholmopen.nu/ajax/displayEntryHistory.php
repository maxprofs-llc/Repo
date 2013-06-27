<?php
$bExcludeInit = true;
require_once("../config/inc.config.php");
require_once(BASE_DIR . "ajax/ajaxHeader.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "models/class.Entry.php");
require_once(BASE_DIR . "models/class.Player.php");

// KLUDGE: but store the open entries in a session var
$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();
$oEntry = new Entry();

$iIDEntry = $oHTTPContext->getInt("iIDEntry");
// check if this entry isn't open in the session var
if(!isset($_SESSION["historyOpenEntries#".$iIDEntry]))
{
	// if it isn't... get all data
	$aEntryHistory = $oEntry->getEntryHistory($iIDEntry);
	$oTemplate->assign("aEntryHistory", $aEntryHistory);
	$oTemplate->display("ajax/displayEntryHistory.tpl.php");
	$_SESSION["historyOpenEntries#".$iIDEntry] = true;
}
else
{
	// if it is, unset the entry in the array
	unset($_SESSION["historyOpenEntries#".$iIDEntry]);

}

require_once(BASE_DIR . "includes/inc.end.php");
?>