<html>
<head>
<link href="classics07.css" rel="stylesheet" type="text/css">
<body>


<h2>INSKRIVNING AV SPELARE I CLASSICS07</h2>

<?php
include("classics07.header.php");

// open connection
$db = MySQL_connect("localhost", "sm", "slamtilt");
MySQL_select_db("classics07", $db);

$sqlPlayers = "SELECT * FROM Players ORDER BY Player_no";
$sqlResultPlayers = MySQL_query($sqlPlayers,$db);
$intPlayers = MYSQL_num_rows($sqlResultPlayers);    // number of players


$aryTags    = array();
$aryNames   = array();
$aryCities  = array();
for($c=0; $c<$intPlayers; $c++)
    {
    $aryNos[$c]    = MySQL_result($sqlResultPlayers,$c,"Player_no");
    $aryTags[$c]   = strtoupper($_POST["txtTag$c"]);
    $aryNames[$c]  = ucwords(strtolower($_POST["txtName$c"]));
    $aryCities[$c] = ucwords(strtolower($_POST["txtCity$c"]));
    }

$intRows = 0;
for($c=0; $c<$intPlayers; $c++)
    {
    if($aryTags[$c] == ' ' and $aryNames[$c] == ' ' and $aryCities[$c] == ' ')
        {
        $sql = "DELETE FROM Players WHERE Player_no = '$aryNos[$c]'";
        $sqlResult = MySQL_query($sql,$db);
        $intRows += MySQL_affected_rows();
        if($intRows)  {
            echo "Följande post togs bort: <span class='nytext'>". MySQL_result($sqlResultPlayers,$c,"Player_no") ."</span>: <span class='nytext'>". MySQL_result($sqlResultPlayers,$c,"Tag") ."</span> (<span class='nytext'>". MySQL_result($sqlResultPlayers,$c,"Name") ."</span>, <span class='nytext'>". MySQL_result($sqlResultPlayers,$c,"City") ."</span>).<br>\n";  }
        else  {
            echo "Ingen post togs bort!<br>\n";  }
        }
    elseif($aryTags[$c] != '' or $aryNames[$c] != '' or $aryCities[$c] != '')
        {
        if($aryTags[$c] == '')  {
            $aryTags[$c] = MySQL_result($sqlResultPlayers, $c, "Tag");  }
        if($aryNames[$c] == '')  {
            $aryNames[$c] = MySQL_result($sqlResultPlayers, $c, "Name");  }
        if($aryCities[$c] == '')  {
            $aryCities[$c] = MySQL_result($sqlResultPlayers, $c, "City");  }
        
        $sql = "UPDATE Players SET Tag='$aryTags[$c]', Name='$aryNames[$c]', City='$aryCities[$c]' WHERE Player_no = '$aryNos[$c]'";
        $sqlResult = MySQL_query($sql,$db);
        $intRows += MySQL_affected_rows();
        echo "No: $aryNos[$c], Tag: <span class='nytext'>$aryTags[$c]</span>, Namn: <span class='nytext'>$aryNames[$c]</span>, City: <span class='nytext'>$aryCities[$c]</span><br>\n";
        }
    }

echo "<p>$intRows poster ändrades.</p>\n";


echo "\n\n<hr><br>\n\n";

if(isset($_POST["txtNewNo"]))    // if data is submitted, add the new posts
    {
    $intNewNo    = $_POST["txtNewNo"];
    $strNewTag   = strtoupper($_POST["txtNewTag"]);
    $strNewName  = ucwords(strtolower($_POST["txtNewName"]));
    $strNewCity  = ucwords(strtolower($_POST["txtNewCity"]));
    
    $sql = "SELECT Player_no FROM Players WHERE Player_no='$intNewNo'";
    $sqlResult = MySQL_query($sql,$db);
    $intNew = MYSQL_num_rows($sqlResult);
    if($intNew == 0)
        {
        $sql = "INSERT INTO Players (Player_no, Tag, Name, City) VALUE ($intNewNo, '$strNewTag', '$strNewName', '$strNewCity')";
        $sqlResult = MySQL_query($sql,$db);
        echo "<p>Ny person tillagd!<br>\n <span class='nytext'>$intNewNo</span>: <span class='nytext'>$strNewTag</span> (<span class='nytext'>$strNewName</span>, <span class='nytext'>$strNewCity</span>).</p><br>\n";
        }
    else  {
        echo "<p>Felaktigt spelarnummer ($intNewNo). Det fanns redan. Försök igen!</p><br>\n";  }
    }
        


echo "<p>Här kan du lägga till en ny spelare:<br>\n";
$strThisfile = basename($_SERVER['PHP_SELF']);
echo "<form name='frmInput' action='$strThisfile' method='post'>\n";
echo "  <p><table border='0' cellpadding='4'>\n";
echo "    <tr><td> Spelar- </td><td> Tag:   </td><td> Namn:  </td><td> Hemort: </td></tr>\n";
echo "    <tr><td> nummer: </td><td> &nbsp; </td><td> &nbsp; </td><td> &nbsp;  </td></tr>\n";
echo "    <tr><td> <input type='text' name='txtNewNo' size='5' maxlength='3'>  </td><td> <input type='text' name='txtNewTag' size='5' maxlength='3'> </td><td> <input type='text' name='txtNewName' size='35' maxlength='35'> </td><td> <input type='text' name='txtNewCity' size='35' maxlength='35'> </td></tr>\n";
echo "  </table><br>\n";
echo "  <input type='submit' value='Skicka'> &nbsp;&nbsp; <input type='reset' value='Återställ'></p><br><br>\n\n";
echo "</form>\n";

echo "\n\n<hr><br>\n\n";

echo "<p>Fyll i namnen på spelarna. Om det nuvarande är ok, lämna fältet tomt. För att ta bort ett namn, skriv bara ett mellanslag.</p>\n\n";

echo "<form name='frmInput' action='$strThisfile' method='post'>\n";
echo "  <p><table border='0' cellpadding='4'>\n";
echo "    <tr><td> Spelar- </td><td> Tag:   </td><td> Namn:  </td><td> Hemort: </td><td> Tag:  </td><td> Namn:   </td><td> Hemort:  </td></tr>\n";
echo "    <tr><td> nummer: </td><td> &nbsp; </td><td> &nbsp; </td><td> &nbsp; </td><td> &nbsp; </td><td> &nbsp;  </td><td> &nbsp;   </td></tr>\n";
$sqlResultPlayers = MySQL_query($sqlPlayers,$db);
$intPlayers = MYSQL_num_rows($sqlResultPlayers);    // number of players
for($c=0; $c<$intPlayers; $c++)  {
    printf("    <tr><td align='center'> %d </td><td> <a href=\"sm07.showentry.php?no=%d\">%s</a> </td><td> %s </td><td> %s </td><td> <input type='text' name='txtTag$c' size='5' maxlength='3'> </td><td> <input type='text' name='txtName$c' size='35' maxlength='35'> </td><td> <input type='text' name='txtCity$c' size='35' maxlength='35'> </td></tr>\n", MySQL_result($sqlResultPlayers,$c,"Player_no"), MySQL_result($sqlResultPlayers,$c,"Player_no"), MySQL_result($sqlResultPlayers,$c,"Tag"), MySQL_result($sqlResultPlayers,$c,"Name"), MySQL_result($sqlResultPlayers,$c,"City"));  }

MySQL_close($db);
php?>
  
  </table><br><br>
  
  <input type="submit" value="Skicka"> &nbsp;&nbsp; <input type="reset" value="Återställ"></p><br><br>
</form>


<hr><br>

A Calle Be production.<br>

</body></html>