<?php
	class pages_defaultPage extends pages_editPage {
		
		function __construct($noun,$list) {
			parent::__construct();
			$dropdown=new html_dropDown();
			$dropdown->id='select'.ucfirst(str_replace('_','',$noun));
			$selected=$dropdown->addOption('',$lang->get('Choose '.$noun).'...');
			$dropdown->addOption(-1,$lang->get('New '.$noun));
			$dropdown->addOption(-99,$lang->get("Get $noun from Master database"));
			
			foreach($list as $item) {
				$opt=$dropdown->addOption($item->id,$item->getName());
			}
			$selected->selected=true;
			
			$this->contents->addEntity(new html_span($lang->get(ucfirst($noun)).': '));
			$this->contents->addEntity($dropdown);
			
			$form=new html_div();
			$form->id=$noun."FormContents";
			
			$this->contents->addEntity(new html_p());
			$this->contents->addEntity($form);			
		}
	}