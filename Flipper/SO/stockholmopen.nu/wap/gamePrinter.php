<?php
require_once("../config/inc.config.php");
require_once(BASE_DIR . "models/class.Game.php");
include "phpqrcode/phpqrcode.php";

	$oGame = new Game();

	echo "<html><body>";

	$iIDGame = $oHTTPContext->getInt("gameId");

	$aGame = $oGame->getGame($iIDGame);
	$gameName = $aGame[0]['game_name'];
	$bAutoPrint = $oHTTPContext->getString("autoPrint");
	
	$qrText = "gid=" . $iIDGame . "&game=" .  $gameName;
	QRcode::png($qrText, "phpqrcode/tmp/gameimg.png", 0, 4, 1);

	echo "<div>";
	echo "<table  width=\"288pt\" style=\"table-layout: fixed;word-wrap:break-word;\" ><tr><td width=\"50%\">";
		echo "<center><b>" . $gameName . "</b><br/>(ID:" . $iIDGame . ")</center></td><td>";
		echo "<img src=\"phpqrcode/tmp/gameimg.png\" /><br/>";
	echo "</td></tr></table>";
	echo "</div>";

	if($bAutoPrint != null && $bAutoPrint == "true"){
		echo "<script>window.print()</script>";
	}
	echo "</body></html>";

?>
