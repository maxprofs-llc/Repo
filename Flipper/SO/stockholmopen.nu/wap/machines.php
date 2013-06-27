<?php
require_once("../config/inc.config.php");
require_once(BASE_DIR . "models/class.Entry.php");
require_once(BASE_DIR . "models/class.Game.php");

$iYear = $_GET["year"];
$iNo = $_GET["start"];
$sDivision = $_GET["div"];

$oEntry = new Entry();
$oGame = new Game();

$aGames = $oGame->getAllGamesByYearAndDivision($iYear, $sDivision, $iNo, ($iNo + 2));
$game = $aGames[0];

header('Content-type: text/vnd.wap.wml');
echo '<?xml version="1.0" encoding="iso-8859-1"?>' . "\n";
?>
<!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN" "http://www.wapforum.org/DTD/wml_1.1.xml">
<wml>
<card id="one" title="Machines">
<?php
	echo("<p>");
	echo ("<a href=\"index.php\">Home</a><br></br>");
	if($iNo != 0)
	{
		echo ("<a href=\"machines.php?div=" . $sDivision . "&amp;year=" . $iYear . "&amp;start=" . ($iNo - 1) . "\"> Back </a> ");
	}
	else
	{
		echo ("<a href=\"machinesindex.php?div=" . $sDivision . "&amp;year=" . $iYear . "\"> Back </a> ");
	}
	if($aGames[($iNo + 1)])
	{
		echo (" <a href=\"machines.php?div=" . $sDivision . "&amp;year=" . $iYear . "&amp;start=" . ($iNo + 1) . "\"> Next </a>");
	}
	echo("</p>");

	echo("<p><b>" . $game['game_name'] . "</b></p>");
	$aEntry =  $oEntry->getEntryRoundsForGame($game['id_game'], $sDivision, $iYear, true, true, 10);
	if($aEntry)
	{
		echo("<p><table columns=\"2\">");

		$i = 1;
		foreach($aEntry as $entry)
		{
			echo("<tr>");
			echo("<td>" . $i . "-" . $entry['player_initials'] . "</td><td>" . $entry['score_game_output'] . "</td>");
			echo("</tr>");
			$i = $i + 1;
		}
		echo("</table></p>");
	}
	else
	{
		echo("<p>No Entries</p>");
	}
?>
</card>
</wml>
