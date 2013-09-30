<?php

$retur = '';

if (isset($_POST['CheckedIn'])) {
	$no = $_POST['id'];

	// open connection
	$db = MySQL_connect("localhost", "flippersm", "ngt3vligt");
	MySQL_select_db("flippersm", $db);

	$sql = "UPDATE sm_2012_anmalda SET CheckedIn = 1, 80s = 0, score80 = 0, vote = 0 WHERE No = $no";
	$result = mysql_query($sql) or die;

	// stäng connection
	MySQL_close($db);

}

if (isset($_POST['submit'])) {


$identifikation = "No = " . $_POST['Person_no'];

// open connection
	$db = MySQL_connect("localhost", "flippersm", "ngt3vligt");
	MySQL_select_db("flippersm", $db);

$sql = "
SELECT * FROM sm_2012_anmalda 
LEFT JOIN sm_2012_funkis ON sm_2012_anmalda.No = sm_2012_funkis.Person_no 
WHERE $identifikation";

$result = mysql_query($sql);
while ($row = mysql_fetch_assoc($result)) 
{
	$tag = $row['Tag'];
	$tshirt = $row['Shirts'];
	if ($tshirt == 'Ingen')
		$shirtstr = 'ska inte ha någon t-shirt. ';
	elseif ($tshirt == NULL)
		$shirtstr = 'får förmodligen sin t-shirt av någon förälder.';
	else
		$shirtstr = 'har beställt ' . $tshirt;

	$namn = ucwords($row['Firstname']) . " " . ucwords($row['Lastname']);

	// Kolla om hen ska funka	
	if ($row['Funk_id'] > 0)
		$funkis = 'Ja';
	else
		$funkis = 'Nej';	
	
	// Kolla om det är både main och classic
	if (($row['Main'] > 0 ) && ($row['Classic'] > 0))
		$competitionStr = 'spela både main och classic';

	if (($row['Main'] > 0 ) && ($row['Classic'] == 0))
		$competitionStr = 'spela enbart main';

	if (($row['Main'] == 0 ) && ($row['Classic'] > 0))
		$competitionStr = 'bara spela classic, för det är en riktig skroträv';

	// Kolla vilket pass som är hens kvalpass
	if ($row['pass1'] == 1)
		$kvalStr = 'kvalpass 1, som börjar kl 16.'; 
	if ($row['pass2'] == 1)
		$kvalStr = 'kvalpass 2, som börjar kl 20.'; 
	if ($row['pass3'] == 1)
		$kvalStr = 'kvalpass 3, som börjar kl 10.'; 
	if ($row['pass4'] == 1)
		$kvalStr = 'kvalpass 4, som börjar kl 14.'; 
	if ($row['pass5'] == 1)
		$kvalStr = 'kvalpass 5, som börjar kl 18.'; 


}

$retur = "<h2>" . $tag . "</h2><p>" . $namn . " " . $shirtstr . "</p><p>Ska " . $tag . " ha en funktionärs-matbiljett? <strong>" . $funkis . "</strong><p>Ifråga om tävlingarna, så ska " . $namn . " " . $competitionStr . ".</p><h3>Kvaltid</h3><p>Glöm inte att upplysa " . $namn . " om att spelaren är uppsatt på <strong>" . $kvalStr . "</strong><br />Om spelaren är anmäld till classic, så informera gärna om att där råder fri kvaltid, men att spelaren bör tänka på att classicrummet kan vara knökfullt sent på lördagkvällen.";

$checkedInButton = "<form action = '1000spinner.php' method = 'POST'><input type = 'submit' name = 'CheckedIn' value = '" . $tag . " has checked In' /><input type = 'hidden' name = 'id' value = " . $_POST['Person_no'] . " /></form>"; 

}



?>


<!DOCTYPE html>
<html>
<head>

<meta http-equiv="content-type" content="text/html; charset=ISO-8859-15" />
<title>Service & informationsenheten</title>
  <link rel="stylesheet" href="style.css" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Ropa+Sans|Plaster' rel='stylesheet' type='text/css'>
</head>

<body>
<!--
<div id="logo">

<a href="http://www.flippersm.se/1000spinner.php">
<img src="bilder/loggor/bowling_bred.png" alt="Flipper-SM 2012" height = '150px' />
</a>

</div>

!-->

<div id = 'content'>



<div class = 'spalt'>

<p><a href = 'voteAnd80.php'>Klicka här för röstning och/eller 80-talstresteg.</a></p>



<form action = '1000spinner.php' method = 'POST'>
<label for = 'Person_no'>Tag och namn.</label>

<select name = "Person_no">
<option value = 0>Ingen vald</option>
<?php 
// open connection
	$db = MySQL_connect("localhost", "flippersm", "ngt3vligt");
	MySQL_select_db("flippersm", $db);

	$sql = "SELECT No, Tag, Firstname, Lastname FROM sm_2012_anmalda WHERE CheckedIn = 0 ORDER by Tag";
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) 
	{
			$firstname = ucwords($row['Firstname']);
			$lastname = ucwords($row['Lastname']);
			$helanamnet = $firstname . " " . $lastname; 
			$tag = $row['Tag'];
			echo "<option value=\"{$row['No']}\">$tag - $helanamnet</option>\n";
	}
	MySQL_close($db);
?>
</select>



<label for = 'submit'>Kolla hur anmälan ser ut</label>
<input type = 'submit' name = 'submit' value = 'OK' />
</form>

<div id = 'facts'>
<hr />
<?php 
	echo $retur;
	echo $checkedInButton;
?>

</div>

</div>
<div class = 'spalt'>
<h2>Efternamnslista</h2>

	
<?php 
// open connection och skriv ut en lista i efternamnsordning.
	$db = MySQL_connect("localhost", "flippersm", "ngt3vligt");
	MySQL_select_db("flippersm", $db);

	$sql = "SELECT Tag, Firstname, Lastname FROM sm_2012_anmalda ORDER by Lastname";
	$result = mysql_query($sql);
	$i = 0;
	echo "<table id = 'smal'><tr><th>Efternamn<th>Förnamn<th>TAG";
	while ($row = mysql_fetch_assoc($result)) 
	{
			$firstname = ucwords($row['Firstname']);
			$lastname = ucwords($row['Lastname']);
			$tag = $row['Tag'];
			if ($i%2)
				echo "<tr class = 'even'>";
			else
				echo "<tr class = 'odd'>";

			echo "<td>" . $lastname . "<td>" . $firstname . "<td>" . $tag . "</tr>";
			$i++;
	}
	echo "</table>";
	MySQL_close($db);
?>

</div>
<br class = 'clearboth' />
</div>

<?php
	include("fot.fil");
?>
