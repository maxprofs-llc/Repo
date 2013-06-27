<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();
$oSmartyConfigFile = new SmartyConfigFile(MAIN_CONFIG_FILE);

$bError = false;

$sCurrency = $oHTTPContext->getString("sCurrency");
$sTShirtSize = $oHTTPContext->getString("sTShirtSize");
$sTShirtColor = $oHTTPContext->getString("sTShirtColor");
$iMain = $oHTTPContext->getString("iMain");
$iClassics = $oHTTPContext->getString("iClassics");
$iTeamMember = $oHTTPContext->getString("iTeamMember");
$iTShirt = $oHTTPContext->getString("iTShirt");

if($iMain == null && $iClassics == null && $iTeamMember == null && $iTShirt == null)
{
	// we need at least one value here
	$bError = true;
}

if(!in_array($sCurrency, unserialize(A_CURRENCIES)))
{
	// the currency is not among the currencies we're using
	$bError = true;
}

if(!in_array($sTShirtSize, unserialize(A_TSHIRT_SIZES)))
{
        // the T-shirt size is not among the sizes we're using
        $bError = true;
}

if(!in_array($sTShirtColor, unserialize(A_TSHIRT_COLORS)))
{
        // the T-shirt color is not among the colors we're using
        $bError = true;
}
$aMainPrice = preg_split('/ /', $oSmartyConfigFile->getStringFromDefinition("MAIN_TOURNAMENT_ENTRANCE_PRICE_" . $sCurrency));
$dMainPrice = $aMainPrice[0];
$aClassicsPrice = preg_split('/ /', $oSmartyConfigFile->getStringFromDefinition("CLASSICS_TOURNAMENT_ENTRANCE_PRICE_" . $sCurrency));
$dClassicsPrice = $aClassicsPrice[0];
$aTeamMemberPrice = preg_split('/ /', $oSmartyConfigFile->getStringFromDefinition("SPLIT_TOURNAMENT_ENTRANCE_PRICE_" . $sCurrency));
$dTeamMemberPrice = $aTeamMemberPrice[0];
$aTShirtPrice = preg_split('/ /', $oSmartyConfigFile->getStringFromDefinition("TSHIRT_PRICE_" . $sCurrency));
$dTShirtPrice = $aTShirtPrice[0];
$dPayPalPercentage = $oSmartyConfigFile->getStringFromDefinition("PAYPAL_ADD_PERCENT");
$aPayPalFee = preg_split('/ /', $oSmartyConfigFile->getStringFromDefinition("PAYPAL_FEE_" . $sCurrency));
$dPayPalFee = $aPayPalFee[0];

if($dMainPrice == null || $dClassicsPrice == null || $dTeamMemberPrice == null || $dPayPalPercentage == null || $dPayPalFee == null || $dTShirtPrice == null)
{
	// one of the values are missing, not to good
	$bError = true;
}

// add all fees to the sum
$dSum = ($iMain * $dMainPrice) + ($iClassics * $dClassicsPrice) + ($iTeamMemberPrice * $dTeamMemberPrice) + ($iTShirt * $dTShirtPrice);
$dSumWithoutPayPalFees = $dSum;

// add the pay pal charges
$dPayPalPercentage = str_replace(".", "", $dPayPalPercentage); // remove the dot from the percentage
$dPayPalPercentage = "1.0" . $dPayPalPercentage;

$dSum = $dSum * $dPayPalPercentage;
$dSum = $dSum + $dPayPalFee;

// round up to closest integer
if($sCurrency == "SEK")
	$dSum = ceil($dSum);
else
	$dSum = round($dSum, 1);

if($dSum == null)
	$bError = true;

$oTemplate->assign("sCurrency", $sCurrency);
$oTemplate->assign("sTShirtSize", $sTShirtSize);
$oTemplate->assign("sTShirtColor", $sTShirtColor);
$oTemplate->assign("dSum", $dSum);
$oTemplate->assign("dSumWithoutPayPalFees", $dSumWithoutPayPalFees);
$oTemplate->assign("dPayPalFees", ($dSum - $dSumWithoutPayPalFees));
$oTemplate->assign("iMain", $iMain);
$oTemplate->assign("dMainPrice", $dMainPrice);
$oTemplate->assign("iClassics", $iClassics);
$oTemplate->assign("dClassicsPrice", $dClassicsPrice);
$oTemplate->assign("iTeamMember", $iTeamMember);
$oTemplate->assign("dTeamMemberPrice", $dTeamMemberPrice);
$oTemplate->assign("iTShirt", $iTShirt);
$oTemplate->assign("dTShirtPrice", $dTShirtPrice);
$oTemplate->assign("bError", $bError);

$oTemplate->display("entranceFeePay.tpl.php");
require_once(BASE_DIR . "includes/inc.end.php");
?>
