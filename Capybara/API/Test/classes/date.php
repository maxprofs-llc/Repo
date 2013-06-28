<?php
	class time extends baseClass {
		//Class 'time' is a specific and absolute point in time, relative to the start of a match, and counted using the regular full time of any previsous periods.
		//There are methods for getting time information (minute, second, string of minute and second) in different relation contexts:
		//	'Total time'
		//		Default, calculated as above
		//  'Regular time'
		//		As 'Total time', but not including any extended time. I.e. if the point in time is during the regular time of the period, 'Regular time' will be identical to 'Total time'. But if the point in time is during the extended time beyond the regular full time of the period, the 'Regular time' will be the same as the period regular length (90:00 for the end of the second period in a regular soccer game).
		//	'Period time'
		//		As 'Total time', but relative to the start of the period, and not to the start of the match.
		//	'Period regular time'
		//	  As 'Regular time', but relative to the start of the period, and not to the start of the match.
		//	'Extended time'
		//		If the point in time is beyond the regular full time of the period, the 'Extended time' will contain the amount of extended time. I.e. the sum of 'Extended time' and 'Regular time' will be identical to 'Total time', and the sum of 'Extended time' and 'Period regular time' will be identical to 'Period time'. If there is no extended time, 'Extended time' will contain minute 0 and second 0.
		
		//Properties
		public $context = NULL;
		public $time = NULL;
		public $isExtended = NULL; //Extended time present?
		public $isAmbiguous = NULL; //Ambiguous time - could be both relative and absolute?
		public $isMinuteOnly = NULL; //Minute only time - If this is true, the actual point in time is during the minute before this ($time contains the ONGOING minute).
		public $isPercentage = NULL; //If $isPercentage is set, $time contains a percentage representing a point in time of the current period (regular time if $isExtended is FALSE, and including extended time if $isExtended is TREU).
		public $isApproximation = NULL; //If set, $time represents an approximation due to lack of exact information
		
		//Unknown
		private static $unknown;
		protected $isUnknown=FALSE;

		public function getName() {
			$lang=lang_lang::getSingleton();
			if (is_null($this->getTimeString())) {
				return $lang->get('Unknown_time');
			} else {
				return $this->getTimeString();
			}
		}
		
		function getPeriod($seconds = NULL) {
			//If context is a period - ask him who he is
			//If context is a match - ask what period this is
			return $this->context->getPeriod($seconds);
		}
		
		function setPeriod(period $period) {
			//If context is a period - ask him who he is
			//If context is a match - ask what period this is
			$this->$context = $period;
		}
		
		function getExtended() {
			//Extended time present?
			return $this->isExtended;
		}
		
		function setExtended($extended = TRUE) {
			//Extended time present?
			$this->isExtended = $extended;
			return TRUE;
		}
		
		function getAmbiguous() {
			//Ambiguous time - could be both relative and absolute?
			//Use this to ask the user if the time he has given is relative to the start of the period or to the start of the match - or set the variable straight if we know which it is
			return $this->isAmbiguous;
		}
				
		function setAmbiguous($ambiguous = TRUE) {
			//Ambiguous time - could be both relative and absolute?
			//Use this to ask the user if the time he has given is relative to the start of the period or to the start of the match - or set the variable straight if we know which it is.
			$this->isAmbiguous = $ambiguous;
			return TRUE;
		}
		
		function getApproximation() {
			//The time is approximate
			return $this->isApproximation;
		}
				
		function setApproximation($approximation = TRUE) {
			//The time is approximate
			//To set minimum/maximum values of the approximation, use the timeSpan object
				$this->isApproximation = $approximation;
			return TRUE;
		}
		
		function getMinuteOnly() {
			return $this->isMinuteOnly;
		}
				
		function setMinuteOnly($minuteOnly = FALSE) {
		//$isMinuteOnly determines if we are setting the ONGOING minute or not. The time 13:42 is in the ONGOING minute 14. Normal default in soccer statistics is to either set a time including seconds, or to set the ONGOING minute.
			$this->isMinuteOnly = $minuteOnly;
			return TRUE;
		}
		
		function getTime($type = 'total') {
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
			if ($this->isPercentage) {
				$time = ($this->isExtended) ? $this->getPeriod($this->time)->getLength('total') * $this->time / 100: $this->getPeriod($this->time)->getLength('regular') * $this->time / 100;
			} else {
				$time = $this->time;
			}
			switch ($type) {
				case 'regular':
					return max($time, $this->getPeriod($time)->getEnd('regular'));
				break;
				case 'extended':
					return ($time > $this->getPeriod($time)->getEnd('regular')) ? $time - $this->getPeriod($time)->getEnd('regular') : FALSE;
				break;
				case 'period':
					return $time - $this->getPeriod($time)->getStart();
				break;
				case 'periodRegular':
					return max($time, $this->getPeriod($time)->getLength('regular'));
				break;
				case 'total':
					return $time;
				break;
				default:
					return FALSE; //ERROR: Non-existing time type specified!
				break;
			}
		}
		
		function setTime($timeString = NULL, $minute = NULL, $second = NULL, $isExtended = FALSE, $isAmbiguous = FALSE, $isMinuteOnly = FALSE, $isPercentage = FALSE) {
			//Setting $timeString will call setTimeString()
			//$isExtended determines whether the period time was extended or not (and, if $isPercentage is set, wheter the percentage is relative to the regular period time (2700 seconds for a normal soccer period), or to the full period time (including any extended time).
			//$isAmbiguous determines whether we know if the time is relative to the period or to the full match
			//$isMinuteOnly determines if we are setting the ONGOING minute or not. The time 13:42 is in the ONGOING minute 14. Normal default in soccer statistics is to either set a time including seconds, or to set the ONGOING minute.
			//$isPercentage determines whether we are setting a percentage point in time or a time with minutes and seconds. If we are setting a percentage, the $isExtended determines if it is relative to the regular period time (2700 seconds for a normal soccer period) or to the full period (including any extended time).
			if (is_null($timeString)) {
				if (is_null($isPercentage)) {
					$this->time = (is_null($minute)) ? $minute : $second;
				} else {
					$this->time = $minute * 60 + $second;
				}
				$this->isExtended = $isExtended;
				$this->isAmbiguous = $isAmbiguous;
				$this->isMinuteOnly = $isMinuteOnly;
				$this->isPercentage = $isPercentage;
				return TRUE;
			} else {
				return $this->setTimeString($timeString);
			}
		}
		
		function getMinute($type = 'total') {
		//getMinute() only returns the minute part of the time. This is the NOT the same as getOnlyMinute() (which returns the _ongoing_ minute)! The time 13:42 will make getMinute() = 13 but getOnlyMinute() = 14.
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
			return floor($this->getTime($type) / 60);
		}
				
		function setMinute($minute = 0) {
			//setMinute() will not change the second part of the time or any other attributes
			$second = $this->time % 60;
			$this->time = $minute * 60 + $second;
			return true;
		}
		
		function getSecond($type = 'total') {
		//getSecond() only returns the second part of the time.
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
			return ($this->isMinuteOnly) ? FALSE : $this->getTime($type) % 60;
		}
		
		function setSecond($second = 0) {
			$minute = floor($this->time/60);
			$this->time = $minute * 60 + $second;
			$this->isMinuteOnly = FALSE;
			return true;
		}
		
		function getOnlyMinute($type = 'total') {
		//getOnlyMinute() returns the ONGOING minute part of the time. This is the NOT the same as getMinute() (which returns the minute part of the time)! The time 13:42 will make getOnlyMinute() = 14 but getMinute() = 13.
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
			return ($this->getMinuteOnly() || empty($this->getSecond($type))) ? $this->getMinute($type) : $this->getMinute($type) + 1;
		}
		
		function setOnlyMinute($minute = 0) {
			$this->time = $minute * 60;
			$this->isMinuteOnly = TRUE;
			return TRUE;
		}
		
		function getPercentage($type = FALSE) {
		//getPercentage returns the percentage of the period or the match (depending on type) represented by the time object.
		//Possible types:
		//	FALSE ('', 0, etc)
		//		Default, returns the value (TRUE/FALSE) of $isPercentage
		//	'total'
		//		A specific and absolute point in time, relative to the start of a match, and counted using the regular full time of any previsous periods.
		//  'regular'
		//		As 'Total time', but not including any extended time. I.e. if the point in time is during the regular time of the period, 'Regular time' will be identical to 'Total time'. But if the point in time is during the extended time beyond the regular full time of the period, the 'Regular time' will be the same as the period regular length (90:00 for the end of the second period in a regular soccer game). Points in time during the extended time will make getPercentage() return values above 100%.
		//	'period'
		//		As 'Total time', but relative to the start of the period, and not to the start of the match.
		//	'periodRegular'
		//	  As 'Regular time', but relative to the start of the period, and not to the start of the match. Points in time during the extended time will make getPercentage() return values above 100%.
		//	'extended'
		//		If the point in time is beyond the regular full time of the period, the 'Extended time' will contain the amount of extended time. I.e. the sum of 'Extended time' and 'Regular time' will be identical to 'Total time', and the sum of 'Extended time' and 'Period regular time' will be identical to 'Period time'. If there is no extended time, 'Extended time' will contain minute 0 and second 0.
			if (empty($type)) {
				return $this->isPercentage;
			} else {
			  if ($this->isPercentage) {
					$time = $this->time * ($this->isExtended) ? $this->getPeriod($this->time)->getEnd('period') : $this->getPeriod($this->time)->getEnd('periodRegular');
				} else {
					$time = $this->time;
				}
				if ($type == 'regular' || $type == 'total') {
					$time += $this->getPeriod($time)->getStart();
				} else if ($type == 'extended') {
	 				$time -= $this->getPeriod($time)->getEnd('periodRegular');
				} else if ($type != 'period' && $type != 'periodRegular') {
					return FALSE; //ERROR: Non-existing type specified!
				}
				return $time / $this->getPeriod($time)->getLength($type) * 100;
			}
		}
		
		function setPercentage($percentage, $extended = FALSE) {
			//$extended determines if the percentage is relative to the period regular length, or the length including any extended time.
			//If $percentage is TRUE or FALSE, it will set the $isPercentage without setting $time to any percentage digits.
			if ($percentage === TRUE || $percentage === FALSE) {
				$this->isPercentage = $percentage;
				$this->isExtended = $extended;
				return TRUE;
			}
			
			if (!is_numeric(preg_replace('/%/', '', $percentage))) {
				return FALSE; //ERROR: Percentage is not numeric!
			} else {
				$this->time = preg_replace('/%/', '', $percentage);
				$this->isPercentage = TRUE;
				$this->isExtended = $extended;
				return TRUE;
			}
		}
		
		function getTimeString($delimiter = ':', $type = 'total') {
		//Default format = MM:SS
		//Possible types:
		//	'total'
		//		Default, a specific and absolute point in time, relative to the start of a match, and counted using the regular full time of any previsous periods.
		//  'regular'
		//		As 'Total time', but not including any extended time. I.e. if the point in time is during the regular time of the period, 'Regular time' will be identical to 'Total time'. But if the point in time is during the extended time beyond the regular full time of the period, the 'Regular time' will be the same as the period regular length (90:00 for the end of the second period in a regular soccer game). Points in time during the extended time will make getPercentage() return values above 100%.
		//	'period'
		//		As 'Total time', but relative to the start of the period, and not to the start of the match.
		//	'periodRegular'
		//	  As 'Regular time', but relative to the start of the period, and not to the start of the match. Points in time during the extended time will make getPercentage() return values above 100%.
		//	'extended'
		//		If the point in time is beyond the regular full time of the period, the 'Extended time' will contain the amount of extended time. I.e. the sum of 'Extended time' and 'Regular time' will be identical to 'Total time', and the sum of 'Extended time' and 'Period regular time' will be identical to 'Period time'. If there is no extended time, 'Extended time' will contain minute 0 and second 0.
			return $this->getMinute($type).$delimiter.sprintf('%02d', $this->getSecond($type));
		}
		
		protected function splitTime($timeString, $type = 'second', $maxDigits = NULL, $delimiterPattern = NULL) {
			//Internal function to split time string into minutes and seconds
			//Input:
			//	$timeString = Time string to split
			//  $type = Type of split (determines default $delimiterPattern and output array key names)
			//	$delimiterPattern = Regex pattern of the delimiter (default: '/[^0-9]+/')
			//	$maxDigits = Maximum amount of digits to consider as first part to split - more digits than this and no delimiter found will split after $maxDigits digits
			//Output:
			//	Array with both numerical keys and human understandable keys
			
			if (!$delimiterPattern) {
				$delimiterPatterns = Array(
					'span' => '/>/',
					'context' => '/;/',
					'extension' => '/\+/',
					'approximation' => '/~/',
					'margin' => '/\-/',
					'second' => '/[^0-9,]+/',
					'decimal' => '/,/'
				);
				$delimiterPattern = $delimiterPatterns[$type];
			}
			$timeArray = (preg_match($delimiterPattern, $timeString) || !$maxDigits) ? preg_split($delimiterPattern, $timeString) : preg_split(':', chunk_split($timeString, $maxDigits, ':'));
			if (sizeof($timeArray) > 2) {
				return FALSE; //ERROR: String contains more than one delimiter - does not compute
			}
			switch ($type) {
				case 'span':
				case 'margin':
					$timeArray['start'] = $timeArray[0];
					$timeArray['end'] = $timeArray[1];
				break;
				case 'context':
					$timeArray['context'] = $timeArray[0];
					$timeArray['time'] = $timeArray[1];
				break;
				case 'extension':
					$timeArray['regular'] = $timeArray[0];
					$timeArray['extension'] = $timeArray[1];
				break;
				case 'approximation':
					$timeArray['time'] = $timeArray[0];
					$timeArray['margin'] = $timeArray[1];
				break;
				case 'second':
					$timeArray['minute'] = $timeArray[0];
					$timeArray['second'] = $timeArray[1];
				break;
				case 'decimal':
					$timeArray['number'] = $timeArray[0];
					$timeArray['decimal'] = $timeArray[1];
				break;
				default:
					return FALSE; //ERROR: Unknown split type!
				break;
			}
			return $timeArray;
		}
		
		protected function timeSplit($timeString, $delimiterPattern = '/[^0-9]+/', $maxDigits = FALSE) {
			
			$timeArray = preg_split($delimiterPattern, $timeString);
			if (sizeof($timeArray) > 2) {
				return FALSE; //ERROR: String contains more than one delimiter - does not compute
			}
			if (!empty($maxDigits) && strlen($timeArray[0]) == strlen($timeString) > $maxDigits) {
				$timeArray['minute'] = substr($timeString, 0, 2);
				$timeArray['second'] = substr($timeString, -2);
			} else {
				$timeArray['minute'] = $timeArray[0];
				$timeArray['second'] = $timeArray[1];
			}
			return $timeArray;
		}
		
		function setTimeString2($timeString, $period = NULL, $delimiterPatterns = NULL, $maxDigitss = NULL) {
			if (!$delimiterPatterns) {
				$delimiterPatterns = Array(
					'span' => '/>/',
					'context' => '/;/',
					'extension' => '/\+/',
					'approximation' => '/~/',
					'margin' => '/\-/',
					'second' => '/[^0-9,]+/',
					'decimal' => '/,/'
				);
			}
			if (!$maxDigitss) {
				$maxDigitss = Array (
					'second' => 2
				);
			}
			$tempArray = splitTime($timeString, 'span');
			foreach($tempArray as $key => $value) {
				$timeArray[$key] = splitTime($tempArray[$key], 'context');
			}
		}
		
		function setTimeString($timeString, $period = NULL, $extendedDelimiterPattern = '/\s*\+\s*/', $secondDelimiterPattern = '/[^0-9]+/', $regularTimeMaxDigits = 3, $extendedTimeMaxDigits = 2) {
			//Parses string to populate time object
		  //Supports a decent number of formats - try your favorite
			
			if (preg_match('/%$/', $timeString)) {
				if (!is_numeric(preg_replace('/%/', '', $timeString))) {
					return FALSE; //ERROR: Percentage is not numeric!
				} else {
					$this->time = preg_replace('/%/', '', $timeString);
					$this->isPercentage = TRUE;
					return TRUE;
				}
			}
			
			//Split any extended time from the regular time if delimiter in input
			$timeArray['original'] = timeSplit($timeString, $extendedDelimiterPattern, FALSE);
			if (empty($timeArray['original'])) {
				return FALSE; //ERROR: timeSplit couldn't parse the string, ask timeSplit why
			}
			
			//Split the regular minutes and seconds
			$timeArray['regular'] = timeSplit($timeArray['original'][0], $secondDelimiterPattern, 3);
			if (empty($timeArray['regular'])) {
				return FALSE; //ERROR: timeSplit couldn't parse the string, ask timeSplit why
			}
			
			if (!empty($timeArray['original'][1])) {

				//Split the extended minutes and seconds
				$timeArray['extended'] = timeSplit($timeArray['original'][1], $secondDelimiterPattern, 2);
				if (empty($timeArray['extended'])) {
					return FALSE; //ERROR: timeSplit couldn't parse the string, ask timeSplit why
				}

				$period = (is_null($period)) ? $this->getPeriod((+$timeArray['regular']['minute'] * 60 + $timeArray['regular']['second'])) : $period;
				
				//If extended time is given, always consider the regular time to be the full period length with or without the length of any previous periods included.
				if ($timeArray['regular']['minute'] * 60 + $timeArray['regular']['second'] != $period->getRegularLength() && $timeArray['regular']['minute'] * 60 + $timeArray['regular']['second'] != $period->getRegularEnd()) {
          return FALSE; //ERROR: Extended time given, but regular time is not on period boundary!
        } else {
					$this->time = $period->getRegularEnd() + $timeArray['extended']['minute'] * 60 + $timeArray['extended']['second'];
					$this->isExtended = TRUE;
					$this->isAmbiguous = FALSE;
        }
			} else {
				if ((+$timeArray['regular']['minute'] * 60 + $timeArray['regular']['second']) <= $period->getStart()) {
					//This is a time relative to the current period clock
					$this->time = $period->getStart() + $timeArray['regular']['minute'] * 60 + $timeArry['regular']['second'];
					$this->isExtended = ($this->time > $period->getRegularEnd());
					$this->isAmbiguous = FALSE;
				} else {
					//This is an absolute time, relative to the full match clock (or ambiguous)
					$this->time = (int) $timeArray['regular']['minute'] * 60 + $timeArray['regular']['second'];
					$this->isExtended = ($this->time > $period->getRegularLength());
					$this->isAmbiguous = ($this->time < $period->getRegularLength()); //This could be both a relative and an absolute time
				}
			}
			
			//If we got all the way to down here without bailing out, everything must have gone fine. Let's set minuteOnly and return TRUE.
			$this->isMinuteOnly = (empty($timeArray['regular']['second']) && $timeArray['regular']['second'] != 0 && $timeArray['regular']['second'] != '0' && $timeArray['regular']['second'] != '00' && empty($timeArray['extended']['second']) && $timeArray['extended']['second'] != 0 && $timeArray['extended']['second'] != '0' && $timeArray['extended']['second'] != '00');
			return TRUE;
		}
		
		static function getUnknown() {
			if (!isset(self::$unknown)) {
				$c=__CLASS__;
				self::$unknown = new $c(true);
			}
			return self::$unknown;
		}
	}
?>
