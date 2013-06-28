<?php
	class Encoding_HTML extends Encoding_BaseEncoding {

		protected function _encodeObject(&$value, $type = 'div')
	    {
			switch ($type) {
				case 'table':
					$objTag = 'table';
					$rowTag = 'tr';
					$cellTag = 'td';
					break;
				case 'list':
					$objTag = 'ul';
					$rowTag = 'li';
					$cellTag = false;
					break;
				case 'select':
					$objTag = 'select';
					$rowTag = 'option';
					$cellTag = false;
					break;
				case 'div':
				default:
					$objTag = 'div';
					$rowTag = 'div';
					$cellTag = false;
			}

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
	                $props .= '<'.$rowTag.' id="'.$this->_encodeValue($name).'">'
	                            . $this->_encodeValue($propValue)
	                         .'</'.$rowTag.'>';
	            }
	        }

			if($value instanceof Encoding_iEncodable) {
				helper::debugPrint('Yes','strings');
				foreach ($value->getVarList() as $name) {
		        	if(substr($name,0,1)=="_")
		        		$name=substr($name,1,strlen($name)-1);
					$props .= '<'.$rowTag.' id="'.$this->_encodeValue($name).'">'
	                            . $this->_encodeValue($value->name)
	                         ."</".$rowTag.">";
				}
			} else {
				helper::debugPrint('No:'.get_class($value),'strings');
			}
	        return '<'.$objTag.' id="' . get_class($value) . '">'
	                . $props .'</'.$objTag.'>';
	    }

		protected function _encodeArray(&$array, $type = 'div')
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