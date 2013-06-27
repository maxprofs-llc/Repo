<?php
require_once("config/inc.config.php");
require_once(BASE_DIR . "classes/class.Template.php");
require_once(BASE_DIR . "classes/class.HTMLFormTemplate.php");
require_once(BASE_DIR . "classes/class.SmartyConfigFile.php");
require_once(BASE_DIR . "classes/class.HTTPContext.php");
require_once(BASE_DIR . "classes/class.String.php");
require_once(BASE_DIR . "classes/class.Validator.php");
require_once(BASE_DIR . "classes/class.LogFile.php");
require_once(BASE_DIR . "models/class.Volunteer.php");

$oTemplate = Template::getInstance(unserialize(TEMPLATE_CONFIG), LANGUAGE);
$oHTTPContext = new HTTPContext();
$oForm = new HTMLFormTemplate($oTemplate, "default", "post", $_SERVER['PHP_SELF']);
$oVolunteer = new Volunteer();
$oString = new String();

$aDuties = $oVolunteer->getDuties();
// create the check-box array values
$aCheckBoxNamesDuties = array();
$aCheckBoxOutputDuties = array();
foreach ($aDuties as $val)
{
	$sCheckBoxName = "duty," . $val['id_vol_duty'];
	array_push($aCheckBoxNamesDuties, $sCheckBoxName);
	$sCheckBoxOutput = $val['vol_duty_name'] . " <i>(" . $val['vol_duty_desc'] . ")</i>";
	array_push($aCheckBoxOutputDuties, $sCheckBoxOutput);	
}

$aTimes = $oVolunteer->getTimes();
$aCheckBoxNamesTimes = array();
$aCheckBoxOutputTimes = array();
$aNumberForTime = array();

foreach ($aTimes as $val)
{
	$sCheckBoxName = "time," . $val['id_vol_time'];
	array_push($aCheckBoxNamesTimes, $sCheckBoxName);
	$aNumberForTime[$sCheckBoxName] = $oVolunteer->getNumberForTime($val['id_vol_time']);
	// TODO: should be formatted in the template, not here
	$sCheckBoxOutput = $oString->mySQLTimestampToSimpleDateTime($val['vol_time_start']) . " - " . $oString->mySQLTimestampToSimpleDateTime($val['vol_time_end']);
	array_push($aCheckBoxOutputTimes, $sCheckBoxOutput);	
}

// *** INIT THE FORM ***
$oForm->initForm();	

// *** CREATE INPUTS ***
// input names
$sInputFirstName = "sFirstName";
$sInputLastName = "sLastName";
$sInputEmail = "sEmail";
$sInputPhoneMobile = "sPhoneMobile";
$sInputTotalTime = "iTotalTime";
$sInputDuties = "sDuties";
$sInputTimes = "sTimes";

// get the input classes
$oSmartyConfigFile = new SmartyConfigFile(INPUTS_CONFIG_FILE);
$aInputClasses = $oSmartyConfigFile->getInputClasses();

$oForm->createTextInput($sInputFirstName, true, 32, 64, null, $aInputClasses["req"]);
$oForm->createTextInput($sInputLastName, true, 32, 64, null, $aInputClasses["req"]);
$oForm->createTextInput($sInputEmail, true, 32, 128, null, $aInputClasses["req"]);
$oForm->createTextInput($sInputPhoneMobile, true, 32, 64, null, $aInputClasses["req"]);
$oForm->createTextInput($sInputTotalTime, true, 3, 3, null, $aInputClasses["req"]);
$oForm->createCheckBoxes($sInputDuties, $aCheckBoxNamesDuties, $aCheckBoxOutputDuties, false, null, $aInputClasses["default"]);
$oForm->createCheckBoxes($sInputTimes, $aCheckBoxNamesTimes, $aCheckBoxOutputTimes, false, null, $aInputClasses["default"]);

// get the buttons-strings
$oSmartyConfigFile = new SmartyConfigFile(LANG_CONFIG_FILE);
$sSubmit = $oSmartyConfigFile->getStringFromDefinition("SUBMIT");

// *** CREATE THE SUBMIT BUTTON(S) ***
$oForm->createFormSubmit($sSubmit, $aInputClasses["submit"], "submit");

// *** THE FORM IS POSTED ***
if($oForm->isSubmit())
{
	// get the posted values
	$sFirstName = $oHTTPContext->getString($sInputFirstName);
	$sLastName = $oHTTPContext->getString($sInputLastName);
	$sEmail = $oHTTPContext->getString($sInputEmail);
	$sPhoneMobile = $oHTTPContext->getString($sInputPhoneMobile);
	$iTotalHours = $oHTTPContext->getInt($sInputTotalTime);

	$aDutyIDs = array();
	$aTimeIDs = array();
	
	foreach($aCheckBoxNamesDuties as $val)
	{
		if($oHTTPContext->getString($val) == "on")
		{
			$aSplit = preg_split("/,/", $val);
			array_push($aDutyIDs, $aSplit[1]);
		}
	}
	
	foreach($aCheckBoxNamesTimes as $val)
	{
		if($oHTTPContext->getString($val) == "on")
		{
			$aSplit = preg_split("/,/", $val);
			array_push($aTimeIDs, $aSplit[1]);
		}
	}

	$oValidator = new Validator();
	if(!$oValidator->validEmail($sEmail))
		$oForm->setCustomError("invalidEmail");
	if(count($aDutyIDs) < 1)
		$oForm->setCustomError("noDuties");
	if(count($aTimeIDs) < 1)
		$oForm->setCustomError("noTimes");
	// we need at least 
}

// *** READY TO POST THE FORM
if($oForm->postData())
{
	// insert the volunteer
	$iIDLast = $oVolunteer->insert($sFirstName, $sLastName, $sEmail, $sPhoneMobile, $iTotalHours);
	$oVolunteer->insertTimes($aTimeIDs, $iIDLast);
	$oVolunteer->insertDuties($aDutyIDs, $iIDLast);
}

// log all form errors
if($oForm->hasErrors())
{
	// store all errors in a string
	$aCustomErrors = $oForm->getCustomErrors();
	$sError = null;
	foreach($aCustomErrors as $key => $val) 
	{
		// if the key isn't numeric, it's a custom error
		if(!is_numeric($key))
		{
			$sError .= $key . " ";	
		}
	} 		
	$oLogFile = new LogFile();
	$oLogFile->writeFailedForm(LOG_FILE_FORMS_FAILED, "volunteer", $sError);
}

// *** END THE FORM ***
$oForm->endForm();

$oTemplate->assign("aCheckBoxNamesDuties", $aCheckBoxNamesDuties);
$oTemplate->assign("aCheckBoxNamesTimes", $aCheckBoxNamesTimes);
$oTemplate->assign("aNumberForTime", $aNumberForTime);
$oTemplate->display("volunteer.tpl.php");

require_once(BASE_DIR . "includes/inc.end.php");
?>