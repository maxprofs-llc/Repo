<?php
require("dbas/dbas.php");



echo "<h1>Maillista över de som inte än är funktionärer</h1>";


$sql = 'SELECT Email'
        . ' FROM sm_2012_anmalda'
        . ' LEFT JOIN sm_2012_funkis ON sm_2012_anmalda.No = sm_2012_funkis.Person_no'
        . ' WHERE sm_2012_funkis.Person_no IS NULL';

$mailstr = '';
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result)){
	$mailstr .= $row['Email'];
	$mailstr .= ", ";
}

echo $mailstr;

echo "<hr />";


$sql = "SELECT DISTINCT Email FROM sm_2012_anmalda 
INNER JOIN sm_2012_funkis ON sm_2012_anmalda.No = sm_2012_funkis.Person_no";

$funkis_mailstr = '';
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result)){
	$funkis_mailstr .= $row['Email'];
	$funkis_mailstr .= ", ";
}

echo $funkis_mailstr;

?>


