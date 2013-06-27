<html>
<head>
<link href="classics07.css" rel="stylesheet" type="text/css">
<body>


<h2>INSKRIVNING AV POÄNG I CLASSICS07</h2>

<?php
include("classics07.header.php");

$aryPlayer    = explode(";", $_POST["cmbPlayer"]);
$strPlayer_no = $aryPlayer[0];
$strTag       = $aryPlayer[1];
$strPointsA   = $_POST["txtPointsA"];
$strPointsB   = $_POST["txtPointsB"];
$strPointsC   = $_POST["txtPointsC"];
$strPointsD   = $_POST["txtPointsD"];
$strPointsE   = $_POST["txtPointsE"];
$strPointsF   = $_POST["txtPointsF"];

// open connection
$db = MySQL_connect("bogart", "webb", "slamtilt");
MySQL_select_db("classics07", $db);


if(strlen($strPlayer_no)>0)    // if data is submitted, add the new post
    {
    $sqlA = "INSERT INTO Qual (Player_no, Tag, Game_id, Game_points) VALUES ($strPlayer_no, '$strTag', 'A', $strPointsA)";
    $sqlB = "INSERT INTO Qual (Player_no, Tag, Game_id, Game_points) VALUES ($strPlayer_no, '$strTag', 'B', $strPointsB)";
    $sqlC = "INSERT INTO Qual (Player_no, Tag, Game_id, Game_points) VALUES ($strPlayer_no, '$strTag', 'C', $strPointsC)";
    $sqlD = "INSERT INTO Qual (Player_no, Tag, Game_id, Game_points) VALUES ($strPlayer_no, '$strTag', 'D', $strPointsD)";
    $sqlE = "INSERT INTO Qual (Player_no, Tag, Game_id, Game_points) VALUES ($strPlayer_no, '$strTag', 'E', $strPointsE)";
    $sqlF = "INSERT INTO Qual (Player_no, Tag, Game_id, Game_points) VALUES ($strPlayer_no, '$strTag', 'F', $strPointsF)";

    if(strlen($strPointsA) >0)  {
        $sqlResultA = MySQL_query($sqlA,$db); $intA = MySQL_affected_rows();  }
    if(strlen($strPointsB) >0)  {
        $sqlResultB = MySQL_query($sqlB,$db); $intB = MySQL_affected_rows();  }
    if(strlen($strPointsC) >0)  {
        $sqlResultC = MySQL_query($sqlC,$db); $intC = MySQL_affected_rows();  }
    if(strlen($strPointsD) >0)  {
        $sqlResultD = MySQL_query($sqlD,$db); $intD = MySQL_affected_rows();  }
    if(strlen($strPointsE) >0)  {
        $sqlResultE = MySQL_query($sqlE,$db); $intE = MySQL_affected_rows();  }
    if(strlen($strPointsF) >0)  {
        $sqlResultF = MySQL_query($sqlF,$db); $intF = MySQL_affected_rows();  }
    
    $intTot = $intA + $intB + $intC + $intD + $intE + $intF;
    
    echo "<p>$intTot nya poster lades till.<br>\n";
    
// recalculate qualification points
    $sql = "SELECT Game_id, Game_name FROM Games";
    $sqlResultGames = MySQL_query($sql,$db);
    $intRowsGames = MYSQL_num_rows($sqlResultGames);

    for($c=0; $c<$intRowsGames; $c++)
        {
        $strGameid = MySQL_result($sqlResultGames,$c,"Game_id");
        MySQL_query("UPDATE Qual SET Qual_points = 0 WHERE Game_id = '$strGameid'",$db);   
        MySQL_query("SET @a:=0",$db);
        $sql = "UPDATE Qual RIGHT JOIN (SELECT IF(@a, @a:=@a+1, @a:=1) as Rownum, Game_points, Player_no, Tag FROM Qual WHERE Game_id  = '$strGameid' ORDER BY Game_points DESC) AS x ON (x.Player_no =  Qual.Player_no) RIGHT JOIN Qual_ladder ON (x.Rownum = Qual_ladder.Qual_pos) SET Qual.Qual_points = Qual_ladder.Qual_points WHERE Game_id = '$strGameid'";
        $sqlResultUpdate = MySQL_query($sql,$db);
        }
    }


echo "<hr><br>\n\n";

echo "<form name='frmInput' action='classics07.input.score.php' method='post'>\n";
echo "  <p><table border='0' cellpadding='4'>\n";
echo "    <tr><td> Spelare: </td><td>\n      <select name='cmbPlayer'>\n        <option value='' selected='selected'> Välj spelare här </option>\n";
$sql = "SELECT * FROM Players ORDER BY Player_no";
$sqlResult = MySQL_query($sql,$db);
$intPlayers = MySQL_num_rows($sqlResult);
for($c=0; $c<$intPlayers; $c++)  {
    printf("        <option value='%s'> %s </option>\n", MySQL_result($sqlResult,$c,"Player_no") .";". MySQL_result($sqlResult,$c,"Tag"), MySQL_result($sqlResult,$c,"Player_no") .": ". MySQL_result($sqlResult,$c,"Tag") ." (". MySQL_result($sqlResult,$c,"Name") .")");  }
echo "      </select>\n    </td></tr>\n";

MySQL_close($db);
php?>
    <tr><td> &nbsp; </td><td> &nbsp; </td></tr>
    <tr><td> Poäng A [Devil's Dare]:  </td><td> <input type="text" name="txtPointsA" size="25" maxlength="25"> </td></tr>
    <tr><td> Poäng B [Wizard!]:       </td><td> <input type="text" name="txtPointsB" size="25" maxlength="25"> </td></tr>
    <tr><td> Poäng C [Haunted House]: </td><td> <input type="text" name="txtPointsC" size="25" maxlength="25"> </td></tr>
    <tr><td> Poäng D [Scorpion]:      </td><td> <input type="text" name="txtPointsD" size="25" maxlength="25"> </td></tr>
    <tr><td> Poäng E [Super orbit]:   </td><td> <input type="text" name="txtPointsE" size="25" maxlength="25"> </td></tr>
    <tr><td> Poäng F [Old Chicago]:   </td><td> <input type="text" name="txtPointsF" size="25" maxlength="25"> </td></tr>
  </table><br><br>
  
  <input type="submit" value="Skicka"> &nbsp;&nbsp; <input type="reset" value="Återställ"></p><br><br>
</form>



A Calle Be production.<br>

</body></html>