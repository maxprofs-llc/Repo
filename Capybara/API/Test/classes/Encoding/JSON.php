<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Json
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Encoder.php 20096 2010-01-06 02:05:09Z bkarwin $
 */

/**
 * Encode PHP constructs to JSON
 *
 * @category   Zend
 * @package    Zend_Json
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

class Encoding_JSON extends Encoding_BaseEncoding
{

    /**
     * Encode an object to JSON by encoding each of the public properties
     *
     * A special property is added to the JSON object called '__className'
     * that contains the name of the class of $value. This is used to decode
     * the object on the client into a specific class.
     *
     * @param $value object
     * @return string
     * @throws Zend_Json_Exception If recursive checks are enabled and the object has been serialized previously
     */
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

        if ($value instanceof Traversable) {
        	helper::debugPrint("It is an iterator","json");
            $propCollection = $value;
        } else {
        	helper::debugPrint("It is not an iterator","json");
            $propCollection = get_object_vars($value);
        }

        foreach ($propCollection as $name => $propValue) {
        	helper::debugPrint("Found property $name","json");
            if (isset($propValue) && (!is_array($value->noJSON) || !in_array($name,$value->noJSON))) {
                $props .= ','
                        . $this->_encodeValue($name)
                        . ':'
                        . $this->_encodeValue($propValue);
            }
        }

		if($value instanceof Encoding_iEncodable) {
			helper::debugPrint('Yes','json');
			foreach ($value->getVarList() as $name) {
				$props .= ','
						. $this->_encodeValue($name)
						. ':'
						. $this->_encodeValue($value->$name);
			}
		} else {
			helper::debugPrint('No:'.get_class($value),'json');
		}
        return '{"__className":"' . get_class($value) . '"'
                . $props . '}';
    }

    /**
     * JSON encode an array value
     *
     * Recursively encodes each value of an array and returns a JSON encoded
     * array string.
     *
     * Arrays are defined as integer-indexed arrays starting at index 0, where
     * the last index is (count($array) -1); any deviation from that is
     * considered an associative array, and will be encoded as such.
     *
     * @param $array array
     * @return string
     */
    protected function _encodeArray(&$array, $type = NULL)
    {
        $tmpArray = array();

        // Check for associative array
        if (!empty($array) && (array_keys($array) !== range(0, count($array) - 1))) {
            // Associative array
            $result = '{';
            foreach ($array as $key => $value) {
                $key = (string) $key;
                $tmpArray[] = $this->_encodeString($key)
                            . ':'
                            . $this->_encodeValue($value);
            }
            $result .= implode(',', $tmpArray);
            $result .= '}';
        } else {
            // Indexed array
            $result = '[';
            $length = count($array);
            for ($i = 0; $i < $length; $i++) {
                $tmpArray[] = $this->_encodeValue($array[$i]);
            }
            $result .= implode(',', $tmpArray);
            $result .= ']';
        }

        return $result;
    }


    /**
     * JSON encode a basic data type (string, number, boolean, null)
     *
     * If value type is not a string, number, boolean, or null, the string
     * 'null' is returned.
     *
     * @param $value mixed
     * @return string
     */
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

    protected function _encodeString($string) {
    	return '"' . parent::_encodeString($string) . '"';
    }
}

