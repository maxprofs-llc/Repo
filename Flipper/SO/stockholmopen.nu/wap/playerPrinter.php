<?php
require_once("../config/inc.config.php");
require_once(BASE_DIR . "models/class.Player.php");
require_once(BASE_DIR . "models/class.Country.php");
include "phpqrcode/phpqrcode.php";

	echo "<html><body>";

	$bAutoPrint = $oHTTPContext->getString("autoPrint"); //adminPlayersEdit
		
	$oPlayer = new Player();
	$oCountry = new Country();

	// pid
	$iIDPlayer = $oHTTPContext->getInt("playerId");

	// player tag and name
	$aPlayer = $oPlayer->getPlayer($iIDPlayer);
	$tag = $aPlayer['player_initials'];
	$aCountry = $oCountry->getCountryFromID($aPlayer['countries_id_country']);
	$qrText = "pid=" . $iIDPlayer . "&tag=" .  $tag;
	QRcode::png($qrText, "phpqrcode/tmp/playerimg.png", 0, 6, 0);
	
	$countryName = $aCountry['country_name'];
	if($countryName == "Unknown"){
		$countryName = "(Team)";
	}

	echo "<div>";
	echo "<table style=\"table-layout: fixed;word-wrap:break-word;\" width=\"288pt\"><tr><td width=\"50%\">";
	echo "<center>" . $aPlayer['player_firstname'] . " " . $aPlayer['player_lastname'] . "<br/><font size=\"6\"><b>" . $tag . "</font></b> ";
	echo "<br/><font size=\"7\">" . $iIDPlayer . "</font><br/> " . $countryName;
	echo "</center></td><td><img src=\"phpqrcode/tmp/playerimg.png\" /><br/>";
	echo "</td></tr></table>";
	echo "</div>";
		
	if($bAutoPrint != null && $bAutoPrint == "true"){
		echo "<script>window.print()</script>";
	}
	echo "</body></html>";

?>
