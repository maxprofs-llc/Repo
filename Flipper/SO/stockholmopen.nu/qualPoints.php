<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.ScoreRange.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);

$oHTTPContext = new HTTPContext();
$sDivision = $oHTTPContext->getString("sDivision");
// let's use "A" as default
if($sDivision == null)
	$sDivision = "A";
	
$oScoreRange = new ScoreRange(TXT_FILE_SCORE_RANGE_FOLDER);
$aScores = $oScoreRange->parseScoreRangeFile(YEAR, $sDivision);
$oTemplate->assign("aScores", $aScores);
$oTemplate->display("qualPoints.tpl.php");
require_once(BASE_DIR . "includes/inc.end.php");
?>