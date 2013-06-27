<html>
<head>
  <title>KONTROLLFRÅGOR SM07</title>
  <link href="sm07.css" rel="stylesheet" type="text/css">
</head>
<body>


<h2>KONTROLLFRÅGOR SM07</h2>

<?php
include("sm07.header.php");

// open connection
$db = MySQL_connect("localhost", "sm", "slamtilt");
MySQL_select_db("sm07", $db);


// CHECK NUMBER OF REGGED QUALGAMES
echo "<h2>Antal reggade kvalomgångar per spelare:</h2>\n\n";

// get data
$sqlQualno3 = "SELECT Players.Player_no, Players.Tag, Players.Name, Players.City, COUNT(Players.Player_no) AS Kvalantal FROM Qual LEFT JOIN Players ON Players.Player_no = Qual.Player_no GROUP BY Players.Player_no HAVING Kvalantal<4 ORDER BY Kvalantal, Players.Player_no";
$sqlResultQualno3 = MySQL_query($sqlQualno3,$db);
$intRowsQualno3 = MYSQL_num_rows($sqlResultQualno3);
$sqlQualno4 = "SELECT Players.Player_no, Players.Tag, Players.Name, Players.City, COUNT(Players.Player_no) AS Kvalantal FROM Qual LEFT JOIN Players ON Players.Player_no = Qual.Player_no GROUP BY Players.Player_no HAVING Kvalantal=4 ORDER BY Kvalantal, Players.Player_no";
$sqlResultQualno4 = MySQL_query($sqlQualno4,$db);
$intRowsQualno4 = MYSQL_num_rows($sqlResultQualno4);
$sqlQualno5 = "SELECT Players.Player_no, Players.Tag, Players.Name, Players.City, COUNT(Players.Player_no) AS Kvalantal FROM Qual LEFT JOIN Players ON Players.Player_no = Qual.Player_no GROUP BY Players.Player_no HAVING Kvalantal>4 ORDER BY Kvalantal, Players.Player_no";
$sqlResultQualno5 = MySQL_query($sqlQualno5,$db);
$intRowsQualno5 = MYSQL_num_rows($sqlResultQualno5);
$sqlQualnototal = "SELECT COUNT(Player_no) AS Kvalantal FROM Qual GROUP BY Player_no";
$sqlResultQualnototal = MySQL_query($sqlQualnototal,$db);
$intRowsQualnototal = MYSQL_num_rows($sqlResultQualnototal);

// display data
echo "<p>Folk med färre än 4 reggade kvalspel (". $intRowsQualno3 ." st):</p>\n";
echo "<table class='tabell'>\n";
echo "  <tr><td> Spelar-<br>nummer: </td><td> Tag: </td><td> Namn: </td><td> Hemort: </td><td> Antal reggade<br>kvalomg: </td></tr>\n";
for($c=0; $c<$intRowsQualno3; $c++)
    {
    echo "  <tr>";
    printf("<td align=\"center\"> %s </td>", MySQL_result($sqlResultQualno3,$c,"Players.Player_no"));
    printf("<td> <a href=\"sm07.showentry.php?no=%s\">%s</a> </td>", MySQL_result($sqlResultQualno3,$c,"Players.Player_no"), MySQL_result($sqlResultQualno3,$c,"Players.Tag"));
    printf("<td> %s </td>", MySQL_result($sqlResultQualno3,$c,"Players.Name"));
    printf("<td> %s </td>", MySQL_result($sqlResultQualno3,$c,"Players.City"));
    printf("<td align=\"center\"> %s </td>", MySQL_result($sqlResultQualno3,$c,"Kvalantal"));
    echo "</tr>\n";
    }
echo "</table>\n\n";

echo "<p>Folk med fler än 4 reggade kvalspel (". $intRowsQualno5 ." st):</p>\n";
echo "<table class='tabell'>\n";
echo "  <tr><td> Spelar-<br>nummer: </td><td> Tag: </td><td> Namn: </td><td> Hemort: </td><td> Antal reggade<br>kvalomg: </td></tr>\n";
for($c=0; $c<$intRowsQualno5; $c++)
    {
    echo "  <tr>";
    printf("<td align=\"center\"> %s </td>", MySQL_result($sqlResultQualno5,$c,"Players.Player_no"));
    printf("<td> <a href=\"sm07.showentry.php?no=%s\">%s</a> </td>", MySQL_result($sqlResultQualno5,$c,"Players.Player_no"), MySQL_result($sqlResultQualno5,$c,"Players.Tag"));
    printf("<td> %s </td>", MySQL_result($sqlResultQualno5,$c,"Players.Name"));
    printf("<td> %s </td>", MySQL_result($sqlResultQualno5,$c,"Players.City"));
    printf("<td align=\"center\"> %s </td>", MySQL_result($sqlResultQualno5,$c,"Kvalantal"));
    echo "</tr>\n";
    }
echo "</table>\n\n";

echo "<p>Folk med exakt 4 reggade kvalspel (". $intRowsQualno4 ." st).<br>\n";
echo "Totalt antal folk: ". $intRowsQualnototal ." st (vilket ska vara = ". $intRowsQualno3 ." + ". $intRowsQualno5 ." + ". $intRowsQualno4 .")</p>\n";


echo "<hr>\n\n";


// CHECK EQUAL GAME POINTS
echo "<h2>Antal spelpoäng som är exakt lika:</h2>\n\n";

// get data
$sqlExactGamepoints = "SELECT Game_points, COUNT(Game_points) AS Spelpoäng FROM Qual GROUP BY Game_points HAVING Spelpoäng>1 ORDER BY Spelpoäng DESC, Game_points DESC";
$sqlResultExactGamepoints = MySQL_query($sqlExactGamepoints,$db);
$intRowsExactGamepoints = MYSQL_num_rows($sqlResultExactGamepoints);

// display data
echo "<p>Folk med exakt samma spelpoäng som nån annan (". $intRowsExactGamepoints ." st):</p>\n";
echo "<table class='tabell'>\n";
echo "  <tr><td> Spelpoäng: </td><td> Antal med<br>samma poäng: </td></tr>\n";
for($c=0; $c<$intRowsExactGamepoints; $c++)
    {
    echo "  <tr>";
    printf("<td align=\"right\"> %s </td>", number_format(MySQL_result($sqlResultExactGamepoints,$c,"Game_points"),0,"."," "));
    printf("<td align=\"center\"> %s </td>", MySQL_result($sqlResultExactGamepoints,$c,"Spelpoäng"));
    echo "</tr>\n";
    }
echo "</table><br>\n\n";


echo "<hr><br>\n";


MySQL_close($db);

echo "<p><i>Aktuell per  ". date("ymd H:i:s") .".</i></p>";
php?>


<hr><br>

A Calle Be production.<br>

</body></html>
