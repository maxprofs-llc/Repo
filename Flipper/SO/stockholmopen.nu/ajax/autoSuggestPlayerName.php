<?php
$bExcludeInit = true;
require_once("../config/inc.config.php");
require_once(BASE_DIR . "ajax/ajaxHeader.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "models/class.Player.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();
$sPlayerSearch = utf8_decode($oHTTPContext->getString("sPlayerSearch"));

if($sPlayerSearch != null)
{
	$oPlayer = new Player();
	$aPlayers = $oPlayer->searchPlayerNamesAndInitials($sPlayerSearch, true);
	
	//echo "<ul>";
	//foreach($aPlayers as $player)
	//{
		//echo "<li>" . $player['player_name'] . "</li>";		
	//}
	//echo "</ul>";
	$oTemplate->assign("aPlayers", $aPlayers);
}

$oTemplate->display("ajax/autoSuggestPlayerName.tpl.php");
require_once(BASE_DIR . "includes/inc.end.php");
?>