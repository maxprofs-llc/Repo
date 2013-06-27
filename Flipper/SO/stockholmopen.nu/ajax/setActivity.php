<?php
$bExcludeInit = true;
require_once("../config/inc.config.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.LogFile.php");
require_once(BASE_DIR . "models/class.UserActivity.php");

$oHTTPContext = new HTTPContext();
$sPage = $oHTTPContext->getString("sPage");
$oUserActivity = new UserActivity();
$oUserActivity->setActive($sPage);
// this will flush old(er) entries in the activity log
$oUserActivity->flush();

$aActiveUsers = $oUserActivity->getActiveUsers();
$aActiveGuests = $oUserActivity->getActiveGuests();

if(LOG_ACTIVE_USERS)
{
	// write in the active users-log
	$oLogFile = new LogFile();
	$oLogFile->writeActiveUsers(LOG_FILE_ACTIVE_USERS, $aActiveUsers, $aActiveGuests);
}

// don't think I want to do the end-file stuff with this one, the logs would be flooded
//require_once(BASE_DIR . "includes/inc.end.php");
?>