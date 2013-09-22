<?php


// open connection
    $db = MySQL_connect("localhost", "flippersm", "nf7JcYqJmYT8ymCE");
    MySQL_select_db("flippersm_test", $db);

$no = mysql_real_escape_string($_GET['person_no']);
$pass = mysql_real_escape_string($_GET['pass']);

    
// input data
    $sql = "UPDATE sm_2012_funkis SET Person_no = $no WHERE Funk_id = $pass";
    $sqlResult = MySQL_query($sql,$db);
    $intRows = MySQL_affected_rows();


		$sql = "SELECT Tag, Firstname, Lastname FROM sm_2012_anmalda WHERE No = $no";
		$result = mysql_query($sql, $db);
		while ($row = mysql_fetch_array($result)) {
			$tag = $row['Tag'];
			$fnamn = $row['Firstname'];
			$lnamn = $row['Lastname'];
			$mail = $row['Email'];
		}
    
    MySQL_close($db);
    
 //   $booAdminMail = mail("hans@hulabeck.se", "Funkisanmälan - $tag: $pass", "Nu har ett funkispass fått sin funktionär.", "From: SM 2012 <webb@flippersm.se>");

    $booPlayerMail = mail($mail, "Funktionär på flipper-SM 2012", "Tack!\n\nDu har nu anmält dig som funktionär till Flipper-SM, 16-18 november 2012!\n\nDitt pass är nummer $pass, som du kan se på funkisschema-sidan på www.flippersm.se", "From: Flipper-SM 2012 <hans@hulabeck.se>");
    
    // && $booAdminMail
    if($intRows == 1  && $booPlayerMail)
        {
        echo "<h1>Anmälan - Funktionär</h1>\n\n";
        

        echo "<div class=\"bred\">";
        echo "<h2>Tack för din insats på Flipper-SM 2012</h2>\n\n";
        
        echo "<p>Ett mail har nu skickats till $mail med ungefär samma information som här. Titta gärna på funkis-schemat på www.flippersm.se för att hålla dig uppdaterad.";
        echo "<p>Kontaktperson vid fr&aring;gor om anm&auml;lan: <a href='mailto:hans@hulabeck.se'>Hans Andersson</a></p>\n";
        echo "</div>";
        }
    else
        {
        echo "<h1>Ett fel uppstod</h1>\n\n";
        

        echo "<div class=\"bred\">";
        echo "<p>N&aring;got gick fel n&auml;r anm&auml;lan skulle skickas.</p>\n
        <p>Troligtvis fungerade det inte att skicka ditt bekr&auml;ftelsemail, men din anm&auml;lan kan ha registrerats &auml;nd&aring;. F&ouml;r mer information om vad som st&aring;r i din anm&auml;lan kontakta <a href='mailto:hans@hulabeck.se'>Hans Andersson</a>. <strong>Felkod: 1</strong></p>\n\n";
        echo "</div>";

        }

echo "<a href = 'http://www.flippersm.se'>Gå tillbaka till flipper-SM-sajten.</a>";
    

?>
