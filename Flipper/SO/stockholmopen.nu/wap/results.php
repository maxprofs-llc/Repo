<?php
require_once("../config/inc.config.php");
require_once(BASE_DIR . "models/class.Standings.php");

if(!$_GET["division"])
{
	$sDivision = "A";
}
else
{
	$sDivision = $_GET["division"];
}

if(!$_GET["start"])
{
	$iStart = 1;
	$iStop = 5;
}
else
{
	$iStart = $_GET["start"];
	$iStop = $_GET["start"] + 5;
}

if(!$_GET["year"])
{
	$iYear = 2007;
}
else
{
	$iYear = $_GET["year"];
}
$oStandings = new Standings();
$aStandings = $oStandings->getStandings($iYear, $sDivision, null, false);

header('Content-type: text/vnd.wap.wml');
echo '<?xml version="1.0" encoding="iso-8859-1"?>' . "\n";
?>
<!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN" "http://www.wapforum.org/DTD/wml_1.1.xml">
<wml>
	<card id="one" title="Results">
	<?php
    		echo ("<p><b>" . $sDivision . " Division " . $iYear . "</b></p>");
		echo ("<p><a href=\"index.php\">Home</a><br></br>");
		if($iStart != 1)
		{
			echo ("<a href=\"results.php?division=" . $sDivision . "&amp;year=" . $iYear . "&amp;start=" . ($iStart - 5) . "\"> Back </a> ");
		}
		if($aStandings)
		{
			if($aStandings[5])
				echo (" <a href=\"results.php?division=" . $sDivision . "&amp;year=" . $iYear . "&amp;start=" . ($iStop) . "\"> Next </a>");
		}
		echo("</p>");
	?>
	<?php
		if($aStandings)
		{
			echo("<p><table columns=\"4\">");
			for($j = 0; $j < 5; $j++)
			{
				$i = $j + $iStart - 1;
				if($aStandings[$i])
				{
					echo "<tr>";
						echo "<td>" . ($i + 1) . "</td>";
						echo "<td>";
						echo ("<a href=\"entries.php?pid=" . $aStandings[$i]['id_player'] . "&amp;name=" . $aStandings[$i]['player_firstname'] . " " .$aStandings[$i]['player_lastname'] . "&amp;div=" . $sDivision . "&amp;year=" . $iYear . "&amp;start=" . ($iStart) . "\">");
						echo ("" . $aStandings[$i]['player_initials'] . "</a></td>");
						if($sDivision == "S")
						{
							echo "<td><img src='images/icons/flags/" . $aStandings[$i]['split_1_country_code'] . ".gif' />";
							echo " <img src='images/icons/flags/" . $aStandings[$i]['split_1_country_code'] . ".gif' /></td>";
						}
						else
							echo "<td><img src='images/icons/flags/" . $aStandings[$i]['country_code'] . ".gif' /></td>";
						echo "<td>" . $aStandings[$i]['entry_score'] . "</td>";
					echo "</tr>";
				}
			}
			echo("</table></p>");

			echo("<p>");
			for($i = 0; $i < sizeof($aStandings); $i = $i + 5)
			{
				if(($i + 1) == $iStart)
					echo(($i + 1) . " ");
				else
					echo ("<a href=\"results.php?division=" . $sDivision . "&amp;year=" . $iYear . "&amp;start=" . ($i + 1) . "\">" . ($i + 1) . "</a> ");

			}
			echo("</p>");
		}
		else
		{
			echo("<p>No Results Available</p>");
		}
	?>
	</card>
</wml>
