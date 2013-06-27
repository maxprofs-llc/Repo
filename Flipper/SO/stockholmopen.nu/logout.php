<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "models/class.User.php");

// if the user is logged in, let's re-direct to the index-page
$oUser = new User();
if($oUser->isLoggedIn())
	header("Location: " . BASE_URL . "index.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oTemplate->display("logout.tpl.php");
	
require_once(BASE_DIR . "includes/inc.end.php");
?>