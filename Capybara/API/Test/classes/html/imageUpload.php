<?php
	class html_imageUpload extends html_htmlEntity {
		public $lang;
		public $imageFilename;
		public $namePrefix;
	
		function printHTML() {
			if(is_null($this->lang))
				$this->lang=lang_lang::getSingleton();
			
			$holder=new html_div();
			$holder->id=$this->namePrefix.'Image';
			if(file_exists('/home/aik/aik.se/www/'.$this->imageFileName)) //-
			{
				$img=new html_img('http://www.aik.se/'.$this->imageFilename,''); //-
				$holder->addEntity($img);
			} else {
				$holder->innerText=$this->lang->get('No image has been uploaded').'.';
			}
			$upload=new html_form();
			$upload->action='common/ajaxupload.php';
			$upload->method='post';
			$upload->id=$this->namePrefix . 'ImageUpload';
			$upload->addEntity(new html_span($this->lang->get('Upload image').': '));
			$file=new html_fileupload();
			$file->name='filename';
			$upload->addEntity($file);
			$upload->addEntity(new html_button($this->lang->get('Upload'),'',"uploadImage(this.form,600,600,'" . $this->namePrefix . "Image');"));
			
			$holder->printHTML();
			$upload->printHTML();		
		}
	}
?>