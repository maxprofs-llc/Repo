<html>
<head>
  <title>RESULTAT SM07 (projektor)</title>
  <script src="autoscroll.js"></script>
  <link href="sm07.projektor.css" rel="stylesheet" type="text/css">
</head>
<body>


<h2>RESULTAT SM07</h2>

<?php
include("sm07.header.snurrlist.php");
php?>


<br><table class="tabell">
  <tr><td> Spelar-<br>nummer: </td><td> Tag: </td><td> Namn: </td><td> Hemort: </td><td> Kvalpoäng: </td><td> Spel: </td><td> Spelpoäng: </td></tr>

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
elseif($strSortorder == 'spel')  {
    $sqlSort = " ORDER BY Game_id, Game_points DESC";  }
else
    {
    $sqlSort = " ORDER BY " . $arySort[$strSortorder];
    if(strpos($arySort[$strSortorder], "points"))  {
        $sqlSort .= " DESC";  }
    }

// open connection
$db = MySQL_connect("localhost", "sm", "slamtilt");
MySQL_select_db("sm07", $db);


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
    printf("<td> %s </td>", MySQL_result($sqlResult,$c,$arySort["tag"]));
    printf("<td> %s </td>", MySQL_result($sqlResult,$c,$arySort["namn"]));
    printf("<td> %s </td>", MySQL_result($sqlResult,$c,"City"));
    printf("<td align=\"center\"> %s </td>", MySQL_result($sqlResult,$c,$arySort["kval"]));
    printf("<td> %s </td>", MySQL_result($sqlResult,$c,"Game_name"));
    printf("<td align=\"right\"> %s </td>", number_format(MySQL_result($sqlResult,$c,"Game_points"),0,"."," "));
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
