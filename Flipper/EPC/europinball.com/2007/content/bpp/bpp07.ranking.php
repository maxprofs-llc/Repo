<html>
<head><script src="autoscroll.jsnej"></script>
<link href="epc07.css" rel="stylesheet" type="text/css">
</head>
<body>


<h2>RANKING EPC07</h2>

<?php
include("header.php");
//include("header.snurrlist.php");
php?>


<br><table class="tabell">
  <tr><td> Position: </td><td> Spelar-<br>nummer: </td><td> Tag: </td><td> Namn: </td><td> Hemort: </td><td> Kvalpoäng: </td></tr>


<!--  <tr><td align="center" colspan="6"> <i>Nedanstående (plats 1-64) klara för slutspel</i><br> KOM I TID TILL UPPROPET 09.45!! </td></tr>
-->


<?php

// handle sorting order
$arySort = array("entry" => "Try_id",
                 "no" => "Player_no",
                 "tag" => "Tag",
                 "namn" => "Name",
                 "kval" => "Qual_points",
                 "spel" => "Game_name",
                 "spelpoäng" => "Game_points");


// open connection
$db = MySQL_connect("localhost", "europinb", "38Pw9962");
MySQL_select_db("europinb_qualtest", $db);


// get data
MySQL_query("SET @a:=0",$db);
$sql = "SELECT IF(@a, @a:=@a+1, @a:=1) as Position, Players.Tag, Players.Name, Players.City, Players.Player_no, SUM(Qual_points) AS Qual_sum FROM Qual LEFT JOIN Players ON Players.Player_no = Qual.Player_no GROUP BY Name ORDER BY Qual_sum DESC";
$sqlResult = MySQL_query($sql,$db);

$intRows = MYSQL_num_rows($sqlResult);


// display data
for($c=0; $c<$intRows; $c++)
    {
    echo "  <tr>";
    printf("<td align=\"center\"> %s </td>", MySQL_result($sqlResult,$c,"Position"));
    printf("<td align=\"center\"> %s </td>", MySQL_result($sqlResult,$c,$arySort["no"]));
    printf("<td> <a href=\"bpp07.showentry.php?id=%s\">%s</a> </td>", MySQL_result($sqlResult,$c,"Player_no"),MySQL_result($sqlResult,$c,$arySort["tag"]));
    printf("<td> %s </td>", MySQL_result($sqlResult,$c,$arySort["namn"]));
    printf("<td> %s </td>", MySQL_result($sqlResult,$c,"City"));
    printf("<td align=\"right\"> %s </td>", MySQL_result($sqlResult,$c,"Qual_sum"));
    echo "</tr>\n";

//    if($c == 63)  {
//      echo "\n  <tr><td align=\"center\" colspan=\"6\"> <i>Nedanstående ej klara för slutspel, men kan få plats<br> om ovanstående ej är närvarande vid uppropet imorgon kl09.45</i> </td></tr>\n\n";  }
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