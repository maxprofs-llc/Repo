<html>
<head>
<link href="epc07.css" rel="stylesheet" type="text/css">
<body>


<h2>INSKRIVNING AV SPEL I EPC07</h2>

<?php
include("header.php");

$GAMES = 6;   // number of games

$arrGames  = array();
for($c=1;$c<=$GAMES;$c++)
    {
    $arrGames[$c]  = $_POST["txtGame$c"];
    }

// open connection
$db = MySQL_connect("localhost", "europinb", "38Pw9962");
MySQL_select_db("europinb_qualtest", $db);

$intRows = 0;
for($c=1;$c<=$GAMES;$c++)
    {
    if($arrGames[$c] != '')
        {
        $sql = "UPDATE Games SET Game_name='$arrGames[$c]' WHERE Game_id='$c'";
        $sqlResult = MySQL_query($sql,$db);
        $intRows += MySQL_affected_rows();
        echo "Id: <span class='nytext'>$c</span>, Namn: <span class='nytext'>$arrGames[$c]</span><br>\n";
        }
    }
 
echo "<p>$intRows poster ändrades.</p>\n";


echo "\n\n<hr><br>\n\n";

echo "<p>Fyll i namnen på spelen. Om det nuvarande är ok, lämna fältet tomt. För att ta bort ett namn, skriv bara ett mellanslag.</p>\n\n";

$strThisfile = basename($_SERVER['PHP_SELF']);
echo "<form name='frmInput' action='$strThisfile' method='post'>\n";
echo "<p><table border='0' cellpadding='4'>\n";
echo "  <tr><td> Spel-   </td><td> Spelnamn:   </td><td> Spelnamn: </td></tr>\n";
echo "  <tr><td> nummer: </td><td> (nuvarande) </td><td> (önskat)  </td></tr>\n";

$sql = "SELECT * FROM Games";
$sqlResult = MySQL_query($sql,$db);

for($c=1;$c<=$GAMES;$c++)
    {
    printf("<tr><td align='center'> $c </td><td> <a href=\"bpp07.showgame.php?id=$c\">%s</a> </td><td> <input type='text' name='txtGame$c' size='35' maxlength='35'> </td></tr>\n",  MySQL_result($sqlResult,$c-1,"Game_name"));
    }

MySQL_close($db);
php?>
        </table><br><br>
        
        <input type="submit" value="Skicka"> &nbsp;&nbsp; <input type="reset" value="Återställ"></p><br><br>
      </form>


<hr><br>

A Calle Be production.<br>

</body></html>