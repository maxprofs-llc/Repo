<?php
	class html_ckeditor extends html_htmlEntity {
		
		public $initialValue;
		public $language;
		public $height='400px';
		public $lateBinding=false;
				
		protected $script;
		
		function __construct($initialValue='') {
			parent::__construct();
			$lang=lang_lang::getSingleton();
			$this->language=$lang->getLanguageCode();
			$this->initialValue=$initialValue;
		}
		
		function printHTML() {
			$textarea=new html_textarea($this->initialValue);
			$textarea->id=$this->id;
			$textarea->name=$this->id;
			$textarea->printHTML();

		
			$config['toolbar'] = array(
				array('NewPage'),
				array('Bold','Italic'),
				array('Cut','Copy','Paste','PasteText','PasteFromWord'),
				array('Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'),
				array('Image','Table','HorizontalRule','SpecialChar','PageBreak'),
				'/',
				array('Format'),
				array('NumberedList','BulletedList'),
				array('Link','Unlink','Anchor'),
				array('Source')
			);
			$config['language']=$this->language;
			$config['filebrowserImageUploadUrl']='upload.php';
			$config['height']=$this->height;
			$config['resize_enabled']=false;
			$config['startupFocus']=true;
			$config['format_tags']="p;h1;h2";
			$config['contentsCss']='css/main.css';
			$config['format_h1']=array('element'=>'h1','attributes'=>array('class'=>'headline'));
			$config['format_h2']=array('element'=>'span','attributes'=>array('class'=>'bildText'));
			//"{ element : 'h2', attributes : { class : 'contentTitle1' } }";
			
			$this->config=$config;
			
			$CKEditor = new ckeditor_CKEditor();

			$CKEditor->basePath=config_conf::getSingleton()->get('publicClassesPath')."ckeditor/";
			$this->script=$CKEditor->replace($this->id,$config);
		}
		
		function getScript() {
			return $this->script;
		}
	}
?>