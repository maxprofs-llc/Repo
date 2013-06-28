<?php

	class period extends baseClass {
		
		public $matchId;
		public $periodTypeId;
		public $regularLength; // Seconds - 2700 seconds for a normal 45 minutes soccer period ALTERNATIVE: A time object?
		public $extendedLength; // Seconds. If >0 - extended time present ALTERNATIVE: A time object?
		public $played; // Bool - TRUE = already played, FALSE = future period
		
		function issetOr($var, $or = FALSE) {
			//Move this elsewhere!
			return (isset($var) && $var != '') ? $var : $or;
		}
		
		function getMatch() {
			return data_dataStore::getProperty('dataReader')->getMatchById($this->matchId);
		}
		
		function getPeriod() {
			//Needed to support the time object
			return $this;
		}
		
		function getPlayed() {
			return $this->played;
		}
		
		function getPreviousPeriod() {
			return data_dataStore::getProperty('dataReader')->getPeriodById($this->previousPeriodId);
		}
		
		function getNextPeriod() {
			return data_dataStore::getProperty('dataReader')->getPeriodById($this->nextPeriodId);
		}
		
		function getLength($type = 'total') {
		//Possible types:
		//	'total'
		//		Default, a specific and absolute point in time, relative to the start of a match, and counted using the regular full time of any previsous periods.
		//  'regular'
		//		As 'Total time', but not including any extended time. I.e. if the point in time is during the regular time of the period, 'Regular time' will be identical to 'Total time'. But if the point in time is during the extended time beyond the regular full time of the period, the 'Regular time' will be the same as the period regular length (90:00 for the end of the second period in a regular soccer game).
		//	'period'
		//		As 'Total time', but relative to the start of the period, and not to the start of the match.
		//	'periodRegular'
		//	  As 'Regular time', but relative to the start of the period, and not to the start of the match.
		//	'extended'
		//		If the point in time is beyond the regular full time of the period, the 'Extended time' will contain the amount of extended time. I.e. the sum of 'Extended time' and 'Regular time' will be identical to 'Total time', and the sum of 'Extended time' and 'Period regular time' will be identical to 'Period time'. If there is no extended time, 'Extended time' will contain minute 0 and second 0.
		//Beware that types 'normal' and 'regular' will return the length of the MATCH and not only this period.

			switch ($type) {
				case 'periodRegular':
					return $this->regularLength;
				break;
				case 'extended':
					return $this->extendedLength;
				break;
				case 'period':
					return $this->regularLength + $this->extendedLength;
				break;
				case 'total':
				case 'regular':
					return $this->getMatch()->getLength($type);
				break;
				default:
					return FALSE; //ERROR: Non-existing type specified!
				break;
			}
		}
		
		function getStart() {
			//This will iterate all previous periods regular end time automatically, to find the minute this period started
			return issetOr($this->getPreviousPeriod()->getEnd('regular'), 0);
		}
		
		function getEnd($type = 'total') {
		//Possible types:
		//	'total'
		//		Default, a specific and absolute point in time, relative to the start of a match, and counted using the regular full time of any previsous periods.
		//  'regular'
		//		As 'Total time', but not including any extended time. I.e. if the point in time is during the regular time of the period, 'Regular time' will be identical to 'Total time'. But if the point in time is during the extended time beyond the regular full time of the period, the 'Regular time' will be the same as the period regular length (90:00 for the end of the second period in a regular soccer game).
		//	'period'
		//		As 'Total time', but relative to the start of the period, and not to the start of the match.
		//	'periodRegular'
		//	  As 'Regular time', but relative to the start of the period, and not to the start of the match.
		//	'extended'
		//		If the point in time is beyond the regular full time of the period, the 'Extended time' will contain the amount of extended time. I.e. the sum of 'Extended time' and 'Regular time' will be identical to 'Total time', and the sum of 'Extended time' and 'Period regular time' will be identical to 'Period time'. If there is no extended time, 'Extended time' will contain minute 0 and second 0.
			
			switch ($type) {
				case 'regular':
					return $this->getStart() + $this->regularLength();
				break;
				case 'extended':
					return $this->extendedLength;
				break;
				case 'period':
					return $this->regularLength() + $this->extendedLength;
				break;
				case 'periodRegular':
					return $this->regularLength();
				break;
				case 'total':
					return $this->getStart() + $this->regularLength + $this->extendedLength;
				break;
				default:
					return FALSE; //ERROR: Non-existing type specified!
				break;
			}
		}
			
		function getName() {
			return $_name;
		}
	}