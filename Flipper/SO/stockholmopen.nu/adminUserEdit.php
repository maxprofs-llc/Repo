<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "functions/func.loginReDirectAdmin.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "models/class.User.php");

$oUser = new User();
// make sure the user is a uber admin
loginRedirectUserAdmin($oUser, "admin_uber");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);

$oTemplate->assign("aUsers", $oUser->getAllUsers());
$oTemplate->display("admin/adminUserEdit.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>