<html>
<head>
<link href="epc07.css" rel="stylesheet" type="text/css">
<body>


<h2>VÄCKTAGNING I EPC07</h2>

<?php
include("header.php");

$strTry_id = $_GET['try_id'];
//$strPlayer_no = $_GET['player'];
//$strGame_id = $_GET['game'];


// open connection
$db = MySQL_connect("localhost", "europinb", "38Pw9962");
MySQL_select_db("europinb_qualtest", $db);


// save post for double check
$sqlChk = "SELECT * FROM Qual WHERE Try_id = '$strTry_id'";
//$sqlChk = "SELECT * FROM Qual WHERE Player_no = '$strPlayer_no' AND Game_id = '$strGame_id'";
$sqlResultChk = MySQL_query($sqlChk,$db);

// delete post
$sqlDel = "DELETE FROM Qual WHERE Try_id = '$strTry_id'";
//$sqlDel = "DELETE FROM Qual WHERE Player_no = '$strPlayer_no' AND Game_id = '$strGame_id'";
$sqlResultDel = MySQL_query($sqlDel,$db);


if($sqlResultDel)
    {
    echo "<p>Posten med försöksid:t $strTry_id togs väck. Den såg ut såhär:</p>\n";
//    echo "<p>Alla poster med spelare $strPlayer_no på spel $strGame_id togs väck. Till exempel den nedanstående:</p>\n";
    echo "<table border='0' cellpadding='4'>";
    printf("<tr><td align='right'><i> Try_id: </td><td> <span class='nytext'>%d</span></i> </td></tr>\n",  MySQL_result($sqlResultChk,0,"Try_id"));
    printf("<tr><td align='right'><i> Spelarnummer: </td><td> <span class='nytext'>%d</span> </td></tr>\n", MySQL_result($sqlResultChk,0,"Player_no"));
    printf("<tr><td align='right'><i> Tag: </td><td> <span class='nytext'>%s</span> </td></tr>\n", MySQL_result($sqlResultChk,0,"Tag"));
    printf("<tr><td align='right'><i> Spelnummer: </td><td> <span class='nytext'>%d</span> </td></tr>\n", MySQL_result($sqlResultChk,0,"Game_id"));
    printf("<tr><td align='right'><i> Spelpoäng: </td><td> <span class='nytext'>%s</span></i> </td></tr>\n", number_format(MySQL_result($sqlResultChk,0,"Game_points"), 0, ',', ' '));
    echo "</table><br>\n";
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