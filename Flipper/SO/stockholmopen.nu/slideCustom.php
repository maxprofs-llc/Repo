<?php
// this page can display "custom"-slide pages: just add the files to:
// views/templates/slideCustom/slide1.html
// views/templates/slideCustom/slide2.html
// etc.
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
$oHTTPContext = new HTTPContext();
$oSmartyConfigFile = new SmartyConfigFile(MAIN_CONFIG_FILE);
$iSlideSpeed = $oSmartyConfigFile->getStringFromDefinition("SLIDE_SPEED_CUSTOM");

$iNumber = $oHTTPContext->getInt("iNumber");
$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);

$sPageToDisplay = null;
$bError = false;

if($iNumber == null)
{
	// we're entering the slide for the first time
	if(!@file_exists(TEMPLATE_DIR . "slideCustom/slide1.html"))
	{
		$bError = true;
		$oTemplate->assign("bFirstPageMissing", true);
		$sPageToDisplay = "slideCustom/slideCustomError.html";		
	}	
}

if(!$bError)
{
	if($iNumber == null)
	{
		// we're entering the slide for the first time
		$sPageToDisplay = "slideCustom/slide1.html";
		$iNumber = 1;
	}
	else
	{
		$sPageToDisplay = "slideCustom/slide" . $iNumber . ".html";	
	}
}

$iSlideSpeed = $iSlideSpeed * 1000;
$iNumberNext = $iNumber + 1;

// check if the next file exists		
if(!@file_exists(TEMPLATE_DIR . "slideCustom/slide" . $iNumberNext . ".html"))
{
	// the "next" page will be page 1 then
	$iNumberNext = 1;
}	

// damn, but i really HAVE to echo some javascript code here since the template files should be dynamic and added by users
?>
<script type="text/javascript">
	setTimeout("reload()", <?php echo $iSlideSpeed ?>);

	function reload()
	{
		window.location.href ='<?php $_SERVER['PHP_SELF'] ?>?iNumber=<?php echo $iNumberNext ?>';
	}
</script>

<?php
$oTemplate->display($sPageToDisplay);
?>