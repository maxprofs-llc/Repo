<?php
	include_once('../_define.php');
	
	$sess->checkUrl(false,$_SESSION['basedir'].'/lang.php',true);
	
	$langid=$_GET['id'];
	
	$form=new form_standardForm('lang','lang');
		
	$phrases=$lang->getPhraseList($langid);
	foreach($phrases as $phrase) {
		$form->addTextField('Phrase',$phrase['string'],$phrase['translation'],'',NULL,false);
	}
	$form->showSave=true;
	$form->saveFunction='saveLanguage';
	$form->printHTML();
	
	$form=new form_standardForm('new','lang');
	$form->addLangField('Phrase',$lang->get('New phrase'),array(),'dummy');
	$form->showSave=true;
	$form->hideSaveThenNew=true;
	$form->saveFunction='addPhrase';
	$form->printHTML();
?>