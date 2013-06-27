<?php
require_once("../config/inc.config.php");
require_once(BASE_DIR . "models/class.Game.php");

$iYear = $_GET["year"];
$sDivision = $_GET["div"];

$oGame = new Game();
$aGames = $oGame->getAllGamesByYearAndDivision($iYear, $sDivision);

header('Content-type: text/vnd.wap.wml');
echo '<?xml version="1.0" encoding="iso-8859-1"?>' . "\n";
?>
<!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN" "http://www.wapforum.org/DTD/wml_1.1.xml">
<wml>
<card id="one" title="MachinesI">
<?php
	echo("<p>");
	echo ("<a href=\"index.php\">Home</a><br></br>");
	echo("</p>");
	echo("<p>");
	echo("<b>" . $sDivision . " Division " . $iYear . "</b>");
	echo("</p>");
	echo("<p>");
	$i = 0;
	foreach($aGames as $game)
	{
		echo ("<a href=\"machines.php?div=" . $sDivision . "&amp;year=" . $iYear . "&amp;start=" . $i . "\">" . $game['game_name'] . "</a><br></br>");
		$i = $i + 1;
	}
	echo("</p>");
?>
</card>
</wml>
