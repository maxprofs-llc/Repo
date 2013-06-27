<?
session_start();
if (!isset($_SESSION['ok_user']))
{
echo "Du är inte inloggad...";
exit;
}
?>
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
<?
echo "<font size='2'>";
echo "<b>Anmälningar</b>";
echo "<br><br>";
echo "<font size='1'>";
echo "Vill du se anmälningarna eller uppdatera dem kan du göra det <b><a href='anmalda_admin.php'>här</b></a>.";
echo "<br><br>";
echo "vill du experimentera med resultatredovisning online, klicka <a href='onlineresultat.php'>här</a>.";
?>
<font size="1">
<font size="2">
<b>Resultat</b>
<br>
<br>
<font size="1">
Här kan man lägga upp resultat, så att folk hemma får se hur tävlingen utvecklar sig.
<br><br>
<?
echo "<table>";
echo "<tr>";
echo "<td><font size='2'><b>Lägg in ett resultat:</td>";
echo "</tr>";
echo "</table>";
echo "<form action='nytt_resultat.php' name='result' method='post'>";

echo "<table>";
echo "<tr>";
echo "<td><font size='1'><b>Spelarnummer:</b></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input type=text name=spelarnr maxlength=4 size=3><br></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'><b>Tag:</b></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input type=text name=tag maxlength=3 size=3><br></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'><b>Namn:</b></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input type=text name=namn maxlength=50 size=30><br></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'><b>Spel 1:</b></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input type=text name=spel1 maxlength=6 size=6><br></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'><b>Poäng på spel 1:</b></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input type=text name=pointsspel1 maxlength=20 size=20><br></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'><b>Spel 2:</b></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input type=text name=spel2 maxlength=6 size=6><br></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'><b>Poäng på spel 2:</b></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input type=text name=pointsspel2 maxlength=20 size=20><br></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'><b>Spel 3:</b></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input type=text name=spel3 maxlength=6 size=6><br></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'><b>Poäng på spel 3:</b></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input type=text name=pointsspel3 maxlength=20 size=20><br></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'><b>Spel 4:</b></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input type=text name=spel4 maxlength=6 size=6><br></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'><b>Poäng på spel 4:</b></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input type=text name=pointsspel4 maxlength=20 size=20><br></td>";
echo "</tr>";

echo "<tr>";
echo "<td colspan=2><input type=submit class='egen' value='Lägg In'></td>";
echo "</tr>";
echo "</table>";
echo "</form>";
?>
<font size="2">
<b>Inlagda Resultat:</b>
<br>
<br>
<font size="1">
Klicka på "Radera" om du vill ta bort resultatet.
<br><br>
<?
require("dbas/dbasbud.php");
require("datumform2.php");
require("datumform.php");
require("tidform.php");

$query = "select *
	 from smkvalresultat
 	 order by spelarnr desc
	 ";
	 
$result = mysql_query($query) or die("<p>SQL: $query <br>".mysql_error()); 
$num_results = mysql_num_rows($result);

echo "<table style='border-collapse: collapse;' width='400'>";

for ($i=0; $i < $num_results; $i++)
{
    $row = mysql_fetch_array($result);

    echo "<tr bgcolor='f1f1f1'>";
    $spelarnr = htmlspecialchars( stripslashes($row["spelarnr"]));
    echo "<td>";
    echo "<font size='1'><b>Spelarnummer:</b> $spelarnr";
    echo "</td>";
    
    $tag = htmlspecialchars( stripslashes($row["tag"]));
    echo "<td>";
    echo "<font size='1'><b>TAG:</b> $tag";
    echo "</td>";

$namn = htmlspecialchars( stripslashes($row["namn"]));
    echo "<td>";
    echo "<font size='1'><b>Namn:</b> $namn";
    echo "</td>";
    echo "</tr>";

$spel1 = htmlspecialchars( stripslashes($row["spel1"]));
echo "<tr>";    
echo "<td>";
    echo "<font size='1'><b>Spel 1:</b> $spel1";
    echo "</td>";    

$pointsspel1 = htmlspecialchars( stripslashes($row["pointsspel1"]));
    echo "<td>";
    echo "<font size='1'><b>Poäng:</b> $pointsspel1";
    echo "</td>";
    echo "</tr>";
   
$spel2 = htmlspecialchars( stripslashes($row["spel2"]));
echo "<tr>";    
echo "<td>";
    echo "<font size='1'><b>Spel 2:</b> $spel2";
    echo "</td>";    

$pointsspel2 = htmlspecialchars( stripslashes($row["pointsspel2"]));
    echo "<td>";
    echo "<font size='1'><b>Poäng:</b> $pointsspel2";
    echo "</td>";
    echo "</tr>";

$spel3 = htmlspecialchars( stripslashes($row["spel3"]));
echo "<tr>";    
echo "<td>";
    echo "<font size='1'><b>Spel 3:</b> $spel3";
    echo "</td>";    

$pointsspel3 = htmlspecialchars( stripslashes($row["pointsspel3"]));
    echo "<td>";
    echo "<font size='1'><b>Poäng:</b> $pointsspel3";
    echo "</td>";
    echo "</tr>";

$spel4 = htmlspecialchars( stripslashes($row["spel4"]));
echo "<tr>";    
echo "<td>";
    echo "<font size='1'><b>Spel 4:</b> $spel4";
    echo "</td>";    

$pointsspel4 = htmlspecialchars( stripslashes($row["pointsspel4"]));
    echo "<td>";
    echo "<font size='1'><b>Poäng:</b> $pointsspel4";
    echo "</td>";
    echo "</tr>";

    echo "<tr>";
    echo "<td bgcolor='f1f1f1' colspan='2' align='right'>";
    echo "<font size='1'><b><a href='tabort_nyhet.php?id=$id'>Radera";
    echo "</td>";
    echo "</tr>";
    
    echo "<tr>";
    echo "<td>";
    echo "<font size='1'><br>";
    echo "</td>";
    echo "</tr>";    

}

echo "</table>";

if (!$num_results)
{
echo "Inga gamla resultat hittades.";
}

?>
</body>
</html>
