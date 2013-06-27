<?php
// TODO: set the functions to the correct type (priv, publ. etc), just used public now since this was developed in PHP4,
// from the start

// And... it's a mess, and is getting messier all the time as I add functionallity. The basic concepts works though, but
// it's about time to re-write this class and split it into several small(er) class(es)

// handles most, basic, stuff that you want to do with forms
// it relies, heavily, on sessions

if(!defined('SID'))
	session_start();

require_once("class.HTMLInput.php");
require_once("class.HTTPContext.php");
	
class HTMLForm
{
	// objects
	private $oHTMLInput = null;
	private $oHTTPContext = null;
	
	// "normal" states
	private $sFormStateDefaultStart = "defaultStart";
	private $sFormStateDefaultSubmit = "defaultSubmit";
	private $sFormStateDefaultPost = "defaultPost";
	private $sFormStateDefaultCompleted = "defaultCompleted";

	// verification states
	private $sFormStateVerStart = "verStart";
	private $sFormStateVerOption = "verOption";
	private $sFormStateVerBack = "verBack";
	private $sFormStateVerSubmit = "verSubmit";
	private $sFormStateVerPost = "verPost";
	private $sFormStateVerCompleted = "verCompleted";
	
	// edit states
	private $sFormStateEditStart = "editStart";
	private $sFormStateEditSubmit = "editSubmit";
	private $sFormStateEditPost = "editPost";
	private $sFormStateEditCompleted = "editCompleted";
	
	// delete states
	private $sFormStateDeleteStart = "deleteStart";
	private $sFormStateDeleteOption = "deleteOption";	
	private $sFormStateDeleteSubmit = "deleteSubmit";
	private $sFormStateDeletePost = "deletePost";
	private $sFormStateDeleteCancel = "deleteCancel";
	private $sFormStateDeleteCompleted = "deleteCompleted";
	private $sFormStateDeleteFailed = "deleteFailed";
	
	// holds all inputs
	private $aInputs = array();
	
	// ver. output values
	//private $aVerificationValues = array();
	
	// custom errors
	private $aCustomErrors = array();
	// warnings
	private $aWarnings = array();
	
	// form start and end strings
	private $sFormStart = null;
	private $sFormEnd = null;
	
	// the entire submit-button string
	private $sButtons = null;
		
	// submit buttons
	private $sButtonVerBack = null;				
	private $sButtonVerProceed = null;				
	private $sButtonVerSubmit = null;		
	private $sButtonSubmit = null;
	private $sButtonEdit = null;
	
	// various booleans
	private $bIsDefaultForm = false;
	private $bIsVerForm = false;
	private $bIsFileForm = false;
	private $bHasErrors = false;
	private $bHasWarnings = false;
	private $bDisplayForm = false;
	private $bReqFieldsMissing = false;
	private $bAlwaysPost = false;
	private $bDisplayVerValues = false;
	private $bVerValuesChecked = false;
	private $bForcePost = false;
	private $bUseSessionPrePopulateVars = false;
	
	// id's
	private $iIDEdit = null;
	private $iIDDelete = null;
	
	
	// misch-ish stuff
	private $sFormState = null;
	private $sFormMethod = null;
	private $aMissingFields = array();
	private $aMissingLabels = array();
	private $sReqFieldsMissingString = "*";
	private $aInputNames = array();
	
	private $sFormSessionPrefix = null;
	
	public function __construct($a_sFormType = "default", $a_sMethod, $a_sAction, $a_sName = null, $a_bFileForm = false, $a_bAlwaysPost = false, $a_bUseSessionPrePopulateVars = false, $a_bUseFormName = false)
	{
		$this->oHTMLInput = new HTMLInput();
		$this->oHTTPContext = new HTTPContext();		
		// set the form action
		if($a_sMethod != "get" && $a_sMethod != "post")
			$a_sMethod = "post";			
		if($a_sAction == null)
			$a_sAction = $_SERVER['PHP_SELF'];
		
		if($a_sFormType == null)
			$a_sFormType = "default";

		$aAllowedTypes = array("default", "verify");
		if(!in_array($a_sFormType, $aAllowedTypes))
		{
			// an unknown type...
			$a_sFormType = "default";
		}
		
		if($a_sName == null)
			$a_sName = "form";		
		
		// set various attributes
		$this->bIsDefaultForm = $a_bFileForm;
		$this->sFormMethod = $a_sMethod;
		if($a_sFormType == "default")
			$this->bIsDefaultForm = true;
		if($a_sFormType == "verify")
			$this->bIsVerForm = true;
			
		$this->setAlwaysPost($a_bAlwaysPost);		
		$this->bUseSessionPrePopulateVars = $a_bUseSessionPrePopulateVars;
		$this->sFormSessionPrefix = $a_sName . "_" . $a_sAction . "_";
		
		// create the forms start string
		$this->sFormStart = $this->createFormStart($a_sMethod, $a_sAction, $a_sName, $a_bFileForm, $a_bUseFormName);		
	}
	
	public function initForm()
	{
		// sets the forms start-state
		$this->setStartState();	
		
		// if it's a start of a form we want to set the session var that tells the form to post the data
		if($this->isStart())
			$this->setSessionPost();
		// if we've gone back on a ver. form we want to reset the session
		if($this->isVerOption())
			$this->setSessionPost();						
	}
		
	public function isSubmit()
	{
		// if the post-session var isn't set it's not a submit
		if(!$this->isSetSession())
			return false;
					
		if($this->isSubmitted()) // if the form is submitted
		{
			// verify all req. values
			if(!$this->verifyReqValues())
				return false;
		}
		
		if($this->isSubmitted() && !$this->bHasErrors)
			return true;
		else
			return false;
	}
	
