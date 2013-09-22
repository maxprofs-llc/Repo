<html>
<head>
<link href="classics07.css" rel="stylesheet" type="text/css">
<body>


<h2>INSKRIVNING AV SPEL I CLASSICS07</h2>

<?php
include("classics07.header.php");

// open connection
$db = MySQL_connect("localhost", "sm", "slamtilt");
MySQL_select_db("classics07", $db);

$sql = "SELECT * FROM Games ORDER BY Game_id";
$sqlResultGames = MySQL_query($sql,$db);
$intGames = MYSQL_num_rows($sqlResultGames);    // number of games

$aryGameNames = array();
$aryGameAbbs = array();
$aryGameIds = array();
for($c=0; $c<$intGames; $c++)
    {
    $aryGameNames[$c] = $_POST["txtGameName$c"];
    $aryGameAbbs[$c]  = strtoupper($_POST["txtGameAbb$c"]);
    $aryGameIds[$c]   = MySQL_result($sqlResultGames, $c, "Game_id");
    }

$intRows = 0;
for($c=0; $c<$intGames; $c++)
    {
    if($aryGameNames[$c] != '' or $aryGameAbbs[$c] != '')
        {
        if($aryGameNames[$c] == '')  {
            $aryGameNames[$c] = MySQL_result($sqlResultGames, $c, "Game_name");  }
        if($aryGameAbbs[$c] == '')  {
            $aryGameAbbs[$c] = MySQL_result($sqlResultGames, $c, "Game_abb");  }
        
        $sql = "UPDATE Games SET Game_name='$aryGameNames[$c]',Game_abb='$aryGameAbbs[$c]' WHERE Game_id='$aryGameIds[$c]'";
        $sqlResult = MySQL_query($sql,$db);
        $intRows += MySQL_affected_rows();
        echo "Id: $aryGameIds[$c], Namn: <span class='nytext'>$aryGameNames[$c]</span> (<span class='nytext'>$aryGameAbbs[$c]</span>)<br>\n";
        }
    }
 
echo "<p>$intRows poster ändrades.</p>\n";


echo "\n\n<hr><br>\n\n";

echo "<p>Fyll i namnen på spelen. Om det nuvarande är ok, lämna fältet tomt. För att ta bort ett fält, skriv bara ett mellanslag i rutan.</p>\n\n";

$strThisfile = basename($_SERVER['PHP_SELF']);
echo "<form name='frmInput' action='$strThisfile' method='post'>\n";
echo "  <p><table border='0' cellpadding='4'>\n";
echo "    <tr><td> Spel-    </td><td> Spelnamn:   </td><td> Förk: </td><td> Spelnamn: </td><td> Förk:  </td></tr>\n";
echo "    <tr><td> bokstav: </td><td> (nuvarande) </td><td> (nuv) </td><td> (önskat)  </td><td> (önsk) </td></tr>\n";
$sql = "SELECT * FROM Games ORDER BY Game_id";
$sqlResultGames = MySQL_query($sql,$db);
$intGames = MYSQL_num_rows($sqlResultGames);    // number of games
for($c=0; $c<$intGames; $c++)  {
    printf("    <tr><td align='center'> %s </td><td> <a href=\"sm07.showgame.php?id=%s\">%s</a> </td><td> %s </td><td> <input type='text' name='txtGameName$c' size='35' maxlength='35'> </td><td> <input type='text' name='txtGameAbb$c' size='6' maxlength='6'> </td></tr>\n", MySQL_result($sqlResultGames,$c,"Game_id"), MySQL_result($sqlResultGames,$c,"Game_id"), MySQL_result($sqlResultGames,$c,"Game_name"), MySQL_result($sqlResultGames,$c,"Game_abb"));  }

MySQL_close($db);
php?>
  </table><br><br>
  
  <input type="submit" value="Skicka"> &nbsp;&nbsp; <input type="reset" value="Återställ"></p><br><br>
</form>


<hr><br>

A Calle Be production.<br>

</body></html>