<?php
	class html_imagePicker extends html_htmlEntity {
		
		public $imageContainer;
		public $imageList;
		public $showUploadOnly=false;
		public $distinctionString='';
		
		function __construct() {
			parent::__construct();
		}
		
		function printHTML() {
			$lang=lang_lang::getSingleton();
			print "<table"; 
			if(!is_null($this->id))
				print " id='$this->id'";
			if(!is_null($this->cssClass))
				print " class='$this->cssClass'";
			print ">";
			if(!$this->showUploadOnly) {
				print "<tr><td><a href='javascript:add".$this->distinctionString."Image()' class='addPicture'>".$lang->get('Add_picture_from_database')."</a>";
				print "</td></tr>";
				print "<tr><td><a href='#' class='uploadPicture'>".$lang->get('Upload_new_picture')."</a>";	
			} else {
				print "<tr><td><span class='smallheadline'>".$lang->get('Upload_new_picture')."</span>";	
			}
			print "<div class='uploadPictureRow'>";
			print "<div id='image".$this->distinctionString."UploadStatus' >&nbsp;</div>";
			$upload=new html_form();
			$upload->action='common/ajaxupload.php';
			$upload->method='post';
			$upload->id='image'.$this->distinctionString.'ImageUpload';
			$upload->addEntity(new html_span($lang->get('Upload image').': '));
			$file=new html_fileupload();
			$file->name='filename';
			$upload->addEntity($file);
			$upload->addEntity(new html_button($lang->get('Upload'),'',"uploadImage(this.form,600,600,'image".$this->distinctionString."UploadStatus');"));
			$upload->printHTML();
			print "</div>";
			print "</td></tr>";
			print "</table>";
			$this->printChildEntities();
			print "<div id='".$this->id."_script'>";
			$cont=implode('',file(__DIR__."/scripts/imagePicker.js"));
			print "<script>";
			print $cont;		
			print "initImagePicker($('$this->id')";
			if(!is_null($this->imageList))
				print ",$('".$this->imageList->id."')";
			else
				print ",null";
			if(!is_null($this->imageContainer))
				print ",$('".$this->imageContainer->id."')";
			else
				print ",null";
			print ");";
			print "$('".$this->id."_script').dispose();";
			print "</script>";
			print "</div>";
		}
	}
?>