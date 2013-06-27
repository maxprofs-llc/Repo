<?php
require_once(BASE_DIR . "classes/class.Template.php");
$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
// we'll just set a session var here that will indicate that we've checked for IE5

$sSessionVar = "bOldIETest";

if(!isset($_SESSION[$sSessionVar]))
{	
	$_SESSION[$sSessionVar] = true;
	$oTemplate->assign("bOldIETest", true);
}
else
{
	$oTemplate->assign("bOldIETest", false);
}
?>