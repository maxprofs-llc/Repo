<?php
	class timeSpan extends baseClass {
		//Class 'timeSpan' contains a $start and an $end (both time objects)
		//To get the start and end times in different formats - use getStart()->getWhateverFormatYouWant that is supported by the time object
		public $start = NULL;
		public $end = NULL;
		
		//Unknown
		private static $unknown;
		protected $isUnknown=FALSE;

		public function getName() {
			$lang=lang_lang::getSingleton();
			if (is_null($this->getTimeSpanString())) {
				return $lang->get('Unknown_time_span');
			} else {
				return $this->getTimeString();
			}
		}
		
		function getStart() {
			//Get span start time object
			return $this->start;
		}
		
		function setStart($start) {
			//Set span start time by feeding a time object
			$this->start = $start;
			return TRUE;
		}
	
		function getEnd() {
			//Get span start time object
			return $this->end;
		}
		
		function setEnd($end) {
			//Set span start time by feeding a time object
			$this->end = $end;
			return TRUE;
		}
	
	}
?>