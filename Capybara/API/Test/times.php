<?php

function variant($period, $time) {
	echo('
            <td>'.$time.'</td>
            <td class="right"><input type="button" value="Try" onclick="fill('.$period.',\''.$time.'\');" /></td>
	');
}

if ($_POST['parse']) {
	echo('<div class="calculations"><span class="caption">Calculations:</span><br />'."\n");
	echo('Input: ');
	print_r($_POST);
	echo("<br />\n");
	echo("Fetching variables...<br />\n");
	$period = ($_POST['period']) ? $_POST['period'] : $_GET['period'] ;
	$time = ($_POST['time']) ? $_POST['time'] : $_GET['time'] ;
	for ($i = 1; $i <= 4; $i++) {
		$regularLength[$i] = ($_POST['period'.$i.'RegularLength']) ? $_POST['period'.$i.'RegularLength'] : $_GET['period'.$i.'RegularLength'] ;
		echo('Period '.$i.' regular length: '.$regularLength[$i]."<br />\n");
	}
	$regularLength['test'] = $regularLength[1];
	print_r($regularLength);
	echo('Period: '.$period."<br />\n");
	echo('Time: '.$time."<br />\n");
	echo("Splitting off extratime...<br />\n");
	$timeArray = preg_split('/\s*\+\s*/',$time);
	$regularTime = $timeArray[0];
	$extraTime = $timeArray[1];
	echo('Regular time: '.$regularTime."<br />\n");
	echo('Extra time: '.$extraTime."<br />\n");
	echo("Splitting regular minutes/seconds (delimiter)...<br />\n");
	$regularTimeArray = preg_split('/[,\.:h\s]+/',$regularTime);
	$regularMinutes = $regularTimeArray[0];
	$regularSecond = $regularTimeArray[1];
	if (strlen($regularMinutes) == strlen($regularTime) > 3) {
		echo('Regular minutes: '.$regularMinutes."<br />\n");
		echo('Regular seconds: '.$regularSecond."<br />\n");
		echo("Splitting regular minutes/seconds...(no delimiter)<br />\n");
		$regularMinutes = substr($regularTime, 0, -2);
		$regularSecond = substr($regularTime, -2);
	}
	echo('Regular minutes: '.$regularMinutes."<br />\n");
	echo('Regular seconds: '.$regularSecond."<br />\n");
	echo("Splitting extra minutes/seconds...<br />\n");
	$extraTimeArray = preg_split('/[,\.:h\s]+/',$extraTime);
	$extraMinute = $extraTimeArray[0];
	$extraSecond = $extraTimeArray[1];
	echo('Extra minutes: '.$extraMinute."<br />\n");
	echo('Extra seconds: '.$extraSecond."<br />\n");
	echo("Adding previous periods...<br />\n");
	for ($i = 1; $i < $period; $i++) {
		$previousMinute[$i] = $regularLength[$i];
		$previousMinutes += $regularLength[$i];
		echo('Added '.$regularLength[$i].' minutes from period '.$period.', total: '.$previousMinutes." minutes<br />\n");
	}
	echo("Finding regular minute...<br />\n");
	if ($extraMinute) {
		echo 'extra';
		if ($regularMinutes != $regularLength[$period] && $regularMinutes != $previousMinutes + $regularLength[$period]) {
			die('<span class="error">ERROR: Extra time given, but regular time is not on period boundary!</span><br />'."\n");
		}
		$periodMinute = $regularLength[$period];
		$regularMinute = $previousMinutes + $regularLength[$period];
	} else {
		echo 'noextra';
		if ($regularMinutes <= $previousMinutes) {
			if ($regularMinutes >= $regularLength[$period]) {
				$periodMinute = $regularLength[$period];
				$regularMinute = $previousMinutes + $regularLength[$period];
				$extraMinute = $regularMinutes - $regularLength[$period];
				$extraSecond = $regularSecond;
				unset($regularSecond);
			} else {
				$periodMinute = $regularMinutes;
				$regularMinute = $previousMinutes + $regularMinutes;
			}
		} else {
			if ($regularMinutes >= $previousMinutes + $regularLength[$period]) {
				$periodMinute = $regularLength[$period];
				$regularMinute = $previousMinutes + $regularLength[$period];
				$extraMinute = $regularMinutes - ($previousMinutes + $regularLength[$period]);
				$extraSecond = $regularSecond;
				unset($regularSecond);
			} else {
				$periodMinute = $regularMinutes - $previousMinutes;
				$regularMinute = $regularMinutes;
			}
		}
	}
	echo("</div>\n");
	echo('<div class="results"><span class="caption">Final results:</span><br />'."\n");
	for ($i = 1; $i < $period; $i++) {
		echo('Previous minutes in period '.$i.': '.$previousMinute[$i]."<br />\n");
	}
	$periodSecond = $regularSecond;
	$regularMinuteOnly = ($regularSecond > 0) ? $regularMinute + 1 : $regularMinute;
	$periodMinuteOnly = ($periodSecond > 0) ? $periodMinute + 1 : $periodMinute;
	$extraMinuteOnly = ($extraSecond > 0) ? $extraMinute + 1 : $extraMinute;
	echo('Total previous minutes: '.$previousMinutes."<br />\n");
	echo('Period: '.$period."<br />\n");
	echo('Period minute: '.$periodMinute."<br />\n");
	echo('Period second: '.$periodSecond."<br />\n");
	echo('Period minute only: '.$periodMinuteOnly."<br />\n");
	echo('Regular minute: '.$regularMinute."<br />\n");
	echo('Regular second: '.$regularSecond."<br />\n");
	echo('Regular minute only: '.$regularMinuteOnly."<br />\n");
	echo('Extra minute: '.$extraMinute."<br />\n");
	echo('Extra second: '.$extraSecond."<br />\n");
	echo('Extra minute only: '.$extraMinuteOnly."<br />\n");
	echo("</div>\n");
} else {
	?>
<html>
<head>
<title>Time parse test</title>
<script type="text/javascript">
          function fill(period, time) {
            document.getElementById('period').value = period;
            document.getElementById('time').value = time;
          }
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
            var post = 'parse=1&period=' + document.getElementById('period').value + '&time=' + encodeURIComponent(document.getElementById('time').value);
            for (var i = 1; i <= 4; i++) {
              post += '&period' + i + 'RegularLength=' + document.getElementById('period' + i + 'RegularLength').value;
            }
            getPage('times.php', 'post', post, true);
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
table {
	border-collapse: collapse;
}

td {
	text-align: center;
}

.right {
	border-right: 1px solid black;
}

.bottom {
	border-bottom: 1px solid black;
}

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

.calculations {
	position: relative;
	float: left;
	width: 50%;
}
</style>
</head>
<body>
<table>
		<caption class="caption">Variants</caption>
		<?php
		echo('
          <tr class="bottom">
            <th class="right">Period</th>
    ');
		for ($i = 1; $i <= 6; $i++) {
			echo('
            <th>Time</th>
            <th class="right"></th>
      ');
		}
		echo('
          </tr>
    ');
		$regularLength = array('45', '45', '15', '15');
		foreach ($regularLength as $period => $length) {
			for ($i = 0; $i <= $period; $i++) {
				$regularEnd[$period] += $regularLength[$i];
			}
		}
		for ($i = 1; $i <= 4; $i++) {
			echo('
          <tr>
            <td class="bold right">'.$i.'</td>
      ');
			$times = array('4', '3:31', '03:31', (string) (+$regularLength[$i-1]+4), (+$regularLength[$i-1]+3).':31', '0'.(+$regularLength[$i-1]+3).'31');
			for ($j = 1; $j <= 6; $j++) {
				variant($i, $times[$j-1]);
			}
			echo('
          </tr>
      ');
			if ($i > 1) {
				echo('
          <tr>
            <td class="right"></td>
        ');
				for ($j=1; $j <=3; $j++) {
					variant($i, $regularLength[$i-1].'+'.$times[$j-1]);
				}
				for ($j = 1; $j <= 3; $j++) {
					variant($i, $regularLength[$i-1].':00+'.$times[$j-1]);
				}
				echo('
          </tr>
        ');
			}
			echo ('
          <tr class="bottom">
            <td class="right"></td>
        ');
			for ($j = 1; $j <= 3; $j++) {
				variant($i, $regularEnd[$i-1].'+'.$times[$j-1]);
			}
			for ($j = 1; $j <= 3; $j++) {
				variant($i, $regularEnd[$i-1].':00+'.$times[$j-1]);
			}
			echo('
          </tr>
      ');
		}
		?>
</table>
<select name="period" id="period">
		<option value="1">1 F&ouml;rsta halvlek</option>
		<option value="2">2 Andra halvlek</option>
		<option value="3">3 F&ouml;rsta f&ouml;rl&auml;ngningsperioden</option>
		<option value="4">4 Andra f&ouml;rl&auml;ngningsperioden</option>
</select>
Period lengths:
		<?php
		for ($i = 1; $i <= 4; $i++) {
			echo ('
        '.$i.' <input type="text" id="period'.$i.'RegularLength" name="period'.$i.'Length" value="'.$regularLength[$i-1].'" size="5"/>
      ');
		}
		?>
<br />
<input type="text" name="time" id="time" />
<input type="button" value="parse" onclick="parse();" />
<div id="output" class="output"></div>
</body>
</html>
		<?php
}
?>
