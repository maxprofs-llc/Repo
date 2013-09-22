<?
session_start();
?>
<html>
<head>
<style>
<!--A:link, A:visited { text-decoration: none;}A:hover {  text-decoration: underline;color:"000033"}--></style>
</head>

<body
bgcolor="ffffff"
link="000000"
vlink="000000">

<font face="verdana">
<font color="000000">
<font size="1">

<font size="2">
<b>Vi har tagit emot följande anmälan till Flipper-SM 2004</b>
<br>
<br>
<font size="1">
Spar eller skriv gärna ut denna sida som en bekräftelse på att din anmälning kommit fram.
<br>
<br>
<?
$id = $_SESSION['id'];
require("dbas/dbas.php");

$query = "select *
	 from sm_anmalningar
 	 where id = '$id'
 	 limit 1
	 ";

$result = mysql_query($query) or die("<p>SQL: $query <br>".mysql_error()); 
$row = mysql_fetch_array($result);

$tag = htmlspecialchars( stripslashes($row["tag"]));
$namn = htmlspecialchars( stripslashes($row["namn"]));
$adress = htmlspecialchars( stripslashes($row["adress"]));
$postnummer = htmlspecialchars( stripslashes($row["postnummer"]));
$telefon = htmlspecialchars( stripslashes($row["telefon"]));
$fefter = htmlspecialchars( stripslashes($row["fefter"]));
$fkvall = htmlspecialchars( stripslashes($row["fkvall"]));
$lform = htmlspecialchars( stripslashes($row["lform"]));
$lefter = htmlspecialchars( stripslashes($row["lefter"]));
$lkvall = htmlspecialchars( stripslashes($row["lkvall"]));
$datum = htmlspecialchars( stripslashes($row["datum"]));
$meddelande = stripslashes(nl2br($row['meddelande'])); 
$meddelande = wordwrap($meddelande, 40, "\n", 1);

echo "<hr>";

echo "<table>";

echo "<tr>";
echo "<td><font size='1'><b>Tag:</b></td>";
echo "<td><font size='1'>$tag</td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'><b>Namn:</b></td>";
echo "<td><font size='1'>$namn</td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'><b>Adress:</b></td>";
echo "<td><font size='1'>$adress</td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'><b>Postnummer:</b></td>";
echo "<td><font size='1'>$postnummer</td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'><b>Telefon:</b></td>";
echo "<td><font size='1'>$telefon</td>";
echo "</tr>";

if($epost != null)
{
echo "<tr>";
echo "<td><font size='1'><b>Epost:</b></td>";
echo "<td><font size='1'>$epost</td>";
echo "</tr>";
}

echo "<tr>";
echo "<td><font size='1'><b>Kan kvala:</b></td>";
echo "<td><font size='1'>";

if($fefter != false or $fkvall != false or $lform != false or $lefter != false or $lkvall != false)
{
	
if($fefter == true)
{
echo "Fredag eftermiddag ";
}

if($fkvall == true)
{
echo "Fredag kväll ";
}

if($lform == true)
{
echo "Lördag förmiddag ";
}

if($lefter == true)
{
echo "Lördag eftermiddag ";
}

if($lkvall == true)
{
echo "Lördag kväll ";
}

}
else
{
echo "När som helst ";
}
echo "</td>";
echo "</tr>";
echo "</table>";

if($meddelande != null)
{
echo "<table>";
echo "<tr>";
echo "<td><font size='1'><b>Meddelande:</b></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size='1'>$meddelande</td>";
echo "</tr>";
echo "</table>";
}

require("datumform2.php");
require("tidform.php");
$datumdag = datumform2($datum);
$tid = tidform($datum);

echo "<br \>";
echo "<br \>";
echo "<font size='1'><b>Anmälningen mottogs:</b> $datumdag kl. $tid.";
echo "<hr>";
?>
</body>
</html>