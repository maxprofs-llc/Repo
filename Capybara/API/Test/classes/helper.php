<?php
	class helper {
	
		public static $lastTimeStamp=0;
		
		public static function safeSetProperty($object,$property,$dataRow,$column) {
			helper::debugPrint("Set property $property to value in $column",'props');
			//if($column=='birthLocation_city_name')
			if (property_exists($dataRow,$column))
			{
				if(property_exists($object,$property))
				{
					if(isset($dataRow->$column))
					{
						if(!(is_null($dataRow->$column) && !is_null($object->$property))) {
							$value=$dataRow->$column;
							helper::debugPrint("Set $property to $value",'props');
							if(gettype($dataRow->$column)!="string")
								$object->$property=$dataRow->$column;	
							else
								$object->$property=$dataRow->$column;								
							return true;
						}
					}
				}		
			} else {
				helper::debugPrint("Property $column does not exist",'props');
			}
			return false;
		}	
		
		public static function debugPrint($text,$switch=1,$traceIt=false) {
			if(isset($_GET['debug']))
				$_SESSION['debug']=$_GET['debug'];
			if(isset($_SESSION['debug']))
				$_GET['debug']=$_SESSION['debug'];
			if(!isset($_GET['debug']))
				return;
			if($_GET['debug']==$switch || $_GET['debug']=='ALL') {
				print $text . "<br />";
				if($traceIt) {
					print "Stack trace:";
					$traces = debug_backtrace();
			        foreach($traces as $trace) {
			            $stack.=$trace['file'] .
			            ' on line ' . $trace['line']."<br>";
			        }					
				}
			}
		}
		
		public static function printTimeStamp($label="") {
			If(isset($_GET['timestamp']) && $_GET['timestamp']==1) {
				$now=microtime(true);
				$dist=$now-self::$lastTimeStamp;
				print "Timestamp $label: $now ";
				if($dist!=$now)
					print " ($dist ms since last)";
				self::$lastTimeStamp=$now;
				print "<br />";
			}
		}
		
		public static function calculateGeoDistance(location_location $location1,location_location $location2) {
			if(is_null($location1->longitude) || is_null($location1->latitude) || is_null($location2->longitude) || is_null($location2->latitude))
				return NULL;
			$earthRadius=6371; //Radius in km
			$dLat=deg2rad($location2->latitude-$location1->latitude); //Latitude distance
			$dLon=deg2rad($location2->longitude-$location1->longitude); //Longitude distance
			$a=(sin($dLat/2)*sin($dLat/2)) +
			  ((cos(deg2rad($location1->latitude))*cos(deg2rad($location2->latitude))) *
			  (sin($dLon/2)*sin($dLon/2)));
			$c=2*atan2(sqrt($a),sqrt(1-$a));
			return $earthRadius*$c;
		}
		
	}

?>