<html>
<head>
  <title>RANKING SM07 (projektor)</title>
  <script src="autoscroll.js"></script>
  <link href="sm07.projektor.css" rel="stylesheet" type="text/css">
</head>
<body>


<h2>SPELENTRY SM07</h2>

<?php
include("sm07.header.snurrlist.php");
php?>





<?php

$strGame_id = $_GET['id'];
if(is_null($strGame_id))  {
    $strGame_id = "ERROR";  }


// open connection
$db = MySQL_connect("localhost", "sm", "slamtilt");
MySQL_select_db("sm07", $db);


$sqlResultGames = MySQL_query("SELECT Game_id, Game_name FROM Games WHERE Game_id='$strGame_id'", $db);
$strGame_name = MySQL_result($sqlResultGames,0,"Game_name");

echo "<h2>Kvalbidrag för $strGame_name</h2>\n\n";
echo "<table class=\"tabell\">\n";
echo "  <tr><td> Position: </td><td> Spelar-<br>nummer: </td><td> Tag: </td><td> Namn: </td><td> Hemort: </td><td> Kvalpoäng: </td><td> Spelpoäng: </td></tr>\n";


// get data
MySQL_query("SET @a:=0",$db);
$sql = "SELECT IF(@a, @a:=@a+1, @a:=1) as Position, Qual.Game_points, Qual.Qual_points, Qual.Player_no, Players.Tag, Players.Name, Players.City FROM Qual LEFT JOIN Players ON Players.Player_no = Qual.Player_no WHERE Game_id='$strGame_id' ORDER BY Qual.Game_points DESC";
$sqlResultQual = MySQL_query($sql, $db);
$intRows = MYSQL_num_rows($sqlResultQual);

// display data
for($c=0; $c<$intRows; $c++)
    {
    echo "  <tr>";
    printf("<td align=\"center\"> %s </td>", MySQL_result($sqlResultQual,$c,"Position"));
    printf("<td align=\"center\"> %s </td>", MySQL_result($sqlResultQual,$c,"Player_no"));
    printf("<td> %s </td>", MySQL_result($sqlResultQual,$c,"Tag"));
    printf("<td> %s </td>", MySQL_result($sqlResultQual,$c,"Name"));
    printf("<td> %s </td>", MySQL_result($sqlResultQual,$c,"City"));
    printf("<td align=\"center\"> %s </td>", MySQL_result($sqlResultQual,$c,"Qual_points"));
    printf("<td align=\"right\"> %s </td>", number_format(MySQL_result($sqlResultQual,$c,"Game_points"),0,"."," "));
    echo "</tr>\n";
    }


MySQL_close($db);

?>

</table><br><br>

<?php
echo "<p><i>Aktuell per  ". date("ymd H:i:s") .".</i></p>";
php?>


<hr><br>

A Calle Be production.<br>

</body></html>
