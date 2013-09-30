<?php
// Här är filen som reggar röster i Best-in-show och/eller (XOR?) reggar antalet försök i 80-talstresteg.


if (isset($_POST['Regga80'])) {
	
	// Hämta värden.
	$no = $_POST['id'];
	$score80 = $_POST['score80'];
	
	// open connection
	$db = MySQL_connect("localhost", "flippersm", "nf7JcYqJmYT8ymCE");
	MySQL_select_db("flippersm_main", $db);

	$sql = "UPDATE sm_2012_anmalda SET Score80 = $score80 WHERE No = $no AND Score80 < $score80 AND 80s < 3";
	$result = mysql_query($sql) or die;

	$sql = "UPDATE sm_2012_anmalda SET 80s = 80s + 1 WHERE No = $no AND 80s < 3";
	$result = mysql_query($sql) or die;

	// stäng connection
	MySQL_close($db);
	

}

if (isset($_POST['vote'])) {

	// Hämta värden.
	$no = $_POST['id'];
	
	// open connection
	$db = MySQL_connect("localhost", "flippersm", "nf7JcYqJmYT8ymCE");
	MySQL_select_db("flippersm_main", $db);

	$sql = "UPDATE sm_2012_anmalda SET vote = 1 WHERE No = $no AND vote <> 1";
	$result = mysql_query($sql) or die;

	// stäng connection
	MySQL_close($db);
	

}

if (isset($_POST['submit'])) {


	$identifikation = "No = " . $_POST['Person_no'];
	$noMoreTries = 0;
	$harVoterat = 0;

	// open connection
	$db = MySQL_connect("localhost", "flippersm", "nf7JcYqJmYT8ymCE");
	MySQL_select_db("flippersm_main", $db);

	$sql = "SELECT Tag, Firstname, Lastname, 80s, vote FROM sm_2012_anmalda WHERE $identifikation";

	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {
		$tag = $row['Tag'];
		$namn = ucwords($row['Firstname']) . " " . ucwords($row['Lastname']);

		// Kolla om spelaren har lämnat in några scorer för 80-talstresteget
		if ($row['80s'] == 0)
			$eighties = 'har tre försök kvar';
		if ($row['80s'] == 1)
			$eighties = 'har två försök kvar';
		if ($row['80s'] == 2)
			$eighties = 'har ett försök kvar';
		if ($row['80s'] == 3){
			$eighties = 'har spelat alla sina försök';
			$noMoreTries = 1;
		}	
	
		// Kolla om spelaren har röstat
		if ($row['vote'] != 1)
			$votering = 'ännu inte röstat';
		else {
			$votering = 'lagt sin röst.';
			$harVoterat = 1;
		}
	}

	$retur = "<h2>" . $tag . "</h2><p>" . $namn . " " . $eighties . " i 80-talstresteget.</p><p>Och när det gäller röstningen, så har " . $tag . " " . $votering;


	if ($noMoreTries == 0)
		$tryButton = "<p><b>Totalpoängen i 80-talstresteget.</b></p><input type = 'text' name = 'score80' value =''><input type = 'submit' name = 'Regga80' value = 'Registrera nytt försök i 80-talstresteg' />";
	else
		$tryButton = '';


	if ($harVoterat == 0)
		$voteButton = "<input type = 'submit' name = 'vote' value = 'Registrera röstning' />";
	else
		$voteButton = '';
	

	$checkedInButton = "<form action = 'voteAnd80.php' method = 'POST'>" . $tryButton . $voteButton . "<input type = 'hidden' name = 'id' value = " . $_POST['Person_no'] . " /></form>"; 
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

<a href="http://www.flippersm.se/voteAnd80.php">
<img src="bilder/loggor/bowling_bred.png" alt="Flipper-SM 2012" height = '150px' />
</a>

</div>

!-->


<div id = 'content'>

	<div class = 'spalt'>

		<p><a href = '1000spinner.php'>Klicka här för INCHECKNING.</a></p>

		<form action = 'voteAnd80.php' method = 'POST'>
		<label for = 'Person_no'>Tag och namn.</label>

		<select name = "Person_no">
		<option value = 0>Ingen vald</option>
		<?php 
		// open connection
			$db = MySQL_connect("localhost", "flippersm", "nf7JcYqJmYT8ymCE");
			MySQL_select_db("flippersm_main", $db);
	
			$sql = "SELECT No, Tag, Firstname, Lastname FROM sm_2012_anmalda WHERE CheckedIn = 1 ORDER by Tag";
			$result = mysql_query($sql);
			while ($row = mysql_fetch_assoc($result)) {
				$firstname = ucwords($row['Firstname']);
				$lastname = ucwords($row['Lastname']);
				$helanamnet = $firstname . " " . $lastname; 
				$tag = $row['Tag'];
				echo "<option value=\"{$row['No']}\">$tag - $helanamnet</option>\n";
			}
		MySQL_close($db);
		?>
		</select>



		<label for = 'submit'>Visa info för röstning & dylikt.</label>
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
		<h2>80-talstresteg top 10</h2>

	
<?php 
// open connection och skriv ut en lista i efternamnsordning.
	$db = MySQL_connect("localhost", "flippersm", "nf7JcYqJmYT8ymCE");
	MySQL_select_db("flippersm_main", $db);

	$sql = "SELECT Tag, Firstname, Lastname, score80, 80s FROM sm_2012_anmalda WHERE 80s > 0 ORDER by score80 DESC LIMIT 0,10";
	$result = mysql_query($sql);
	$i = 1;
	echo "<table id = 'smal'><tr><th>#<th>Namn<th>TAG<th>Score<th>Attempts";
	while ($row = mysql_fetch_assoc($result)) 
	{
			$namnet = ucwords($row['Firstname']) . " " . ucwords($row['Lastname']);
			$tag = $row['Tag'];
			$scoren = number_format($row['score80'], 0, '',' ');
			$antaltries = $row['80s'];
			if ($i%2)
				echo "<tr class = 'even'>";
			else
				echo "<tr class = 'odd'>";

			echo "<td>" . $i . "<td>" . $namnet . "<td>" . $tag . "<td align = right>" . $scoren . "<td align = right>" . $antaltries . "</tr>";
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
</html>



