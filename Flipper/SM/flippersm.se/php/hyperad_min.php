<h1>Hyperadmin</h1>


<div class="bred">

<?php
require("../dbas/dbas.php");
require("datumform.php");

echo "</div><br class=\"clearboth\"/>";


$oMain = "select *
from sm_2012_anmalda WHERE U18 = '' AND Main = 1 order by No desc";

$result_oMain = mysql_query($oMain) or die("<p>SQL: $oMain <br>".mysql_error()); 
$num_results_oMain = mysql_num_rows($result_oMain);

$oClassic = "select *
from sm_2012_anmalda WHERE U18 = '' AND Classic = 1 order by No desc";

$result_oClassic = mysql_query($oClassic) or die("<p>SQL: $oClassic <br>".mysql_error()); 
$num_results_oClassic = mysql_num_rows($result_oClassic);


$uMain = "select *
from sm_2012_anmalda WHERE U18 = 1 AND Main = 1 order by No desc";

$result_uMain = mysql_query($uMain) or die("<p>SQL: $uMain <br>".mysql_error()); 
$num_results_uMain = mysql_num_rows($result_uMain);

$uClassic = "select *
from sm_2012_anmalda WHERE U18 = 1 AND Classic = 1 order by No desc";

$result_uClassic = mysql_query($uClassic) or die("<p>SQL: $uClassic <br>".mysql_error()); 
$num_results_uClassic = mysql_num_rows($result_uClassic);

$main = $num_results_oMain + $num_results_uMain;
$classic = $num_results_oClassic + $num_results_uClassic;
echo "<h2>Fakta</h2>";

echo "<table cellspacing = 3><tr><th width = 100px>Kategori<th>Main<th>Classic";
echo "<tr><td colspan = 3><hr />";
echo "<tr><td>Ordinarie<td>$num_results_oMain<td>$num_results_oClassic";
echo "<tr><td>U18<td>$num_results_uMain<td>$num_results_uClassic";
echo "<tr><td colspan = 3><hr />";
echo "<tr><td>Totalt<td>$main<td>$classic";
echo "</table>";

$pengar = "select SUM(Price) from sm_2012_anmalda";

$result_pengar = mysql_query($pengar) or die("<p>SQL: $pengar <br>".mysql_error()); 
while ($row = mysql_fetch_array($result_pengar)){
	$pengar_in = $row['SUM(Price)'];
}	

$pengar_in = number_format($pengar_in,0,'e',' ');
echo "<p>Intäkter för SM: " . $pengar_in . " kr";

?>

<hr />
<h2>T-shirtar</h2>
<?php

// Räkna small
$small = "SELECT Tag, Shirts
FROM  `sm_2012_anmalda` 
WHERE  `Shirts` 
LIKE  '%Small'";

echo "<table cellspacing = 3><tr><th width = 100px>Tag<th>Small";
echo "<tr><td colspan = 2><hr />";
$result_small = mysql_query($small) or die("<p>SQL: $small <br>".mysql_error()); 
while ($row = mysql_fetch_array($result_small)){
	echo "<tr><td>'{$row['Tag']}'<td>'{$row['Shirts']}'";
}	
echo "</table>";

// Räkna Medium
$medium = "SELECT Tag, Shirts
FROM  `sm_2012_anmalda` 
WHERE  `Shirts` 
LIKE  '%Medium'";

echo "<table cellspacing = 3><tr><th width = 100px>Tag<th>Medium";
echo "<tr><td colspan = 2><hr />";
$result_medium = mysql_query($medium) or die("<p>SQL: $medium <br>".mysql_error()); 
while ($row = mysql_fetch_array($result_medium)){
	echo "<tr><td>'{$row['Tag']}'<td>'{$row['Shirts']}'";
}	
echo "</table>";



// Räkna large
$large = "SELECT Tag, Shirts
FROM  `sm_2012_anmalda` 
WHERE  `Shirts` 
LIKE  '%Large'";

echo "<table cellspacing = 3><tr><th width = 100px>Tag<th>Large";
echo "<tr><td colspan = 2><hr />";
$result_large = mysql_query($large) or die("<p>SQL: $large <br>".mysql_error()); 
while ($row = mysql_fetch_array($result_large)){
	echo "<tr><td>'{$row['Tag']}'<td>'{$row['Shirts']}'";
}	
echo "</table>";


// Räkna XL
$xl = "SELECT Tag, Shirts
FROM  `sm_2012_anmalda` 
WHERE  `Shirts` 
LIKE  '%XL' ";

echo "<table cellspacing = 3><tr><th width = 100px>Tag<th>XL";
echo "<tr><td colspan = 2><hr />";
$result_xl = mysql_query($xl) or die("<p>SQL: $xl <br>".mysql_error()); 
while ($row = mysql_fetch_array($result_xl)){
	echo "<tr><td>'{$row['Tag']}'<td>'{$row['Shirts']}'";
}	
echo "</table>";


// Räkna XXL
$xxl = "SELECT Tag, Shirts
FROM  `sm_2012_anmalda` 
WHERE  `Shirts` 
LIKE  '%XXL'";

echo "<table cellspacing = 3><tr><th width = 100px>Tag<th>XXL";
echo "<tr><td colspan = 2><hr />";
$result_xxl = mysql_query($xxl) or die("<p>SQL: $xxl <br>".mysql_error()); 
while ($row = mysql_fetch_array($result_xxl)){
	echo "<tr><td>'{$row['Tag']}'<td>'{$row['Shirts']}'";
}	
echo "</table>";


// Räkna XXXL
$xxl = "SELECT Tag, Shirts
FROM  `sm_2012_anmalda` 
WHERE  `Shirts` 
LIKE  '%XXXL'";

echo "<table cellspacing = 3><tr><th width = 100px>Tag<th>XXXL";
echo "<tr><td colspan = 2><hr />";
$result_xxxl = mysql_query($xxxl) or die("<p>SQL: $xxxl <br>".mysql_error()); 
while ($row = mysql_fetch_array($result_xxxl)){
	echo "<tr><td>'{$row['Tag']}'<td>'{$row['Shirts']}'";
}	
echo "</table>";

?>
