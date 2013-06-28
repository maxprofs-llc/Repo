<?php
	class Encoding_XML extends Encoding_BaseEncoding {

		protected function _encodeObject(&$value, $type = NULL)
	    {
	        if ($this->_cycleCheck) {
	            if ($this->_wasVisited($value)) {

	                if (isset($this->_options['silenceCyclicalExceptions'])
	                    && $this->_options['silenceCyclicalExceptions']===true) {

	                    return '"* RECURSION (' . get_class($value) . ') *"';

	                } else {
	                    throw new Exception(
	                        'Cycles not supported in encoding, cycle introduced by '
	                        . 'class "' . get_class($value) . '"'
	                    );
	                }
	            }

	            $this->_visited[] = $value;
	        }

	        $props = '';

	        if ($value instanceof Iterator) {
	            $propCollection = $value;
	        } else {
	            $propCollection = get_object_vars($value);
	        }

	        foreach ($propCollection as $name => $propValue) {
	        	if(substr($name,0,1)=="_")
	        		$name=substr($name,1,strlen($name)-1);
	            if (isset($propValue) && (!is_array($value->noJSON) || !in_array($name,$value->noJSON))) {
	                $props .= "<".$this->_encodeValue($name).">"
	                            . $this->_encodeValue($propValue)
	                         ."</".$this->_encodeValue($name).">";
	            }
	        }

			if($value instanceof Encoding_iEncodable) {
				helper::debugPrint('Yes','strings');
				foreach ($value->getVarList() as $name) {
		        	if(substr($name,0,1)=="_")
		        		$name=substr($name,1,strlen($name)-1);
					$props .= "<".$this->_encodeValue($name).">"
	                            . $this->_encodeValue($value->name)
	                         ."</".$this->_encodeValue($name).">";
				}
			} else {
				helper::debugPrint('No:'.get_class($value),'strings');
			}
	        return "<" . get_class($value) . '>'
	                . $props ."</" . get_class($value) . '>';
	    }

		protected function _encodeArray(&$array, $type = NULL)
	    {
	        $tmpArray = array();

	        // Check for associative array
	        if (!empty($array) && (array_keys($array) !== range(0, count($array) - 1))) {
	            // Associative array
	            $result = '<value>';
	            foreach ($array as $key => $value) {
	                $key = (string) $key;
	                $tmpArray[] = "<".$this->_encodeString($key).">"
	                            . $this->_encodeValue($value)
	                            ."</".$this->_encodeString($key).">";
	            }
	            $result .= implode("", $tmpArray) ."</value>";
	        } else {
	            // Indexed array
	            $result = '<value>';
	            $length = count($array);
	            for ($i = 0; $i < $length; $i++) {
	                $tmpArray[] = "<value>".$this->_encodeValue($array[$i])."</value";
	            }
	            $result .= implode('', $tmpArray) . "</value>";
	        }

	        return $result;
	    }

	    protected function _encodeDatum(&$value)
	    {
	        $result = 'null';

	        if (is_int($value) || is_float($value)) {
	            $result = (string) $value;
	            $result = str_replace(",", ".", $result);
	        } elseif (is_string($value)) {
	            $result = $this->_encodeString($value);
	        } elseif (is_bool($value)) {
	            $result = $value ? 'true' : 'false';
	        }

	        return $result;
	    }
	}

?>