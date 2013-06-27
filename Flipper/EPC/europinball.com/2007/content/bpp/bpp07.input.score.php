<html>
<head>
<link href="epc07.css" rel="stylesheet" type="text/css">
<body>


<h2>INSKRIVNING AV POÄNG I EPC07</h2>

<?php
include("header.php");

$strPlayerno = $_POST["txtPlayerno"];
$strTag      = $_POST["txtTag"];
$strGameid   = $_POST["txtGameid"];
$strPoints   = str_replace (" ", "", $_POST["txtPoints"]);


// open connection
$db = MySQL_connect("localhost", "europinb", "38Pw9962");
MySQL_select_db("europinb_qualtest", $db);

if (isset($_POST["txtPoints"]))    // if data is submitted, add the new posts
    {
    // check if Tags and player numbers match
    $sqlPlayer = "SELECT Player_no, Tag FROM Players WHERE Player_no = '$strPlayerno'";
    $sqlResultPlayer = MySQL_query($sqlPlayer,$db);
    if(strtolower(MySQL_result($sqlResultPlayer,0,"Tag")) != strtolower($strTag))
        {
        echo "<p>Näääääe, nu är det nåt som inte stämmer! Kontrollera spelarnummer och tag så att de stämmer!<br>Du skrev: $strPlayerno ($strTag),";
        printf(" men i tabellerna står det: %d (%s).</p>\n", MySQL_result($sqlResultPlayer,0,"Player_no"), MySQL_result($sqlResultPlayer,0,"Tag"));
        }
    
    // check input fields
    elseif($strPlayerno == '' or $strTag == '' or $strGameid == '' or $strPoints == '')  {
        echo "<p>Näääääe, nu glömde du fylla i nåt av fälten. Fyll i ALLA rutorna!</p>\n";  }
    else
        {
        
        // insert new post
        $sql = "INSERT INTO Qual (Player_no, Tag, Game_id, Game_points) VALUES ('$strPlayerno','". strtoupper($strTag) ."','$strGameid','$strPoints')";
        $sqlResult = MySQL_query($sql,$db);
        $intRows = MySQL_affected_rows();
        
        
        // recalculate qualification points
        $sqlCalc = "SELECT Game_id, Game_name FROM Games";
        $sqlResultGames = MySQL_query($sqlCalc,$db);
        $intRowsGames = MYSQL_num_rows($sqlResultGames);
        
        for($c=0; $c<$intRowsGames; $c++)
            {
            $strID = MySQL_result($sqlResultGames,$c,"Game_id");
            MySQL_query("UPDATE Qual SET Qual_points = 0 WHERE Game_id = '$strID'",$db);   
            MySQL_query("SET @a:=0",$db);   
            $sql = "UPDATE Qual RIGHT JOIN (Qual_ladder, (SELECT IF(@a, @a:=@a+1, @a:=1) as Rownum, Game_points, Player_no, Tag FROM Qual WHERE Game_id  = '$strID' ORDER BY Game_points DESC) AS x) ON (x.Rownum = Qual_ladder.Qual_pos AND x.Player_no =  Qual.Player_no) SET Qual.Qual_points = Qual_ladder.Qual_points WHERE Game_id = '$strID'";
            $sqlResultUpdate = MySQL_query($sql,$db);
            
//            printf("Name: %s , ", MySQL_result($sqlResultGames,$c,"Game_name"));
//            printf("Rows: %s <br>\n", MySQL_affected_rows());
            }
        
        
        // print new post on screen
        $sqlChk = "SELECT Qual.Try_id, Qual.Player_no, Qual.Tag, Players.Tag, Players.Name, Players.City, Qual.Game_id, Games.Game_name, Qual.Game_points, Qual.Qual_points FROM Qual LEFT JOIN Players ON Players.Player_no = Qual.Player_no LEFT JOIN Games ON Games.Game_id = Qual.Game_id WHERE Qual.Player_no = '$strPlayerno' AND Qual.Game_id = '$strGameid'";
        $sqlResultChk = MySQL_query($sqlChk,$db);
        
        echo "<p>$intRows post lades till: (text i <span class='nytext'>denna färg</span> lades till; resten fanns innan och är med för att hitta fel)</p>\n";
        echo "<table border='0' cellpadding='4'>";
        printf("<tr><td align='right'><i> Try_id: </td><td> <span class='nytext'>%d</span></i> </td></tr>\n",  MySQL_result($sqlResultChk,0,"Qual.Try_id"));
        printf("<tr><td align='right'><i> Spelarnummer: </td><td> <span class='nytext'>%d</span> </td></tr>\n", MySQL_result($sqlResultChk,0,"Qual.Player_no"));
        printf("<tr><td align='right'><i> Tag: </td><td> <span class='nytext'>%s</span> (%s) </td></tr>\n", MySQL_result($sqlResultChk,0,"Qual.Tag"), MySQL_result($sqlResultChk,0,"Players.Tag"));
        printf("<tr><td align='right'><i> Namn: </td><td> %s </td></tr>\n", MySQL_result($sqlResultChk,0,"Players.Name"));
        printf("<tr><td align='right'><i> Hemort: </td><td> %s </td></tr>\n", MySQL_result($sqlResultChk,0,"Players.City"));
        printf("<tr><td align='right'><i> Spelnummer: </td><td> <span class='nytext'>%d</span> </td></tr>\n", MySQL_result($sqlResultChk,0,"Qual.Game_id"));
        printf("<tr><td align='right'><i> Spelnamn: </td><td> %s </td></tr>\n", MySQL_result($sqlResultChk,0,"Games.Game_name"));
        printf("<tr><td align='right'><i> Spelpoäng: </td><td> <span class='nytext'>%s</span></i> </td></tr>\n", number_format(MySQL_result($sqlResultChk,0,"Qual.Game_points"), 0, ',', ' '));
        printf("<tr><td align='right'><i> Kvalpoäng: </td><td> <span class='nytext'>%s</span></i> </td></tr>\n", MySQL_result($sqlResultChk,0,"Qual.Qual_points"));
        echo "</table>\n";
        }
    }

echo "\n\n<hr><br>\n\n";


echo "<p>Fyll i rutorna och klicka Skicka. På sidan som dyker opp då står uppgifterna överst - KONTROLLERA att det bidde rätt! Fel fixas i efterhand av Cab, om ni noterar vilket Try_id det gäller.</p>\n\n";


$strThisfile = basename($_SERVER['PHP_SELF']);
echo "<form name='frmInput' action='$strThisfile' method='post'>\n";
echo "<p><table border='0' cellpadding='4'>\n";
echo "  <tr><td> SpelARnummer: </td><td> <input type='text' name='txtPlayerno' size='5' maxlength='3'> </td></tr>\n";
echo "  <tr><td> Tag: </td><td> <input type='text' name='txtTag' size='5' maxlength='3'> </td></tr>\n";
echo "  <tr><td> Spelnummer: </td><td> <input type='text' name='txtGameid' size='5' maxlength='2'> </td></tr>\n";
echo "  <tr><td> Spelpoäng: </td><td> <input type='text' name='txtPoints' size='15' maxlength='15'> </td></tr>\n";

MySQL_close($db);
php?>
        </table><br><br>
        
        <input type="submit" value="Skicka"> &nbsp;&nbsp; <input type="reset" value="Återställ"></p><br><br>
      </form>


<hr><br>

A Calle Be production.<br>

</body></html>