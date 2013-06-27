<?php
require_once("../config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.Validator.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "classes/class.Validator.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oForm = new HTMLFormTemplate($oTemplate, null, "get", $_SERVER['PHP_SELF'], null, null, true);
$oSmartyConfigFile = new SmartyConfigFile(MENU_CONFIG_FILE);
$oHTTPContext = new HTTPContext();

// get the input classes
$oSmartyConfigFile = new SmartyConfigFile(INPUTS_CONFIG_FILE);
$aInputClasses = $oSmartyConfigFile->getInputClasses();

// get the buttons-strings
$oSmartyConfigFile = new SmartyConfigFile(LANG_CONFIG_FILE);
$sProceed = $oSmartyConfigFile->getStringFromDefinition("CALCULATE");

// *** CREATE THE SUBMIT BUTTON(S) ***
$oForm->createFormSubmit($sProceed, $aInputClasses["submit"]);

// *** CREATE INPUTS ***
$sInputMain = "iMain";
$sInputClassics = "iClassics";
$sInputTeamMember = "iTeamMember";
$sInputTShirt = "iTShirt";
$sInputCurrency = "sCurrency";
$sInputTShirtSize = "sTShirtSize";
$sInputTShirtColor = "sTShirtColor";
$sInputType = "iType";

$oForm->createTextInput($sInputMain, false, 2, 2, null, $aInputClasses["default"], false, null, "onkeyup=\"calcEntranceFee()\"");
$oForm->createTextInput($sInputClassics, false, 2, 2, null, $aInputClasses["default"], false, null, "onkeyup=\"calcEntranceFee()\"");
$oForm->createTextInput($sInputTeamMember, false, 2, 2, null, $aInputClasses["default"], false, null, "onkeyup=\"calcEntranceFee()\"");
$oForm->createTextInput($sInputTShirt, false, 2, 2, null, $aInputClasses["default"], false, null, "onkeyup=\"calcEntranceFee()\"");
$oForm->createRadioButtons($sInputTShirtSize, unserialize(A_TSHIRT_SIZES), unserialize(A_TSHIRT_SIZES), true, "XL", $aInputClasses["default"], "onclick=\"calcEntranceFee()\"");
$oForm->createRadioButtons($sInputTShirtColor, unserialize(A_TSHIRT_COLORS), unserialize(A_TSHIRT_COLORS), true, "Blue", $aInputClasses["default"], "onclick=\"calcEntranceFee()\"");
$oForm->createRadioButtons($sInputCurrency, unserialize(A_CURRENCIES), unserialize(A_CURRENCIES), true, "SEK", $aInputClasses["default"], "onclick=\"calcEntranceFee()\"");
// create the paypal / bank transfer input
$sPaypalCreditCard = $oSmartyConfigFile->getStringFromDefinition("PAYPAL_CREDIT_CARD");
$sBankTransferDomestic = $oSmartyConfigFile->getStringFromDefinition("BANK_TRANSFER_DOMESTIC");
$sBankTransferInternational = $oSmartyConfigFile->getStringFromDefinition("BANK_TRANSFER_INTERNATIONAL");

$aVals[0] = 0;
$aVals[1] = 1;
$aVals[2] = 2;
$aOutput[0] = $sBankTransferDomestic;
$aOutput[1] = $sBankTransferInternational;
$aOutput[2] = $sPaypalCreditCard;

$oForm->createRadioButtons($sInputType, $aVals, $aOutput, true, "2", $aInputClasses["default"], "onclick=\"calcEntranceFee()\"");

$bPosted = $oHTTPContext->getString("bPosted");

$bDisplaySum = false;

// *** THE FORM IS POSTED ***
if($bPosted)
{
	$bDisplaySum = true;

	// ugly stuff coming up since i whipped this up quickly from a non-ajax form
	$oValidator = new Validator();
	
	$iMain = $oHTTPContext->getString($sInputMain);
	$iClassics = $oHTTPContext->getString($sInputClassics);
	$iTeamMember = $oHTTPContext->getString($sInputTeamMember);
	$iTShirt = $oHTTPContext->getString($sInputTShirt);
	$sCurrency = $oHTTPContext->getString($sInputCurrency);
	$sTShirtSize = $oHTTPContext->getString($sInputTShirtSize);
	$sTShirtColor = $oHTTPContext->getString($sInputTShirtColor);
	$iType = $oHTTPContext->getString($sInputType);
	
	// iType 0 = domestic bank transfer
	// iType 1 = int. bank transfer
	// iType 2 = paypal
	
	// all values can not be null
	if($iMain == null && $iClassics == null && $iTeamMember == null && $iTShirt == null)
	{
		$oForm->setCustomError("noDivisionSelected");
		$bDisplaySum = false;
	}
	
	// *** SET CUSTOM ERRORS ***
	if(!$oValidator->positiveInt($iMain) && $iMain != null)
	{
		$oForm->setCustomError("nonInteger");
		$bDisplaySum = false;
	}

	if(!$oValidator->positiveInt($iClassics) && $iClassics != null)
	{
		$oForm->setCustomError("nonInteger");
		$bDisplaySum = false;
	}

	if(!$oValidator->positiveInt($iTeamMember) && $iTeamMember != null)
	{
		$bDisplaySum = false;
		$oForm->setCustomError("nonInteger");
	}

        if(!$oValidator->positiveInt($iTShirt) && $iTShirt != null)
        {
                $bDisplaySum = false;
                $oForm->setCustomError("nonInteger");
        }
}

$bError = false;

// *** READY TO POST THE FORM
if($bDisplaySum)
{
	$oSmartyConfigFile = new SmartyConfigFile(MAIN_CONFIG_FILE);
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
/*
        if(!in_array($sTShirtSize, unserialize(A_TSHIRT_SIZES)))
        {
                // the T-shirt size is not among the sizes we're using
                $bError = true;
        }
*/
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

	if($dMainPrice == null || $dClassicsPrice == null || $dTeamMemberPrice == null || $dTShirtPrice == null || $dPayPalPercentage == null || $dPayPalFee == null)
	{
		// one of the values are missing, not to good
		$bError = true;
	}

	// add all fees to the sum
	$dSum = ($iMain * $dMainPrice) + ($iClassics * $dClassicsPrice) + ($iTeamMember * $dTeamMemberPrice) + ($iTShirt * $dTShirtPrice);
	$dSumWithoutPayPalFees = $dSum;

	if($iType == 2)
	{
		// add the pay pal charges
		$dPayPalPercentage = str_replace(".", "", $dPayPalPercentage); // remove the dot from the percentage
		$dPayPalPercentage = "1.0" . $dPayPalPercentage;
		$dSum = $dSum * $dPayPalPercentage;
		$dSum = $dSum + $dPayPalFee;
	}
	
	// round up to closest integer
	if($sCurrency == "SEK")
		$dSum = ceil($dSum);
	else
		$dSum = round($dSum, 1);

	if($dSum == null)
	{
		$bError = true;
	}

	$oTemplate->assign("sCurrency", $sCurrency);
	$oTemplate->assign("sTShirtSize", $sTShirtSize);
	$oTemplate->assign("sTShirtColor", $sTShirtColor);
	$oTemplate->assign("iType", $iType);
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
}

$oTemplate->assign("bError", $bError);

// *** END THE FORM ***
$oForm->endForm();

$oTemplate->display("forms/form.entranceFee.tpl.php");

if($bDisplaySum)
	$oTemplate->display("ajax/entranceFeePay.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>
