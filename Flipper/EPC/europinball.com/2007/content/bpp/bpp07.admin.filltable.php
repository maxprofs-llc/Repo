<html>
<head>
<link href="epc07.css" rel="stylesheet" type="text/css">
<body>


<h2>FILLTABLE</h2>

<?php
include("header.php");

$strTable = $_POST["txtTable"];  

if (isset($_POST["txtTable"]))    // if data is submitted, add the new posts
    {
    $ROWS = $_POST["txtRows"];   // number of rows to fill
    
    // open connection
    $db = MySQL_connect("localhost", "europinb", "38Pw9962");
    MySQL_select_db("europinb_qualtest", $db);
    
    $intRows = 0;
    for($c=1;$c<=$ROWS;$c++)
        {
        $sql = "INSERT INTO $strTable () VALUES ()";
        $sqlResult = MySQL_query($sql,$db);
        $intRows += MySQL_affected_rows();
        }
     
    echo "<p>$intRows poster ändrades.</p>\n";
    MySQL_close($db);
    }


echo "\n\n<hr><br>\n\n";

$strThisfile = basename($_SERVER['PHP_SELF']);
echo "<form name='frmInput' action='$strThisfile' method='post'>\n";
echo "<p>Namnet på tabellen: <input type='text' name='txtTable' size='35' maxlength='35'> </p><br>\n";
echo "<p>Antal rader att fylla: <input type='text' name='txtRows' size='35' maxlength='35'> </p><br>\n";

php?>    
        <input type="submit" value="Skicka"> &nbsp;&nbsp; <input type="reset" value="Återställ"></p><br><br>
      </form>


<hr><br>

A Calle Be production.<br>

</body></html>