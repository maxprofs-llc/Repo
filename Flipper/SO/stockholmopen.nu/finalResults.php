<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();
$iYear = $oHTTPContext->getInt("iYear");
$sDivision = $oHTTPContext->getString("sDivision");
$sText = $oHTTPContext->getString("sText");

// read the content of the file and assign it to the template
$sFile = TEMPLATE_DIR . "finals/" . $iYear . "/" . $sDivision . ".html";
$fh = fopen($sFile, 'r');
$sFileContent = fread($fh, filesize($sFile));
fclose($fh);


if($sText != null)
{
	// new text has been submitted, write to a backup-file
	$bFileFound = false;
	$i = 1;
	
	while($bFileFound == false)
	{
		$sFileWrite = TEMPLATE_DIR . "finals/" . $iYear . "/bak." . $i . "." . $sDivision . ".html";
		if(!file_exists($sFileWrite))
			$bFileFound = true;	
		$i++;
	}
	
	$fh = fopen($sFileWrite, 'w');
	fwrite($fh, $sText);
	fclose($fh);
	
	// write the new content to the original file
	$fh = fopen($sFile, 'w');
	fwrite($fh, $sText);
	fclose($fh);
	// read the new content'
	$fh = fopen($sFile, 'r');
	$sFileContent = fread($fh, filesize($sFile));
	fclose($fh);
	
	// for some reason the text-area gets some weird chars if we don't reload the page, so ....
	header("location: " . $_SERVER['PHP_SELF'] . "?iYear=" . $iYear . "&sDivision=" . $sDivision);
}

$oTemplate->assign("sFileContent", $sFileContent);
$oTemplate->assign("iYear", $iYear);
$oTemplate->assign("sDivision", $sDivision);
$oTemplate->display("finalResults.tpl.php");
?>