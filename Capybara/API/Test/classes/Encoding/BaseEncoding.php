<?php

	abstract class Encoding_BaseEncoding {
	   	/**
	     * Whether or not to check for possible cycling
	     *
	     * @var boolean
	     */
	    protected $_cycleCheck;

	    /**
	     * Additional options used during encoding
	     *
	     * @var array
	     */
	    protected $_options = array();

	    /**
	     * Array of visited objects; used to prevent cycling.
	     *
	     * @var array
	     */
	    protected $_visited = array();

	    /**
	     * Constructor
	     *
	     * @param boolean $cycleCheck Whether or not to check for recursion when encoding
	     * @param array $options Additional options used during encoding
	     * @return void
	     */
	    protected function __construct($cycleCheck = false, $options = array())
	    {
	        $this->_cycleCheck = $cycleCheck;
	        $this->_options = $options;
	    }

	    /**
	     * Use the JSON encoding scheme for the value specified
	     *
	     * @param mixed $value The value to be encoded
	     * @param boolean $cycleCheck Whether or not to check for possible object recursion when encoding
	     * @param array $options Additional options used during encoding
	     * @return string  The encoded value
	     */
	    public static function encode($value, $cycleCheck = false, $options = array(), $type = 'div') {
        	$c=get_called_class();
	    	$encoder = new $c(($cycleCheck) ? true : false, $options, $type);
        	return $encoder->_encodeValue($value, $type);
	    }

		 /**
	     * Recursive driver which determines the type of value to be encoded
	     * and then dispatches to the appropriate method. $values are either
	     *    - objects (returns from {@link _encodeObject()})
	     *    - arrays (returns from {@link _encodeArray()})
	     *    - basic datums (e.g. numbers or strings) (returns from {@link _encodeDatum()})
	     *
	     * @param $value mixed The value to be encoded
	     * @return string Encoded value
	     */
	    protected function _encodeValue(&$value, $type = 'div')
	    {
	    	if(is_object($value) && is_a($value,'baseClass')) {
				if($_GET['verbose']==1) {
					helper::debugPrint("Prepare for verbose serialization","json");
		    		$value->prepareForSerialization();
		    	} else {
			    	$value->minimumPrepareForSerialization();
		    	}
			}
			if(is_a($value,"baseClassList"))
				$value=$value->getArrayCopy();
			helper::debugPrint(is_object($value) ? "It is an object" : "It is not an object","json");
			helper::debugPrint(is_array($value) ? "It is an array" : "It is not an array","json");
	        if (is_object($value)) {
	            return $this->_encodeObject($value, $type);
	        } else if (is_array($value)) {
	            return $this->_encodeArray($value, $type);
	        }

	        return $this->_encodeDatum($value, $type);
	    }

	    protected abstract function _encodeObject(&$value, $type = 'div');

	    protected abstract function _encodeArray(&$array, $type = 'div');

	    protected abstract function _encodeDatum(&$value);

    	/**
	     * Determine if an object has been serialized already
	     *
	     * @param mixed $value
	     * @return boolean
	     */
	    protected function _wasVisited(&$value)
	    {
	        if (in_array($value, $this->_visited, true)) {
	            return true;
	        }

	        return false;
	    }

		/**
	     * JSON encode a string value by escaping characters as necessary
	     *
	     * @param $value string
	     * @return string
	     */
	    protected function _encodeString(&$string)
	    {
	        // Escape these characters with a backslash:
	        // " \ / \n \r \t \b \f
	        $search  = array('\\', "\n", "\t", "\r", "\b", "\f", '"', '/');
	        $replace = array('\\\\', '\\n', '\\t', '\\r', '\\b', '\\f', '\"', '\\/');
	        $string  = str_replace($search, $replace, $string);

	        // Escape certain ASCII characters:
	        // 0x08 => \b
	        // 0x0c => \f
	        $string = str_replace(array(chr(0x08), chr(0x0C)), array('\b', '\f'), $string);
	        $string = self::encodeUnicodeString($string);

	        return $string;
	    }
	    /**
	     * Encode Unicode Characters to \u0000 ASCII syntax.
	     *
	     * This algorithm was originally developed for the
	     * Solar Framework by Paul M. Jones
	     *
	     * @link   http://solarphp.com/
	     * @link   http://svn.solarphp.com/core/trunk/Solar/Json.php
	     * @param  string $value
	     * @return string
	     */
	    public static function encodeUnicodeString($value)
	    {
	        $strlen_var = strlen($value);
	        $ascii = "";

	        /**
	         * Iterate over every character in the string,
	         * escaping with a slash or encoding to UTF-8 where necessary
	         */

	        for($i = 0; $i < $strlen_var; $i++) {
	            $ord_var_c = ord($value[$i]);

	            switch (true) {
	                case (($ord_var_c >= 0x20) && ($ord_var_c <= 0x7F)):
	                    // characters U-00000000 - U-0000007F (same as ASCII)
	                    $ascii .= $value[$i];
	                    break;

	                case (($ord_var_c & 0xE0) == 0xC0):
	                    // characters U-00000080 - U-000007FF, mask 110XXXXX
	                    // see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
	                    $char = pack('C*', $ord_var_c, ord($value[$i + 1]));
	                    $i += 1;
	                    $utf16 = self::_utf82utf16($char);
	                    $ascii .= sprintf('\u%04s', bin2hex($utf16));
	                    break;

	                case (($ord_var_c & 0xF0) == 0xE0):
	                    // characters U-00000800 - U-0000FFFF, mask 1110XXXX
	                    // see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
	                    $char = pack('C*', $ord_var_c,
	                                 ord($value[$i + 1]),
	                                 ord($value[$i + 2]));
	                    $i += 2;
	                    $utf16 = self::_utf82utf16($char);
	                    $ascii .= sprintf('\u%04s', bin2hex($utf16));
	                    break;

	                case (($ord_var_c & 0xF8) == 0xF0):
	                    // characters U-00010000 - U-001FFFFF, mask 11110XXX
	                    // see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
	                    $char = pack('C*', $ord_var_c,
	                                 ord($value[$i + 1]),
	                                 ord($value[$i + 2]),
	                                 ord($value[$i + 3]));
	                    $i += 3;
	                    $utf16 = self::_utf82utf16($char);
	                    $ascii .= sprintf('\u%04s', bin2hex($utf16));
	                    break;

	                case (($ord_var_c & 0xFC) == 0xF8):
	                    // characters U-00200000 - U-03FFFFFF, mask 111110XX
	                    // see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
	                    $char = pack('C*', $ord_var_c,
	                                 ord($value[$i + 1]),
	                                 ord($value[$i + 2]),
	                                 ord($value[$i + 3]),
	                                 ord($value[$i + 4]));
	                    $i += 4;
	                    $utf16 = self::_utf82utf16($char);
	                    $ascii .= sprintf('\u%04s', bin2hex($utf16));
	                    break;

	                case (($ord_var_c & 0xFE) == 0xFC):
	                    // characters U-04000000 - U-7FFFFFFF, mask 1111110X
	                    // see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
	                    $char = pack('C*', $ord_var_c,
	                                 ord($value[$i + 1]),
	                                 ord($value[$i + 2]),
	                                 ord($value[$i + 3]),
	                                 ord($value[$i + 4]),
	                                 ord($value[$i + 5]));
	                    $i += 5;
	                    $utf16 = self::_utf82utf16($char);
	                    $ascii .= sprintf('\u%04s', bin2hex($utf16));
	                    break;
	            }
	        }

	        return $ascii;
	     }

	    /**
	     * Convert a string from one UTF-8 char to one UTF-16 char.
	     *
	     * Normally should be handled by mb_convert_encoding, but
	     * provides a slower PHP-only method for installations
	     * that lack the multibye string extension.
	     *
	     * This method is from the Solar Framework by Paul M. Jones
	     *
	     * @link   http://solarphp.com
	     * @param string $utf8 UTF-8 character
	     * @return string UTF-16 character
	     */
	    protected static function _utf82utf16($utf8)
	    {
	        // Check for mb extension otherwise do by hand.
	        if( function_exists('mb_convert_encoding') ) {
	            return mb_convert_encoding($utf8, 'UTF-16', 'UTF-8');
	        }

	        switch (strlen($utf8)) {
	            case 1:
	                // this case should never be reached, because we are in ASCII range
	                // see: http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
	                return $utf8;

	            case 2:
	                // return a UTF-16 character from a 2-byte UTF-8 char
	                // see: http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
	                return chr(0x07 & (ord($utf8{0}) >> 2))
	                     . chr((0xC0 & (ord($utf8{0}) << 6))
	                         | (0x3F & ord($utf8{1})));

	            case 3:
	                // return a UTF-16 character from a 3-byte UTF-8 char
	                // see: http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
	                return chr((0xF0 & (ord($utf8{0}) << 4))
	                         | (0x0F & (ord($utf8{1}) >> 2)))
	                     . chr((0xC0 & (ord($utf8{1}) << 6))
	                         | (0x7F & ord($utf8{2})));
	        }

	        // ignoring UTF-32 for now, sorry
	        return '';
	    }
	}




?>