<?php
$bExcludeInit = true;
require_once("../config/inc.config.php");
require_once(BASE_DIR . "ajax/ajaxHeader.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "models/class.UserActivity.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oUserActivity = new UserActivity();
$oTemplate->assign("aActiveGuests", $oUserActivity->getActiveGuests());
$oTemplate->display("ajax/activeGuests.tpl.php");
require_once(BASE_DIR . "includes/inc.end.php");
?>