	public function postData()
	{
		$bCompleted = true;
		
		// in case of mis-usage where the req. values wouldn't be checked before this
		if(!$this->bVerValuesChecked && $this->isSubmitted())
		{
			if(!$this->verifyReqValues())
				return false;
		}
							
		// if it's an edit submit we always want to return false
		if($this->isEditSubmit())
			return false;
			
		// check if the form is completed/ok and ready to post the data for
		if(!$this->hasErrors() && !$this->hasCustomErrors() && $this->isSubmitted())
		{			
			if($this->getFormState() == $this->sFormStateVerBack) // if it's a ver. back thingie we don't want to post anything
				$bCompleted = false;
			elseif($this->getFormState() == $this->sFormStateVerOption) // and, if it's a ver. option we won't want to post
				$bCompleted = false;
			else
				$bCompleted = true;
		}
		else
			$bCompleted = false;
			
		// set the forms state to completed
		if($bCompleted == true)
		{
			// unless it's a verification form
			if($this->isVerForm())
				$this->setFormState($this->sFormStateVerCompleted);
			else
				$this->setFormState($this->sFormStateDefaultCompleted);
		}
		
		// if we, for some reason, always want to post the form
		if($this->alwaysPost() && $bCompleted == true)
			return true;
			
		// if the "post" session is set, and the form is completed
		if($this->isSetSession() && $bCompleted == true)
		{
			// unset the session "post" var, unless we want to force the post
			if(!$this->bForcePost)
			{
				$this->unsetSessionPost();
			}
			
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	public function postDataEdit()
	{
		// in case of mis-usage where the req. values wouldn't be checked before this
		if(!$this->bVerValuesChecked && $this->isSubmitted())
		{
			if(!$this->verifyReqValues())
				return false;
		}
		
		if($this->isEditSubmit() && !$this->hasErrors())
		{
			$this->setFormState($this->sFormStateEditCompleted);
			return true;
		}
		else		
			return false;	
	}
	
	public function endForm()
	{
		// if the form has been submitted, we want to register session vars for all posted values
		if($this->isSubmitted())
			$this->setSessionVars();
		
		$this->setEndState();
		
		// check if we should display etc. the form or not
		if($this->isCompleted() || $this->isEditCompleted() || $this->isDeleteCompleted() || $this->isDeleteFailed() || $this->isVerCompleted())
		{
			// remove warning-state
			$this->setDisplayForm(false);
			$this->setWarningState(false);
		}
		else
			$this->setDisplayForm(true);

		// if it's a ver. option, and the form has no errors, we want to convert the inputs to hidden 
		//to display the output values
		if(($this->getFormState() == $this->sFormStateVerOption) && !$this->hasErrors())
			$this->makeVerificationInputs();

		$this->prepareButtons();
		// assign edit and delete id's (if there are any)
		$this->assignIDEdit();
		$this->cleanUpInputs();
		// if the form is displayed, we want to reset the session-post-var so it gets posted even though the user uses the browser back-button(s)
		if($this->bDisplayForm)
			$this->setSessionPost();
		
		// if the form has been posted/completed we want to unset all session vars
		if($this->isCompleted())
			$this->unsetSessionVars();
		
		//$this->assignIDDelete();	
	}

	public function isSubmitted()
	{
		// if any of the submit-states are posted return true
		if($this->getFormState() == $this->sFormStateDefaultSubmit)
			return true;
		elseif($this->getFormState() == $this->sFormStateVerOption)
			return true;
		elseif($this->getFormState() == $this->sFormStateVerSubmit)
			return true;
		elseif($this->getFormState() == $this->sFormStateEditSubmit)
			return true;
		elseif($this->getFormState() == $this->sFormStateDeleteSubmit)
			return true;
		else
			return false;
	}	
	
	public function setFormState($a_sFormState)
	{
		$this->sFormState = $a_sFormState;
	}
	
	public function setErrorState()
	{
		$this->bHasErrors = true;
	}
	
	// *** INPUTS ***
	public function getInputs()
	{
		return $this->aInputs;
	}

	public function setInputs($a_aInputs)
	{
		$this->aInputs = $a_aInputs;
	}	
	
	public function setMissingFieldsString($a_sStr)
	{
		$this->sReqFieldsMissingString = $a_sStr;
	}
	
	// *** CUSTOM ERRORS ***
	public function setCustomError($a_sErrorType, $a_sInputName = null, $a_sErrorMessage = null)
	{
		$iCustomErrorCount = count($this->aCustomErrors);
		// adding this for some legacy-ish code
		$this->aCustomErrors[$a_sErrorType] = true;
		
		// don't set the custom errors if there are required fields missing
		if(!$this->hasReqFieldsMissing())
		{
			if($a_sInputName != null)
			{
				$this->aInputs[$a_sInputName]['hasError'] = true;
				$this->aInputs[$a_sInputName]['errorMessage'] = $a_sErrorMessage;
			}
			
			//$this->aCustomErrors[$a_sErrorType] = true;
			$this->aCustomErrors[$iCustomErrorCount][$a_sErrorType]['error'] = true;
			$this->aCustomErrors[$iCustomErrorCount]['errorMessage'] = $a_sErrorMessage;
			// set the forms status to not ok
			$this->setErrorState();
		} 
	}
	
	public function getCustomErrors()
	{
		return $this->aCustomErrors;
	}
	
	public function hasCustomErrors()
	{
		if(count($this->aCustomErrors) != 0)
			return true;
		else
			return false;
	}	
	
	// *** VERIFICATION VALUES ***
	public function replaceVerificationValues()
	{
		// we only want to replace them if it's a verify option and the form has no errors
		if($this->isVerOption() && !$this->hasErrors())	
			return true;
		else
			return false;
	}
	
	// nifty to use if we want to replace a verification (output) value
	public function replaceVerificationValue($a_sKey, $a_sValue)
	{
		$this->aInputs[$a_sKey]['verValue'] = $a_sValue;
		$this->aInputs[$a_sKey]['verValueOverride'] = true;
	}

	/*
	public function getVerificationValues()
	{
		return $this->aVerificationValues;
	}

	public function getVerificationValue($a_sKey)
	{
		return $this->aVerificationValues[$a_sKey]['output'];
	}	

	public function replaceVerificationValue($a_sKey, $a_mValue)
	{
		$this->aVerificationValues[$a_sKey]['output'] = $a_mValue;
	}	
	*/
	// *** WARNINGS ***
	public function setWarningState($a_bWarningState)
	{
		$this->bHasWarnings = $a_bWarningState;
	}
	
	public function setWarning($a_sWarningType, $a_sInputName = null, $a_sString = null)
	{
		// only set the warning(s) if there are no errors in the form
		if(!$this->hasErrors())
		{
			$this->bHasWarnings = true;
	
			$this->aWarnings[$a_sWarningType]['warning'] = true;
			$this->aWarnings[$a_sWarningType]['warningMessage'] = $a_sString;		
	
			if($a_sInputName != null)
			{
				$this->aInputs[$a_sInputName]['hasWarning'] = true;
			}
			
			return $this->aWarnings[$a_sWarningType];
		}
		else
			return null;
	}
	
	public function getWarnings()
	{
		return $this->aWarnings;
	}
	
	public function hasWarnings()
	{
		return $this->bHasWarnings;
	}	
	
	// *** ERRORS ***
	public function hasErrors()
	{
		return $this->bHasErrors;
	}
	
	public function getFormState()
	{
		return $this->sFormState;
	}

	public function setDisplayForm($a_bDisp)
	{
		$this->bDisplayForm = $a_bDisp;
	}
	
	public function displayForm()
	{
		return $this->bDisplayForm;
	}

	public function hideForm()
	{
		$this->aInputs = null;
		$this->sButtons = null;
		$this->sButtonEdit = null;
		$this->sButtonSubmit = null;
		$this->sButtonVerBack = null;
		$this->sButtonVerProceed = null;
		$this->sButtonVerSubmit = null;
		$this->sFormStart = null;
		$this->sFormEnd = null;
	}
	
	public function displayVerValues()
	{
		return $this->bDisplayVerValues;
	}
	
	public function displayStartText()
	{
		if($this->displayForm() && $this->isStart())
			return true;
		else 
			return false;
	}
	
	public function setAlwaysPost($a_bPost)
	{
		$this->bAlwaysPost = $a_bPost;
	}
	
	public function alwaysPost()
	{
		return $this->bAlwaysPost;
	}
	
	public function setReqFieldsMissing($a_bMissing)
	{
		$this->bReqFieldsMissing = $a_bMissing;
	}
	
	public function hasReqFieldsMissing()
	{
		return $this->bReqFieldsMissing;
	}
	
	public function setSessionPost()
	{
		$_SESSION['_form']['doPost'] = true;
	}
	
	public function unsetSessionPost()
	{
		$_SESSION['_form']['doPost'] = null;
		unset($_SESSION['_form']['doPost']);
	}
	
	public function isSetSession()
	{
		if(isset($_SESSION['_form']['doPost']))
			return true;
		else
			return false;
	}
	
	
	public function setSessionVars()
	{
		if($this->bUseSessionPrePopulateVars)
		{
			foreach($this->aInputs as $input)
			{
				if(isset($input['isGroup']) && $input['isGroup'] == true)
				{
					// loop through the input-names
					foreach($input['names'] as $inputname)
					{
						// use this hack-ish prefix to not overwrite any set vars
						$sInputVal = $this->oHTTPContext->getString($inputname);
						// we have to set this so "isset" can be used, later on
						if($sInputVal == null)
							$sInputVal = '';						
								
						$_SESSION['_form'][$this->sFormSessionPrefix . $inputname] = $sInputVal;
					}
				}
				if(isset($input['isMultiple']) && $input['isMultiple'] == true)
				{
					// a multiple-select
					$aVals = $this->oHTTPContext->getMultiple($input['inputName']);
					// we have to set this so "isset" can be used, later on
					if($aVals == null)
						$aVals = '';	
					$_SESSION['_form'][$this->sFormSessionPrefix . $input['inputName']] = $aVals;
				}
				else
				{
					// ... a normal-ish input
					$sInputVal = $this->oHTTPContext->getString($input['inputName']);
					// we have to set this so "isset" can be used, later on
					if($sInputVal == null)
						$sInputVal = '';						

					// use this hack-ish prefix to not overwrite any set vars
					$_SESSION['_form'][$this->sFormSessionPrefix . $input['inputName']] = $sInputVal;
				}
			}
		}
	}
	// TODO: unset group inputs (groups seem to work as of 080130)
	public function unsetSessionVars()
	{
		if($this->bUseSessionPrePopulateVars)
		{
			if(is_array($this->aInputs))
			{
				foreach($this->aInputs as $input)
				{
					$_SESSION['_form'][$this->sFormSessionPrefix . $input['inputName']] = null;
					unset($_SESSION['_form'][$this->sFormSessionPrefix . $input['inputName']]);
				}
			}
		}
	}
	
	public function setStartState()
	{
		if($this->isDefaultForm()) // it's a default form
		{
			// we want to set it to the "edit start" state, triggered with an "iIDEdit" varibale
			if($this->oHTTPContext->isPosted("iIDEdit"))
			{
				// unless the edit button is posted
				if($this->oHTTPContext->isPosted("buttonEdit"))
					$this->setFormState($this->sFormStateEditSubmit);
				else
					$this->setFormState($this->sFormStateEditStart);
			}
			elseif($this->oHTTPContext->isPosted("iIDDelete")) // it's the start of a delete
			{
				// unless the "buttonDelete" button is posted
				if($this->oHTTPContext->getString("buttonDelete") != null)
					$this->setFormState($this->sFormStateDeleteSubmit);
				else
					$this->setFormState($this->sFormStateDeleteStart);
			}
			elseif($this->oHTTPContext->getString("buttonSubmit") != null)
				$this->setFormState($this->sFormStateDefaultSubmit);
			elseif($this->oHTTPContext->getString("buttonEdit") != null)
				$this->setFormState($this->sFormStateEditSubmit);
			else
				$this->setFormState($this->sFormStateDefaultStart);			
		}
		
		if($this->isVerForm()) // if it's a ver. form
		{
			if($this->oHTTPContext->getString("buttonVerProceed") != null)
				$this->setFormState($this->sFormStateVerOption);
			elseif($this->oHTTPContext->getString("buttonVerBack") != null)
				$this->setFormState($this->sFormStateVerBack);
			elseif($this->oHTTPContext->getString("buttonVerSubmit") != null)
				$this->setFormState($this->sFormStateVerSubmit);
			elseif($this->oHTTPContext->isPosted("iIDDelete")) // it's the start of a delete
			{
				// unless the "buttonDelete" button is posted
				if($this->oHTTPContext->getString("buttonDelete") != null)
					$this->setFormState($this->sFormStateDeleteSubmit);
				else
					$this->setFormState($this->sFormStateDeleteStart);
			}
			elseif($this->oHTTPContext->isPosted("iIDEdit")) // it's the start of an edit
			{
				// unless the "buttonEdit" button is posted
				if($this->oHTTPContext->getString("buttonEdit") != null)
					$this->setFormState($this->sFormStateEditSubmit);
				else				
					$this->setFormState($this->sFormStateEditStart);			
			}
			else // well, it's a ver. start
				$this->setFormState($this->sFormStateVerStart);
		}
		
	}	

	public function setEndState()
	{
		if($this->isVerForm()) // if it's a ver. form
		{
			if(($this->getFormState() == $this->sFormStateVerOption) && $this->hasErrors())
			{
				// we've got a ver. option with errors, set the state to ver. start
				$this->setFormState($this->sFormStateVerStart);
			}

			if(($this->getFormState() == $this->sFormStateEditSubmit) && $this->hasErrors())
			{
				// we've got a ver. option with errors, set the state to ver. start
				$this->setFormState($this->sFormStateEditStart);
			}			
		}
		else // a "default", or a "delete" form
		{
			// *** DELETE STATES ***
			// if it's a submitted delete, and it has no errors
			if(($this->getFormState() == $this->sFormStateDeleteSubmit) && !$this->hasErrors())
				$this->setFormState($this->sFormStateDeleteCompleted);
			// if it's a submitted delete, and it HAS errors
			if(($this->getFormState() == $this->sFormStateDeleteSubmit) && $this->hasErrors())
				$this->setFormState($this->sFormStateDeleteStart);	
	
			// *** DEFAULT STATES ***
			// if it's a submitted default form and there are no errors, it's completed
			if(($this->getFormState() == $this->sFormStateDefaultSubmit) && !$this->hasErrors())
				$this->setFormState($this->sFormStateDefaultCompleted);
				
			// *** EDIT STATES ***	
			// if it's a submitted edit, and it has no errors	
			if(($this->getFormState() == $this->sFormStateEditSubmit) && !$this->hasErrors())
				$this->setFormState($this->sFormStateEditCompleted);
				
			// if it's a submitted edit, and it has errors we want to set it to edit-start
			if(($this->getFormState() == $this->sFormStateEditSubmit) && $this->hasErrors())
				$this->setFormState($this->sFormStateEditStart);
		}		
	}	
	
	
	public function getFormStart()
	{
		return $this->sFormStart;
	}

	public function getFormEnd()
	{
		$sString = null;
		// add the edit id to the form end
		if($this->iIDEdit != null)
			$sString = $this->createHiddenInput("iIDEdit", $this->iIDEdit, false);
		
		$this->sFormEnd .= " " . $sString;
		
		return $this->sFormEnd . " </form>";
	}

	public function getMissingFields()
	{
		return $this->aMissingFields;
	}
	
	public function getMissingLabels()
	{
		return $this->aMissingLabels;
	}
	
	
	// add hidden input to the form end string
	public function addHiddenInputToFormEnd($a_sName, $a_sValue, $b_Req = false)
	{
		$this->sFormEnd .= " " . $this->createHiddenInput($a_sName, $a_sValue, $b_Req);
	}

	// ugly hack when we want to add a hidden input to a regular input
	public function addHiddenInputToInput($a_sName, $a_sValue, $b_Req = false)
	{
		$sInput = $this->aInputs[$a_sName]['input'];
		$this->aInputs[$a_sName]['input'] = $sInput . $this->createHiddenInput($a_sName, $a_sValue, $b_Req);
	}
		
	// *** BUTTONS ***
	public function getButtonSubmit()
	{
		return $this->sButtonSubmit;
	}
	
	public function getButtonVerBack()
	{
		return $this->sButtonVerBack;
	}
	
	public function getButtonVerProceed()
	{
		return $this->sButtonVerProceed;
	}
	
	public function getButtonVerSubmit()
	{
		return $this->sButtonVerSubmit;
	}
	
	public function getButtons()
	{
		return $this->sButtons;
	}
	
	// hides the buttons that shouldn't be displayed
	public function prepareButtons()
	{
		if($this->isVerForm())
		{
			if($this->getFormState() == $this->sFormStateVerStart)
			{
				$this->sButtonVerSubmit = null;	// start of a ver., hide the ver. submit button
				$this->sButtonVerBack = null; // hide the ver. back button too
			}

			if($this->getFormState() == $this->sFormStateVerOption)
			{
				$this->sButtonVerProceed = null;	// option of a ver., hide the ver. proceed button
			}
			
			if($this->getFormState() == $this->sFormStateVerBack)
			{
				$this->sButtonVerSubmit = null;	// start of a ver., hide the ver. submit button
				$this->sButtonVerBack = null; // hide the ver. back button too
			}
	
			if($this->getFormState() == $this->sFormStateVerSubmit)
			{
				// the ver. is submitted, hide all buttons, unless there are errors in the form (this could happen in some odd cases where the user is messing with the URL)
				if(!$this->hasErrors())
				{
					$this->sButtonVerSubmit = null;
					$this->sButtonVerBack = null;
					$this->sButtonVerProceed = null;
				}
				else // if there are errors we just want to display the submit and back buttons
					$this->sButtonVerProceed = null;
			}
			
			if($this->getFormState() == $this->sFormStateDefaultCompleted)
			{
				// the form is completed
				$this->sButtonVerSubmit = null;	// start of a ver., hide the ver. submit button
				$this->sButtonVerBack = null; // hide the ver. back button too
			}
			
			if($this->isDeleteForm())
			{
				$this->sButtonVerBack = null;
				$this->sButtonVerProceed = null;
				$this->sButtonVerSubmit = null;
				$this->sButtonEdit = null;	
			}

			if($this->isEditForm())
			{
				$this->sButtonVerBack = null;
				$this->sButtonVerProceed = null;
				$this->sButtonVerSubmit = null;
			}
			else
				$this->sButtonEdit = null;

			// just in case so we don't get any multiple submit buttons
			$this->sButtonSubmit = null;
		}
		else
		{
			if($this->getFormState() == $this->sFormStateDefaultStart)
			{
				$this->sButtonEdit = null;
			}
			elseif($this->getFormState() == $this->sFormStateDefaultSubmit)
			{
				$this->sButtonEdit = null;
			}
			elseif($this->getFormState() == $this->sFormStateEditStart)
			{
				// it's an edit-start, hide the submit button
				$this->sButtonSubmit = null;
			}		
				
		}
		// add all buttons to one string
		$this->sButtons = $this->sButtonVerBack . " " . $this->sButtonVerProceed . " "  . $this->sButtonVerSubmit . " " . $this->sButtonSubmit . " " . $this->sButtonEdit; 	
		return $this->sButtons;
	}

	public function isDefaultForm()
	{
		if($this->bIsDefaultForm)
			return true;
		else
			return false;				
	}
	
	public function isVerForm()
	{
		if($this->bIsVerForm)
			return true;
		else
			return false;
	}
	
	public function isFileForm()
	{
		if($this->bIsFileForm)
			return true;
		else
			return false;		
	}
	
	public function isStart()
	{
		if($this->getFormState() == $this->sFormStateDefaultStart) // a "default" start
			return true;
		elseif($this->getFormState() == $this->sFormStateVerStart) // a ver. start
			return true;
		elseif($this->getFormState() == $this->sFormStateVerBack) // a ver. back, which is, more or less, a start
			return true;
		elseif($this->getFormState() == $this->sFormStateEditStart)
			return true;
		elseif($this->getFormState() == $this->sFormStateDeleteStart)
			return true;
		else
			return false;
	}
	
	public function isDefaultStart()
	{
		if($this->getFormState() == $this->sFormStateDefaultStart)
			return true;
		else
			return false;
	}
	
	public function isDefaultSubmitted()
	{
		if($this->getFormState() == $this->sFormStateDefaultSubmit)
			return true;
		else
			return false;
	}
	
	public function isDefaultCompleted()
	{
		if($this->getFormState() == $this->sFormStateDefaultCompleted)
			return true;
		else
			return false;
	}
	
	public function isPost()
	{
		if($this->getFormState() == $this->sFormStateDefaultPost)
			return true;
		else
			return false;		
	}
	
	public function isVerStart()
	{
		if($this->getFormState() == $this->sFormStateVerStart)
			return true;
		else
			return false;
	}
	
	public function isVerOption()
	{
		if($this->getFormState() == $this->sFormStateVerOption)
			return true;
		else
			return false;		
	}
	
	public function isVerBack()
	{
		if($this->getFormState() == $this->sFormStateVerBack)
			return true;
		else
			return false;		
	}
	
	public function isVerSubmit()
	{
		if($this->getFormState() == $this->sFormStateVerSubmit)
			return true;
		else
			return false;		
	}
	
	public function isVerPost()
	{
		if($this->getFormState() == $this->sFormStateVerPost)
			return true;
		else
			return false;		
	}

	public function isVerCompleted()
	{
		if($this->getFormState() == $this->sFormStateVerCompleted)
			return true;
		else
			return false;		
	}	
	
	public function isEditForm()
	{
		if($this->getFormState() == $this->sFormStateEditStart)
			return true;
		elseif($this->getFormState() == $this->sFormStateEditSubmit)
			return true;
		elseif($this->getFormState() == $this->sFormStateEditPost)
			return true;
		elseif($this->getFormState() == $this->sFormStateEditCompleted)
			return true;
		else
			return false;			
	}
	
	public function isEditStart()
	{
		// sets the forms start-state
		$this->setStartState();	
		
		if($this->getFormState() == $this->sFormStateEditStart)
		{
			return true;
		}
		else
			return false;		
	}
	
	public function isEditSubmit()
	{
		if($this->getFormState() == $this->sFormStateEditSubmit)
			return true;
		else
			return false;			
	}

	public function assignIDEdit()
	{
		if($this->oHTTPContext->isPosted("iIDEdit"))
			$this->iIDEdit = $this->oHTTPContext->getString("iIDEdit");
	}
	/* won't use this
	public function isEditPost()
	{
		if($this->getFormState() == $this->sFormStateEditPost)
			return true;
		else
			return false;			
	}
	*/

	public function isDeleteForm()
	{
		if($this->isDeleteStart())
			return true;
		elseif($this->isDeleteOption())
			return true;
		elseif($this->isDeleteSubmit())
			return true;
		elseif($this->isDeletePost())
			return true;
		elseif($this->isDeleteCancel())
			return true;
		elseif($this->isDeleteCompleted())
			return true;
		elseif($this->isDeleteFailed())
			return true;
		else
			return false;							
	}
	
	public function isDeleteStart()
	{
		// sets the forms start-state
		//$this->setStartState();	
		if($this->getFormState() == $this->sFormStateDeleteStart)
		{
			// get and assign the edit id
			$this->iIDDelete = $this->oHTTPContext->getString("iIDDelete");
			return true;
		}
		else
			return false;
	}
	
	public function isDeleteOption()
	{
		if($this->getFormState() == $this->sFormStateDeleteOption)
			return true;
		else
			return false;		
	}

	public function isDeleteSubmit()
	{
		// if the post-session var isn't set it's not a submit
		if(!$this->isSetSession())
			return false;
		
		if($this->getFormState() == $this->sFormStateDeleteSubmit)
		{
			$this->unsetSessionPost();
			return true;
		}
		else
			return false;		
	}	
	
	public function isDeletePost()
	{
		if($this->getFormState() == $this->sFormStateDeletePost)
			return true;
		else
			return false;		
	}
	
	public function isDeleteCancel()
	{
		if($this->getFormState() == $this->sFormStateDeleteCancel)
			return true;
		else
			return false;		
	}
	
	public function isDeleteCompleted()
	{
		if($this->getFormState() == $this->sFormStateDeleteCompleted)
			return true;
		else
			return false;				
	}
	
	public function isDeleteFailed()
	{
		if($this->getFormState() == $this->sFormStateDeleteFailed)
			return true;
		else
			return false;		
	}
	
	public function setDeleteCompleted()
	{
		// hide the form
		$this->setDisplayForm(false);
		$this->setFormState($this->sFormStateDeleteCompleted);
	}
	
	public function setDeleteFailed()
	{
		// hide the form
		$this->setDisplayForm(false);
		$this->setFormState($this->sFormStateDeleteFailed);		
	}
	
	public function isCompleted()
	{
		if($this->getFormState() == $this->sFormStateDefaultCompleted)
			return true;
		elseif($this->isDeleteCompleted())
			return true;
		elseif($this->isVerCompleted())
			return true;
		elseif($this->isEditCompleted())
			return true;
		else
			return false;		
	}

	public function isEditCompleted()
	{
		if($this->getFormState() == $this->sFormStateEditCompleted)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}	
	
	public function createFormSubmit($a_sString, $a_sClass = null, $a_sType = null)
	{
		$sVerBack = "verBack";
		$sVerProceed = "verProceed";
		$sVerSubmit = "verSubmit";
		$sEdit = "edit";
		$sSubmit = "submit";
		$sDelete = "delete";
		
		if($a_sType == null)
			$a_sType = "submit";
		$aAllowedTypes = array("verBack", "verProceed", "verSubmit", "edit", "submit", "delete");
		if(!in_array($a_sType, $aAllowedTypes))
		{
			// set the default type to submit
			$a_sType = "submit";
		}
		
		if($a_sType == $sSubmit)
			$sName = "buttonSubmit";
		if($a_sType == $sVerBack)
			$sName = "buttonVerBack";
		elseif($a_sType == $sVerProceed)
			$sName = "buttonVerProceed";
		elseif($a_sType == $sVerSubmit)
			$sName = "buttonVerSubmit";
		elseif($a_sType == $sEdit)
			$sName = "buttonEdit";
		elseif($a_sType == $sDelete)
			$sName = "buttonDelete";
		elseif($a_sType == $sSubmit)
			$sName = "buttonSubmit";

		$sString = $this->oHTMLInput->getSubmit($sName, $a_sString, $a_sClass, $a_sType);
		
		if($a_sType == $sVerBack)
			$this->sButtonVerBack = $sString;				
		elseif($a_sType == $sVerProceed)
			$this->sButtonVerProceed = $sString;				
		elseif($a_sType == $sVerSubmit)
			$this->sButtonVerSubmit = $sString;				
		elseif($a_sType == $sEdit)
			$this->sButtonEdit = $sString;
		else
			$this->sButtonSubmit = $sString;
		
		return $sString;
	}
	
	public function getFormSubmit()
	{
		return $this->sFormSubmit;
	}
	
	public function getFormProceed()
	{
		return $this->sFormProceed;
	}
	
	public function getFormBack()
	{
		return $this->sFormBack;
	}

	public function forcePost()
	{
		$_SESSION['_form']["bPostTheForm"] = true;
		$this->bForcePost = true;
	}	

	public function forceDisplay()
	{
		$this->setDisplayForm(true);
	}
	
	public function cleanUpInputs()
	{
		// ugly stuff to get rid of notices etc.
		if($this->aInputs != null)
		{
			foreach($this->aInputs as $input)
			{
				if(!isset($this->aInputs[$input['inputName']]['input']))
					$this->aInputs[$input['inputName']]['input'] = null;
				if(!isset($this->aInputs[$input['inputName']]['errorMessage']))
					$this->aInputs[$input['inputName']]['errorMessage'] = null;
				if(!isset($this->aInputs[$input['inputName']]['reqFieldMissing']))
					$this->aInputs[$input['inputName']]['reqFieldMissing'] = null;

				// clean up verification values, if it's the start of an form
				if($this->isStart())
				{
					$this->aInputs[$input['inputName']]['verValue'] = null;
				}
	
			}
		}
		
	}
	
	public function makeVerificationInputs()
	{
		$aInputs = $this->aInputs;
		// we want to clear all inputs to rebuild them below
		$this->aInputs = null;
		$this->bDisplayVerValues = true;		
		
		// convert all inputs to hidden inputs and create the display values
		$i = 0;
		foreach($aInputs as $input)
		{
			// add the warning and error values, if any
			if(isset($input['hasWarning']))
				$this->aInputs[$input['inputName']]['hasWarning'] = true;

			if(isset($input['hasError']))
				$this->aInputs[$input['inputName']]['hasError'] = true;
			
			// if it's a group-input
			if(isset($input['isGroup']) && $input['isGroup'] == true)
			{
				$sGroupName = $input['inputName'];
				// set a var that states that we've got verification values for this group
				$this->aInputs[$sGroupName]['gotVerValue'] = true;
				$this->aInputs[$sGroupName]['inputName'] = $input['inputName'];

				// if it's a radio-group
				if(isset($input['isRadio']) && $input['isRadio'] == true)
				{	
					// get the posted value from the submit
					$sPostedValue = $this->oHTTPContext->getString($sGroupName);
					// create a hidden input in the first radio-buttons position
					$sFirstInputName = $input['names'][0];
					$this->aInputs[$sGroupName][$sFirstInputName]['input'] = $this->createHiddenInput($sGroupName, $sPostedValue, $input['isReq']);
					// we want the output value as verification value for this
					if(isset($aInputs[$sGroupName][$sPostedValue]['output']))
						$this->aInputs[$sGroupName]['verValue'] = $aInputs[$sGroupName][$sPostedValue]['output'];
					
					// create dummy-ish vars (to get rid of notices)
					foreach($input['names'] as $inputname)
					{
						if(!isset($this->aInputs[$inputname]))
						{
							$this->aInputs[$sGroupName][$inputname]['output'] = null;
							$this->aInputs[$sGroupName][$inputname]['input'] = null;					
						}	 
					}
				}
				else
				{
					// a "normal" group
					// loop through the names and see if the name is posted (= on)
					$bAddGroup = true;
					foreach($input['names'] as $inputname)
					{
						if($this->oHTTPContext->getString($inputname) == "on")
						{
							// if it's posted we want to create (a) hidden input(s) with this name and where it's value is on
							// we only want to add the group if it's the first time this loop is run
							if($bAddGroup == true) 
							{
								$this->addGroup($sGroupName, $input['isReq']);
								$bAddGroup = false;
							}
							
							$this->createGroupHiddenInput($sGroupName, $inputname, $inputname, "on", $input['isReq']);						
							
							// create the verification value for this input
							if(!isset($this->aInputs[$sGroupName]['verValue']))
							{
								$this->aInputs[$sGroupName]['verValue'] = $input[$inputname]['output']  . $input['separator'];
							}
							else
							{
								$this->aInputs[$sGroupName]['verValue'] = $this->aInputs[$sGroupName]['verValue'] . " " . $input[$inputname]['output'];
								$this->aInputs[$sGroupName]['verValue'].= $input['separator'];
							}
						}
						// this part will delete a previously stored (hidden) input if there is no value posted for inupt 2,3,4 etc.
						//else 
						//{
							//$this->aInputs[$sGroupName]['input'] = null;
						//}
					}					
					
					if(isset($this->aInputs[$sGroupName]['verValue']))
					{					
						// ugly, ugly, ugly, but let's strip the last char from the verValue string if it's a "separator-char"
						$iStrLen = strlen($this->aInputs[$sGroupName]['verValue']);
						$cLastChar = substr($this->aInputs[$sGroupName]['verValue'], ($iStrLen-1), 1);
						if($cLastChar == $input['separator'])
						{
							$this->aInputs[$sGroupName]['verValue'] = substr($this->aInputs[$sGroupName]['verValue'],0,($iStrLen-1));
						}
					}
					else
					{
						$this->aInputs[$sGroupName]['verValue'] = null;
					}
				}
			}
			else
			{
				// it's a "normal"-ish input
				$sInputName = $input['inputName'];
				$sInputValue = $this->oHTTPContext->getString($sInputName);

				if(isset($input['isMultiple']) && $input['isMultiple'] == true)
				{
					// get the posted values
					$aPostedValues = $this->oHTTPContext->getMultiple($input['inputName']);
					$sMultipleInputValue = null;
					$sMultipleInputHiddenValue = "multiple,";
					$iCount = count($aPostedValues);
					$i = 1;
					foreach($aPostedValues as $mPostedValue)
					{
						$sMultipleInputValue.= $mPostedValue . " ";						
						$sMultipleInputHiddenValue.= $mPostedValue;
						if($i < $iCount)
							$sMultipleInputHiddenValue.= ",";
						
						$i++;
					}
					// a multiple select hidden input
					$this->createMultipleHiddenInput($sInputName, $sMultipleInputHiddenValue, $input['isReq']);
				}
				else
				{
					$this->createHiddenInput($sInputName, $sInputValue, $input['isReq']);
				}
				
				// if it's a selectID we want to replace this with the output (from the select input) value
				if(isset($input['isSelectID']))
				{
					// find the position where the value is held
					$iPos = array_search($sInputValue, $input['values']);
					// replace with with the output value
					$this->aInputs[$sInputName]['verValue'] = $input['output'][$iPos];
					
					//$this->aVerificationValues[$sInputName]['output'] =  $input['output'][$iPos];
				}
				else
				{
					// if we've chosen to override the verification values
					if(isset($aInputs[$sInputName]['verValueOverride']))
					{
						// TODO: this should probably be fixed for multiple-inputs etc.
						$this->aInputs[$sInputName]['verValue'] = $aInputs[$sInputName]['verValue'];
					}
					else
					{
						// if it is a multiple select
						if(isset($input['isMultiple']) && $input['isMultiple'] == true)
						{	

							$aPostedVals = $this->oHTTPContext->getMultiple($input['inputName']);
							$sMultipleInputVerValue = null;
							foreach($aPostedVals as $inputVal)
								if($inputVal != null)
									$sMultipleInputVerValue.= $inputVal . $input['separator'];
									
							$this->aInputs[$sInputName]['verValue'] = $sMultipleInputVerValue;
						
							// ugly, ugly, ugly, but let's strip the last char from the verValue string if it's a "separator-char"
							$iStrLen = strlen($this->aInputs[$sInputName]['verValue']);
							$cLastChar = substr($this->aInputs[$sInputName]['verValue'], ($iStrLen-1), 1);
							if($cLastChar == $input['separator'])
								$this->aInputs[$sInputName]['verValue'] = substr($this->aInputs[$sInputName]['verValue'],0,($iStrLen-1));
						}
						else
						{
							// if we've chosen to use a specific verification-value for this input...
							if(isset($aInputs[$sInputName]['verValue']))
							{
								// if it's a checkbox the posted value will be "on", use the verValue then
								if($this->oHTTPContext->getString($sInputName) == "on")
									$this->aInputs[$sInputName]['verValue'] = $aInputs[$sInputName]['verValue'];
							}
							else	// use the posted value, with line-breaks, if any
							{		
								// a special case for a single check-box where we've used an array with verification values (such as "Yes/No" or whatever)
								if(isset($input['a_verValues']))
								{
									// if it's posted as "on", use the first value
									if($this->oHTTPContext->getString($sInputName) == "on")
										$this->aInputs[$sInputName]['verValue'] = $input['a_verValues'][0];
									else
										$this->aInputs[$sInputName]['verValue'] = $input['a_verValues'][1];																		
								}
								else
									$this->aInputs[$sInputName]['verValue'] = nl2br($sInputValue);
							}
						}
					}
				}
			}						
			
			// add the label to the input
			$sInputName = $input['inputName'];
			$this->aInputs[$sInputName]['label'] = $input['label'];
			$i++;
		}
	}

	public function verifyReqValues()
	{
		$this->bVerValuesChecked = true;
		
		$bAllFieldsSet = true;
		
		foreach($this->aInputs as $value)
		{
			$bCurrentFieldMissing = false;
			
			// if it's a group
			if(isset($value['isGroup']) && $value['isGroup'] == true)
			{
				$bGotPostedValue = false;
				if(isset($value['isRadio']))	
				{
					$bGotPostedValue = true;
					if($value['isRadio'] == true && $value['isReq'] == true)
					{
						if($this->oHTTPContext->getString($value['inputName']) == null)
						{
							// we've got a posted value for the group where input was required
							$bGotPostedValue = false;
						}
					}
					
					if($bGotPostedValue == false)
					{
						$bCurrentFieldMissing = true;
						$bAllFieldsSet = false;
						$this->setErrorState();
						$this->aInputs[$value['inputName']]['reqFieldMissing'] = $this->sReqFieldsMissingString;
					}
				}
				else
				{
					$bGotPostedValue = false;					
					// only check this if it's required
					if($value['isReq'] == true)
					{
						// loop through all the input names
						$iCount = count($value['names']);
						$bGotPostedValue = false;
						for($i = 0; $i < $iCount; $i++)
						{
							if($this->oHTTPContext->getString($value['names'][$i]) == 'on')
							{
								// we've got a posted value for the group where input was required
								$bGotPostedValue = true;
							}
						}
						
						if($bGotPostedValue == false)
						{
							$bCurrentFieldMissing = true;
							$bAllFieldsSet = false;
							$this->setErrorState();
							$this->aInputs[$value['inputName']]['reqFieldMissing'] = $this->sReqFieldsMissingString;
						}
					}
		
				}				
			}
			else // normal input, i.e. not a group
			{
				if(isset($value['isMultiple']) &&  $value['isMultiple'] == true)
				{
					if($value['isReq'] == true)
					{
						$bGotPostedValue = false;
						// it's a required multiple select, loop through the array
						$aMultInput = $this->oHTTPContext->getMultiple($value['inputName']);
						
						if(is_array($aMultInput))
						{
							foreach($aMultInput as $post)
							{
								if($post != null)
									$bGotPostedValue = true;
							}
						}
					}
					
					if($bGotPostedValue == false)
					{
						$this->setErrorState();
						$bCurrentFieldMissing = true;
						$bAllFieldsSet = false;
						$this->aInputs[$value['inputName']]['reqFieldMissing'] = $this->sReqFieldsMissingString;
					}					
				}
				else
				{	
					// it's a regular select	
					if($this->oHTTPContext->getString($value['inputName']) == null && $value['isReq'] == true)
					{
						// a reuired value is missing
						$this->setErrorState();
						$bCurrentFieldMissing = true;
						$bAllFieldsSet = false;						
						$this->aInputs[$value['inputName']]['reqFieldMissing'] = $this->sReqFieldsMissingString;
					}
				}
			}
			
			if($bCurrentFieldMissing == true)
			{
				if(!in_array($value['inputName'], $this->aMissingFields))
				{
					// push into the missing-fields array
					array_push($this->aMissingFields, $value['inputName']);
				}
				
				if(!in_array($value['label'], $this->aMissingLabels))
				{
					// push into the missing-labels array
					array_push($this->aMissingLabels, $value['label']);
				}				
			}
		}
		
		if($bAllFieldsSet == false)
			$this->setReqFieldsMissing(true);
		
		return $bAllFieldsSet;
	}	

	// *** ADDING OF ELEMENTS/INPUTS TO THE FORM
	// a_aVerValues is used for a single check-box that might want a "Yes/No" type of ver. value
	
	public function addElement($a_sBaseType, $a_sString, $a_sName, $a_bReq = false, $a_sType = null, $a_aValues = null, $a_aOutput = null, $a_sLabel = null, $a_sSeparator = null, $a_bDateInput = false, $a_sVerValue = null, $a_aVerValues = null)
	{
		$this->aInputs[$a_sName]['input'] = $a_sString;
		$this->aInputs[$a_sName]['inputName'] = $a_sName;
 		$this->aInputs[$a_sName]['isReq'] = $a_bReq;
 		$this->aInputs[$a_sName]['verValue'] = $a_sVerValue;
		$this->aInputs[$a_sName]['label'] = $a_sLabel;
		$this->aInputs[$a_sName]['separator'] = $a_sSeparator;
		$this->aInputs[$a_sName]['dateInput'] = $a_bDateInput;
		$this->aInputs[$a_sName]['errorMessage'] = null;				
		$this->aInputs[$a_sName]['reqFieldMissing'] = null;				
		$this->aInputs[$a_sName]['output'] = $a_aOutput;
		$this->aInputs[$a_sName]['a_verValues'] = $a_aVerValues;
		$this->aInputs[$a_sName]['baseType'] = $a_sBaseType;
		
		if($a_sType == "multipleSelect")
 			$this->aInputs[$a_sName]['isMultiple'] = true;
 		if($a_sType == "select")
 			$this->aInputs[$a_sName]['isSelect'] = true;
 		if($a_sType == "selectID")
 		{
 			$this->aInputs[$a_sName]['isSelectID'] = true;
 			$this->aInputs[$a_sName]['values'] = $a_aValues;
 		}
 		// add just to get rid of notices etc.
 		//$this->aVerificationValues[$a_sName]['output'] = null;
 		
 		// add the posted value to the input-value-array
 		$this->aInputs[$a_sName]['postedValue'] = $this->oHTTPContext->getString($a_sName);
	}

	public function addGroup($a_sGroup, $a_bReq = false, $sType = null, $a_sLabel = null, $a_sSeparator = null)
	{
		$this->aInputs[$a_sGroup]['inputName'] = $a_sGroup;
		$this->aInputs[$a_sGroup]['isReq'] = $a_bReq;
		$this->aInputs[$a_sGroup]['isGroup'] = true;
		$this->aInputs[$a_sGroup]['names'] = array();			
		$this->aInputs[$a_sGroup]['label'] = $a_sLabel;
		$this->aInputs[$a_sGroup]['separator'] = $a_sSeparator;
		$this->aInputs[$a_sGroup]['verValue'] = null;
		$this->aInputs[$a_sGroup]['errorMessage'] = null;
		$this->aInputs[$a_sGroup]['reqFieldMissing'] = null;		
				
		if($sType == "radio")
			$this->aInputs[$a_sGroup]['isRadio'] = true;
		if($sType == "checkBox")
			$this->aInputs[$a_sGroup]['isCheckBox'] = true;	
	}
	
	public function addGroupElement($a_sGroup, $a_sString, $a_sName, $a_sOutput = null)
	{	
		$this->aInputs[$a_sGroup][$a_sName]['input'] = $a_sString;
		$this->aInputs[$a_sGroup][$a_sName]['output'] = "<label for='" . $a_sGroup . "_" . $a_sName . "'>" . $a_sOutput . "</label>";		
		$iArrIndex = count($this->aInputs[$a_sGroup]['names']);
 		$this->aInputs[$a_sGroup]['names'][$iArrIndex] = $a_sName;
		// add the posted value to the input-array
 		$this->aInputs[$a_sGroup][$a_sName]['postedValue'] = $this->oHTTPContext->getString($a_sName) . "<br />";
	}
	
	public function addGroupInputString($a_sGroup)
	{
		$sStr = null;
		foreach($this->aInputs[$a_sGroup]['names'] as $inputName)
		{
			$sStr.= $this->aInputs[$a_sGroup][$inputName]['input'] . $this->aInputs[$a_sGroup][$inputName]['output'];
		}
		$this->aInputs[$a_sGroup]['input'] = $sStr;			
	}	
	
	public function addMultipleSelectElement($a_sString, $a_sName, $a_bReq, $a_sLabel = null, $a_sSeparator = null)
	{
		$this->addElement("multiple", $a_sString, $a_sName, $a_bReq, "multipleSelect", null, null, $a_sLabel, $a_sSeparator);
	}	
	
	// *** CREATION AND ADDING OF HTML-INPUTS IN THE REST OF THE CLASS
	
	public function setPreSelect($a_sName, $a_sPreSelect)
	{
		if(!$this->oHTTPContext->isPosted($a_sName))
			$sPreSelect = $a_sPreSelect;
		else
			$sPreSelect = $this->oHTTPContext->getString($a_sName);
		
		// check if it's set in the session
		if(isset($_SESSION['_form'][$this->sFormSessionPrefix . $a_sName]))
		{
			$sPreSelect = $_SESSION['_form'][$this->sFormSessionPrefix . $a_sName];
		}
			
		return $sPreSelect;		
	}

	public function setPreSelectMultiple($a_sName, $a_aPreSelect)
	{
		if(!$this->oHTTPContext->isPosted($a_sName))
		{
			// check if we've got a session-value for this one, and if the form isn't submitted
			if(isset($_SESSION['_form'][$this->sFormSessionPrefix . $a_sName]) && !$this->isSubmitted())
			{
				$aPreSelect = $_SESSION['_form'][$this->sFormSessionPrefix . $a_sName];
			}
			else
				$aPreSelect = $a_aPreSelect;
		}
		else
			$aPreSelect = $this->oHTTPContext->getMultiple($a_sName);
		
		return $aPreSelect;			
	}	
	
	public function inputIsPosted($a_sName)
	{
		if($this->oHTTPContext->isPosted($a_sName))
			return true;
		else
			return false;
	}
	
	public function createFormStart($a_sMethod, $a_sAction, $a_sName, $a_bFileForm, $a_bUseFormName = false)
	{
		$sString = $this->oHTMLInput->getFormStart($a_sMethod, $a_sAction, $a_sName, $a_bFileForm, $a_bUseFormName);
		$this->sFormStart = $sString;
		return $sString;
	}

	// this one is used if we just want some output text, in some cases, instead of input(s)
	public function createOutput($a_sName, $a_sText)
	{
		$this->addElement("output", $a_sText, $a_sName, false);
		return true;
	}
	
	public function createTextInput($a_sName, $a_bReq = false, $a_iSize, $a_iMaxLength, $a_sPreSelect = null, $a_sClass = null, $a_bDisabled = false, $a_sType = null, $a_sCustomText = null, $a_sLabel = null)
	{
		$sPreSelect = $this->setPreSelect($a_sName, $a_sPreSelect);			
		$sString = $this->oHTMLInput->getTextInput($a_sName, $a_iSize, $a_iMaxLength, $sPreSelect, $a_sClass, $a_bDisabled, $a_sType, $a_sCustomText);
		$this->addElement("text", $sString, $a_sName, $a_bReq, null, null, null, $a_sLabel);
		return $sString;	
	}

	public function createPasswordInput($a_sName, $a_bReq = false, $a_iSize, $a_iMaxLength, $a_sPreSelect = null, $a_sClass = null, $a_bDisabled = false, $a_sCustomText = null, $a_sLabel = null)
	{
		$sPreSelect = $a_sPreSelect;
		// we don't want to set any (posted) pre-select for password inputs
		//$sPreSelect = $this->setPreSelect($a_sName, $a_sPreSelect);			
		$sString = $this->oHTMLInput->getTextInput($a_sName, $a_iSize, $a_iMaxLength, $sPreSelect, $a_sClass, $a_bDisabled, "password", $a_sCustomText);
		$this->addElement("password", $sString, $a_sName, $a_bReq, null, null, null, $a_sLabel);
		return $sString;
	}
	
	public function createTextArea($a_sName, $a_bReq, $a_iRows, $a_iCols, $a_iLimit = null, $a_sPreSelect = null, $a_sClass = null, $a_sCustomText = null, $a_sLabel = null)
	{
		$sPreSelect = $this->setPreSelect($a_sName, $a_sPreSelect);			
		$sString = $this->oHTMLInput->getTextArea($a_sName, $a_iRows, $a_iCols, $a_iLimit, $sPreSelect, $a_sClass, $a_sCustomText);
		$this->addElement("text", $sString, $a_sName, $a_bReq, null, null, null, $a_sLabel);
		$this->addCountDownInput($a_iLimit);
		return $sString;				
	}
	
	public function addCountDownInput($a_iLimit)
	{
		$this->sCountDownInput = $this->oHTMLInput->getCountDownInput($a_iLimit);
		return $this->sCountDownInput;
	}
	
	public function getCountDownInput()
	{
		return $this->sCountDownInput;
	}
	
	public function getTextAreaLimitJavascript()
	{
		// TODO: add this one
		//return $this->oHTMLInput->getTextAreaLimitJavascript;
	}

	public function createJavaScriptNumberSelect($a_sName, $a_sLocation, $a_iMax = 50, $a_bReq = false, $a_sPreSelect = null, $a_sClass = null, $a_cPrefix = null)
	{
		$sString = 	$this->oHTMLInput->getJavaScriptNumberSelect($a_sName, $a_sLocation, $a_iMax, $a_sPreSelect, $a_sClass, $a_cPrefix);
		$this->addElement("select", $sString, $a_sName, $a_bReq, "select");
		return $sString;
	}
	
	public function createJavaScriptSelect($a_sName, $a_sLocation, $a_aValues, $a_bReq = false, $a_sPreSelect = null, $a_sClass = null, $a_sLabel = null)
	{
		$sString = $this->oHTMLInput->getJavaScriptSelect($a_sName, $a_sLocation, $a_aValues, $a_sPreSelect, $a_sClass);
		$this->addElement("select", $sString, $a_sName, $a_bReq, "select", null, null, $a_sLabel);
		return $sString;
	}
		
	public function createSelect($a_sName, $a_aValues, $a_bReq = false, $a_sPreSelect = null, $a_sClass = null, $a_sCustomText = null, $a_sLabel = null)
	{
		$sPreSelect = $this->setPreSelect($a_sName, $a_sPreSelect);			
		$sString = $this->oHTMLInput->getSelect($a_sName, $a_aValues, $sPreSelect, $a_sClass, $a_sCustomText);
		$this->addElement("select", $sString, $a_sName, $a_bReq, "select", null, null, $a_sLabel);
		return $sString;
	}

	public function createSelectID($a_sName, $a_aValues, $a_aOutput, $a_bReq = false, $a_sPreSelect = null, $a_sClass = null, $a_sCustomText = null, $a_sLabel = null)
	{	
		$sPreSelect = $this->setPreSelect($a_sName, $a_sPreSelect);			
		$sString = $this->oHTMLInput->getSelectID($a_sName, $a_aValues, $a_aOutput, $sPreSelect, $a_sClass, $a_sCustomText);
		$this->addElement("select", $sString, $a_sName, $a_bReq, "selectID", $a_aValues, $a_aOutput, $a_sLabel);
		return $sString;
	}
	
	public function createMultipleSelect($a_sName, $a_aValues, $a_iSize, $a_bReq = false, $a_aPreSelect = null, $a_sClass = null, $a_sCustomText = null, $a_sLabel = null, $a_sSeparator = null)
	{
		$aPreSelect = $this->setPreSelectMultiple($a_sName, $a_aPreSelect);
		$sString = $this->oHTMLInput->getMultipleSelect($a_sName, $a_aValues, $a_iSize, $aPreSelect, $a_sClass, $a_sCustomText);
		$this->addMultipleSelectElement($sString, $a_sName, $a_bReq, $a_sLabel, $a_sSeparator);
		return $sString;
	}
	
	public function createMultipleSelectID($a_sName, $a_aValues, $a_aOutput, $a_iSize, $a_bReq = false, $a_aPreSelect = null, $a_sClass = null, $a_sCustomText = null, $a_sLabel = null, $a_sSeparator = null)
	{
		$aPreSelect = $this->setPreSelectMultiple($a_sName, $a_aPreSelect);
		$sString = $this->oHTMLInput->getMultipleSelectID($a_sName, $a_aValues, $a_aOutput, $a_iSize, $aPreSelect, $a_sClass, $a_sCustomText);
		$this->addMultipleSelectElement($sString, $a_sName, $a_bReq, $a_sLabel, $a_sSeparator);
		return $sString;
	}	
	
	public function createSelectYear($a_sName, $a_bReq = false, $a_iEndYear = null, $a_iPreselectYear = null, $a_sClass = null, $a_sCustomText = null, $a_sLabel = null, $a_bDateInput = true)
	{
		$iPreselectYear = $this->setPreSelect($a_sName, $a_iPreselectYear);			
		$sString = $this->oHTMLInput->getSelectYear($a_sName, $a_iEndYear, $iPreselectYear, $a_sClass, $a_sCustomText);
		$this->addElement("select", $sString, $a_sName, $a_bReq, "select", null, null, $a_sLabel, null, $a_bDateInput);
		return $sString;
	}

	public function createSelectMonth($a_sName, $a_bReq = false, $a_iPreselectMonth = null, $a_sClass = null, $a_sCustomText = null, $a_sLabel = null, $a_bDateInput = true)
	{
		$iPreselectMonth = $this->setPreSelect($a_sName, $a_iPreselectMonth);			
		$sString = $this->oHTMLInput->getSelectMonth($a_sName, $iPreselectMonth, $a_sClass, $a_sCustomText);
		$this->addElement("select", $sString, $a_sName, $a_bReq, "select", null, null, $a_sLabel, null, $a_bDateInput);
		return $sString;	
	}

	public function createSelectDay($a_sName, $a_bReq = false, $a_iPreselectDay = null, $a_sClass = null, $a_sCustomText = null, $a_sLabel = null, $a_bDateInput = true)
	{
		$iPreselectDay = $this->setPreSelect($a_sName, $a_iPreselectDay);			
		$sString = $this->oHTMLInput->getSelectDay($a_sName, $iPreselectDay, $a_sClass, $a_sCustomText);
		$this->addElement("select", $sString, $a_sName, $a_bReq, "select", null, null, $a_sLabel, null, $a_bDateInput);
		return $sString;		
	}
	
	public function createFileInput($a_sName, $a_bReq = false, $a_iSize = null, $a_sClass = null, $a_sCustomText = null, $a_sLabel)
	{
		$sString = $this->oHTMLInput->getFileInput($a_sName, $a_iSize, $a_sClass, $a_sCustomText);
		$this->addElement("file", $sString, $a_sName, $a_bReq, null, null, null, $a_sLabel);
		return $sString;
	}
	
	public function createHiddenInput($a_sName, $a_sValue, $a_bReq = false, $a_sCustomText = null)
	{
		$sString = $this->oHTMLInput->getHiddenInput($a_sName, $a_sValue, $a_sCustomText);
		$this->addElement("hidden", $sString, $a_sName, $a_bReq);
		return $sString;
	}

	public function createGroupHiddenInput($a_sGroup, $a_sName, $a_sInputName, $a_sValue, $a_sCustomText = null)
	{
		$sString = $this->oHTMLInput->getHiddenInput($a_sName, $a_sValue, $a_sCustomText);
		$this->addGroupElement($a_sGroup, $sString, $a_sInputName);
		$this->addGroupInputString($a_sGroup);
	}	

	public function createMultipleHiddenInput($a_sName, $sMultipleInputValue, $a_bReq = false, $a_sCustomText = null)
	{
		$sString = $this->oHTMLInput->getHiddenInput($a_sName, $sMultipleInputValue, $a_sCustomText);
		$this->addElement("hidden", $sString, $a_sName, $a_bReq);
		return $sString;
	}	
	
	// TODO: put these below into class.HTMLInput	
	// a_sVerValue is used if we only want one verification value for the check-box = display the value if it's posted as "on"
	// a_aVerValues is used if we want two different verification values, as in e.g. "Yes/No"
	// the value at position 0 in the array will be used if the check-box is checked
	public function createCheckBox($a_sName, $a_sOutput = null, $a_bReq = false, $a_bChecked = false, $a_sClass = null, $a_sCustomText = null, $a_sLabel = null, $a_sVerValue = null, $a_aVerValues = null)
	{
		if($a_sClass != null)
			$sClass = "class='" . $a_sClass . "'";
		else
			$sClass = null;

		$sChecked = null;
		
		// if the value isn't posted, check if we've got a pre-select
		if($this->oHTTPContext->isPosted($a_sName) == false)
		{
			// ... but check the session first, and use that val, if the form isn't submitted
			if(isset($_SESSION['_form'][$this->sFormSessionPrefix . $a_sName]) && !$this->isSubmitted())
			{	
				if($_SESSION['_form'][$this->sFormSessionPrefix . $a_sName] == "on")
					$sChecked = "checked";
				else
					$sChecked = null;
			}
			else
			{
				if($a_bChecked == true)
					$sChecked = "checked";
			}
		}
		else
			if($this->oHTTPContext->getString($a_sName) == "on")
				$sChecked = "checked";

		$sString = "<input type='checkbox' " . $sChecked . " id='" . $a_sName . "' name='" . $a_sName ."' " . $sClass . " " . $a_sCustomText . " />" . $a_sOutput;
		$this->addElement("checkbox", $sString, $a_sName, $a_bReq, null, null, $a_sOutput, $a_sLabel, null, null, $a_sVerValue, $a_aVerValues);
		return $sString;
	}
	
	public function createCheckBoxes($a_sGroup, $a_aNames, $a_aOutput = null, $a_bReq = false, $a_aPreSelect = null, $a_sClass = null, $a_sCustomText = null, $a_sLabel = null, $a_sSeparator = null, $a_bUseBoxNameForJavascript = false)
	{
		$sRet = null;

		if($a_sClass != null)
			$sClass = "class='" . $a_sClass . "'";
		else 
			$sClass = null;
			
		$this->addGroup($a_sGroup, $a_bReq, "checkBox", $a_sLabel, $a_sSeparator);
		
		$i = 0;				
		foreach($a_aNames as $val)
		{
			$sChecked = null;
			if($this->inputIsPosted($val))
			{
				// to pre-select the check-boxes if it's posted
				if($this->oHTTPContext->getString($val) == 'on')
					$sChecked = "checked";
			}
			else
			{
				// check if we've got a input-value set in the session, and use that val, if the form isn't submitted
				if(isset($_SESSION['_form'][$this->sFormSessionPrefix . $val]) && !$this->isSubmitted())
				{
					if($_SESSION['_form'][$this->sFormSessionPrefix . $val] == "on")
						$sChecked = "checked";
				}
				else
				{
					// if the form isn't posted (or the session-pre-select is set), pre-select check-boxes, if any are chosen
					if(is_array($a_aPreSelect))
					{
						if(in_array($val, $a_aPreSelect))
							$sChecked = "checked";
					}
				}				
			}
			
			if($a_bUseBoxNameForJavascript)
			{
				// 010830, commenting, can't see how this would work, or why!?
				//$sPrefix = null;
				//if($a_bUseBoxNameForJavascript != null)
					//$sPrefix = $a_sBoxNamePrefix;
					
				// if we want to use the box's name/id in a javascript...
				$cFind   = '(';
				$iPos = strpos($a_sCustomText, $cFind);
				$a_sCustomText = substr($a_sCustomText, 0, ($iPos+1)) . "'" . $val . "')";
			}
			
			$sString = null;
			$sString = "<input type='checkbox' " . $sChecked . " id='" . $val . "' name='" . $val ."' " . $sClass . " " . $a_sCustomText . " />";
			$this->addGroupElement($a_sGroup, $sString, $val, $a_aOutput[$i], $a_sSeparator);
			$this->addGroupInputString($a_sGroup);
			$sRet .= $sString;
			$i++;
		}
		
		return $sRet;
	}
	
	public function createRadioButtons($a_sGroup, $a_aNames, $a_aOutput = null, $a_bReq = false, $a_sPreSelect = null, $a_sClass = null, $a_sCustomText = null, $a_sLabel = null)
	{
		$sRet = null;
		
		if($a_sClass != null)
			$sClass = "class='" . $a_sClass . "'";
		else 
			$sClass = null;		
		
		$this->addGroup($a_sGroup, $a_bReq, "radio", $a_sLabel);

		$i = 0;				
		foreach($a_aNames as $val)
		{
			$sChecked = null;			
			
			if($this->inputIsPosted($a_sGroup))
			{
				// if the form is posted, pre-select a value, if any is selected
				if($this->oHTTPContext->getString($a_sGroup) == $val) 
					$sChecked = "checked";
			}
			else
			{
				// check if we've got a session-value for this button, if the form isn't submitted
				if(isset($_SESSION['_form'][$this->sFormSessionPrefix . $a_sGroup]) && !$this->isSubmitted())
				{
					if($_SESSION['_form'][$this->sFormSessionPrefix . $a_sGroup] == $val)
						$sChecked = "checked";
				}
				else // ... no session vars...
				{
					// if the form isn't posted, check if we've got a pre-select
					if($a_sPreSelect == $val)
						$sChecked = "checked";
				}
			}
			
			$sString = null;
			$sString = "<input type='radio' " . $sChecked . " id='" . $a_sGroup . "_" . $val .  "' name='" . $a_sGroup ."' value='" . $val . "' " . $sClass ." " . $a_sCustomText . " />";
			$this->addGroupElement($a_sGroup, $sString, $val, $a_aOutput[$i]);
			$sRet .= $sString;
			$this->addGroupInputString($a_sGroup);
			$i++;
		}
		
		return $sRet;
	}
	
	/* TODO: fixish
	// requires an array with the months-names, and one with the month ids
	public function createDateSelectMonthString($a_aMonthsNames, $a_aMonthsIDs, $a_sNamePrefix = null, $a_bReq = false, $a_iPreselectYear = null, $a_iPreselectMonth = null, $a_iPreselectDay = null, $a_sClass = null, $a_sLabel = null)
	{
		$sString = $this->oHTMLInput->getDateSelectMonthString($a_aMonthsNames, $a_aMonthsIDs, $a_sNamePrefix, $a_bReq, $a_iPreselectYear, $a_iPreselectMonth, $a_iPreselectDay, $a_sClass);
		$this->addElement("select", $sString, $a_bReq;
		return $sString;
	}

	public function createTimeSelect($a_sNamePrefix = null, $a_bReq = false, $a_iPreselectHour = null, $a_iPreselectMinute = null, $a_sClass = null, $a_sLabel = null)
	{
		$sString = $this->oHTMLInput->getTimeSelect($a_sNamePrefix, $a_bReq, $a_iPreselectHour, $a_iPreselectMinute, $a_sClass);
		$this->addElement("select", $sString, $a_bReq);
		return $sString;	
	}	
	*/
	
	// *** DISPLAY FUNCTIONS ***
	public function getTableForm($a_sTableClass = null, $a_iTableWidth = null, $a_sTRClass = null, $a_sTDClass = null, $a_iTDWidth = null)
	{
		return $this->oHTMLInput->getTableForm($this, $a_sTableClass, $a_iTableWidth, $a_sTRClass, $a_sTDClass, $a_iTDWidth);
	}
}
?>
