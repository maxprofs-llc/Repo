<?php
	abstract class html_htmlEntity {
	
		public $innerText;
		public $id;
		public $cssClass;
		public $entities;
		public $onclick;
		public $onchange;
		public $disabled=false;
		public $loadScript=false;
		public $visible=true;
		
		public function __construct() {
			$this->entities=new ArrayObject();
		}
		
		public function printChildEntities() {
			foreach($this->entities as $entity) {
				if(is_object($entity) && is_a($entity,'html_htmlEntity'))
					$entity->printHTML();
				else
					print $entity . ' is not an htmlEntity.';
			}
		}
		
		function addEntity($entity) {
			$this->entities->Append($entity);
		}
		
		function addEntitiesWithText($entitytype,$entityTexts,$cssClass=NULL) {
			foreach($entityTexts as $text) {
				$e=new $entitytype();
				$e->innerText=$text;
				$e->cssClass=$cssClass;
				$this->addEntity($e);
			}		
		}
		
		function addEntities($entitytype,$entities,$cssClass=NULL,$classes=false) {
			$i=0;
			foreach($entities as $ent) {
				$e=new $entitytype();
				$e->cssClass=$cssClass;
				if($classes) {
					$e->cssClass .= " " . $classes[$i];
				}
				if(is_string($ent))
				{
					$e->innerText=$ent;
				} else {
					if(is_object($ent))
					{
						if(is_subclass_of($ent,'htmlEntity'))
							$e->addEntity($ent);
					} else {
						$e->innerText=$ent;
					}
				}
				$this->addEntity($e);
				$i++;
			}		
		}
		
		abstract protected function printHTML();
		
		function doLoadScript() {
			if(!$this->loadScript)
				return;
			print "<div id='".$this->id."_script'>";
			print "<script>";
			print $this->loadScript;
			print "$('".$this->id."_script').dispose();";
			print "</script>";
			print "</div>";			
		}
		
	}
?>