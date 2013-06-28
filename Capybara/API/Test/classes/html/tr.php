<?php
	class html_tr extends html_htmlEntity {
		public function __construct($class=NULL,$tds=false) {
			parent::__construct();
			$this->cssClass=$class;
			if($tds) {
				foreach($tds as $td) {
					if(is_string($td))
						$this->addEntity(new html_td($td));
					elseif(is_a($td,'html_td'))
						$this->addEntity($td);
					else
						$this->addEntity(new html_td($td));
				}
			}
		}
		
		function printHTML() {
			print "<tr";
			if(!is_null($this->id))
				print " id='$this->id'";
			if(!is_null($this->cssClass))
				print " class='$this->cssClass'";
			print ">";
			$this->printChildEntities();
			print '</tr>';
		}

	}
	
?>