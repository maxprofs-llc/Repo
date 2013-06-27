<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.ArrayHelper.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "models/class.Game.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oGame = new Game();
$oDivisionsToYears = new DivisionsToYears();
$aDivisions = $oDivisionsToYears->getDivisionsFromYear(YEAR);

echo "<center>";
echo "<br /><font color='red'><b>DO NOT LOSE YOUR ENTRY TICKET</b></font><br /><br />";
echo "<h1>GAMES IN THE TOURNAMENT</h1>";
foreach($aDivisions as $division)
{
	echo "<h2>Division - " . $division['division_name_short'] . "</h2>";
	
	$aGames = $oGame->getAllGamesByYearAndDivision(YEAR, $division['division_name_short']);
	$iCount = count($aGames);
	$i = 0;
	foreach($aGames as $game)
	{
		echo $game['game_name'];
		
		if($i < ($iCount-1))
 			echo "  -  ";
 			
 		$i++;
	}
}
echo "<br /><br />";
echo "<font color='red'><b>DO NOT LOSE YOUR ENTRY TICKET</b></font><br />";

echo "</center>";
require_once(BASE_DIR . "includes/inc.end.php");
?>