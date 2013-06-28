<?php
	
	class form_expandableArea {
		
		public $id;
		public $headline;
		public $subHeadline;
		public $table;
		public $areas;
		
		protected $lang;
		protected $contents;
		protected $headlineElement;
		protected $subHeadlineElement;
		
		function __construct($hideText='',$showText='',$headline='') {
			$this->areas=new baseClassList();
			$this->lang=lang_lang::getSingleton();
			$this->contents=new html_expandableDiv($this->lang->get($hideText),$this->lang->get($showText));
			$this->contents->expanderCssClass='block';
			$this->headline=$headline;
			$this->table=new html_table();
			$this->headlineElement=new html_p('','headline');
			$this->subHeadlineElement=new html_p('','subheadline');
			$this->contents->addEntity($this->headlineElement);
			$this->contents->addEntity($this->subHeadlineElement);
			$this->contents->addEntity($this->table);
		}
		
		function getDiv() {
			$this->contents->id=$this->id;
			$this->table->id=$this->id."_table";
			$this->headlineElement->innerText=$this->lang->get($this->headline);
			
			$this->subHeadlineElement->innerText=$this->lang->get($this->subHeadline);
			$this->subHeadlineElement->visible=($this->subHeadline!='');
							
			$contents=clone $this->contents;
			
			foreach($this->areas as $area) {
				$contents->addEntity($area->getDiv());
			}		
			return $contents;	
		}
	}
?>