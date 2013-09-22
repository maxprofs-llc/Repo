<html>
<head>
  <title>POÄNGINPUT SM07</title>
  <link href="sm07.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="document.frmInput.cmbPlayer.focus();">


<h2>INSKRIVNING AV POÄNG I SM07</h2>

<?php
include("sm07.header.php");

$aryPlayer   = explode(";", $_POST["cmbPlayer"]);
$strPlayerno = $aryPlayer[0];
$strTag      = $aryPlayer[1];
$strGameid   = $_POST["cmbGameid"];
$strPoints   = str_replace (" ", "", $_POST["txtPoints"]);


// open connection
$db = MySQL_connect("localhost", "sm", "slamtilt");
MySQL_select_db("sm07", $db);

$sqlCalc = "SELECT * FROM Games ORDER BY Game_id";
$sqlResultGames = MySQL_query($sqlCalc,$db);
$intRowsGames = MYSQL_num_rows($sqlResultGames);


if(isset($_POST["txtPoints"]))    // if data is submitted, add the new posts
    {
    // check input fields
    if($strPlayerno == '' or $strTag == '' or $strGameid == '' or $strPoints == '')  {
        echo "<p>Näääääe, nu glömde du fylla i nåt av fälten. Fyll i ALLA rutorna!</p>\n";  }
    else
        {
        // insert new post
        $sql = "INSERT INTO Qual (Player_no, Tag, Game_id, Game_points) VALUES ('$strPlayerno','$strTag','$strGameid','$strPoints')";
        $sqlResult = MySQL_query($sql,$db);
        $intRows = MySQL_affected_rows();
        
        
        // recalculate qualification points
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
        printf("  <tr><td align='right'><i> Try_id: </td><td> <span class='nytext'>%d</span></i> </td></tr>\n",  MySQL_result($sqlResultChk,0,"Qual.Try_id"));
        printf("  <tr><td align='right'><i> Spelare: </td><td> <span class='nytext'>%d</span>: <span class='nytext'>%s</span> (<span class='nytext'>%s</span>, <span class='nytext'>%s</span>) </td></tr>\n", MySQL_result($sqlResultChk,0,"Qual.Player_no"), MySQL_result($sqlResultChk,0,"Qual.Tag"), MySQL_result($sqlResultChk,0,"Players.Name"), MySQL_result($sqlResultChk,0,"Players.City"));
        printf("  <tr><td align='right'><i> Spel: </td><td> <span class='nytext'>%s</span>: <span class='nytext'>%s</span> </td></tr>\n", MySQL_result($sqlResultChk,0,"Qual.Game_id"), MySQL_result($sqlResultChk,0,"Games.Game_name"));
        printf("  <tr><td align='right'><i> Spelpoäng: </td><td> <span class='nytext'>%s</span></i> </td></tr>\n", number_format(MySQL_result($sqlResultChk,0,"Qual.Game_points"), 0, ',', ' '));
        printf("  <tr><td align='right'><i> Kvalpoäng: </td><td> <span class='nytext'>%s</span></i> </td></tr>\n", MySQL_result($sqlResultChk,0,"Qual.Qual_points"));
        echo "</table>\n";
        }
    }

echo "\n\n<hr>\n\n";


echo "<p>Fyll i rutorna och klicka Skicka. På sidan som dyker opp då står uppgifterna överst - KONTROLLERA att det bidde rätt! Fel kan fixas i efterhand genom att klicka på 'Ta väck!' i Resultatlistan eller av Cabben, om ni noterar vilket Try_id det gäller.</p>\n\n";


$strThisfile = basename($_SERVER['PHP_SELF']);
echo "<form name='frmInput' action='$strThisfile' method='post'>\n";
echo "  <p><table border='0' cellpadding='4'>\n";
echo "    <tr><td> Spelare: </td><td>\n      <select name='cmbPlayer'>\n        <option value='' selected='selected'> Välj spelare här </option>\n";
$sql = "SELECT * FROM Players ORDER BY Player_no";
$sqlResult = MySQL_query($sql,$db);
$intPlayers = MySQL_num_rows($sqlResult);
for($c=0; $c<$intPlayers; $c++)  {
    printf("        <option value='%s'> %s </option>\n", MySQL_result($sqlResult,$c,"Player_no") .";". MySQL_result($sqlResult,$c,"Tag"), MySQL_result($sqlResult,$c,"Player_no") .": ". MySQL_result($sqlResult,$c,"Tag") ." (". MySQL_result($sqlResult,$c,"Name") .")");  }
echo "      </select>\n    </td></tr>\n";
echo "    <tr><td> Spelbokstav: </td><td>\n      <select name='cmbGameid'>\n        <option value='' selected='selected'> Välj spel här </option>\n";
for($c=0; $c<$intRowsGames; $c++)  {
    printf("        <option value='%s'> %s </option>\n", MySQL_result($sqlResultGames,$c,"Game_id"), MySQL_result($sqlResultGames,$c,"Game_id") .": ". MySQL_result($sqlResultGames,$c,"Game_name"));  }
echo "      </select>\n    </td></tr>\n";
echo "    <tr><td> Spelpoäng: </td><td> <input type='text' name='txtPoints' size='15' maxlength='15'> </td></tr>\n";

MySQL_close($db);
php?>
  </table><br><br>
  
  <input type="submit" value="Skicka"> &nbsp;&nbsp; <input type="reset" value="Återställ"></p><br><br>
</form>


<hr><br>

A Calle Be production.<br>

</body></html>