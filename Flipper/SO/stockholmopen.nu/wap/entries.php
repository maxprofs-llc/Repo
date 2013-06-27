<?php
require_once("../config/inc.config.php");
require_once(BASE_DIR . "models/class.Entry.php");
require_once(BASE_DIR . "models/class.Player.php");

$oEntry = new Entry();
$oPlayer = new Player();

$iIDPlayer = $_GET["pid"];
$sIDPlayerName = $_GET["name"];
$sDiv =  $_GET["div"];
$iYear =  $_GET["year"];
$iStart =  $_GET["start"];

header('Content-type: text/vnd.wap.wml');
echo '<?xml version="1.0" encoding="iso-8859-1"?>' . "\n";
?>
<!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN" "http://www.wapforum.org/DTD/wml_1.1.xml">
<wml>
	<card id="one" title="Entries">
	<?php
	echo("<p><b>" . $sIDPlayerName . "</b><br></br>" . $sDiv . " Division Entries</p>");
	echo ("<p><a href=\"results.php?division=" . $sDiv . "&amp;year=" . $iYear . "&amp;start=" . ($iStart) . "\">Back</a></p>");

	$bValidPlayerID = $oPlayer->isValidPlayerID($iIDPlayer);
	if($bValidPlayerID)
	{
		$aEntry = $oEntry->getAllEntriesForPlayer($iIDPlayer);
		foreach($aEntry as $entry)
		{
			if($entry['division_name_short'] == $sDiv)
			{
				echo("<p><table columns=\"3\">");
				echo("<tr>");
				echo("<td><b>" . $entry['id_entry'] . "</b></td>");
				echo("<td>Pos</td><td>Pts</td></tr>");
			
				foreach($entry['entry_rounds'] as $game)
				{
					echo("<tr>");
					echo("<td>" . substr($game['game_name'], 0, 7) . "</td>");
					echo("<td>" . $game['entry_round_position'] . "</td>");
					echo("<td>" . $game['entry_round_score_tournament'] . "</td>");
					echo("</tr>");
				}
				echo("<tr><td></td><td><b>Tot</b></td>");
				$score = $entry['entry_score'];
				if($entry['entry_is_voided'] == 1)
					$score = "void";
				echo("<td>" . $score . "</td>");
				echo("</tr>");
				echo("</table></p>");
			}
		}
	}
	?>
	</card>
</wml>
