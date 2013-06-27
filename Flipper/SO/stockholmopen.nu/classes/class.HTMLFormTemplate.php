<?php
require("class.HTMLForm.php");
class HTMLFormTemplate extends HTMLForm
{
	private $oTemplate = null;

	function __construct($a_oTemplate, $a_sFormType, $a_sMethod, $a_sAction, $a_sName = null, $a_bFileForm = false, $a_bAlwaysPost = false, $a_bUseSessionPrePopulateVars = false)
	{	
		parent::__construct($a_sFormType, $a_sMethod, $a_sAction, $a_sName, $a_bFileForm, $a_bAlwaysPost, $a_bUseSessionPrePopulateVars);		
		$this->oTemplate = &$a_oTemplate;
	}	
	
	public function endForm()
	{
		parent::endForm();
		return $this->prepareTemplate();	
	}
	
	private function prepareTemplate()
	{
		$this->oTemplate->assign("aInputs", $this->getInputs());
		$this->oTemplate->assign("aCustomErrors", $this->getCustomErrors());
		$this->oTemplate->assign("aWarnings", $this->getWarnings());
		$this->oTemplate->assign("sFormState", $this->getFormState());
		$this->oTemplate->assign("bDisplayForm", $this->displayForm());
		$this->oTemplate->assign("bReqFieldsMissing", $this->hasReqFieldsMissing());
		$this->oTemplate->assign("bHasErrors", $this->hasErrors());
		$this->oTemplate->assign("bHasWarnings", $this->hasWarnings());
		$this->oTemplate->assign("sFormStart", $this->getFormStart());
		$this->oTemplate->assign("sFormEnd", $this->getFormEnd());		
		$this->oTemplate->assign("sButtons", $this->getButtons());
		$this->oTemplate->assign("sButtonSubmit", $this->getButtonSubmit());
		$this->oTemplate->assign("sButtonVerBack", $this->getButtonVerBack());
		$this->oTemplate->assign("sButtonVerProceed", $this->getButtonVerProceed());
		$this->oTemplate->assign("sButtonVerSubmit", $this->getButtonVerSubmit());
		$this->oTemplate->assign("bIsCompleted", $this->isCompleted());
		$this->oTemplate->assign("bDisplayStartText", $this->displayStartText());
		$this->oTemplate->assign("bDisplayVerValues", $this->displayVerValues());
		$this->oTemplate->assign("bIsStart", $this->isStart());
		$this->oTemplate->assign("bIsVerOption", $this->isVerOption());
		$this->oTemplate->assign("bIsEditCompleted", $this->isEditCompleted());		
		$this->oTemplate->assign("bIsEditForm", $this->isEditForm());
		$this->oTemplate->assign("bIsDeleteCompleted", $this->isDeleteCompleted());
		$this->oTemplate->assign("bIsDeleteFailed", $this->isDeleteFailed());		
		$this->oTemplate->assign("bIsDefaultCompleted", $this->isDefaultCompleted());

		$this->oTemplate->assign("bIsEditStart", $this->isEditStart());
	
		return $this->oTemplate;				
		
		//$this->oTemplate->assign("aVerificationValues", $this->getVerificationValues());
	}
	
	//public function setCustomError($a_sErrorType)
	//{
		//$this->aCustomErrors[$a_sErrorType] = true;
		// set the forms status to not ok
		//$this->setErrorState();	
	//}
}
?>