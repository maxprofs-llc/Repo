<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "functions/func.getImageNamesForGallery.php");
$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();

$iYear = $oHTTPContext->getInt("iYear");
if($iYear == null)
	$iYear = YEAR;
	
$aImages = getImageNamesForGallery(GALLERY_DIR . $iYear . "/");
$oTemplate->assign("iYear", $iYear);
$oTemplate->assign("aImages", $aImages);
$oTemplate->display("gallery.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>