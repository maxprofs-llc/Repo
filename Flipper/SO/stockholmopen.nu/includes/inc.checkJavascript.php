<?php
require_once(BASE_DIR . "classes/class.Template.php");
$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);

// javascript-enabled-test
if(!isset($_SESSION['bJSTest']))
{	
	$_SESSION['bJSTest'] = true;
	$oTemplate->assign("bJSTest", true);
}
else
{
	$oTemplate->assign("bJSTest", false);
}

// redirect if the bJS var is set 
// UPDATE: (don't think this is used?)
if(isset($_REQUEST['bJS']))
	header("Location: " . BASE_URL . "noScript.php");
?>