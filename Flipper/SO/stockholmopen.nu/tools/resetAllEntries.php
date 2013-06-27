<?php
require_once("../config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.MDB2Wrapper.php");
require_once(BASE_DIR . "models/class.User.php");
$oUser = new User();
// make sure the user is an uber admin
loginRedirectUserAdmin($oUser, "admin_uber");

require_once("toolsMenu.php");

$oDB = MDB2::singleton(unserialize(DSN));
$oMDB2Wrapper = new MDB2Wrapper($oDB);

if(isset($_REQUEST['sGo']))
	$sGo = $_REQUEST['sGo'];
else
	$sGo = null;

if($sGo != "ok")
{
	echo "Enter \"ok\" to reset all entries<br />";
	echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='get' >";
	echo "<input type='text' size='2' name='sGo' /> <input type='submit' value='GO' />";	
	echo "</form>";
}
else
{
	$sQuery = "UPDATE entry_rounds
				SET entry_round_score_tournament = 0, entry_round_position = 0, entry_round_is_counted = 0";
	$aRes = $oMDB2Wrapper->query("exec", $sQuery);	

	$sQuery = "UPDATE entries
				SET entry_score = 0, entry_is_counted = 0, entry_position = 0";
	$aRes = $oMDB2Wrapper->query("exec", $sQuery);
	echo "Yee-haa. All entries were reset.<br />";
}

require_once(BASE_DIR . "includes/inc.end.php");
?>