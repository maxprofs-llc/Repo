<?php
$bExcludeInit = true;
require_once("../config/inc.config.php");
require_once(BASE_DIR . "ajax/ajaxHeader.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "models/class.Game.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();
$sGameSearch = utf8_decode($oHTTPContext->getString("sGameSearch"));

if($sGameSearch != null)
{
	$oGame = new Game();
	$aGames = $oGame->searchGames($sGameSearch, true);
	
	//echo "<ul>";
	//foreach($aGames as $game)
	//{
		//echo "<li>" . $game['game_name'] . "</li>";		
	//}
	//echo "</ul>";
	
	$oTemplate->assign("aGames", $aGames);
}

$oTemplate->display("ajax/autoSuggestGameName.tpl.php");
require_once(BASE_DIR . "includes/inc.end.php");
?>