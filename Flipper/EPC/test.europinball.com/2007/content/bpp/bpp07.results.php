<html>
<head><script src="autoscroll.jsnej"></script>
<link href="epc07.css" rel="stylesheet" type="text/css">
</head>
<body>


<h2>RESULTAT EPC07</h2>

<?php
include("header.php");
//include("header.snurrlist.php");
php?>


<br><table class="tabell">
  <tr><td> Spelar-<br>nummer: </td><td> Tag: </td><td> Namn: </td><td> Hemort: </td><td> Kvalpoäng: </td><td> Spel: </td><td> Spelpoäng: </td><td> &nbsp; </td></tr>

<?php

// handle sorting order
$arySort = array("entry" => "Try_id",
                 "no" => "Player_no",
                 "tag" => "Tag",
                 "namn" => "Name",
                 "kval" => "Qual_points",
                 "spel" => "Game_id",
                 "spelpoäng" => "Game_points");

$strSortorder = $_GET['sortby'];
if(is_null($strSortorder))  {
    $sqlSort = "";  }
else
    {
    $sqlSort = " ORDER BY " . $arySort[$strSortorder];
    if(strpos($arySort[$strSortorder], "points"))  {
        $sqlSort .= " DESC";  }
    }

// open connection
$db = MySQL_connect("localhost", "europinb", "38Pw9962");
MySQL_select_db("europinb_qualtest", $db);


// get data
$sql = "SELECT Qual.Player_no, Players.Tag, Players.Name, Players.City, Qual.Qual_points, Qual.Game_id, Games.Game_name, Qual.Game_points, Qual.Try_id FROM Qual LEFT JOIN Games ON Qual.Game_id = Games.Game_id LEFT JOIN Players ON Players.Player_no = Qual.Player_no" . $sqlSort;
$sqlResult = MySQL_query($sql,$db);

$intRows = MYSQL_num_rows($sqlResult);


// display data
for($c=0; $c<$intRows; $c++)
    {
    echo "  <tr>";
//    printf("<td align=\"center\"> %s </td>", MySQL_result($sqlResult,$c,$arySort["entry"]));
    printf("<td align=\"center\"> %s </td>", MySQL_result($sqlResult,$c,$arySort["no"]));
    printf("<td> <a href=\"bpp07.showentry.php?id=%s\">%s</a> </td>", MySQL_result($sqlResult,$c,$arySort["no"]), MySQL_result($sqlResult,$c,$arySort["tag"]));
    printf("<td> %s </td>", MySQL_result($sqlResult,$c,$arySort["namn"]));
    printf("<td> %s </td>", MySQL_result($sqlResult,$c,"City"));
    printf("<td align=\"center\"> %s </td>", MySQL_result($sqlResult,$c,$arySort["kval"]));
    printf("<td> <a href=\"bpp07.showgame.php?id=%s\">%s</a> </td>", MySQL_result($sqlResult,$c,"Game_id"), MySQL_result($sqlResult,$c,"Game_name"));
    printf("<td align=\"right\"> %s </td>", number_format(MySQL_result($sqlResult,$c,"Game_points"),0,"."," "));
    printf("<td> <a href=\"bpp07.delete.php?try_id=%s\">Ta väck!</a> </td>", MySQL_result($sqlResult,$c,"Try_id"));
//    printf("<td> <a href=\"bpp07.delete.php?player=%s&game=%s\">Ta väck!</a> </td>", MySQL_result($sqlResult,$c,$arySort["no"]), MySQL_result($sqlResult,$c,$arySort["spel"]));
    echo "</tr>\n";
    }

MySQL_close($db);

php?>

</table><br><br>

<?php
echo "<p><i>Aktuell per  ". date("ymd H:i:s") .".</i></p>";
php?>


<hr><br>

A Calle Be production.<br>

</body></html>
