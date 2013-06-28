<?php
	
	class form_inlineForm extends form_standardForm {
		
		public $onLoadFunction;
		protected $cells;
		
		function __construct($standardPrefix='',$assetFolder,$contentClass) {
			parent::__construct($standardPrefix,$assetFolder,NULL);
			$this->content=new $contentClass();
			$this->cells=array();
		}
		
		public function printHTML() {
			$this->content->id=$this->standardPrefix . 'Contents';
			foreach($this->areas as $area) {
				$this->content->addEntity($area->getDiv());
			}
			if($this->fixExpanders)
				$this->content->addEntity(new html_script("fixExpanders();"));
			if($this->fixDeletes)
				$this->content->addEntity(new html_script("fixDeletes();"));
			if($this->fixDateFields)
				$this->content->addEntity(new html_script("fixDateFields();"));
			if($this->fixSearchBoxes)
				$this->content->addEntity(new html_script("fixSearchBoxes();"));
			
			$this->content->addEntity(new html_script('var js=new Asset.javascript("'.$this->assetFolder.'/functions.js",{onload:function() {
				'.$this->onLoadFunction.';
			}});'));
			$this->content->printHTML();
		}
		
		public function getCells() {
			
		}
	}
?>