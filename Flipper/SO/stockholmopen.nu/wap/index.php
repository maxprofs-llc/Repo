<?php
require_once("../config/inc.config.php");
require_once(BASE_DIR . "models/class.DivisionsToYears.php");
$oDiv = new DivisionsToYears();
header('Content-type: text/vnd.wap.wml');
echo '<?xml version="1.0" encoding="iso-8859-1"?>' . "\n";
?>
<!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN" "http://www.wapforum.org/DTD/wml_1.1.xml">
<wml>
	<card id="one" title="Index">
	<p>
		<b>
		Qualification	Standings
		</b>
	</p>
	<?php
		for($i = YEAR; $i >= 2005; $i--)
		{
			echo("<p>" . $i . ":<br></br>");
			$aDivisions = $oDiv->getDivisionsFromYear($i);
			for($j = 0; $j < sizeof($aDivisions); $j++)
			{
				echo ("<a href=\"results.php?division=" . $aDivisions[$j]['division_name_short']  . "&amp;year=" . $i . "&amp;start=1\">" . $aDivisions[$j]['division_name'] . "</a><br></br>");
				echo ("<a href=\"machinesindex.php?div=" . $aDivisions[$j]['division_name_short'] . "&amp;year=" . $i . "\">" . $aDivisions[$j]['division_name_short']  . " Machines</a><br></br>");
			}
			echo("</p>");
		}
	?>
	</card>
</wml>
