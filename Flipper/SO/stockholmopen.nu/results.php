<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();

$iYear = $oHTTPContext->getInt("iYear");
if($iYear == null)
	$iYear = YEAR;

$sTemplateFile = "results" . $iYear . ".tpl.php";
$sFullPath = TEMPLATE_DIR . $sTemplateFile;
if(!file_exists($sFullPath))
{
	$oTemplate->display("errorPages/error.tpl.php");
}	
else
{
	$oTemplate->display("results" . $iYear . ".tpl.php");
}

require_once(BASE_DIR . "includes/inc.end.php");
?>