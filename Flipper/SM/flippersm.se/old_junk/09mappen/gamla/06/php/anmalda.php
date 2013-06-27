<html>
<head>
<title></title>
</head>
<body
bgcolor="ffffff"
link="000000"
vlink="000000">

<font face="verdana">
<font color="000000">
<font size="1">

<font size="2">
<b>Anmälda spelare till Flipper-SM 2004</b>
<br>
<br>
<font size="1">
Dessa Spelare är anmälda till Flipper-SM 2004. När spelarens anmälningsavgift är betald markeras "Betalat" kolumnen med ett Ja.
<br><br>
Om du vill ändra något i din anmälan: skicka ett mail till <a href=mailto:stefan@flippersm.se><b>den här</b></a> adressen.
<br>
<br>
<?
require("dbas/dbas.php");

$query = "select tag
	 from sm_anmalningar
 	 order by tag asc
	 ";
	 
$result = mysql_query($query) or die("<p>SQL: $query <br>".mysql_error()); 
$num_results = mysql_num_rows($result);

$query = "select tag
	 from sm_anmalningar
 	 where betalat = 'ja'
	 ";
	 
$result = mysql_query($query) or die("<p>SQL: $query <br>".mysql_error()); 
$num_results2 = mysql_num_rows($result);

echo "<td><font size='1'>Antal anmälda spelare: $num_results<br>";
echo "<font size='1'>Antal spelare som betalat anmälningsavgiften: $num_results2</p>";

$datum = date("y.m.d");                         

echo "<font size='1'>Klicka på rubrikerna för att sortera efter: Tag, Namn, Hemort eller Anmälningsdatumet.<br>";

echo "<br>";

require("dbas/dbas.php");
require("datumform.php");

