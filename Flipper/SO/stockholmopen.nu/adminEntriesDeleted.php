<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "models/class.Entry.php");
require_once(BASE_DIR . "models/class.User.php");

$oUser = new User();
// make sure the user is an uber admin
loginRedirectUserAdmin($oUser, "admin_uber");

$oEntry = new Entry();
$aEntries = $oEntry->getDeletedEntries();
$oTemplate->assign("aEntries", $aEntries);
$oTemplate->display("admin/adminEntriesDeleted.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>