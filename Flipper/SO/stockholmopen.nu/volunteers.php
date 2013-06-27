<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.String.php");
require_once(BASE_DIR . "models/class.Volunteer.php");
require_once(BASE_DIR . "models/class.User.php");

//$oUser = new User();
// make sure the user is an uber admin
//loginRedirectUserAdmin($oUser, "admin_uber");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oVolunteer = new Volunteer();
$oString = new String();
$aSchedule = $oVolunteer->getSchedule();
$i = 0;
foreach($aSchedule as $val)
{
	$aSchedule[$i]['vol_time_start'] = $oString->mySQLTimestampToSimpleDateTime($aSchedule[$i]['vol_time_start']);
	$aSchedule[$i]['vol_time_end'] = $oString->mySQLTimestampToSimpleDateTime($aSchedule[$i]['vol_time_end']);
	$i++;
}

$oTemplate->assign("aSchedule", $aSchedule);
$oTemplate->assign("aTopVolunteers", $oVolunteer->getTopVolunteers());
$oTemplate->assign("aVolunteers", $oVolunteer->getVolunteers());
$oTemplate->display("volunteers.tpl.php");
require_once(BASE_DIR . "includes/inc.end.php");
?>