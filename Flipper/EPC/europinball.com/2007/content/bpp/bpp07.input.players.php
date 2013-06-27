<html>
<head>
<link href="epc07.css" rel="stylesheet" type="text/css">
<body>


<h2>INSKRIVNING AV SPELARE I EPC07</h2>

<?php
include("header.php");

$PLAYERS = 50;   // number of players

$arrTags    = array();
$arrNames   = array();
$arrCities  = array();
for($c=1;$c<=$PLAYERS;$c++)
    {
    $arrTags[$c]   = $_POST["txtTag$c"];
    $arrNames[$c]  = $_POST["txtName$c"];
    $arrCities[$c] = $_POST["txtCity$c"];
    }

// open connection
$db = MySQL_connect("localhost", "europinb", "38Pw9962");
MySQL_select_db("europinb_qualtest", $db);

$intRows = 0;
for($c=1;$c<=$PLAYERS;$c++)
    {
    if($arrTags[$c] != '')
        {
        $sql = "UPDATE Players SET Tag='$arrTags[$c]', Name='$arrNames[$c]', City='$arrCities[$c]' WHERE Player_no = '$c'";
        $sqlResult = MySQL_query($sql,$db);
        $intRows += MySQL_affected_rows();
        echo "Tag: <span class='nytext'>$arrTags[$c]</span>, Namn: <span class='nytext'>$arrNames[$c]</span>, City: <span class='nytext'>$arrCities[$c]</span><br>\n";
        }
    }

echo "<p>$intRows poster ändrades.</p>\n";


echo "\n\n<hr><br>\n\n";

echo "<p>Fyll i namnen på spelarna. Om det nuvarande är ok, lämna fältet tomt. För att ta bort ett namn, skriv bara ett mellanslag.</p>\n\n";

$strThisfile = basename($_SERVER['PHP_SELF']);
echo "<form name='frmInput' action='$strThisfile' method='post'>\n";
echo "<p><table border='0' cellpadding='4'>\n";
echo "  <tr><td> Spelar- </td><td> Tag:   </td><td> Namn:  </td><td> Hemort: </td><td> Tag:  </td><td> Namn:   </td><td> Hemort:  </td></tr>\n";
echo "  <tr><td> nummer: </td><td> &nbsp; </td><td> &nbsp; </td><td> &nbsp; </td><td> &nbsp; </td><td> &nbsp; </td><td> &nbsp; </td></tr>\n";

$sql = "SELECT * FROM Players";
$sqlResult = MySQL_query($sql,$db);

for($c=1;$c<=$PLAYERS;$c++)
    {
    printf("<tr><td align='center'> $c </td><td> <a href=\"bpp07.showentry.php?id=$c\">%s</a> </td><td> %s </td><td> %s </td><td> <input type='text' name='txtTag$c' size='5' maxlength='3'> </td><td> <input type='text' name='txtName$c' size='35' maxlength='35'> </td><td> <input type='text' name='txtCity$c' size='35' maxlength='35'> </td></tr>\n",  MySQL_result($sqlResult,$c-1,"Tag"),  MySQL_result($sqlResult,$c-1,"Name"),  MySQL_result($sqlResult,$c-1,"City"));
    }

MySQL_close($db);
php?>
        </table><br><br>
        
        <input type="submit" value="Skicka"> &nbsp;&nbsp; <input type="reset" value="Återställ"></p><br><br>
      </form>


<hr><br>

A Calle Be production.<br>

</body></html>