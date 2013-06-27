<?php
require_once("../config/inc.config.php");
require_once(BASE_DIR . "models/class.Game.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.Entry.php");
include "phpqrcode/phpqrcode.php";

	echo "<html><body>";

	$iIDEntry = $oHTTPContext->getInt("entryId");

	$bAutoPrint = $oHTTPContext->getString("autoPrint");
		
	echo "Entry ID: <font size=\"5\"><u><b>" . $iIDEntry . "</b></u></font><br/>";
	
	$oEntry = new Entry();
	$oPlayer = new Player();

	// pid
	$iIDPlayer = $oEntry->getPlayerIDForEntry($iIDEntry);

	// player tag and name
	$aPlayer = $oPlayer->getPlayer($iIDPlayer);
	$tag = $aPlayer['player_initials'];
	echo "<font size=\"6\"><u>" . $aPlayer['player_firstname'] . " " . $aPlayer['player_lastname'] . " (" .$tag . ", id:" . $iIDPlayer . ")</u></font>";
	echo("<br/>");	
	echo("<br/>");	
	
	// loop through the rounds and print QR code and info for each
	$aEntryRounds = $oEntry->getRoundsInEntry($iIDEntry);
	$i = 0;
	$aAlign = array();
	array_push($aAlign, "left");
	array_push($aAlign, "right");
	array_push($aAlign, "left");

	$aYPosition = array();
	array_push($aYPosition , "0");
	array_push($aYPosition , "-100");
	array_push($aYPosition , "-120");


	foreach($aEntryRounds as $aEntryRound)
	{
		$qrText = "gid=" . $aEntryRound['games_id_game'] . "&pid=" . $iIDPlayer . "&eid=" . $iIDEntry . "&tag=" . $tag . "&game=" .  $aEntryRound['game_name'];
		QRcode::png($qrText, "phpqrcode/tmp/img" . $i . ".png", 0, 8, 1);
		
		echo "<div style=\"position:relative;top:" . $aYPosition[$i] . ";\" align=\"" . $aAlign[$i] . "\">";
		echo "<table><tr><td>";
			echo "Game: <b>" . $aEntryRound['game_name'] . "</b><br />";
			echo "<img src=\"phpqrcode/tmp/img" . $i . ".png\" /><br/>";
			echo "Sign: ________";
		echo "</td></tr></table>";
		echo "</div>";
		$i++;
	}

	if($bAutoPrint != null && $bAutoPrint == "true"){
		echo "<script>window.print()</script>";
	}
	echo "</body></html>";

?>
<?php
require_once("../config/inc.config.php");
require_once(BASE_DIR . "models/class.Game.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.Entry.php");
include "phpqrcode/phpqrcode.php";

	echo "<html><body>";

	$iIDEntry = $oHTTPContext->getInt("entryId");

	$bAutoPrint = $oHTTPContext->getString("autoPrint");
		
	echo "Entry ID: <font size=\"5\"><u><b>" . $iIDEntry . "</b></u></font><br/>";
	
	$oEntry = new Entry();
	$oPlayer = new Player();

	// pid
	$iIDPlayer = $oEntry->getPlayerIDForEntry($iIDEntry);

	// player tag and name
	$aPlayer = $oPlayer->getPlayer($iIDPlayer);
	$tag = $aPlayer['player_initials'];
	echo "<font size=\"6\"><u>" . $aPlayer['player_firstname'] . " " . $aPlayer['player_lastname'] . " (" .$tag . ", id:" . $iIDPlayer . ")</u></font>";
	echo("<br/>");	
	echo("<br/>");	
	
	// loop through the rounds and print QR code and info for each
	$aEntryRounds = $oEntry->getRoundsInEntry($iIDEntry);
	$i = 0;
	$aAlign = array();
	array_push($aAlign, "left");
	array_push($aAlign, "right");
	array_push($aAlign, "left");

	$aYPosition = array();
	array_push($aYPosition , "0");
	array_push($aYPosition , "-100");
	array_push($aYPosition , "-120");


	foreach($aEntryRounds as $aEntryRound)
	{
		$qrText = "gid=" . $aEntryRound['games_id_game'] . "&pid=" . $iIDPlayer . "&eid=" . $iIDEntry . "&tag=" . $tag . "&game=" .  $aEntryRound['game_name'];
		QRcode::png($qrText, "phpqrcode/tmp/img" . $i . ".png", 0, 8, 1);
		
		echo "<div style=\"position:relative;top:" . $aYPosition[$i] . ";\" align=\"" . $aAlign[$i] . "\">";
		echo "<table><tr><td>";
			echo "Game: <b>" . $aEntryRound['game_name'] . "</b><br />";
			echo "<img src=\"phpqrcode/tmp/img" . $i . ".png\" /><br/>";
			echo "Sign: ________";
		echo "</td></tr></table>";
		echo "</div>";
		$i++;
	}

	if($bAutoPrint != null && $bAutoPrint == "true"){
		echo "<script>window.print()</script>";
	}
	echo "</body></html>";

?>
