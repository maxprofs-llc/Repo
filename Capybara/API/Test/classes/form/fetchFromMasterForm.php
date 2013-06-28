<?php
	class form_fetchFromMasterForm {
		
		public $dr;
		public $objectList;
		public $showSave=true;
		public $lang;
		public $table;
		public $abbrevation;
		public $className;
		public $headline;
		
		function __construct($table,$abbrevation,$className) {
			$db=new data_masterDatabase();
			$this->lang=lang_lang::getSingleton();
			$dr=new data_dataReader($db,$this->lang);
			$this->dr=$dr;
			$this->table=$table;
			$this->abbrevation=$abbrevation;
			$this->className=$className;
			$this->objectList=$dr->getGenericList($table,$abbrevation,$className,false,false);
			$this->headline=$this->lang->get('Find in master database');
		}
		
		function printHTML() {
			print "<p class='headline'>$this->headline</p>";
			print "Filter: ";
			print "<input type='text' name='filter' id='masterFormFilter' class='noChangeTrack' />";
			print "<select multiple='multiple' id='masterDatabaseList' class='noChangeTrack'>";
			
			foreach($this->objectList as $object) {
				print "<option value='$object->id'>".$object->getLongString()."</option>";
			}	
			print "</select>";
			if($this->showSave) 
				print "<input type='button' value='".$this->lang->get('Save to local')."' onclick='fetchFromMasterDatabase(\"$this->table\")' />";
			print "<div id='masterFormScript'>";
			print "<script>";
			print "
					var lastFilter='';
					var lastTimeout;
					$('masterFormFilter').addEvent('keyup',function(e) {
						if(lastTimeout!=null)
							clearTimeout(lastTimeout);

						var filterFn=function() {
							var filter=$('masterFormFilter').value;
							if(filter!=lastFilter) {
								$('masterDatabaseList').getElements('option').each(function(opt) {
									if(opt.get('html').toUpperCase().indexOf(filter.toUpperCase())<0) {
										opt.erase('selected');
										opt.setStyle('display','none');
									} else {
										opt.setStyle('display','block');
									}
								});
							}
							lastFilter=filter;						
						};
						
						lastTimeout=setTimeout(filterFn,1000);
					});
			";
			print '$("masterFormScript").dispose();';
			print "</script>";
			print "</div>";
		}
	}