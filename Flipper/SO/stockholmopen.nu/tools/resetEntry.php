<?php
require_once("../config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.MDB2Wrapper.php");
require_once(BASE_DIR . "models/class.User.php");
$oUser = new User();
// make sure the user is an uber admin
loginRedirectUserAdmin($oUser, "admin_uber");

$oDB = MDB2::singleton(unserialize(DSN));
$oMDB2Wrapper = new MDB2Wrapper($oDB);

require_once("toolsMenu.php");

if(isset($_REQUEST['iEntryID']))
	$iEntryID = $_REQUEST['iEntryID'];
else
	$iEntryID = null;

if($iEntryID == null)
{
	echo "Enter the Entry ID that you want to reset the score(s) for<br />";
	echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='get' >";
	echo "<input type='text' size='6' name='iEntryID' /> <input type='submit' value='GO' />";	
	echo "</form>";
}
else
{
	$sQuery = sprintf("UPDATE entry_rounds
						SET entry_round_score_tournament = 0, entry_round_position = 0, entry_round_is_counted = 0
						WHERE entries_id_entry=%d",
						$oDB->escape($iEntryID));	
	$aRes = $oMDB2Wrapper->query("exec", $sQuery);	

	$sQuery = sprintf("UPDATE entries
						SET entry_score = 0, entry_is_counted = 0, entry_position = 0, entry_position_change = 0
						WHERE id_entry=%d",
						$oDB->escape($iEntryID));	
	$aRes = $oMDB2Wrapper->query("exec", $sQuery);	
	
	echo "The entry has been reset, if you submitted a correct entry-number.<br />";
}

require_once(BASE_DIR . "includes/inc.end.php");
?>