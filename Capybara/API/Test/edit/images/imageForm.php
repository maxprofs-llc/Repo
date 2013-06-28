<?php
	include_once('../_define.php');
	
	$sess->checkUrl(false,$_SESSION['basedir'].'/images.php',true);
	
	if(isset($_GET['start']))
		$start=$_GET['start'];
	else
		$start=1;
	
	if(isset($_GET['single']))
		$single=$_GET['single'];
	else
		$single=0;
		
	$form=new html_div();
	$form->id='imageForm';
	
	$form->addEntity(new html_p($lang->get('Images'),'headline'));
	
	$imageList=$dr->getImageList();
	$cont=new html_div();
	$cont->id='imageListContainer';
	
	$list=new html_imageList();
	$list->id="imageImageList";
	$list->columns=8;
	$list->multiSelect=!$single;
	foreach($imageList as $image) {
		$list->addImage($image);
	}
	$cont->addEntity($list);
	
	$ip=new html_imagePicker();
	$ip->imageList=$list;
	$ip->id="imageImagePicker";
	$ip->showUploadOnly=true;
	$ip->onCompleteAjax='images/imageList.php?prefix=image';
	$ip->onCompleteAjaxContainer=$cont->id;

	$form->addEntity($cont);
	if($_GET['nosave']!=1) {
		$form->addEntity(new html_p());
		$form->addEntity(new html_button($lang->get('Delete_selected_images'),'','deleteSelectedImages()'));
		$form->addEntity(new html_p());
		$form->addEntity($ip);
	}
	$form->printHTML();
	
	//helper::debugPrint(json_encode($person),'person');
?>