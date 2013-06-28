<?php
function splitTime($timeString, $type = 'span', $delimiterPattern = NULL, $maxDigits = NULL) {
	//Internal function to split time string into minutes and seconds
	//Input:
	//	$timeString = Time string to split
	//  $type = Type of split (determines default $delimiterPattern and output array key names)
	//	$delimiterPattern = Regex pattern of the delimiter (default: '/[^0-9]+/')
	//	$maxDigits = Maximum amount of digits to consider as first part to split - more digits than this and no delimiter found will split after $maxDigits digits
	//Output:
	//	Array with both numerical keys and human understandable keys

	$delimiterPattern = $delimiterPattern ?: setDelimiterPatterns($type);
	$maxDigits = $maxDigits ?: setMaxDigitss($type);
	$maxDigits = ($maxDigits < 1) ? strlen($timeString) - $maxDigits : $maxDigits;

	$timeArray = (preg_match($delimiterPattern, $timeString) || !$maxDigits) ? preg_split($delimiterPattern, $timeString) : str_split($timeString, $maxDigits);
	if (sizeof($timeArray) > 2) {
		return FALSE; //ERROR: String contains more than one delimiter - does not compute
	}

	switch ($type) {
		case 'span':
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
			$timeArray['origin'] = $timeArray[0];
			$timeArray['margin'] = $timeArray[1];
			break;
		case 'margin':
			$timeArray['marginStart'] = $timeArray[0];
			$timeArray['marginEnd'] = $timeArray[1];
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
	unset($timeArray[0]);
	unset($timeArray[1]);
	return $timeArray;
}

function setTimeString($timeString, $period = NULL, $delimiterPatterns = NULL, $maxDigitss = NULL) {
	$delimiterPatterns = $delimiterPatterns ?: setDelimiterPatterns();
	$maxDigitss = $maxDigitss ?: setMaxDigitss();

	$timeArray = parseTimeString($timeString, $delimiterPatterns, $maxDigitss);
	echo('<div class="results"><span class="caption">Final results:</span><br />'."\n");
	printArray($timeArray);
	echo("</div>\n");
}

function parseTimeString($time, $delimiterPatterns = NULL, $maxDigitss = NULL, $types = Array('span', 'context', 'extension', 'approximation', 'margin', 'second', 'decimal')) {
	$delimiterPatterns = $delimiterPatterns ?: setDelimiterPatterns();
	$maxDigitss = $maxDigitss ?: setMaxDigitss();

	$type = array_shift($types);
	if (is_array($time)) {
		foreach ($time as $key => $value) {
			if (preg_match('/%$/', $value)) {
				$result['percentage'] = TRUE;
				$value = preg_replace('/%$/', '', $value);
			}
			if (preg_match('/^-/', $value)) {
				$result['fromEnd'] = TRUE;
				$value = preg_replace('/^-/', '', $value);
			}
			if ($delimiterPatterns[$type] && preg_match($delimiterPatterns[$type], $value)) {
				$result[$key] = parseTimeString(splitTime($value, $type, $delimiterPatterns[$type], $maxDigitss[$type]), $delimiterPatterns, $maxDigitss, $types);
			} else if (preg_match('/[^0-9]+/', $value)) {
				$result[$key] = parseTimeString($value, $delimiterPatterns, $maxDigitss, $types);
			} else if (strlen($value) > $maxDigits[$type]) {
				$result[$key] = splitTime($value, $type, $delimiterPatterns[$type], $maxDigitss[$type]);
			} else {
				$result[$key] = $value;
			}
		}
	} else {
		if (preg_match('/%$/', $time)) {
			$result['percentage'] = TRUE;
			$time = preg_replace('/%$/', '', $time);
		}
		if (preg_match('/^-/', $time)) {
			$result['fromEnd'] = TRUE;
			$time = preg_replace('/^-/', '', $time);
		}
		if ($delimiterPatterns[$type] && preg_match($delimiterPatterns[$type], $time)) {
			$result = parseTimeString(splitTime($time, $type, $delimiterPatterns[$type], $maxDigitss[$type]), $delimiterPatterns, $maxDigitss, $types);
		} else if (preg_match('/[^0-9]+/', $time)) {
			$result = parseTimeString($time, $delimiterPatterns, $maxDigitss, $types);
		} else if (strlen($time) > $maxDigits[$type]) {
			$result[$key] = splitTime($time, $type, $delimiterPatterns[$type], $maxDigitss[$type]);
		} else {
			$result = $time;
		}
	}
	return $result;
}

function printArray($array, $indent = NULL) {
	if (!is_array($array)) {
		echo $array."<br />\n";
	} else {
		$indent .= '&nbsp;&nbsp;';
		foreach ($array as $key => $value) {
			echo $indent.$key.': ';
			if (is_array($value)) {
				echo "<br />\n";
			}
			printArray($value, $indent);
		}
	}
}


function setDelimiterPatterns($type = NULL) {
	$delimiterPatterns = Array(
					'span' => '/>/',
					'context' => '/;/',
					'extension' => '/\+/',
					'approximation' => '/~/',
					'margin' => '/\-/',
					'second' => '/[^0-9,]+/',
					'decimal' => '/\,/'
					);
					return ($type) ? $delimiterPatterns[$type] : $delimiterPatterns;
}

function setMaxDigitss($type = NULL) {
	$maxDigitss = Array (
					'second' => 2
	);
	return ($type) ? $maxDigitss[$type] : $maxDigitss;
}

if ($_POST['parse'] || $_GET['parse']) {
	$time = ($_POST['time']) ? $_POST['time'] : $_GET['time'] ;
	setTimeString($time, (($period) ? $period : NULL));
} else {
	?>
<html>
<head>
<title>Time parse test</title>
<script type="text/javascript">
          function getPage(url, method, post, async) {
            if (window.XMLHttpRequest) {
              xmlhttp = new XMLHttpRequest();
            } else {
              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.open(method, url, async);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send(post);
          }
          function parse() {
            var post = 'parse=1&time=' + encodeURIComponent(document.getElementById('time').value);
            getPage('timetest.php', 'post', post, true);
            xmlhttp.onreadystatechange = function() {
              if (xmlhttp.readyState == 4) {
                if (xmlhttp.status == 200) {
                  document.getElementById('output').innerHTML = xmlhttp.responseText;
                } else {
                  document.getElementById('output').innerHTML = '<span class="error">Something went wrong. Please reload the page, and try again. If it still doesn' + "'t work, take a nice long walk in the park.<br/>\n";
                }
              }
            }
          }
        </script>
<style type="text/css">
.caption {
	text-align: left;
	font-weight: bold;
	font-size: 150%;
}

.bold {
	font-weight: bold;
}

.error {
	text-size: 120%;
	background-color: #FF0000;
	color: #FFFFFF;
}

.input {
	width: 50em;
}
</style>
</head>
<body>
<br />
Format reminder:
0;-00:00,00%~00:00,00%-00:00,00%+-00:00,00%~00:00,00%-00:00,00%>0;-00:00,00%~00:00,00%-00:00,00%+-00:00,00%~00:00,00%-00:00,00%
<br />
Time string:
<input type="text" name="time" id="time" class="input" />
<input type="button" value="parse" onclick="parse();" />
<div id="output" class="output"></div>
</body>
</html>
	<?php
}
?>
