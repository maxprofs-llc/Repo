<html>
<head>
<link href="sm07.css" rel="stylesheet" type="text/css">
<body>


<h2>VÄCKTAGNING I SM07</h2>

<?php
include("sm07.header.php");

$strTry_id = $_GET['try_id'];


// open connection
$db = MySQL_connect("localhost", "sm", "slamtilt");
MySQL_select_db("sm07", $db);


// save post for double check
$sqlChk = "SELECT * FROM Qual WHERE Try_id = '$strTry_id'";
$sqlResultChk = MySQL_query($sqlChk,$db);

// delete post
$sqlDel = "DELETE FROM Qual WHERE Try_id = '$strTry_id'";
$sqlResultDel = MySQL_query($sqlDel,$db);


if($sqlResultDel)
    {
    echo "<p>Posten med försöksid:t $strTry_id togs väck. Den såg ut såhär:</p>\n";
    echo "<table border='0' cellpadding='4'>";
    printf("  <tr><td align='right'><i> Try_id: </td><td> <span class='nytext'>%d</span></i> </td></tr>\n",  MySQL_result($sqlResultChk,0,"Try_id"));
    printf("  <tr><td align='right'><i> Spelarnummer: </td><td> <span class='nytext'>%d</span> </td></tr>\n", MySQL_result($sqlResultChk,0,"Player_no"));
    printf("  <tr><td align='right'><i> Tag: </td><td> <span class='nytext'>%s</span> </td></tr>\n", MySQL_result($sqlResultChk,0,"Tag"));
    printf("  <tr><td align='right'><i> Spelnummer: </td><td> <span class='nytext'>%d</span> </td></tr>\n", MySQL_result($sqlResultChk,0,"Game_id"));
    printf("  <tr><td align='right'><i> Spelpoäng: </td><td> <span class='nytext'>%s</span></i> </td></tr>\n", number_format(MySQL_result($sqlResultChk,0,"Game_points"), 0, ',', ' '));
    echo "</table><br>\n";
    
    // recalculate qualification points
    $sqlGames = "SELECT * FROM Games ORDER BY Game_id";
    $sqlResultGames = MySQL_query($sqlGames,$db);
    $intRowsGames = MYSQL_num_rows($sqlResultGames);
    for($c=0; $c<$intRowsGames; $c++)
        {
        $strID = MySQL_result($sqlResultGames,$c,"Game_id");
        MySQL_query("UPDATE Qual SET Qual_points = 0 WHERE Game_id = '$strID'",$db);   
        MySQL_query("SET @a:=0",$db);   
        $sql = "UPDATE Qual RIGHT JOIN (Qual_ladder, (SELECT IF(@a, @a:=@a+1, @a:=1) as Rownum, Game_points, Player_no, Tag FROM Qual WHERE Game_id  = '$strID' ORDER BY Game_points DESC) AS x) ON (x.Rownum = Qual_ladder.Qual_pos AND x.Player_no =  Qual.Player_no) SET Qual.Qual_points = Qual_ladder.Qual_points WHERE Game_id = '$strID'";
        $sqlResultUpdate = MySQL_query($sql,$db);
        }
    echo "<p>Kvalpoängen omräknades.</p>\n";
    }
else
    {
    echo "<p>Äh, det bidde knas. Kalla på CAB!</p>\n";
    }


MySQL_close($db);
php?>


<hr><br>

A Calle Be production.<br>

</body></html>