if ($nysort != 'yadayadaa')
{

$query = "select *
	 from sm_anmalningar
 	 order by datum desc
	 ";
  		
echo "<table style='border-collapse: collapse;'>";
echo "<tr>";
echo "<td class='egen2'><a href='anmalda.php?sortera=tag&nysort=yadayadaa'><font size='1'><b>Tag:</b></td>";
echo "<td class='egen'><a href='anmalda.php?sortera=namn&nysort=yadayadaa'><font size='1'><b>Namn:</b></td>";
echo "<td class='egen'><a href='anmalda.php?sortera=hemort&nysort=yadayadaa'><font size='1'><b>Hemort:</b></td>";
echo "<td class='egen'><a href='anmalda.php?sortera=sedan&nysort=yadayadaa'><font size='1'><b>Anmäld:</b></td>";
echo "<td class='egen2'><font size='1'><b>Betalat:</b></td>";
echo "</tr>";
}
else
{

if ($sortera=='tag' & $nysort=='yadayadaa')
{	
	
	$query = "select *
	 from sm_anmalningar
 	 order by tag asc
 	 ";
 	 
echo "<table style='border-collapse: collapse;'>";

echo "<tr>";
echo "<td class='egen2'><a href='anmalda.php?sortera=tag&nysort=yadayadaa'><font size='1'><b>Tag:</b></td>";
echo "<td class='egen'><a href='anmalda.php?sortera=namn&nysort=yadayadaa'><font size='1'><b>Namn:</b></td>";
echo "<td class='egen'><a href='anmalda.php?sortera=hemort&nysort=yadayadaa'><font size='1'><b>Hemort:</b></td>";
echo "<td class='egen'><a href='anmalda.php?sortera=sedan&nysort=yadayadaa'><font size='1'><b>Anmäld:</b></td>";
echo "<td class='egen2'><font size='1'><b>Betalat:</b></td>";
echo "</tr>";	
}

if ($sortera=='namn' & $nysort=='yadayadaa')
{
	 $query = "select *
	 from sm_anmalningar
 	 order by namn asc
 	 ";
		
echo "<table style='border-collapse: collapse;'>";

echo "<tr>";
echo "<td class='egen'><a href='anmalda.php?sortera=tag&nysort=yadayadaa'><font size='1'><b>Tag:</b></td>";
echo "<td class='egen2'><a href='anmalda.php?sortera=namn&nysort=yadayadaa'><font size='1'><b>Namn:</b></td>";
echo "<td class='egen'><a href='anmalda.php?sortera=hemort&nysort=yadayadaa'><font size='1'><b>Hemort:</b></td>";
echo "<td class='egen'><a href='anmalda.php?sortera=sedan&nysort=yadayadaa'><font size='1'><b>Anmäld:</b></td>";
echo "<td class='egen2'><font size='1'><b>Betalat:</b></td>";
echo "</tr>";	
}

if ($sortera=='hemort' & $nysort=='yadayadaa')
{	
	 $query = "select *
	 from sm_anmalningar
 	 order by stad asc
 	 ";
	
echo "<table style='border-collapse: collapse;'>";

echo "<tr>";
echo "<td class='egen'><a href='anmalda.php?sortera=tag&nysort=yadayadaa'><font size='1'><b>Tag:</b></td>";
echo "<td class='egen'><a href='anmalda.php?sortera=namn&nysort=yadayadaa'><font size='1'><b>Namn:</b></td>";
echo "<td class='egen2'><a href='anmalda.php?sortera=hemort&nysort=yadayadaa'><font size='1'><b>Hemort:</b></td>";
echo "<td class='egen'><a href='anmalda.php?sortera=sedan&nysort=yadayadaa'><font size='1'><b>Anmäld:</b></td>";
echo "<td class='egen2'><font size='1'><b>Betalat:</b></td>";
echo "</tr>";	
}

if ($sortera=='sedan' & $nysort=='yadayadaa')
{	
	
	 $query = "select *
	 from sm_anmalningar
 	 order by datum desc
 	 ";
	
echo "<table style='border-collapse: collapse;'>";

echo "<tr>";
echo "<td class='egen'><a href='anmalda.php?sortera=tag&nysort=yadayadaa'><font size='1'><b>Tag:</b></td>";
echo "<td class='egen'><a href='anmalda.php?sortera=namn&nysort=yadayadaa'><font size='1'><b>Namn:</b></td>";
echo "<td class='egen'><a href='anmalda.php?sortera=hemort&nysort=yadayadaa'><font size='1'><b>Hemort:</b></td>";
echo "<td class='egen2'><a href='anmalda.php?sortera=sedan&nysort=yadayadaa'><font size='1'><b>Anmäld:</b></td>";
echo "<td class='egen2'><font size='1'><b>Betalat:</b></td>";
echo "</tr>";	
}
}
$result = mysql_query($query) or die("<p>SQL: $query <br>".mysql_error()); 
$num_results = mysql_num_rows($result);

for ($i=0; $i < $num_results; $i++)
{
    $row = mysql_fetch_array($result);
	
    if($i % 2)
    {
    echo "<tr>";
    }
    else
    {
    echo "<tr bgcolor='f1f1f1'>";     
    }
    
    echo "<td>";
    $tag = htmlspecialchars( stripslashes($row["tag"]));
    echo "<font size='1'>$tag";
    echo "</td>";

    echo "<td>";
    $namn = htmlspecialchars( stripslashes($row["namn"]));
    echo "<font size='1'>$namn";
    echo "</td>";
    
    echo "<td>";
    $temp = htmlspecialchars( stripslashes($row["stad"]));
    echo "<font size='1'>$temp";
    echo "</td>";

    echo "<td>";
    $temp = htmlspecialchars( stripslashes($row["datum"]));
    $tempdatum = datumform($temp);
    echo "<font size='1'>$tempdatum";
    echo "</td>";

    $betalat = htmlspecialchars( stripslashes($row["betalat"]));
    echo "<td align='center'>";
    
    if($betalat == 'ja')
    {
    echo "<font size='1'>Ja";
    }
    
    echo "</td>";
        
    echo "</tr>";
}

echo "</table>";

if (!$num_results)
{
echo "Inga registrerade resultat hittade.";
}

echo "</table>";


?>

</body>

</html>