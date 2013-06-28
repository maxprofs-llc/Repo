<?php
	include('../_define.php');
	$imageList=$dr->getImageList('person',$_GET['id']);
	$list=new html_imageList();
	$list->id=$_GET['prefix']."ImageList";
	foreach($imageList as $image) {
		$list->addImage("common/getFile.php?id=$image->id");
	}
	print $list->printHTML();
?>