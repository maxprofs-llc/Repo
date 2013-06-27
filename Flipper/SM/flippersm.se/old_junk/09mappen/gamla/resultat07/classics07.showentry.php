<html>
<head><script src="autoscroll.jsnej"></script>
<link href="classics07.css" rel="stylesheet" type="text/css">
</head>
<body>


<h2>SPELENTRY CLASSICS07</h2>

<?php
include("classics07.header.php");
//include("header.snurrlist.php");
php?>


<h2>Kvalbidrag för</h2>

<table class="tabell">
  <tr><td> Spelar-<br>nummer: </td><td> Tag: </td><td> Namn: </td><td> Hemort: </td><td> Kvalpoäng: </td><td> Position<br>totalt: </td></tr>


<?php

$strPlayer_no = $_GET['no'];
if(is_null($strPlayer_no))  {
    $strPlayer_no = "ERROR";  }

// open connection
$db = MySQL_connect("localhost", "sm", "slamtilt");
MySQL_select_db("classics07", $db);


$sqlResultPlayers = MySQL_query("SELECT Player_no, Tag, Name, City FROM Players WHERE Player_no='$strPlayer_no'", $db);
$intPlayer_no = MySQL_result($sqlResultPlayers,0,"Player_no");

MySQL_query("SET @a:=0",$db);
$sql = "SELECT Temp.Tag, Temp.Name, Temp.City, Temp.Player_no, Temp.Qual_sum, Temp.Position FROM (SELECT IF(@a, @a:=@a+1, @a:=1) as Position, Players.Tag, Players.Name, Players.Player_no, Players.City, SUM(Qual_points) AS Qual_sum FROM Qual LEFT JOIN Players ON Players.Player_no = Qual.Player_no GROUP BY Name ORDER BY Qual_sum DESC) as Temp WHERE Temp.Player_no = '$intPlayer_no'";
$sqlResultQual = MySQL_query($sql, $db);

$intRows = MySQL_num_rows($sqlResultQual);

// display data
for($c=0; $c<$intRows; $c++)
    {
    echo "  <tr>";
    printf("<td align=\"center\"> %s </td>", MySQL_result($sqlResultQual,$c,"Player_no"));
    printf("<td> %s </td>", MySQL_result($sqlResultQual,$c,"Tag"));
    printf("<td> %s </td>", MySQL_result($sqlResultQual,$c,"Name"));
    printf("<td> %s </td>", MySQL_result($sqlResultQual,$c,"City"));
    printf("<td align=\"center\"> %s </td>", MySQL_result($sqlResultQual,$c,"Qual_sum"));
    printf("<td align=\"center\"> %s </td>", MySQL_result($sqlResultQual,$c,"Position"));
    echo "</tr>\n";
    }


echo "</table><br><br>\n\n";
echo "<table class=\"tabell\">\n";
echo "  <tr><td> Spel: </td><td> Spelpoäng: </td><td> Kvalpoäng: </td></tr>\n";
//echo "  <tr><td> Spel: </td><td> Spelpoäng: </td><td> Kvalpoäng: </td><td> Position<br>på detta spel: </td></tr>\n";


// get data
//$sql = "SELECT Games.Game_id, Games.Game_name, Qual.Game_points, Qual.Qual_points, Qual_ladder.Qual_pos FROM Qual RIGHT JOIN (Games, Qual_ladder) ON (Qual.Game_id=Games.Game_id AND Qual.Qual_points=Qual_ladder.Qual_points) WHERE Player_no='$intPlayer_no'";
$sql = "SELECT Games.Game_id, Games.Game_name, Qual.Game_points, Qual.Qual_points FROM Qual RIGHT JOIN Games ON (Qual.Game_id=Games.Game_id) WHERE Player_no='$intPlayer_no'";
$sqlResultQual = MySQL_query($sql, $db);

$intRows = MYSQL_num_rows($sqlResultQual);

// display data
for($c=0; $c<$intRows; $c++)
    {
    echo "  <tr>";
    printf("<td> <a href=\"classics07.showgame.php?id=%s\">%s</a> </td>", MySQL_result($sqlResultQual,$c,"Game_id"),MySQL_result($sqlResultQual,$c,"Game_name"));
    printf("<td align=\"right\"> %s </td>", number_format(MySQL_result($sqlResultQual,$c,"Game_points"),0,"."," "));
    printf("<td align=\"center\"> %s </td>", MySQL_result($sqlResultQual,$c,"Qual_points"));
//    printf("<td align=\"center\"> %s </td>", MySQL_result($sqlResultQual,$c,"Qual_pos"));
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
